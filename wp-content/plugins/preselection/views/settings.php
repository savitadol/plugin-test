<div>
    <h2>Settings</h2>
    <form action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="POST">

        <table class="form-table">
            <tr valign="top">
                <th scope="row">Product Titles Prefix</th>
                <td><input type="text" name="preselection_product_prefix" placeholder="Write prefix here..." value="<?php echo esc_attr( get_option('preselection_product_prefix') ); ?>" /><br><i>Add a prefix to a single product page titles</i></td>
                <input type="hidden" name="action" value="save_product_prefix">
            </tr>
        </table>
        <?php wp_nonce_field(Preselection::NONCE) ?>
        <?php submit_button(); ?>
    </form>
</div>
