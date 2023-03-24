<?php

    namespace Controller;
    use Model\Connect;

    class RoleController {


        public function addRole() {
            if($_POST["submit"]) {

                if(filter_input(INPUT_POST, "roleName", FILTER_SANITIZE_FULL_SPECIAL_CHARS)) {
                    $roleName = filter_input(INPUT_POST, "roleName", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                }

                $pdo = Connect::seConnecter();
                $addGenreRequest = $pdo->prepare("
                    INSERT INTO role (role_name) VALUES (:roleName)
                ");
                $addGenreRequest->execute([
                    "roleName" => $roleName
                ]);


                $_SESSION["success"] = "Le role " . $roleName  . " a bien été ajouté";
                header('Location: index.php?action=admin');

            }
        }

        
    }

?>