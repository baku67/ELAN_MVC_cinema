<?php

    $movieDetails = $request2->fetch();

    function convertToHoursMins($time, $format = '%02d:%02d') {
        if ($time < 1) {
            return;
        }
        $hours = floor($time / 60);
        $minutes = ($time % 60);
        return sprintf($format, $hours, $minutes);
    }
    $durationformatted = convertToHoursMins($movieDetails["movie_length"], '%02d h %02d m');

    ob_start();
?>

    <div class="subtitleDiv">
        <h2 class="movieDetailTitle"><?= $movieDetails["movie_title"] ?></h2>
        <div class="underlineElem"></div>
    </div>

    <a class="backButton" href="javascript:history.go(-1)">Retour</a>



    

    <br>

    <div class="movieDetailGrid">

        <div class="movieDetailsImgDiv">
            <?php
                if ($movieDetails["movie_imgUrl"] == "") {
                ?>
                    <p>Aucune affiche disponible</p>
                <?php
                }
                else if ($movieDetails["movie_imgUrl"] != "") {
                ?>
                    <img class="movieDetailsImg" src="<?= './uploads/moviesImg/' . $movieDetails["movie_imgUrl"] ?>">
                <?php
                }
            ?>
        </div>


        <div class="movieDetailsInfos">

            <div class="movieDetailSubGrid">

                <div>
                    <div class="movieDetailSubtitleDiv">
                        <p class="movieDetailsSubtitle">Réalisateur</p>
                        <div class="underlineElem"></div>
                    </div>
                    <a href="index.php?action=directorDetails&id=<?= $movieDetails["director_id"] ?>" class="actorsCard alignLeft">

                        <div class="personCardImgWrapper">
                            <img class="personCardImg" src="<?= "./uploads/personImg/" . $movieDetails['person_imgUrl'] ?>">
                        </div>
                        <p class="directorCardName"><?= $movieDetails['réalisateur'] ?></p>
                    </a>
                </div>

                <div class="movieDetailInfoDiv">
                    <div class="movieDetailSubtitleDiv">
                        <p class="movieDetailsSubtitle">Infos</p>
                        <div class="underlineElem"></div>
                    </div>
                    <p>Date de sortie: <?= $movieDetails["sortie"] ?></p>
                    <p>Durée: <?= $durationformatted ?></p>
                    <p>Note: <?= $movieDetails["movie_rating"] ?>/5 <i class="yellow fa-solid fa-star"></i></p>
                    <p>
                        Genres: 
                        <?php
                        foreach ($requestGenres as $genre) {
                        ?>
                            <a href="index.php?action=listMoviesFiltered&filterId=<?= $genre["movieGenre_id"] ?>&filterLabel=<?= $genre["movieGenre_label"] ?>"><?= ucfirst($genre["movieGenre_label"]) ?></a>
                        <?php
                        }
                        ?>
                    </p>
                </div>

            </div>


            <br>


            <div>
                <div class="movieDetailSubtitleDiv">
                    <p class="movieDetailsSubtitle">Casting</p>
                    <div class="underlineElem"></div>
                </div>
                <ul class="movieDetailActorsDiv">
                    <?php
                    foreach ($requestCasting->fetchAll() as $actor) {
                    ?>  
                        <a href="index.php?action=actorDetails&id=<?= $actor['actor_id'] ?>" class="actorsCard">
                            <li>
                                <div class="personCardImgWrapper">
                                    <img class="personCardImg" src="./uploads/personImg/<?= $actor['person_imgUrl'] ?>">
                                </div>
                                <p class="actorCardName"><?= $actor["acteur"] ?></p>
                                <!-- Ajouter le role entres guillmets -->
                            </li>
                        </a>
                    <?php
                    }
                    ?>
                </ul>

            </div>
        </div>

    </div>







<?php
    $contenu = ob_get_clean();

    $activeNavHome = "";
    $activeNavMovies = "activeNav";
    $activeNavActors = "";
    $activeNavDirectors = "";
    $activeNavAdmin = "";

    $titre = "Détails du film";
    $titre_secondaire = "";

    require "view/template.php";
?>