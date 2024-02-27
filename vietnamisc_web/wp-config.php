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
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'vietnamisc_database' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'LVtech2023@' );

/** Database hostname */
define( 'DB_HOST', 'vietnamisc_db' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

define('FS_METHOD','direct');

define( 'WP_MEMORY_LIMIT','512M');


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
define( 'AUTH_KEY',         'lYe3UwlU @ut,H&?Uc>T~0A.Uha_ECy=JZ%#tDmdZ[|a*nUVAZrb95F6>#SYQl4W' );
define( 'SECURE_AUTH_KEY',  ' A_FvSJOV-):DKOBJF!aQ*OkMY`?VhyFz,LP3KlR s^wEKkDkw;c1y)^${Oi%]8+' );
define( 'LOGGED_IN_KEY',    'Gw<3N9j,0|Yv&NY=+Yvb22M>]LF`!d!$?1!mD3}D^l:1/rg]hrAInoImiy>q 5Oy' );
define( 'NONCE_KEY',        'g_S1^M(+aens4<>.lKO]F}>]%KpfWmN&{J+k;/YmwyQ>l-AnFqBA60bg?-&kR-|`' );
define( 'AUTH_SALT',        's~0YIQ!}I(gt!jO@EQ-9&w`o+3Cbegs&Q$,P!3F%B_fK~yHXlF|/Q=B(x0|UWB&q' );
define( 'SECURE_AUTH_SALT', '[aP>2pwv0@eiLQR#cO*~a;ud/5^pqjD#5bc^V7zr:[sSrO4(zKe)Wnx}|AJkLX,i' );
define( 'LOGGED_IN_SALT',   'sb.-Uiv<PhBG,2v ]`]UhNw)W$5T%JNB.Wv`m7KA3Fc0v pP-2xB;HE6ONFGz%U*' );
define( 'NONCE_SALT',       '>/5lgg4_Gt=-(Zhpzc{4Ydkb6iUgp/~7U!2I`^ASr#e<#[|RC86tL4Ry#cV9/c75' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'iscvn_';

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
    $_SERVER['HTTPS'] = 'on';
}
/*
if (strpos($_SERVER['HTTP_X_FORWARDED_PROTO'], 'https') !== false)
       $_SERVER['HTTPS']='on';
*/
if (isset($_SERVER['HTTP_X_FORWARDED_HOST'])) {
        $_SERVER['HTTP_HOST'] = $_SERVER['HTTP_X_FORWARDED_HOST'];
}


/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
