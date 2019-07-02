<?php

class Preselection {
    private static $initiated = false;
    const NONCE = 'preselection-update-key';
    public static function init() {
        if ( ! self::$initiated ) {
            self::init_hooks();
        }
    }
    /**
     * Initializes WordPress hooks
     */
    private static function init_hooks() {
        self::$initiated = true;
        add_filter( 'plugin_action_links_'.plugin_basename( PRESELECTION_PLUGIN_DIR . 'preselection.php'), array('Preselection','admin_plugin_settings_link' ) );
        add_action( 'admin_menu', array( 'Preselection', 'admin_menu' ), 5 );
        add_action( 'add_meta_boxes', array('Preselection','register_meta_boxes'));
        add_action( 'save_post', array('Preselection','save_product_meta_box') );
        add_action('wp_head',array('Preselection','generate_custom_robots_meta'),0);
        if(isset($_POST['action']) && $_POST['action']=='save_product_prefix')
            add_action( 'admin_post_save_product_prefix', array( 'Preselection','save_product_prefix'));
        if(get_option('preselection_product_prefix')!=''){
            add_filter( 'wpseo_title', array('Preselection','generate_custom_product_prefix_title'));
            add_filter( 'wp_title', array('Preselection','generate_custom_product_prefix_title'));
            add_filter( 'pre_get_document_title', array('Preselection','generate_custom_product_prefix_title'));
        }
    }

    public static function admin_plugin_settings_link( $links ) {

        $settings_link = '<a href="'.esc_url( self::get_page_url() ).'">'.__('Settings', 'preselection').'</a>';
        array_unshift( $links, $settings_link );
        return $links;
    }

    public static function admin_menu() {
        self::load_menu();
    }

    public static function load_menu() {

        $hook = add_menu_page( __('PreSelection Config', 'preselection'), __('PreSelection', 'preselection'), 'manage_options', 'preselection-config', array( 'Preselection', 'render_prefix_page' ) );

    }



    public function register_meta_boxes(){
        add_meta_box( 'indexing', __( 'Indexing', 'preselection' ), array('Preselection','render_meta_box_content'), 'product' );
    }

    public function render_meta_box_content(){
        global $post;
        //fetch the current saved indexing meta key
        $value = get_post_meta( $post->ID, 'preselection_indexing_meta_key', true );
        // Display the form, using the current value.
        ?>
        <label for="preselection_indexing">
            <?php _e( 'NoIndex', 'preselection' ); ?>
        </label>
        <input type="checkbox" id="preselection_indexing" name="preselection_indexing" value="yes" size="25" <?=($value)?'checked':'';?> />
        <?php
    }

    public function save_product_meta_box($post_id){
        // Check if our nonce is set.
        if ( ! isset( $_POST['_wpnonce'] ) ) {
            return $post_id;
        }

        /*
         * If this is an autosave, our form has not been submitted,
         * so we don't want to do anything.
         */
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return $post_id;
        }

        // Check the user's permissions.
        if ( 'product' == $_POST['post_type'] ) {
            if ( ! current_user_can( 'edit_page', $post_id ) ) {
                return $post_id;
            }
        } else {
            if ( ! current_user_can( 'edit_post', $post_id ) ) {
                return $post_id;
            }
        }
        // Sanitize the user input.
        $index_field = sanitize_text_field( $_POST['preselection_indexing'] );

        // Update the meta field.
        update_post_meta( $post_id, 'preselection_indexing_meta_key', $index_field );
    }

    public function generate_custom_robots_meta(){

        if(get_post_type()=='product'){
            global $wp_query;
            $post_id = $wp_query->post->ID;
            $index_meta_field=get_post_meta($post_id,'preselection_indexing_meta_key',true);
            if(!empty($index_meta_field) && $index_meta_field== 'yes'){
                echo '<meta name="robots" content="noindex" /> ';
            }
        }
    }
    public function generate_custom_product_prefix_title($title){
        if(get_post_type()=='product')
        {
            global $wp_query;
            return get_option('preselection_product_prefix').$wp_query->post->post_title.' &#8211; '.get_bloginfo('name');
        }
    }

    public static function render_prefix_page() {
        Preselection::view('settings');
    }

    public function save_product_prefix(){
        if( isset( $_POST['_wpnonce'] ) && wp_verify_nonce( $_POST['_wpnonce'], 'preselection-update-key') ) {
           update_option('preselection_product_prefix',$_POST['preselection_product_prefix']);
           wp_redirect($_POST['_wp_http_referer']);
        }
    }

    public static function view( $name, array $args = array() ) {
        $args = apply_filters( 'preselection_view_arguments', $args, $name );

        foreach ( $args AS $key => $val ) {
            $$key = $val;
        }

        load_plugin_textdomain( 'preselection' );

        $file = PRESELECTION_PLUGIN_DIR . 'views/'. $name . '.php';

        include( $file );
    }



    public static function get_page_url( $page = 'config' ) {

        $args = array( 'page' => 'preselection-config' );
        $url = add_query_arg( $args, admin_url( 'options-general.php' ) );
        return $url;
    }

    /**
     * Attached to activate_{ plugin_basename( __FILES__ ) } by register_activation_hook()
     * @static
     */
    public static function plugin_activation() {
        if ( version_compare( $GLOBALS['wp_version'], PRESELECTION_MINIMUM_WP_VERSION, '<' ) ) {
            load_plugin_textdomain( 'preselection' );

            $message = '<strong>'.sprintf(esc_html__( 'PreSelection %s requires WordPress %s or higher.' , 'preselection'), PRESELECTION_VERSION, PRESELECTION_MINIMUM_WP_VERSION ).'</strong> '.sprintf(__('Please <a href="%1$s">upgrade WordPress</a> to a current version.', 'preselection'), 'https://codex.wordpress.org/Upgrading_WordPress', 'https://preselectiontest.matrixmarketers.com');

            Preselection::release_activation_resources( $message );
        }
    }

    private static function release_activation_resources( $message, $deactivate = true ) {
        ?>
        <!doctype html>
        <html>
        <head>
            <meta charset="<?php bloginfo( 'charset' ); ?>" />
        </head>
        <body>
        <p><?php echo esc_html( $message ); ?></p>
        </body>
        </html>
        <?php
        if ( $deactivate ) {
            $plugins = get_option( 'active_plugins' );
            $preselection = plugin_basename( PRESELECTION_PLUGIN_DIR . 'preselection.php' );
            $update  = false;
            foreach ( $plugins as $i => $plugin ) {
                if ( $plugin === $preselection ) {
                    $plugins[$i] = false;
                    $update = true;
                }
            }

            if ( $update ) {
                update_option( 'active_plugins', array_filter( $plugins ) );
            }
        }
        exit;
    }

    /**
     * Removes all connection options
     * @static
     */
    public static function plugin_deactivation( ) {
        flush_rewrite_rules();
    }
}

