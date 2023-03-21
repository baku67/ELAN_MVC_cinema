<?php

    namespace Controller;
    use Model\Connect;

    class ActorController {

        public function listActors() {
            $pdo = Connect::seConnecter();
            $request = $pdo->query("
                SELECT CONCAT(person_firstName, ' ', person_lastName) AS actorName, actor_id, p.person_imgUrl
                FROM person p
                INNER JOIN actor a ON a.person_id = p.person_id
            ");
            require "view/listActors.php";

        }

        public function actorDetails(int $actorId) {
            $pdo = Connect::seConnecter();

            $request2 = $pdo->prepare("
                SELECT p.person_id, CONCAT(person_firstName, ' ', person_lastName) AS actor_name, person_gender, person_birthDate, person_imgUrl
                FROM actor a
                INNER JOIN person p ON p.person_id = a.person_id
                WHERE a.actor_id = :actor_id
            ");
            $request2->execute([
                "actor_id" => $actorId
            ]);

            $requestMovieList = $pdo->prepare("
                SELECT m.movie_id, movie_title, role_name AS 'Rôle', movie_frenchPublishDate, movie_synopsis, movie_rating, movie_length, movie_imgUrl
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


        public function addActor() {
            if($_POST["submit"]) {

                $pdo = Connect::seConnecter();

                $firstName = filter_input(INPUT_POST, "actorFirstName", FILTER_SANITIZE_SPECIAL_CHARS);
                $lastName = filter_input(INPUT_POST, "actorLastName", FILTER_SANITIZE_SPECIAL_CHARS);
                $gender = $_POST["actorGender"];
                $birthDate = $_POST["actorBirthDate"];

                $addPersonRequest = $pdo->prepare("
                    INSERT INTO person (person_firstName, person_lastName, person_gender, person_birthDate) 
                    VALUES (:firstName, :lastName, :gender, :birthDate)
                ");
                $addPersonRequest->execute([
                    "firstName" => $firstName,
                    "lastName" => $lastName,
                    "gender" => $gender,
                    "birthDate" => $birthDate,
                ]);

                $last_insert_id = $pdo->lastInsertId();

                $addActorRequest = $pdo->prepare("
                    INSERT INTO actor (person_id) 
                    VALUES (:personId)
                ");
                $addActorRequest->execute([
                    "personId" => $last_insert_id,
                ]);


                header("location: index.php?action=listActors");

            }

        }


    }

?>

