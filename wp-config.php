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
define( 'DB_NAME', 'maeva' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

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
define( 'AUTH_KEY',         'BL#cT6Q2~zV$ `abLwlO [rHOY&Ltr$}msx3OWD(KwA]*#U4`jrS$M3UuyIx4]Ix' );
define( 'SECURE_AUTH_KEY',  '{vS52-c7]sD/pbYRG6U3Uag_7!ihYj@`o<mo6xV.L Kt<Tokj3!R}^kO_y(8=kAA' );
define( 'LOGGED_IN_KEY',    '0Q,=!Fdc<ATmrKBU@+=*.,i1zuq*=;O9tV}&SU$,)!w4[e)?*z735*B8e=I$VeF)' );
define( 'NONCE_KEY',        '} Z,? d,+>^Qj>$d9l[>|p[5G-2QAuDafaVSG{ECm0J#]4@;f@7hk&#!aS[4]Pna' );
define( 'AUTH_SALT',        'VrH4.NDlpFq@;Kw2)_FbT_F`aHTj*{hqhAbzjFyWt{p@k}S_{^FQNEWfiSDyx=`S' );
define( 'SECURE_AUTH_SALT', 'e+EL6d#^0I%~+KarLR_Y3VA+`nC^fIWLt%Lu^t:+x0;[^hZh27A!VK(Nv_WMr,(#' );
define( 'LOGGED_IN_SALT',   'Zqo;7xNV) nE-xv9`kvt!!ja1WVX<?GP*NQs##{870$3LJ)KP3uZ]UC,mt~U=98Z' );
define( 'NONCE_SALT',       '3!{xq<Rb:?.F7Iq0c>LJ5hW{Mp}]`mwD~|eRsk~R|zCjM[GOd7`RKX|X1R.G-`dW' );

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
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
