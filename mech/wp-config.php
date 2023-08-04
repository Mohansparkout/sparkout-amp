<?php
define('WP_CACHE', true); // WP-Optimize Cache
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */
// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'mech' );
/** Database username */
define( 'DB_USER', 'root' );
/** Database password */
define( 'DB_PASSWORD', '' );
/** Database hostname */
define( 'DB_HOST', 'localhost' );
/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );
/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );
/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'i%KbP4)T-!dtQDJ5B($+=qFH(w$u2!N=UYr`?PeRx,26L_&}TG]+iv^}<K?VM+Ma' );
define( 'SECURE_AUTH_KEY',  '}_MdR[;4A]OC6#Z%Im/Bdl{CO:KVm^y&eH+$M >?.eb7}cFhY~Vz6pb@e6Pu})-w' );
define( 'LOGGED_IN_KEY',    'g_x~%Sirh1Tr!;+oo^O<h[9~zcs&kaIVss1WN(c1PBFrc1Z}hKMy7EOk@OQTX]@Q' );
define( 'NONCE_KEY',        '8Z!Amq*RyN~?=&^LHz^Y.[$b9gwEo2?i$N<<na@CebCp>CGZZb`!n[D;ibRdO.M)' );
define( 'AUTH_SALT',        'e8NGlet:IgZ&d`u1$#}qfky!/7RWMN8w7(kmugf/y> yzOv%jV{8rg{$p6LUGq>@' );
define( 'SECURE_AUTH_SALT', ']l*BfxzUQ+uY}w[PrvGG;kV0Q^pigk(p=qn&Pv*]BlL{7>SD2)h9z+{?|U1tq<i(' );
define( 'LOGGED_IN_SALT',   'hM6]JZssB-+Exe6sVq|-q11``zFW-tynkn(0J4MQ0Xh}d!M] klhH;JM?KYPTM6<' );
define( 'NONCE_SALT',       'DuPO-q_t0,&)[c9pE:)aZ_8}#+cI=$mT1sa4rp=TGq(J2AP^9Q8tkh`H.[q%j3;d' );
/**#@-*/
/**
 * WordPress database table prefix.
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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );
/* Add any custom values between this line and the "stop editing" line. */
/* That's all, stop editing! Happy publishing. */
/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}
/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';