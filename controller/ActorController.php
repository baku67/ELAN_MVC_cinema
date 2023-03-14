<?php

    namespace Controller;
    use Model\Connect;

    class ActorController {

        public function listActors() {
            $pdo = Connect::seConnecter();
            $request = $pdo->query("
                SELECT CONCAT(person_firstName, ' ', person_lastName) AS actorName, actor_id
                FROM person p
                INNER JOIN actor a ON a.person_id = p.person_id
            ");
            require "view/listActors.php";

        }

        public function actorDetails($actorId) {
            $pdo = Connect::seConnecter();

            $request2 = $pdo->prepare("
                SELECT p.person_id, CONCAT(person_firstName, ' ', person_lastName) AS actor_name, person_gender, person_birthDate
                FROM actor a
                INNER JOIN person p ON p.person_id = a.person_id
                WHERE a.actor_id = :actor_id
            ");
            $request2->execute([
                "actor_id" => $actorId
            ]);

            $requestMovieList = $pdo->prepare("
                SELECT m.movie_id, movie_title, role_name AS 'Rôle', movie_frenchPublishDate AS 'Date de sortie FR'
                FROM casting c
                INNER JOIN movie m ON m.movie_id = c.movie_id
                INNER JOIN role r ON r.role_id = c.role_id
                WHERE (actor_id = :actorId)
                ORDER BY movie_frenchPublishDate DESC
            ");
            $requestMovieList->execute([
                "actorId" => $actorId
            ]);

            require "view/actorDetails.php";

        }


    }

?>

