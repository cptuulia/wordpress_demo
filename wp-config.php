<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'test' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'wordpress_demo_mysql' );

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
define( 'AUTH_KEY',         'dn~X*#o/t~cDqi)HrUIl(N7ys@Gxw%W#aO?F6jVIU]:+BX/F4#[:+eiWS@<Pz2wh' );
define( 'SECURE_AUTH_KEY',  '&B>We!DI#^iW}R?Q]-WJ*hjDv*Xbk5.o&I&Aq~WIaj=lf9/)CdqP)?=$A<o17K|f' );
define( 'LOGGED_IN_KEY',    '+ISCN;4n34%sUB$h]@}/sI78P[y-0|7_Zy^+&?NbP.OZ0PB@0qi{7s9DFnzb]$SW' );
define( 'NONCE_KEY',        ')>GKWx@JIw9)a%sNt5|s.DXH;Q~Y{+K{7=;`}{[zw@HxNGurW`~m/.>#$pFgw1]-' );
define( 'AUTH_SALT',        'ptTM{=).CP2jCJls@79`naK9?x+6L^skkoky[.xYaBpg`mpj5$k1x?x/N*r`&>Cl' );
define( 'SECURE_AUTH_SALT', 'dCP/z!+ K%@,t5qv,I9ZdH1oFU81=v*T;NccNx0zD%, =W/!Ow|gzuEd_(nm1j%8' );
define( 'LOGGED_IN_SALT',   '9(x9{nhN9<tRzSL}>f{tvNM@RZBrn=xCerzFZz#2!Trv9Ukah]CnboxN{KMPsr<G' );
define( 'NONCE_SALT',       'uR_Y1>5WXSyZY=BB_z_gTKo_G`qH_)!E_V@HKAZsx3X3pDAl#Ed8|E!WLjpE[D{m' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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
