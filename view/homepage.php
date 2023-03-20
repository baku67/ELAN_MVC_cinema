<?php
    $titre = "Bienvenue";
    $titre_secondaire = "Bienvenue";
    ob_start();
?>

    <a href="index.php?action=listMovies">Voir les films disponibles</a>
    <br>
    <a href="index.php?action=listActors">Voir la liste des acteurs</a>
    <br>
    <a href="index.php?action=listDirectors">Voir la liste des réalisateurs</a>

    <br><br>

    <p>Ajouter un genre:</p>
    <form action="index.php?action=addGenre" method="post">
        <label for="genreTitle"></label>
        <input name="genreTitle" type="text" placeholder="Ex: Drame, Fiction, ...">
        <input type="submit" name="submit" value="Ajouter">
    </form>

    <p>Ajouter un role:</p>
    <form action="index.php?action=addRole" method="post">
        <label for="roleName"></label>
        <input name="roleName" type="text" placeholder="Ex: Zorro, Tinky Winky, ...">
        <input type="submit" name="submit" value="Ajouter">
    </form>

<?php 
    $activeNavHome = "activeNav";
    $activeNavMovies = "";
    $activeNavActors = "";
    $activeNavDirectors = "";
    $activeNavAdmin = "";

    $contenu = ob_get_clean();
    require "view/template.php";
?>
