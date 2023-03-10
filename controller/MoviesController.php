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
                INNER JOIN person p ON p.person_id = d.person_id
            ");
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

        public function movieDetails($movieId) {
            $pdo = Connect::seConnecter();
            $request2 = $pdo->prepare("
                SELECT movie_title, YEAR(movie_frenchPublishDate) AS 'sortie', movie_length, CONCAT(person_firstName, ' ', person_lastName) AS 'réalisateur'
                FROM movie m
                INNER JOIN director d ON m.director_id = d.director_id
                INNER JOIN person p ON p.person_id = d.person_id
                WHERE m.movie_id = :movieId
            ");
            $request2->execute([
                "movieId" => $movieId
            ]);
            require "view/movieDetails.php";
        }

    }