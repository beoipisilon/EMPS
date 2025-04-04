<?php

// EMPS6 Local Configuration File

// Database configuration
define('EMPS_DB_HOST', 'localhost');
define('EMPS_DB_USER', 'root');
define('EMPS_DB_PASSWORD', '');
define('EMPS_DB_NAME', 'emps');

// Site configuration
define('EMPS_SITE_NAME', 'API de Produtos');
define('EMPS_SITE_URL', 'http://localhost:8080');

// Host name - set to the domain name of your app
define('EMPS_HOST_NAME', 'localhost');

// Debug settings
define('EMPS_DEBUG_MODE', true);

// Path settings - set to the full absolute path to your app's htdocs folder
define('EMPS_SCRIPT_PATH', realpath(__DIR__ . '/../../'));
define('EMPS_SCRIPT_WEB', '');

// Website paths
define('EMPS_WEBSITE_SCRIPT_PATH', realpath(__DIR__ . '/..'));
define('EMPS_WEBSITE_SCRIPT_WEB', '');

// Time zone - set to your web app's time zone
define('EMPS_TZ', 'America/Sao_Paulo');

// Session cookie lifetime (in seconds)
define('EMPS_SESSION_COOKIE_LIFETIME', 86400); // 24 hours

// Photo size settings for image uploader
define('EMPS_PHOTO_SIZE', '1920x1920|100x100|inner');

// Database connection settings
$emps_db_config = [
    'host' => EMPS_DB_HOST,
    'user' => EMPS_DB_USER,
    'password' => EMPS_DB_PASSWORD,
    'database' => EMPS_DB_NAME,
    'charset' => 'utf8mb4'
];

// Default language
$emps_lang = 'pt';

// Enable localhost mode for local development
$emps_localhost_mode = true;

// Create EMPS class if not exists
if (!class_exists('EMPS')) {
    class EMPS {
        public function main() {
            // Main functionality
        }
        
        public function json_ok($data) {
            header('Content-Type: application/json');
            echo json_encode($data);
        }
    }
}

// Create global EMPS object if not exists
global $emps;
if (!isset($emps)) {
    $emps = new EMPS();
} 