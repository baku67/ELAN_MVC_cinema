<?php ob_start(); ?>

<p>Il y a <?= $request->rowCount() ?> films disponibles</p>
<a href="index.php">Revenir à l'accueil</a>

    <p>Filtrer par genre</p>
    <?php 
    if (!isset($_SESSION["filters"])) {
    ?>
        <ul id="movieFilterGenreList">
            <!-- For each genre créer le bouton filtre (+localstorage pour garder et cumuler ?) -->
            <?php 
            foreach($requestGenre->fetchAll() as $genre) {
            ?>
                <li><a href="index.php?action=listMoviesFiltered&filterId=<?= $genre["movieGenre_id"] ?>&filterLabel=<?= $genre["movieGenre_label"] ?>"><?= ucfirst($genre["movieGenre_label"]) ?></a></li>
            <?php
            }
            ?>
        </ul>
    <?php
    }
    else {
    ?>
        <ul id="movieFilterGenreList">
            <!-- For each genre créer le bouton filtre (+localstorage pour garder et cumuler ?) -->
            <?php 
            foreach($requestGenre->fetchAll() as $genre) {
            ?>
                <?php
                if(!in_array($genre["movieGenre_id"], $_SESSION["filters"][0])) {
                ?>
                <li><a href="index.php?action=listMoviesFiltered&filterId=<?= $genre["movieGenre_id"] ?>&filterLabel=<?= $genre["movieGenre_label"] ?>"><?= ucfirst($genre["movieGenre_label"]) ?></a></li>
                <?php
                }
                ?>
            <?php
            }
            ?>
        </ul>
    <?php
    }
    ?>
    


    <p>Filtres actifs:</p>
    <?php 
    if(isset($_SESSION["filters"])) {
        // [1]: filterLabel
        foreach($_SESSION["filters"][0] as $filter)
        ?>
            <span><?= ucfirst($filter) ?></span>
        <?php
    }
    else {
        echo "Aucun filtre actif";
    }
    ?>



    <table>
        <thead>
            <tr>
                <th>Titre</th>
                <th>Année de sortie</th>
                <th>Details</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($request->fetchAll() as $movie) {
            ?>
                <tr>
                    <td><?= $movie["movie_title"] ?></td>
                    <td><?= $movie["sortie"] ?></td>
                    <td><a href="index.php?action=movieDetails&id=<?= $movie["movie_id"] ?>">Voir fiche détaillée</a></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>




<?php 
    $titre = "Liste des films";
    $titre_secondaire = "Liste des films";
    $contenu = ob_get_clean();

    require "view/template.php";
?>