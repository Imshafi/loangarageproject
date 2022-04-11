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
define( 'DB_NAME', 'loangarag_wp834' );

/** Database username */
define( 'DB_USER', 'loangarag_wp834' );

/** Database password */
define( 'DB_PASSWORD', 'O8Cp7oS@4.' );

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
define( 'AUTH_KEY',         'gpjn3enczdcgmlmiegzq3us2xdwfr98ac6ka37irkht5iziiydnhqojyd9ssx84r' );
define( 'SECURE_AUTH_KEY',  'v4lo275s9blmgb9mzvdt39v04uzgtycvzw7mrrvq59idxcxevwp1at5yqwvbhssm' );
define( 'LOGGED_IN_KEY',    'uz30wfptejbsslz7r1d9cazjzi2r5vsp5gmoiijygq4p54vo9zbpynblvus5n7no' );
define( 'NONCE_KEY',        'gszrfucmcniygrxfmhoxbmnobfjloojqmnopvvvtlv1gdx3vty5ylgd8oeqrpe14' );
define( 'AUTH_SALT',        'afrpd0mdosbtk7xgyjako38whehb8eu4ygix4jng8fa6gknrk5qhpgnnp679unay' );
define( 'SECURE_AUTH_SALT', 'dnl19u6ek1kca1tf61qm46bf6lc6whs8hbrplyvualb3zrtcivzyrmlgac0xaubg' );
define( 'LOGGED_IN_SALT',   'ouahgejejdhpnfjrvhrxlluog4ko9ngle0gtvbmawcbhqwbdkwbrxgwqmpzhvhup' );
define( 'NONCE_SALT',       'nkundlsuk5da3rjqw3yvkskimpmx8caerbirum3abj6xjklgldvpxsg87pwqcip8' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wpez_';

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
