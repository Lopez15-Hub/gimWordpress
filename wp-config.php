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
define( 'DB_USER', 'admin' );

/** MySQL database password */
define( 'DB_PASSWORD', 'admin' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',         '[7J{pV) ZmL2;+,[z;C*@u ]U j9ba%;vHOCfuFnX|Gj<9t5oP3lcjG}N8zqhAeE' );
define( 'SECURE_AUTH_KEY',  'hZm<H&:OmcQ*ESN6;v1-+NuCC]xdwgkK?[c<q.deS#<[Pe6 a$D97FFACx{9~Kh[' );
define( 'LOGGED_IN_KEY',    '/*/H^AYm&&c4Hz@ORa9ubD`4En[|3Ao%!g-3Yegn#[t-vuhWE`CmFf[imO8%>rwX' );
define( 'NONCE_KEY',        's=.:yj@q18H5X=>O1+RE8X8W/B0kR$RI[TUeWyGH>m|}R4PRpEA]iNp CS$iGhWH' );
define( 'AUTH_SALT',        'T/5(m;i)4LCB~wf}fwPG-;:SDnC1FsL HAFt W^j4C7Jm>7/&2E|6L/,Mb9cX /^' );
define( 'SECURE_AUTH_SALT', '>-9x+bT2[ydms6Tb{-t#Sx+UWdsi}M3[pCg6> KM>% TCFfwUFN.Fjii,ZDv4Z2k' );
define( 'LOGGED_IN_SALT',   'GM7&*hW.[+s.%tosvY~*U<]8n$iHu^M<|3z}IwbA+M8L:]dzf|4#3NEd :O*P~Pq' );
define( 'NONCE_SALT',       '_h/{(aJ)=XAcevD3E$t8IHd8(hO8:]GGRa*f__W~kyfL;%ZeK{L1l9NROYJ{g1G ' );

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

/*Multisitio*/
define('MULTISITE', true);
define('SUBDOMAIN_INSTALL', false);
define('DOMAIN_CURRENT_SITE', 'localhost');
define('PATH_CURRENT_SITE', '/wordpress/');
define('SITE_ID_CURRENT_SITE', 1);
define('BLOG_ID_CURRENT_SITE', 1);

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
