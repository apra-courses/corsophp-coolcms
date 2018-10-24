<?php

class Db {

    public static function getConnection() {
        static $conn = null;
        if (!$conn) {
            $conn = new PDO(
                    App::getInstance()->getConfig('DB_DNS'), 
                    App::getInstance()->getConfig('DB_USERNAME'), 
                    App::getInstance()->getConfig('DB_PASSWORD')
            );
        }
        return $conn;
    }

}
