<?php

    namespace Controller;
    use Model\Connect;

    class adminController {

        public function getAdmin() {

            $pdo = Connect::seConnecter();

            $requestGenre = $pdo->query("
                SELECT movieGenre_id, movieGenre_label, genreImgUrl, genreColor
                FROM movie_genre
            ");

            $requestDirectorsSelect = $pdo->query("
                SELECT CONCAT(p.person_firstName, ' ', person_lastName) AS 'Director', director_id, p.person_imgUrl
                FROM person p
                INNER JOIN director d ON d.person_id = p.person_id
                ORDER BY Director ASC
            ");

            $requestActorsSelect = $pdo->query("
                SELECT CONCAT(person_firstName, ' ', person_lastName) AS actorName, actor_id, p.person_imgUrl
                FROM person p
                INNER JOIN actor a ON a.person_id = p.person_id
                ORDER BY actorName ASC
            ");

            $requestMovieSelect = $pdo->query("
                SELECT movie_id, movie_title, YEAR(movie_frenchPublishDate) AS 'sortie', movie_length, CONCAT(person_firstName, ' ', person_lastName) AS 'réalisateur', movie_synopsis, movie_rating, movie_frenchPublishDate, movie_imgUrl
                FROM movie m
                INNER JOIN director d ON m.director_id = d.director_id
                INNER JOIN person p ON p.person_id = d.person_id
                ORDER BY sortie DESC
            ");

            $requestRoleSelect = $pdo->query("
                SELECT role_id, role_name
                FROM role
                ORDER BY role_name ASC
            ");


            require "view/admin.php";

        }

    }