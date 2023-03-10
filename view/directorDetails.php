<?php

    $directorDetails = $request2->fetch();
    ob_start();
?>

    <p>Réalisateur: <?= $directorDetails["director_name"] ?></p>
    <br>
    <p>Sexe: <?= $directorDetails["person_gender"] ?></p>
    <p>Date de naissance: <?= $directorDetails["person_birthDate"] ?></p>

<?php
    $contenu = ob_get_clean();
    $titre = "Détails du réalisateur";
    $titre_secondaire = "Détails du réalisateur";

    require "view/template.php";
?>