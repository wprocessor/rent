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
define( 'DB_NAME', getenv('RENT_DB_NAME') );

/** MySQL database username */
define( 'DB_USER', getenv('RENT_DB_USERNAME') );

/** MySQL database password */
define( 'DB_PASSWORD', getenv('RENT_DB_PASS') );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

require_once( dirname( __FILE__ ) . '/../security/wp-vars.php' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'vr_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', true );

define('WP_HOME_PATH', dirname( __FILE__ ) );
define('WP_HOME','http://rent.lc');
define('WP_SITEURL','http://rent.lc/wordpress');

define( 'WP_CONTENT_DIR', dirname(__FILE__) . '/wordpress/wp-content' );
define ('WP_CONTENT_URL', 'http://rent.lc' . '/wordpress/wp-content' );

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/wordpress/' );
}

global $wp_theme_directories;

$custom_themes_path = dirname( __FILE__ ) . '/themes';
$wp_theme_directories[] = rtrim( $custom_themes_path, '/\\' );

function wp_custom_path_to_url($path) {
  return str_ireplace(WP_HOME_PATH, WP_HOME, $path);
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
