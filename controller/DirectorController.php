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

        public function directorDetails(int $directorId) {
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

            $requestMovieList = $pdo->prepare("
                SELECT movie_id, movie_title, YEAR(movie_frenchPublishDate)
                FROM movie m 
                WHERE director_id = :directorId
            ");
            $requestMovieList->execute([
                "directorId" => $directorId
            ]);



            require "view/directorDetails.php";

        }


        public function addDirector() {
            if($_POST["submit"]) {

                $pdo = Connect::seConnecter();

                $firstName = filter_input(INPUT_POST, "dirFirstName", FILTER_SANITIZE_SPECIAL_CHARS);
                $lastName = filter_input(INPUT_POST, "dirLastName", FILTER_SANITIZE_SPECIAL_CHARS);
                $gender = $_POST["dirGender"];
                $birthDate = $_POST["dirBirthDate"];

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

                $addDirectorRequest = $pdo->prepare("
                    INSERT INTO director (person_id) 
                    VALUES (:personId)
                ");
                $addDirectorRequest->execute([
                    "personId" => $last_insert_id,
                ]);


                header("location: index.php?action=listDirectors");

            }

        }
    }

?>

