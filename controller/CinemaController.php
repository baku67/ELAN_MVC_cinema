<?php 

    namespace Controller;
    use Model\Connect;

    class CinemaController {

        public function listMovies() {
            $pdo = Connect::seConnecter();
            $request = $pdo->query("
                SELECT movie_title, YEAR(movie_frenchPublishDate), movie_length, CONCAT(person_firstName, ' ', person_lastName) AS 'réalisateur'
                FROM movie m
                INNER JOIN director d ON m.director_id = d.director_id
                INNER JOIN person p ON p.person_id = d.person_id
            ");
            require "view/listMovies.php";
        }

        public function listActorMovies() {

        }

    }