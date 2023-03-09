<?php 

    use Controller\CinemaController;

    spl_autoload_register(function ($class_name) {
        include $class_name . '.php';
    });

    $ctrlCinema = new CinemaController();




    if(isset($_GET["action"])) {
        switch($_GET["action"]) {

            case "listMovies":
                $ctrlCinema->listMovies();
                break;
            case "actorListMovies":
                $ctrlCinema->listActorMovies();
                break;

        }
    }