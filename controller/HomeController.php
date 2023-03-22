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
                SELECT m.movie_id AS id, m.movie_title AS title, movie_frenchPublishDate AS publishDate, movie_imgUrl AS imgUrl, create_Time, m.type
                FROM movie m
                UNION
                SELECT p.person_id AS id, p.person_firstName AS title, person_birthDate AS publishDate, person_imgUrl AS imgUrl, create_Time, p.type
                FROM person p
                ORDER BY create_time DESC
                LIMIT 6
            ");


            require 'view/homepage.php';
        }

    }
