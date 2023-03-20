<?php 

    namespace Controller;
    use Model\Connect;


    class HomeController {

        public function getHomepage() {

            $pdo = Connect::seConnecter();
            $newsList = $pdo->query("
            SELECT * FROM news
            ORDER BY publishDate DESC
            ");


            require 'view/homepage.php';
        }

    }
