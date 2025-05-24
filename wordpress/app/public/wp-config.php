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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          'nfoDbHw7ZNAgy()p/&y2%E$kP-oP<-ktY,_a@y9~eZm#7Dz1x2:0V2,P!&P+x%*J' );
define( 'SECURE_AUTH_KEY',   'o!)w7m(G>O2p;~zdQXHO(fjzVb^yw}:`U.-fc~Ma2Y gda)v0 %7ELA98xVVh(CA' );
define( 'LOGGED_IN_KEY',     'e)pvFR{]*{AS LQ?BY~OAf;(Goh~R30DRQsz7ati8I-1}p|*STP7*D>lQKa&teuD' );
define( 'NONCE_KEY',         'a O)BH{~Ea~Z8zwn-e#gd!oak 2tLus~a/U5Y<C[.GHTGlw+v(a#Spg>e4^|6BhW' );
define( 'AUTH_SALT',         'HyY]-omI7Qc}r$AcqED<AVzEt:@RIsCuEl]=E9-|ya1E?@3ShAY;8k&?I+EV6;la' );
define( 'SECURE_AUTH_SALT',  'M?,s/c]S&/4R$EjhU#u%n7mQC*ug0{NJzW3 &|ag#[j5)!kQW~}FW6=,hrdt^5c.' );
define( 'LOGGED_IN_SALT',    'ft$y%nxs~<YLPVz~NVi[=XL!eBJV3Naa=*[t|Z7E3QmipE2=z>SOO3+F>;DU+`0<' );
define( 'NONCE_SALT',        '3Zp@RPG7nqtAFP ihhW{` az3:{6xOW3=#> m }D-Z;[tq8dYubT7d)Gd;Ak#PkZ' );
define( 'WP_CACHE_KEY_SALT', '$X 8MH77T!VU{2.8xoY;:.eQ_w)KgEJb/V3Z9y:Z7UU|kN_crILOu90*uyW0_hPv' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
define('WP_MEMORY_LIMIT', '256M');
define('WP_MAX_MEMORY_LIMIT', '512M');
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
