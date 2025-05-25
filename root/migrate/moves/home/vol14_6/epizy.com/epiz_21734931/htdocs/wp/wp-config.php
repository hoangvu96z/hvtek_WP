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
define('DB_NAME', 'hvteksho_w392');

/** MySQL database username */
define('DB_USER', 'hvteksho_w392');

/** MySQL database password */
define('DB_PASSWORD', 'VUnph08641996');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'xjrtbjfqktejlcnnjayrpticqm789pi9vlfexeqjsqzuqecdtxyajuy5zqorahbc');
define('SECURE_AUTH_KEY',  'groauifeymmzc97uusvjvter38id5igqwafvr0p6vltizzaa77xgcjxviezcyhpn');
define('LOGGED_IN_KEY',    'fiuwdb5p2ynbfpicjl2epuucfsffysmuckvzeshdf50leocloi8q2nsci43cutis');
define('NONCE_KEY',        'cy1qcuslxlqqzpsxmd9laqpr3etjl2pppvhghbwbvmd1xxdhheqtonceraealoxz');
define('AUTH_SALT',        'dwqg4wcamso7ppdhjzucry85odmks53pxibgfke2r5aeb1gtz52t3jmyfyoreerd');
define('SECURE_AUTH_SALT', '3qoobzgrjq06mrmz6aohxwcn4mudtsjfdhf8mxioqjo6seg5bu2y7azb6eblxu5n');
define('LOGGED_IN_SALT',   'k77imnwo1youq2kbyqeo1nq7lh4cbvqukj6a25ixsymxdywssigtq6hvtqkig9q6');
define('NONCE_SALT',       'wel7orhgtrxf0pbih5of1mkne6eoyzyortmsisfo6lpish4asm9509aqkedovb9g');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wpwt_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
