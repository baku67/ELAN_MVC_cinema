<?php

    $movieDetails = $request2->fetch();
    ob_start();
?>

    <p>Détail du film: <?= $movieDetails["movie_title"] ?></p>
    <a href="javascript:history.go(-1)">Retour</a>
    <br>
    <p>Réalisateur: <?= $movieDetails["réalisateur"] ?></p>
    <p>Date de sortie: <?= $movieDetails["sortie"] ?></p>
    <p>Durée: <?= $movieDetails["movie_length"] ?></p>

<?php
    $contenu = ob_get_clean();
    $titre = "Détails du film";
    $titre_secondaire = "Détails du film";

    require "view/template.php";
?>