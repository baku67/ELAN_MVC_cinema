<?php

    namespace Controller;
    use Model\Connect;

    class GenreController {

        public function listGenre() {
            $pdo = Connect::seConnecter();
            $request = $pdo->query("
                SELECT genre_label
                FROM movieGenre m
            ");
            require "view/listGenre.php";

        }

        public function genreFilter(int $genreId) {
            $pdo = Connect::seConnecter();
            $request2 = $pdo->prepare("
                SELECT movie_id, movie_title, YEAR(movie_frenchPublishDate) AS 'sortie', movie_length, CONCAT(person_firstName, ' ', person_lastName) AS 'réalisateur'
                FROM movie m
                INNER JOIN director d ON m.director_id = d.director_id
                INNER JOIN person p ON p.person_id = d.person_id
                WHERE 
            ");
            $request2->execute([
                "genre_id" => $genreId
            ]);
            require "view/listMovies.php";

        }
    }

?>