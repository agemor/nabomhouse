<?php
/** Enable W3 Total Cache Edge Mode */
define('W3TC_EDGE_MODE', true); // Added by W3 Total Cache

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
define('DB_NAME', 'nabomhouse');

/** MySQL database username */
define('DB_USER', 'nabomhouse');

/** MySQL database password */
define('DB_PASSWORD', 'nabomhouse1');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         '=2(:(W1y4 hh$-DBW_?Jys[;;~f~aD@{SIbuii;w,!G55*hYtLoB6 jj`?[f+=?G');
define('SECURE_AUTH_KEY',  'DjenEA}#Y2=BrDpt`A]Pi%Fs#p]-h~YNh0q*~R+7fT.qmB4s_Sg2z9oWm.ijK([O');
define('LOGGED_IN_KEY',    '.nz)NEJE9aPe>F35K>k&*/Zzphq{BhtE2WA-A&Qrb@kiH6D{:#Q*?g $3G{,~Nh[');
define('NONCE_KEY',        '&8$+3D.4^(8)$YdO,nn^EFpqTa0D4p/Vm;FoVRWleHx8v|puh1v9hpw,A@5@7goF');
define('AUTH_SALT',        '?~#&zo_8viRoD/!0*vu-@M(W wH!$Zn]2iUd]5#0P57~f{[Uf*^x/Jmv$0%K&75$');
define('SECURE_AUTH_SALT', '~e)uNxQQ`RGCf)+WOYUNV#X]ea[4OA%a0H 45#G aEg2->A50q-G|Lh,d=jbX%5t');
define('LOGGED_IN_SALT',   '5^,2#}lmd3zVPnx1gLK=^(iz7iX.,]J62[{fj@npGR,[<p<Oswx?yheiTjk+fn5P');
define('NONCE_SALT',       'leMNG!A$tqH~xr/i8[[]e/`~,_pu!*[F[fTTJSuEsS(vi%S?(avJbgm5~Rnz?UJE');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
