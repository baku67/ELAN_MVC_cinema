<?php 

    use Controller\MoviesController;
    use Controller\HomeController;
    use Controller\ActorController;

    spl_autoload_register(function ($class_name) {
        include $class_name . '.php';
    });

    $ctrlMovies = new MoviesController();
    $ctrlHome = new HomeController();
    $ctrlActors = new ActorController();




    if(isset($_GET["action"])) {
        switch($_GET["action"]) {

            case "listMovies":
                $ctrlMovies->listMovies();
                break;
            case "movieDetails":
                $ctrlMovies->movieDetails($_GET["id"]);
                break;

            case "listActors":
                $ctrlActors->listActors();
                break;

            case "actorDetails":
                $ctrlActors->actorDetails($_GET["id"]);


        }
    }
    else {
        $ctrlHome->getHomepage();
    }

?>


