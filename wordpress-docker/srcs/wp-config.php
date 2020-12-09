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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** MySQL database username */
define( 'DB_USER', 'wp' );

/** MySQL database password */
define( 'DB_PASSWORD', 'wp123' );

/** MySQL hostname */
define( 'DB_HOST', 'mysql' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'M3!V3,]dS8tfP3V0H3ITO58.kYjpUS6P5dEg/C&{|GaWWYPC+4eRtbbKhA!t3^d|' );
define( 'SECURE_AUTH_KEY',  '(-QjlNv+SF@>#ul4CQ47#DEdD4I91fmH~KZMUW-aJOBG0n:)O`hnBp/u9vjG<$PB' );
define( 'LOGGED_IN_KEY',    ')~wE|, F!Lo9+so-UYxmd/s^~{-%SaVdKK,AK^oci$7DRJF,{7_:=4bB0C`/)O`}' );
define( 'NONCE_KEY',        'w({e{NsmJq}QfjNq}I~;Un|<~;4mXPC0Z9|VIxX5khfN;#@Xhp*IpKEnsJQJ`{k=' );
define( 'AUTH_SALT',        'DWI6J>0_M_$ADzM*fcGn(S_mvLs+tPLAFqa$DknK|D=5eU[c Pi%1|9b=vL+$W_H' );
define( 'SECURE_AUTH_SALT', 'x[!@9[F YV%TU3oE+pPC@pWZ+{l{h/OA|oR^c)W[w1<x0(tU`Y`GtltZ|@ XMxJ/' );
define( 'LOGGED_IN_SALT',   '5iZDJ*>TxjScNu@@<G#!Li;1BT5ZXfJ4F@;WLN0<6?/uAn5VuWM%Oa>ks9V*=[1O' );
define( 'NONCE_SALT',       '~4H)@f:wNQ;<m1Ly 1ah}WYJ2bti}Qtc_S.//o@QND*k>BQt%a60t!Y]5Ruf%b-I' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

