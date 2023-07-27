<?php
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
define( 'DB_NAME', 'industry' );

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
define( 'AUTH_KEY',         'BHq#AdQF:E`m?kvm<r074_wh_}UH`#V{vf+iBa`O^huT9x9u|1JfROY81%MEku&9' );
define( 'SECURE_AUTH_KEY',  'QgTGw*dV<6zW;X8fFJ~KB.dt,X.z}~<#-$jb05qPs)]2eyNT4dy#g->.@T4.DFI1' );
define( 'LOGGED_IN_KEY',    'OD |A%i]b9$4i%`>[Y4;I]vR5uy<_2kefkEa,Z?*M&(s VOHjx(eC;VrGfky }F;' );
define( 'NONCE_KEY',        '&HEVV9COQ}#sh}fKLquQtJSNZ<Oqj6)4{/I|$QNH%XXRg3BZrFve_(tv5$`*3J87' );
define( 'AUTH_SALT',        '!(knHL>m(-Y2Jj:?%eRo3K+k+DtIbOxI)bb/E3j)ibn>+Qpkx?{+Pi@N;@0dz<uJ' );
define( 'SECURE_AUTH_SALT', 'Q-(+zSd-e5DG^s<;JqE.v>J|R3q5kDw=k1rdxVTJh3Cfty4hA59C`!aodRT9crmO' );
define( 'LOGGED_IN_SALT',   'Es{`0q>)6(a6MujHesa`,WIXomjl@WDZ;Dwz(q7*1Dq*lUtCfs<{rZz!!*><*zgh' );
define( 'NONCE_SALT',       'O%7e1swLqvzdy7c%uDe2X;sL]PQ&)]dFd)cfkk0YxGy+@a>RyyJsD`Z:L.OCDx3o' );

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
