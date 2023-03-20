<?php

    $actorDetails = $request2->fetch();
    ob_start();
?>

    <p>Acteur: <?= $actorDetails["actor_name"] ?></p>
    <a href="javascript:history.go(-1)">Retour</a>
    <br>
    <p>Sexe: <?= $actorDetails["person_gender"] ?></p>
    <p>Date de naissance: <?= $actorDetails["person_birthDate"] ?></p>

    <br><br>

    <h3>Filmographie</h3>
    <?php 
    foreach ($requestMovieList->fetchAll() as $movie) {
    ?>
        <a href="index.php?action=movieDetails&id=<?= $movie["movie_id"] ?>"><?= $movie["movie_title"] ?></a><br>
        
    <?php
    }
    ?>

<?php
    $contenu = ob_get_clean();

    $activeNavHome = "";
    $activeNavMovies = "";
    $activeNavActors = "activeNav";
    $activeNavDirectors = "";
    $activeNavAdmin = "";

    $titre = "Détails de l'acteur";
    $titre_secondaire = "Détails de l'acteur";

    require "view/template.php";
?>