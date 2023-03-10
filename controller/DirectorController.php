<?php

    namespace Controller;
    use Model\Connect;

    class DirectorController {

        public function listDirectors() {
            $pdo = Connect::seConnecter();
            $request = $pdo->query("
                SELECT CONCAT(person_firstName, ' ', person_lastName) AS director_name, director_id
                FROM person p
                INNER JOIN director d ON d.person_id = p.person_id
            ");
            require "view/listDirectors.php";

        }

        public function directorDetails($directorId) {
            $pdo = Connect::seConnecter();
            $request2 = $pdo->prepare("
                SELECT p.person_id, CONCAT(person_firstName, ' ', person_lastName) AS director_name, person_gender, person_birthDate
                FROM director d
                INNER JOIN person p ON p.person_id = d.person_id
                WHERE d.director_id = :director_id
            ");
            $request2->execute([
                "director_id" => $directorId
            ]);
            require "view/directorDetails.php";

        }
    }

?>

