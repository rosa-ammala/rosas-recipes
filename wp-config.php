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
define( 'DB_NAME', 'wordpress' );

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
define( 'AUTH_KEY',         'Ptg],%p,5LXqi`HAnMVD4C^zS%yS(-<F iGHgCY/3ouI;2j/v:JKs#MgUn )`HBT' );
define( 'SECURE_AUTH_KEY',  '45*Bez^`uLoUcKH[>^mNnP5Kp%Je^`GP,#_LxnWLuwY)A:NzLsvEqZ6.|J!eg8xg' );
define( 'LOGGED_IN_KEY',    'J/kv O8))P/C[,mJgYb)CymyhjFPQ-GA?Wx,!^ye#)W6rUB5C&f22#A3u5n/?llX' );
define( 'NONCE_KEY',        'Sz*U.}^akt4@Ic5sDY}w|P:/I/1zJ=f1d<_6,40k=D(:!YvP5}e5i-)N!zqORnOA' );
define( 'AUTH_SALT',        'gO<Sc,BSxEr7EV23|uYT%8#J>a~}Yg-cp?V973t^TZYegYp#{ sW|PG!}jfn.L4*' );
define( 'SECURE_AUTH_SALT', '%hoS9@BNhb/P3[x1y7dHMw?j[Oi{]5Cjo+28R{3IsC0}-)q7f=HwUYrTsFat>6>M' );
define( 'LOGGED_IN_SALT',   'sL1Y2%XPDoo7ZYAP}LH6xA15eg;8,`(:IQS.rcO(qO$Xs&o7Ih^4Eu0oq)W2(v+B' );
define( 'NONCE_SALT',       '%b{8p#oBh4*bV6Y_O##_iP n^mrc>)r VKxEY6b5)VO&r8S<@<xvBh !!Jg<y@v{' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp2_';

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

/* Add any custom values between this line and the "stop editing" line.

define('WP_HOME', 'localhost');
define('WP_SITEURL', 'localhost'); */

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
