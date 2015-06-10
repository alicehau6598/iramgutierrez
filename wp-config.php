<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'iramgutierrez');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'gigigo');

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
define('AUTH_KEY',         'w>Pg:<~.7,yaW+j&-,/Mv$VGY$JV.G9&p}SV3+E6IhjzE9r|Pf2IE++K-`lGx#(~');
define('SECURE_AUTH_KEY',  '3 {UC+-sDtw`kSL+gEtLwquXND6KB%So1lb(%_{dv!$qrYxwtwpc/R 0[hP39k/p');
define('LOGGED_IN_KEY',    '*dPb1R|/3l&n9=)dTtd%wnGe1ZE-!Zb(Kcx?iS4|Z-|}3xZD@X<-{g^&`d!>l+jp');
define('NONCE_KEY',        'h,YL* +,){ *1u:[;fgUAK9|.zjPR|ORv{.#AtIwmK9A:s*(UBwq&X+fd%-}|~p3');
define('AUTH_SALT',        '6o^z`!^*tG2E4oq$%0}[Wx@0H xBBge5Up}DFo.4#LUQ jgK(!^|mc>K4@~M:7(L');
define('SECURE_AUTH_SALT', ':Zajc`O#F@_4A--He-knHP^x|0=~x&)s`yc|KR<H#1=pz0mM[*#w[;^/)emn#:? ');
define('LOGGED_IN_SALT',   's=tL,}b$tk,A3O1S@0$*S`!aA-8OR&`7]IlTVAvyaR8LXXSS>ulB>b^3>iNu-a# ');
define('NONCE_SALT',       '3)a36U^$ u,Qss5WG^u&:lgGWmL1@6^@br9hxEs,096l<Aw+juG%YWU#H)nfzjEm');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'igg_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
