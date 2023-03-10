<?php ob_start(); ?>

<p>Il y a <?= $request->rowCount() ?> films disponibles</p>

    <p>Filtrer par genre</p>
    <ul id="movieFilterGenreList">
        <!-- For each genre créer le bouton filtre (+localstorage pour garder et cumuler ?) -->
        <?php 
        foreach($requestGenre->fetchAll() as $genre) {
        ?>
            <li><a href="index.php?action=listMoviesFiltered&filter=<?= $genre["movieGenre_id"] ?>" onclick=addFilterLocalStrg()><?= ucfirst($genre["movieGenre_label"]) ?></a></li>
        <?php
        }
        ?>
    </ul>

    <script>
        window.onload() = function() {
            function addFilterLocalStrg() {

            }
        }
    </script>


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