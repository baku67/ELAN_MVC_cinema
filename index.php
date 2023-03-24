<?php 

    session_start();

    use Controller\MoviesController;
    use Controller\HomeController;
    use Controller\ActorController;
    use Controller\DirectorController;
    use Controller\GenreController;
    use Controller\RoleController;

    use Controller\AdminController;


    // spl_autoload_register(function ($class_name) {
    //     include $class_name . '.php';
    // });
    include "controller/HomeController.php";
    include "controller/ActorController.php";
    include "controller/AdminController.php";
    include "controller/DirectorController.php";
    include "controller/GenreController.php";
    include "controller/MoviesController.php";
    include "controller/RoleController.php";
    include "model/connect.php";

    $ctrlMovies = new MoviesController();
    $ctrlHome = new HomeController();
    $ctrlActors = new ActorController();
    $ctrlDirector = new DirectorController();
    $ctrlGenre = new GenreController();
    $ctrlRole = new RoleController();

    $ctrlAdmin = new AdminController();





    if(isset($_GET["action"])) {
        switch($_GET["action"]) {

            case "listMovies":
                $ctrlMovies->listMovies();
                break;
            case "listMoviesFiltered":
                $ctrlMovies->listMoviesFiltered($_GET["filterId"], $_GET["filterLabel"]);
                break;
            case "movieDetails":
                $ctrlMovies->movieDetails($_GET["id"]);
                break;

            case "listActors":
                $ctrlActors->listActors();
                break;

            case "actorDetails":
                $ctrlActors->actorDetails($_GET["id"]);
                break;

            case "listDirectors":
                $ctrlDirector->listDirectors();
                break;

            case "directorDetails":
                $ctrlDirector->directorDetails($_GET["id"]);
                break;

            case "listGenre":
                $ctrlGenre->listGenre();
                break;

            // case "genreFilter":
            //     $ctrlGenre->genreFilter($_GET["id"]);
            //     break;

            case "addGenre":
                $ctrlGenre->addGenre();
                break;

            case "addRole":
                $ctrlRole->addRole();
                break;

            case "addMovie":
                $ctrlMovies->addMovie();
                break;

            case "addActor":
                $ctrlActors->addActor();
                break;

            case "addDirector":
                $ctrlDirector->addDirector();
                break;

            case "addCasting":
                $ctrlMovies->addCasting();
                break;


            case "admin":
                $ctrlAdmin->getAdmin();
                break;

            case "search":
                $ctrlHome->search();
                break;

            // case "removeFilter":
            //     $ctrlMovies->removeFilter($filterId);
            //     break;
        }
    }
    else {
        session_destroy();
        $ctrlHome->getHomepage();
    }

?>


