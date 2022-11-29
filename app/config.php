<?php

if (!empty(getenv('DB_HOST'))) {
    define('DB_HOST', getenv('DB_HOST'));
    define('DB_USERNAME', getenv('DB_USERNAME'));
    define('DB_PASSWORD', getenv('DB_PASSWORD'));
    define('DB_NAME', getenv('DB_NAME'));
    define('DB_PORT', getenv('DB_PORT'));
    define('BASE_PUBLIC_URL', getenv('BASE_PUBLIC_URL'));
    define('BASE_SOAP_URL', getenv('BASE_SOAP_URL'));
    define('API_KEY', getenv('API_KEY'));
    define('BINOTIFY_PREMIUM_API', getenv('BINOTIFY_PREMIUM_API'));
} else {
    define('DB_HOST', parse_ini_file('.env')['DB_HOST']);
    define('DB_USERNAME', parse_ini_file('.env')['DB_USERNAME']);
    define('DB_PASSWORD', parse_ini_file('.env')['DB_PASSWORD']);
    define('DB_NAME', parse_ini_file('.env')['DB_NAME']);
    define('DB_PORT', parse_ini_file('.env')['DB_PORT']);
    define('BASE_PUBLIC_URL', parse_ini_file('.env')['BASE_PUBLIC_URL']);
    define('BASE_SOAP_URL', parse_ini_file('.env')['BASE_SOAP_URL']);
    define('API_KEY', parse_ini_file('.env')['API_KEY']);
    define('BINOTIFY_PREMIUM_API', parse_ini_file('.env')['BINOTIFY_PREMIUM_API']);
}

?>