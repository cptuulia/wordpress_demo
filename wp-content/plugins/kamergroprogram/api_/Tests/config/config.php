<?php



require_once __DIR__ . '/../../../../../wp-config.php';

return [
    'db' => [
        'host' => DB_HOST,
        'database' => DB_NAME,
        'username' => DB_USER,
        'password' => DB_PASSWORD,
    ],
    'slide_show_images' => $_SERVER['HOME'] .'/wp-content/plugins/kamergroProgram/images/' 
];
