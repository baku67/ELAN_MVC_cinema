<?php 

    namespace Controller;
    use Model\Connect;

    class MoviesController {

        public function listMovies() {
            $pdo = Connect::seConnecter();
            $request = $pdo->query("
                SELECT movie_id, movie_title, YEAR(movie_frenchPublishDate) AS 'sortie', movie_length, CONCAT(person_firstName, ' ', person_lastName) AS 'réalisateur'
                FROM movie m
                INNER JOIN director d ON m.director_id = d.director_id
                INNER JOIN person p ON p.person_id = d.person_id"
            );
            $requestGenre = $pdo->query("
                SELECT movieGenre_id, movieGenre_label 
                FROM movie_genre
            ");
            require "view/listMovies.php";
        }

        public function listMoviesFiltered($filterId, $filterLabel) {
            
            $newFilter = [
                "filterId" => $filterId, 
                "filterLabel" => $filterLabel
            ];
            $_SESSION["filters"][] = $newFilter;
            $pdo = Connect::seConnecter();

            $requestTxt = 
            "SELECT m.movie_id, movie_title, YEAR(movie_frenchPublishDate) AS 'sortie', movie_length, CONCAT(person_firstName, ' ', person_lastName) AS 'réalisateur'
            FROM movie m
            INNER JOIN director d ON m.director_id = d.director_id
            INNER JOIN person p ON p.person_id = d.person_id
            INNER JOIN moviegenrelist mgl ON mgl.movie_id = m.movie_id
            INNER JOIN movie_genre mg ON mg.movieGenre_id = mgl.movieGenre_id
            WHERE mg.movieGenre_id = :movieGenreId";
            // ajout des conditions de filtres supplémentaires
            foreach ($_SESSION["filters"] as $filter) {

            }

            $request = $pdo->prepare($requestTxt);

            $request->execute([
                "movieGenreId" => $filterId
            ]);
            $requestGenre = $pdo->query("
                SELECT movieGenre_id, movieGenre_label 
                FROM movie_genre
            ");
            require "view/listMovies.php";
        }


        // public function removeFilter($filterId) {
        //     // $_SESSION["filters"][0]

        //     // Doc: https://stackoverflow.com/questions/369602/deleting-an-element-from-an-array-in-php
        //     $array = [0 => "a", 1 => "b", 2 => "c"];
        //     $array = \array_filter($array, static function ($element) {
        //         return $element !== "b";
        //         //                   ↑
        //         // Array value which you want to delete
        //     });

        //     // A adapter car suppr 1 filtre et il peut en rester
        //     // listMovies();
        // }

        public function movieDetails($movieId) {
            $pdo = Connect::seConnecter();

            $request2 = $pdo->prepare("
                SELECT movie_title, YEAR(movie_frenchPublishDate) AS 'sortie', movie_length, CONCAT(person_firstName, ' ', person_lastName) AS 'réalisateur', d.director_id
                FROM movie m
                INNER JOIN director d ON m.director_id = d.director_id
                INNER JOIN person p ON p.person_id = d.person_id
                WHERE m.movie_id = :movieId
            ");
            $request2->execute([
                "movieId" => $movieId
            ]);

            $requestCasting = $pdo->prepare("
                SELECT m.movie_id, movie_title, CONCAT(p.person_firstName, ' ', p.person_lastName) AS 'acteur', person_gender, a.actor_id
                FROM casting
                INNER JOIN movie m ON m.movie_id = casting.movie_id
                INNER JOIN actor a ON casting.actor_id = a.actor_id
                INNER JOIN person p ON p.person_id = a.person_id
                WHERE (m.movie_id = :movieId) 
            ");
            $requestCasting->execute([
                "movieId" => $movieId
            ]);


            require "view/movieDetails.php";
        }

    }