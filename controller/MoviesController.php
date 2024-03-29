<?php 

    namespace Controller;
    use Model\Connect;

    class MoviesController {



        public function listMovies() {
            $pdo = Connect::seConnecter();
            $request = $pdo->query("
                SELECT movie_id, movie_title, YEAR(movie_frenchPublishDate) AS 'sortie', movie_length, CONCAT(person_firstName, ' ', person_lastName) AS 'réalisateur', movie_synopsis, movie_rating, movie_frenchPublishDate, movie_imgUrl
                FROM movie m
                INNER JOIN director d ON m.director_id = d.director_id
                INNER JOIN person p ON p.person_id = d.person_id
                ORDER BY sortie DESC
            ");
            $requestGenre = $pdo->query("
                SELECT movieGenre_id, movieGenre_label, genreImgUrl, genreColor
                FROM movie_genre
            ");

            //** Films par genre (mauvaise idéé ? filtres dynamiques plutot)
            // $actionMovies = $pdo->query("
            //     SELECT * FROM movie m
            //     INNER JOIN moviegenrelist mgl ON mgl.movie_id = m.movie_id
            //     INNER JOIN movie_genre mg ON mg.movieGenre_id = mgl.movieGenre_id
            //     WHERE mgl.movieGenre_id = 3
            // ");


            require "view/listMovies.php";
        }



        public function listMoviesFiltered(int $filterId, string $filterLabel) {
            
            $newFilter = [
                "filterId" => $filterId, 
                "filterLabel" => $filterLabel
            ];
            $_SESSION["filters"][] = $newFilter;
            $pdo = Connect::seConnecter();

            $requestTxt = "
            SELECT m.movie_id, movie_title, YEAR(movie_frenchPublishDate) AS 'sortie', movie_length, CONCAT(person_firstName, ' ', person_lastName) AS 'réalisateur'
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
                SELECT movieGenre_id, movieGenre_label, genreImgUrl, genreColor
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


        public function addCasting() {
            $pdo = Connect::seConnecter();

            // $actorId = filter_input(INPUT_POST, "actorSelect", FILTER_SANITIZE_NUMBER_INT);
            // $movieId = filter_input(INPUT_POST, "movieSelect", FILTER_SANITIZE_NUMBER_INT);
            // $roleId = filter_input(INPUT_POST, "roleSelect", FILTER_SANITIZE_NUMBER_INT);
            $movieId = $_POST["movieSelect"];
            $roleId = $_POST["roleSelect"];
            // $_POST["actorSelect"] non identifié pour aucune raison (exactement pareil que les 2 autres)
            $actorId = $_POST["actorSelect"];
            // $actorId = 1;


            $requestAddCasting = $pdo->prepare("
                INSERT INTO casting (movie_id, actor_id, role_id) VALUES (:actorId, :movieId, :roleId)
            ");
            $requestAddCasting->execute([
                "actorId" => $actorId,
                "movieId" => $movieId,
                "roleId" => $roleId
            ]);

            header("Location: index.php?action=listMovies");
        }



        public function movieDetails(int $movieId) {
            $pdo = Connect::seConnecter();

            $request2 = $pdo->prepare("
                SELECT movie_title, YEAR(movie_frenchPublishDate) AS 'sortie', movie_length, CONCAT(person_firstName, ' ', person_lastName) AS 'réalisateur', movie_imgUrl, d.director_id, p.person_imgUrl, movie_rating
                FROM movie m
                INNER JOIN director d ON m.director_id = d.director_id
                INNER JOIN person p ON p.person_id = d.person_id
                WHERE m.movie_id = :movieId
            ");
            $request2->execute([
                "movieId" => $movieId
            ]);

            $requestCasting = $pdo->prepare("
                SELECT m.movie_id, movie_title, CONCAT(p.person_firstName, ' ', p.person_lastName) AS 'acteur', person_gender, a.actor_id, role_name, p.person_imgUrl
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

            $requestGenres = $pdo->prepare("
                SELECT mg.movieGenre_id, movieGenre_label, genreImgUrl, genreColor
                FROM movie_genre AS mg
                INNER JOIN moviegenrelist AS mgl ON mgl.movieGenre_id = mg.movieGenre_id
                WHERE mgl.movie_id = :movieId
            ");
            $requestGenres->execute([
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
                    INSERT INTO movie (movie_title, movie_frenchPublishDate, movie_length, movie_synopsis, movie_rating, movie_imgUrl, director_id, type) 
                    VALUES (:movieTitle, :moviePublishDate, :movieLength, :movieSynopsis, :movieRating, :movieImgUrl, :directorId, :type)
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
                    "type" => "movie"
                ]);

                // Récupération de l'id du movie tout juste inséré
                $last_insert_id = $pdo->lastInsertId();

                // 2eme requete d'insertion dans table movieGenreList (table relationnelle) pour chaque genre coché:
                $checkboxes = isset($_POST['genre']) ? $_POST['genre'] : array();
                foreach($checkboxes as $value) {

                    $addGenreRelation = $pdo->prepare("
                        INSERT INTO moviegenrelist (movie_id, movieGenre_id) 
                        VALUES (:movieId, :genreId)
                    ");
                    $addGenreRelation->execute([
                        "movieId" => $last_insert_id,
                        "genreId" => $value
                    ]);
                }


                // On repasse par le controller pour l'affichage de la liste de film (à jour):
                header("location: index.php?action=listMovies");
                // listMovies();
                // require "view/listMovies.php";
        
            }
        }

    }