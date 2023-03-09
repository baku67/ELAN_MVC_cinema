<?php ob_start(); ?>

<p>Il y a <?= $requete->rowCount() ?> films</p>

<?php
    foreach($requete->fetchAll() as $movie) {
    ?>
        <br><p><?= $movie["movie_title"] ?></p>

    <?php
    }
?>



<?php 
    $titre = "Liste des films";
    $titre_secondaire = "Liste des films";
    $contenu = ob_get_clean();

    require "view/template.php";
?>