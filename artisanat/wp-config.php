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
define( 'DB_NAME', 'artisanat_woocomerce' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '123456' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

define('FS_METHOD','direct');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'Cud?#/kw.X*e<R17O8h{-]@XWih^Rggd46Eo3<{K9W$7snV64TZ#T#u{VCd1y2r$' );
define( 'SECURE_AUTH_KEY',  'ZNb_igIP=`v=[mXW@cKo]_~UiBu 4H?MjJ{m!S_3J9`K#S5aRaJ.VZ;F-iQN3$G,' );
define( 'LOGGED_IN_KEY',    '7|Z1$Z`+WWT&J*`8N^RU{P3RXn>ADo:!Y;=6nT&BJK-oK-*~XH=f(ty<@K`xDLG<' );
define( 'NONCE_KEY',        '-#/)!7FfAiE.{+!aS$L-reLOXR!<HE/X% A`[Ve[HA~_}>6^G]uw^k}M+ fcb/M:' );
define( 'AUTH_SALT',        'mrdgQ`%Ulm)NlTTN`rK]Q&lmtZ>ovPx8(Q:;ti@jWEi+@D7cr|Ng1#^e_FesK#Tg' );
define( 'SECURE_AUTH_SALT', '3zxLvF{,[t5Ytf7Gb`.3PbTq.4Cykg,eA`|m+)12i:TOA?`.pe~iA3_~)D~#tVhU' );
define( 'LOGGED_IN_SALT',   '@{K:UzkXo,X{.@`-57fRWy%Jt5Xq0{1)-Px]t%|+;+pg!8YL}Q+y|t7w-y[qC*-S' );
define( 'NONCE_SALT',       'h5`PA&i;6[SF((T&w]Uv`ScGN6jA3=JPar]y-*v]1(fNE:Zuugn#cL(^f.l-~oBP' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
