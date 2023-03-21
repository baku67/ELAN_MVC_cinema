<?php

    $movieDetails = $request2->fetch();
    ob_start();
?>

    <div class="subtitleDiv">
        <h2><?= $movieDetails["movie_title"] ?></h2>
        <div class="underlineElem"></div>
    </div>

    <a class="backButton" href="javascript:history.go(-1)">Retour</a>



    

    <br>


    <?php
        if ($movieDetails["movie_imgUrl"] == "") {
        ?>
            <p>Aucune affiche disponible</p>
        <?php
        }
        else if ($movieDetails["movie_imgUrl"] != "") {
        ?>
            <img src="<?= 'uploads/' . $movieDetails["movie_imgUrl"] ?>">
        <?php
        }
    ?>
    <br>
    <p>Réalisateur: <a href="index.php?action=directorDetails&id=<?= $movieDetails["director_id"] ?>"><?= $movieDetails["réalisateur"] ?></a></p>

    <p>Date de sortie: <?= $movieDetails["sortie"] ?></p>
    <p>Durée: <?= $movieDetails["movie_length"] ?></p>
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

    <br>

    <?php 
    foreach ($requestCasting->fetchAll() as $actor) {
    ?>
        <p style="display:inline-flex;">
            <a href="index.php?action=actorDetails&id=<?= $actor["actor_id"] ?>"><?= $actor["acteur"] ?></a>
            <span>&nbsp;dans le rôle de <?= $actor["role_name"] ?></span>
        </p>
        <br>

    <?php
    }
    ?>

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