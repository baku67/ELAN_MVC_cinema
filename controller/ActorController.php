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
            require "view/actorDetails.php";

        }
    }

?>

