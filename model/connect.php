<?php

    namespace Model;

    abstract class Connect {

        const HOST = 'localhost';
        const DB = "basile_cinema";
        const USER = "root";
        const PASS = "";

        public static function seConnecter() {
            try {
                return new \PDO(
                    "mysql:host=".self::HOST.";dbname=".self::DB.";charset=utf8", self::USER, self::PASS
                );
            } catch (\PDOException $e) {
                return $e->getMessage();
            }
        }
    }




?>