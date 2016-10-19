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
define('DB_NAME', 'shop');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         'VmL{Af 5Lq~a[x:Av%X}txW7bsSIGNn?x$5OE7.X[v3Fl<}$4{xG`hh$]{ksc;Kv');
define('SECURE_AUTH_KEY',  'g(vV4Uwt_-2>`>0L0JY0E138DLfZ##tMkKWRF&/Xz%r/vbJ&h{/YA^RBw=3isZn<');
define('LOGGED_IN_KEY',    '>%A&r,qf5![#A;bEqsN]N/&:$wJy eIAByQqk4LPtC,unFb3*gsmRacWx/gx8PK#');
define('NONCE_KEY',        '=L=QX@JtA!|v:JlWo2X<BzUERmlqP,-=c8!aw<qT::Js> ovHZMW*RtL5yDECtHM');
define('AUTH_SALT',        '!tI9w(F]&P6Eun7DlD*bE4&B8x=Z-lFMaXb~cp;(mjt<nut*N,nZ&fy} `;3yYS ');
define('SECURE_AUTH_SALT', 'W]5(!4uGyv8ver[.UI@64{{lR$6%DF<-v>}{d[zo4<e/F]-9OIDauaL!PtMMCI(X');
define('LOGGED_IN_SALT',   ' JM/(5lMR_!>{T8OOU*]Q+c:Bk5mhIe$)&,]y~k]l]QE.@PJ.Ge!i9$k>^2B +pt');
define('NONCE_SALT',       '}Ve3&5D]a-cYz$`!EH%pt}.K1dM*#0n0gZZySyQHTOW*701)[N`8F;#7C!KjGT`,');

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
