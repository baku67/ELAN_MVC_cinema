<?php
    $titre = "Bienvenue";
    $titre_secondaire = "Bienvenue";
    ob_start();
?>

    <p>TEST</p>
    <a href="index.php?action=listMovies">VOIR LA LISTE DES FILMS</a>

<?php 
    $contenu = ob_get_clean();
    require "view/template.php";
?>
