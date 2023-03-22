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


            require "view/admin.php";

        }

    }