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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',          'm{fMZB<<jucX;z*qx0egxdt8H`,uBx]0Z`8C_UBIpHF!u.@Rt?QKxFnfix0gL#{ ' );
define( 'SECURE_AUTH_KEY',   '67G*>t$^55g&x~ Mh>*}<3Y`[r*zVv?bHm#xpDq?</}@3(%b4:K)8{RP8)j^5hL:' );
define( 'LOGGED_IN_KEY',     'g.!)wx4WCOc(jDx9s$B{uT|60q,k2gx;}F2S8,[}&|BOXRCce)E~hez$o@ONR}9F' );
define( 'NONCE_KEY',         '1E$~!{?MbwV^Bv?J>0:vwl+8}?=StEyJ7Pik?>I,=w70dp`gES9bwJ:4mwh9[A @' );
define( 'AUTH_SALT',         '#hB(Ye65D/qWG+YD(D%#]po%b6u_zln,9_r*t#,#5vjY)};M*4EkIQ4tkC.3G[m_' );
define( 'SECURE_AUTH_SALT',  ')DD!Tp#U+Pbh1,bi1NY{AfBt}f:,M/1{e`YStVx=0o4k{,I_Z]C]?15no=m@FIPT' );
define( 'LOGGED_IN_SALT',    '&jog5*D;G_wSl@1V>F|VO&d4^N?kAc}b xO2zN:6#Hk2#Vn:!E ved&&3I5hL&p;' );
define( 'NONCE_SALT',        '?oy>wnlUIBKX){x>]l}]2$sI7LOjk|!I=)0/nR ?~vo~wecq7p>AB60/mq*p$dPL' );
define( 'WP_CACHE_KEY_SALT', 'wN+E[Gn;6Y*}!7^8]9g-4r9:p~J KT.MR3&GSpmH6n$YAEy(),xnFyp[BE)fC:a|' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
