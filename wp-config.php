<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'preselectiontest-wp-nY3zOPJo' );

/** MySQL database username */
define( 'DB_USER', 'mWl71CR59yJY' );

/** MySQL database password */
define( 'DB_PASSWORD', 'BeTbrKGKxqDcE7D2' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          'j>` N.*+*hfudgw,7Tse3y 3xh0pI-4qJ!ldyAD^%r<a`Y*F3qj[+2fEy<sQCe/=' );
define( 'SECURE_AUTH_KEY',   '`} e()P(GIKM|=sgu#PzMRXoa=5YyPPvU&61S|2!lM)0Rz#R=/!jWba[ WR;l?_{' );
define( 'LOGGED_IN_KEY',     '9!NgZ|3+k&dD}>tsh;%>j|:SVs7n[9OQXNEMA.Sz(y(tBq^m?AG3{V~}`Y2Ai,|X' );
define( 'NONCE_KEY',         'CW&@AK#]SuH%cAP8sRbGa9dN9n&*IlFpH)KGIVcqz2qtU3paEtn8=f3+oW*( i[[' );
define( 'AUTH_SALT',         ' &x=j6R)AaO^E0m1b1;wHh!MO?dZFYpIeLg>?2wtQ~y_%[x?I,/s4AVVlEhLw8n.' );
define( 'SECURE_AUTH_SALT',  'N7h~_W,7#{4U%5-]-S(8/;[tJ^(L]zS&Uhpm.#{x/W]XQu#K?y}4}6twn+B<ae~H' );
define( 'LOGGED_IN_SALT',    'n#wo3jF2bUnV6O6>T9*Y-r|cfswoC|1lcSUf;k7xX=wxqy2;Xae?,?reDIdRGOC4' );
define( 'NONCE_SALT',        '4@neFEI=/086x0-u^S _S&>`|-sUwq<X{?n/W&4!(*-;~jRjyCKFvfA;YMx<,Gc0' );
define( 'WP_CACHE_KEY_SALT', 'f_A1^u=#3=B3b8+rXWx*sarJ)C1vbxi#  ?yoZYOiw$749S^fAZYt.d@2>Eo9#D~' );

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_c6c6341168_';


/* Change WP_MEMORY_LIMIT to increase the memory limit for public pages. */
define('WP_MEMORY_LIMIT', '256M');

/* Uncomment and change WP_MAX_MEMORY_LIMIT to increase the memory limit for admin pages. */
//define('WP_MAX_MEMORY_LIMIT', '256M');

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
