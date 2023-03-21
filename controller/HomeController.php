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

            // Est-ce qu'il faut créer une table dateAjout et la joigner à movie/person ?
            $lastAddsList = $pdo->query("
                SELECT m.movie_title AS title, movie_synopsis AS content, movie_frenchPublishDate AS publishDate, movie_imgUrl AS imgUrl
                FROM movie m
                ORDER BY create_time DESC
                LIMIT 5
            ");


            require 'view/homepage.php';
        }

    }
