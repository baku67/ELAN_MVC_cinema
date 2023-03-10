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

        public function listMoviesFiltered($filters) {
            $pdo = Connect::seConnecter();
            $request = $pdo->prepare("
                SELECT m.movie_id, movie_title, YEAR(movie_frenchPublishDate) AS 'sortie', movie_length, CONCAT(person_firstName, ' ', person_lastName) AS 'réalisateur'
                FROM movie m
                INNER JOIN director d ON m.director_id = d.director_id
                INNER JOIN person p ON p.person_id = d.person_id
                INNER JOIN moviegenrelist mgl ON mgl.movie_id = m.movie_id
                INNER JOIN movie_genre mg ON mg.movieGenre_id = mgl.movieGenre_id
                WHERE mg.movieGenre_id = :movieGenreId
            ");
            $request->execute([
                "movieGenreId" => $filters
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