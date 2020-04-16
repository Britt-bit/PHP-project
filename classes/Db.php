<?php

    class Db {
        //static: maar 1 bestaande vorm van de databank classe
        private static $conn;

        public static function getConnection(){
            include_once(__DIR__ . "/../settings/settings.php");
            if(self::$conn === null){
                self::$conn = new PDO('mysql:host=' . SETTINGS['db']['host'] . ';dbname=' . SETTINGS['db']['db'], SETTINGS['db']['user'], SETTINGS['db']['password']);
                return self::$conn;
            } else {
                return self::$conn;
            }
        }
    }


?>