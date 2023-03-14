<?php

    $movieDetails = $request2->fetch();
    ob_start();
?>

    <p>Détail du film: <?= $movieDetails["movie_title"] ?></p>
    <a href="javascript:history.go(-1)">Retour</a>
    <br>
    <p>Réalisateur: <a href="index.php?action=directorDetails&id=<?= $movieDetails["director_id"] ?>"><?= $movieDetails["réalisateur"] ?></a></p>

    <p>Date de sortie: <?= $movieDetails["sortie"] ?></p>
    <p>Durée: <?= $movieDetails["movie_length"] ?></p>

    <br>

    <?php 
    foreach ($requestCasting->fetchAll() as $actor) {
    ?>
        <a href="index.php?action=actorDetails&id=<?= $actor["actor_id"] ?>"><?= $actor["acteur"] ?></a><br>

    <?php
    }
    ?>

<?php
    $contenu = ob_get_clean();
    $titre = "Détails du film";
    $titre_secondaire = "Détails du film";

    require "view/template.php";
?>