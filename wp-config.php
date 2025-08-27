<?php
/**
 * WordPress configuration file for Docker/Coolify deployment
 */

// Load environment variables
if (file_exists(__DIR__ . '/.env')) {
    $lines = file(__DIR__ . '/.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) {
            continue;
        }
        list($name, $value) = explode('=', $line, 2);
        $_ENV[trim($name)] = trim($value, '"\'');
    }
}

// Database settings
define('DB_NAME', $_ENV['WORDPRESS_DB_NAME'] ?? $_ENV['DB_NAME'] ?? 'wordpress');
define('DB_USER', $_ENV['WORDPRESS_DB_USER'] ?? $_ENV['DB_USER'] ?? 'wordpress');
define('DB_PASSWORD', $_ENV['WORDPRESS_DB_PASSWORD'] ?? $_ENV['DB_PASSWORD'] ?? 'wordpress');
define('DB_HOST', $_ENV['WORDPRESS_DB_HOST'] ?? $_ENV['DB_HOST'] ?? 'db');
define('DB_CHARSET', 'utf8mb4');
define('DB_COLLATE', '');

// WordPress Salts
define('AUTH_KEY',         $_ENV['AUTH_KEY'] ?? 'put your unique phrase here');
define('SECURE_AUTH_KEY',  $_ENV['SECURE_AUTH_KEY'] ?? 'put your unique phrase here');
define('LOGGED_IN_KEY',    $_ENV['LOGGED_IN_KEY'] ?? 'put your unique phrase here');
define('NONCE_KEY',        $_ENV['NONCE_KEY'] ?? 'put your unique phrase here');
define('AUTH_SALT',        $_ENV['AUTH_SALT'] ?? 'put your unique phrase here');
define('SECURE_AUTH_SALT', $_ENV['SECURE_AUTH_SALT'] ?? 'put your unique phrase here');
define('LOGGED_IN_SALT',   $_ENV['LOGGED_IN_SALT'] ?? 'put your unique phrase here');
define('NONCE_SALT',       $_ENV['NONCE_SALT'] ?? 'put your unique phrase here');

// WordPress debugging
define('WP_DEBUG', filter_var($_ENV['WORDPRESS_DEBUG'] ?? $_ENV['WP_DEBUG'] ?? 'false', FILTER_VALIDATE_BOOLEAN));
define('WP_DEBUG_LOG', filter_var($_ENV['WORDPRESS_DEBUG_LOG'] ?? $_ENV['WP_DEBUG_LOG'] ?? 'false', FILTER_VALIDATE_BOOLEAN));
define('WP_DEBUG_DISPLAY', filter_var($_ENV['WORDPRESS_DEBUG_DISPLAY'] ?? $_ENV['WP_DEBUG_DISPLAY'] ?? 'false', FILTER_VALIDATE_BOOLEAN));

// WordPress URLs
if (isset($_ENV['WP_HOME'])) {
    define('WP_HOME', $_ENV['WP_HOME']);
}
if (isset($_ENV['WP_SITEURL'])) {
    define('WP_SITEURL', $_ENV['WP_SITEURL']);
}

// WordPress table prefix
$table_prefix = 'wp_';

// WordPress file permissions
define('FS_METHOD', 'direct');

// Multisite
define('WP_ALLOW_MULTISITE', true);

// Memory limit
define('WP_MEMORY_LIMIT', '256M');

// Auto updates
define('WP_AUTO_UPDATE_CORE', true);

// Security keys for production
if (!WP_DEBUG) {
    define('DISALLOW_FILE_EDIT', true);
    define('DISALLOW_FILE_MODS', true);
}

// Load WordPress
if (!defined('ABSPATH')) {
    define('ABSPATH', __DIR__ . '/');
}

require_once ABSPATH . 'wp-settings.php';