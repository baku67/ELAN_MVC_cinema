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
                INNER JOIN person p ON p.person_id = d.person_id"
            );
            $requestGenre = $pdo->query("
                SELECT movieGenre_id, movieGenre_label 
                FROM movie_genre
            ");

            $requestDirectorsSelect = $pdo->query("
                SELECT CONCAT(p.person_firstName, ' ', person_lastName) AS 'Director', director_id
                FROM person p
                INNER JOIN director d ON d.person_id = p.person_id
            ");
            require "view/listMovies.php";
        }



        public function listMoviesFiltered(int $filterId, string $filterLabel) {
            
            $newFilter = [
                "filterId" => $filterId, 
                "filterLabel" => $filterLabel
            ];
            $_SESSION["filters"][] = $newFilter;
            $pdo = Connect::seConnecter();

            $requestTxt = 
            "SELECT m.movie_id, movie_title, YEAR(movie_frenchPublishDate) AS 'sortie', movie_length, CONCAT(person_firstName, ' ', person_lastName) AS 'réalisateur'
            FROM movie m
            INNER JOIN director d ON m.director_id = d.director_id
            INNER JOIN person p ON p.person_id = d.person_id
            INNER JOIN moviegenrelist mgl ON mgl.movie_id = m.movie_id
            INNER JOIN movie_genre mg ON mg.movieGenre_id = mgl.movieGenre_id
            WHERE mg.movieGenre_id = :movieGenreId";
            // ajout des conditions de filtres supplémentaires
            foreach ($_SESSION["filters"] as $filter) {

            }

            $request = $pdo->prepare($requestTxt);

            $request->execute([
                "movieGenreId" => $filterId
            ]);
            $requestGenre = $pdo->query("
                SELECT movieGenre_id, movieGenre_label 
                FROM movie_genre
            ");
            require "view/listMovies.php";
        }


        // public function removeFilter($filterId) {
        //     // $_SESSION["filters"][0]

        //     // Doc: https://stackoverflow.com/questions/369602/deleting-an-element-from-an-array-in-php
        //     $array = [0 => "a", 1 => "b", 2 => "c"];
        //     $array = \array_filter($array, static function ($element) {
        //         return $element !== "b";
        //         //                   ↑
        //         // Array value which you want to delete
        //     });

        //     // A adapter car suppr 1 filtre et il peut en rester
        //     // listMovies();
        // }



        public function movieDetails(int $movieId) {
            $pdo = Connect::seConnecter();

            $request2 = $pdo->prepare("
                SELECT movie_title, YEAR(movie_frenchPublishDate) AS 'sortie', movie_length, CONCAT(person_firstName, ' ', person_lastName) AS 'réalisateur', d.director_id
                FROM movie m
                INNER JOIN director d ON m.director_id = d.director_id
                INNER JOIN person p ON p.person_id = d.person_id
                WHERE m.movie_id = :movieId
            ");
            $request2->execute([
                "movieId" => $movieId
            ]);

            $requestCasting = $pdo->prepare("
                SELECT m.movie_id, movie_title, CONCAT(p.person_firstName, ' ', p.person_lastName) AS 'acteur', person_gender, a.actor_id, role_name
                FROM casting
                INNER JOIN movie m ON m.movie_id = casting.movie_id
                INNER JOIN actor a ON casting.actor_id = a.actor_id
                INNER JOIN person p ON p.person_id = a.person_id
                INNER JOIN role r ON r.role_id = casting.role_Id
                WHERE (m.movie_id = :movieId) 
            ");
            $requestCasting->execute([
                "movieId" => $movieId
            ]);


            require "view/movieDetails.php";
        }




        public function addMovie() {

            if($_POST["submit"]) {
            
                $movieTitle = filter_input(INPUT_POST, "movieTitle", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $moviePublishDate = $_POST["moviePublishDate"];
                $movieLength = filter_input(INPUT_POST, "movieLength", FILTER_VALIDATE_INT);
                $movieSynopsis = filter_input(INPUT_POST, "movieSynopsis", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $movieDirector = filter_input(INPUT_POST, "movieDirector", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $stars = filter_input(INPUT_POST, "stars", FILTER_VALIDATE_INT);


                // Gestion de l'upload d'image:
                $fileName = "";
                // Image pas obligatoire
                if(isset($_FILES['file'])){
                    // Initialisation var:
                    $tmpName = $_FILES['file']['tmp_name'];
                    $name = $_FILES['file']['name'];
                    $size = $_FILES['file']['size'];
                    $error = $_FILES['file']['error'];

                    // Récupération de l'extension du fichier:
                    $tabExtension = explode('.', $name);
                    $extension = strtolower(end($tabExtension));
                    // Extensions autorisées :
                    $extensions = ['jpg', 'png', 'jpeg', "PNG", "JPG"];
                    // Max size: 40Mb 
                    $maxSize = 400000;

                    if(in_array($extension, $extensions) && $size <= $maxSize && $error == 0){
                        $uniqueName = uniqid($name, true);
                        $fileName = $uniqueName.".".$extension;
                        // Upload:
                        move_uploaded_file($tmpName, './uploads/'.$fileName);
                    }
                }
                // Fin upload

                $pdo = Connect::seConnecter();
                $addMovieRequest = $pdo->prepare("
                    INSERT INTO movie (movie_title, movie_frenchPublishDate, movie_length, movie_synopsis, movie_rating, movie_imgUrl, director_id) 
                    VALUES (:movieTitle, :moviePublishDate, :movieLength, :movieSynopsis, :movieRating, :movieImgUrl, :directorId)
                ");
                // Données de test à remplacer par les var
                $addMovieRequest->execute([
                    "movieTitle" => $movieTitle,
                    "moviePublishDate" => $moviePublishDate,
                    "movieLength" => $movieLength,
                    "movieSynopsis" => $movieSynopsis,
                    "movieRating" => $stars,
                    "movieImgUrl" => $fileName,
                    "directorId" => $movieDirector,
                ]);

                // Récupération de l'id du movie tout juste inséré
                // https://openclassrooms.com/forum/sujet/pdo-lastinsertid-61280
                // PDO::lastInsertId()
                $lastMovieId = "test";
                $lastMovieId = $pdo->lastInsertId();

                // 2eme requete d'insertion dans table movieGenreList (table relationnelle) pour chaque genre coché:


                // On repasse par le controller pour l'affichage de la liste de film (à jour):
                header("location: index.php?action=listMovies");
                // listMovies();
                // require "view/listMovies.php";
        
            }
        }

    }