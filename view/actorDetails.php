<?php

    $actorDetails = $request2->fetch();

    function convertToHoursMins($time, $format = '%02d:%02d') {
        if ($time < 1) {
            return;
        }
        $hours = floor($time / 60);
        $minutes = ($time % 60);
        return sprintf($format, $hours, $minutes);
    }

    ob_start();
?>

    <div class="actorDetailContainer">

        
        <a class="backButton" href="javascript:history.go(-1)">Retour</a>


        <div class="actorDetailSection1">
            <div>
                <img class="actorDetailsImg" src="./uploads/personImg/<?= $actorDetails['person_imgUrl'] ?>">
            </div>

            <div class="actorDetailInfos">
                <!-- Infos -->
                <div class="subtitleDiv">
                    <h2 class="movieDetailTitle"><?= $actorDetails["actor_name"] ?></h2>
                    <div class="underlineActorElem"></div>
                </div>
                <p>TEST</p>
            </div>
        </div>


        <div class="actorDetailSubtitleDiv">
            <h2 class="movieDetailsSubtitleActor">Filmographie</h2>
            <div class="subUnderlineActorElem"></div>
        </div>

        <div class="actorDetailsMovieList">
            <?php 
            foreach ($requestMovieList->fetchAll() as $movie) {
                $movieLengthFormatted = convertToHoursMins($movie["movie_length"], '%02d h %02d m');
                $moviePubDateYear = substr($movie["movie_frenchPublishDate"], 0, 4);
            ?>
                <!-- <a href="index.php?action=movieDetails&id=<?= $movie["movie_id"] ?>"><?= $movie["movie_title"] ?></a><br> -->
                

                
                    <a href="index.php?action=movieDetails&id=<?= $movie["movie_id"] ?>">
                        <li class="movieCard">
                            <div class="movieImgWrapper">
                                <img class="movieImg" src="<?= "./uploads/moviesImg/" . $movie["movie_imgUrl"] ?>">
                            </div>

                            <div class="movieContentWrapper">
                                <div class="movieTitleContainer">
                                    <p class="movieTitle yellow"><?= $movie["movie_title"] ?></p>
                                    <div class="underlineMovieTitle"></div>
                                </div>

                                <!-- Affichage des genres (tags) de chaque card Movie
                                <div class="">
                                </div>
                                -->
                                
                                <p class="movieSynopsisCard"><?= $movie["movie_synopsis"] ?></p>

                                <div class="movieInfosLine">
                                    <p class="movieRating"><?= $movie["movie_rating"]?>/5 <i class="yellow fa-solid fa-star"></i></p>
                                    <p class="movieLength"><?= $movieLengthFormatted ?></p>
                                </div>

                                <p class="moviePubDate"><?= $moviePubDateYear ?></p>
                            </div>
                        </li>
                    </a>
                 

            <?php
            }
            ?>
        </div>

    </div>

<?php
    $contenu = ob_get_clean();

    $activeNavHome = "";
    $activeNavMovies = "";
    $activeNavActors = "activeNav";
    $activeNavDirectors = "";
    $activeNavAdmin = "";

    $titre = "Détails de l'acteur";
    $titre_secondaire = "";

    require "view/template.php";
?>