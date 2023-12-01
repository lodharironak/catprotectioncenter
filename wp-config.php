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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'catprotectioncenter' );

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
define( 'AUTH_KEY',         '()Du0W@Nkb4=X%;66[1(YmGks6<TISCXr( `WYBzZ,)^`9iQ}L4Roh;%X~]X*Xn[' );
define( 'SECURE_AUTH_KEY',  'tjLzwYN$A@T@I{)82=R}*PsZK7Y)tz_Sh}Q Sp1LRi+{)E5q ) 4G]uGn.x^ Pz}' );
define( 'LOGGED_IN_KEY',    '1.0Td.^/[&-DywcVkJx7CwUs)R#-U)*+Xb1(,a]AfVn&wOW=7$FM1`*i[Lo9$P-.' );
define( 'NONCE_KEY',        '5+u[&`hkW=`/4kB~h/|1qVgYYSFZOh:hC-L|W?c M<qvr/G)8-(zy*,8?n`m,{cD' );
define( 'AUTH_SALT',        'dIg_olSdX2<VRvHX)ey=|O}(6/kF!M+]}|)pRp9mb9)ZgEV`kk|feEhd~DAP@wW/' );
define( 'SECURE_AUTH_SALT', '|XxI#UcRo5|pd94m0C)*Rf[scTA%i#eYMOIGlT#u?;=K>sHX_x)c;B -oR8z7Cg[' );
define( 'LOGGED_IN_SALT',   'EaWR7Xic:4w*U$HjYoimT4?vYxFEjQBoY1@(^09aY%uC_~cswsKNEIG?O6v~ofG#' );
define( 'NONCE_SALT',       'U>p pE=B`<R7%cM`k@yTdVB%GpBE^h7u27XbnO5_:yAkMUXrod9vZla+O8D[%[}@' );

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define('ALLOW_UNFILTERED_UPLOADS', true);
define( 'WP_DEBUG', false );
define('FS_METHOD', 'direct');
define( 'AUTOMATIC_UPDATER_DISABLED', true );
define( 'WP_AUTO_UPDATE_CORE', false );
/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
