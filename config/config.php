<?php
use \Monolog\Logger;

return array(    
    
    // SITE
    'ROOT' => 'http://localhost:4000/coolcms/public',
    
    // LOG
    'LOG_LEVEL' => Logger::INFO,
    
    // Database
    'DB_DNS' => 'mysql:host=localhost;dbname=coolcms;charset=utf8',
    'DB_USERNAME' => 'root',
    'DB_PASSWORD' => '',
    
    // Admin
    'ADMIN_USERNAME' => 'admin',
    'ADMIN_PASSWORD' => 'qwerty123'
    
);