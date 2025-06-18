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
define( 'AUTH_KEY',          '/w/VjyA{q)_wYl(F*HHe;=pz:eK3b$GKHPk<RJ7%O`^nJc}=1~>`ab*xJT7I$<F.' );
define( 'SECURE_AUTH_KEY',   '?Q:b/MG`_zJo=)Y#|)p(|z9=>AlX[i-aNP*wd0G7($Cy):ZQnyChI;Lj,H<jaAiR' );
define( 'LOGGED_IN_KEY',     ':&o6Np;*f#!:M$br$;94rLpu`P+^Vr)NT_JImvQKO#4~E0XMlL}a[2~A54l,`OYI' );
define( 'NONCE_KEY',         'XR)BR665~ok=OM-t{FVu_N:S?SH TOv47Mo06-Bnk_.s|O$acx)3gbX_&{Vm@lk:' );
define( 'AUTH_SALT',         's$A42bH%uX=C(R*<.|44=>3C&i9r8th0?uN{x&>fcO7lr5E%d)uiwZ]}v}TD>^,*' );
define( 'SECURE_AUTH_SALT',  ' Ceb gIMUpf|NHyAm$:h`fw{0)MID$CrnAG*+lx]5m;{2jwnF>GQ13r^!Q~u(EeK' );
define( 'LOGGED_IN_SALT',    'FA[-CXSN?>VK>6v;D26G<])1VLjJR4(QQaO!jO{J/c[W`^?Sm}!;pS;MBC1}mUqq' );
define( 'NONCE_SALT',        'WIT+Qt%6jGa^b+V.Ofj}#~Imfe8jl.ty9<dP<t^:YL+rxWpgRjenD<mvpcBGU#3A' );
define( 'WP_CACHE_KEY_SALT', '!MlyMS&;!F^)<!aLnM]DcF86ANQw]VL:4wF; ~zb3n4e2zi?4`wVIEgqfP*QNT@`' );


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
