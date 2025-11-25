<?php
define( 'WP_CACHE', true );

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
define( 'DB_NAME', 'wp_xzkn7' );

/** Database username */
define( 'DB_USER', 'wp_ur6bn' );

/** Database password */
define( 'DB_PASSWORD', 'aZ3i_ZJQw2wI_8Xy' );

/** Database hostname */
define( 'DB_HOST', 'localhost:3306' );

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
define('AUTH_KEY', '4B*jL92H@4A4hxo@w&p!!e-p%E1:JYx/XgPn(5F|7]M65gpR485_0)Igt|!VQZmq');
define('SECURE_AUTH_KEY', 'JcS!@qC6U9utW!;*]460+ykSOWpP6Q77+jGH7~JD|fq1XCrwX|/1ze1MKebHd*6D');
define('LOGGED_IN_KEY', 'SG1[Xj5!A4Bb7%&|~N&LH1jBuZgAPU|QmmP;640:@]93HM6e:)[SKP_n-(s4)Pf2');
define('NONCE_KEY', 'cL|%5ZsE_~KqwG@j4|qMW23t[WK-nO#/opJ!S)0m#213U3*0Cl/M7-wf]X;-2e7c');
define('AUTH_SALT', ':COK(]Z089F9wwarY#TU(pVW|4535d7#e3*5x!(r3hwXqVkN%d98!wtqI17!Ug0H');
define('SECURE_AUTH_SALT', 'd0M_I)Yw@51kK)LMrDJZ+5_@65DVi71U(e92C*75fse&(I%|XRd)8/09@b:&4a5F');
define('LOGGED_IN_SALT', 'o7P7Wj+*b&+49!iT|/vJ%C8Wxe|IDD@R5Yx];2367D]5731@%BG6Ys:N98PH#bvU');
define('NONCE_SALT', 'w2)&Th88LrBC8c3[!qse/q~);%#2H!GrVFqcsGlG2Vs4-Kk)Ln@x7*oN]zB58;Vf');


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'VFIFNJZWB_';


/* Add any custom values between this line and the "stop editing" line. */

define('WP_ALLOW_MULTISITE', true);
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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
