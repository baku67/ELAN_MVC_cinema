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
                    "mysql:host=".self::HOST.";dbname=".self::DB.";username=".self::USER.";password=".self::PASS
                );
            } catch (\PDOException $e) {
                return $e->getMessage();
            }
        }
    }




?>