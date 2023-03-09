<?php

    $actorDetails = $request2->fetch();
    ob_start();
?>

    <p>Acteur: <?= $actorDetails["actor_name"] ?></p>
    <br>
    <p>Sexe: <?= $actorDetails["person_gender"] ?></p>
    <p>Date de naissance: <?= $actorDetails["person_birthDate"] ?></p>

<?php
    $contenu = ob_get_clean();
    $titre = "Détails de l'acteur";
    $titre_secondaire = "Détails de l'acteur";

    require "view/template.php";
?>