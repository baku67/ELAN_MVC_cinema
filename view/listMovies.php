<?php ob_start(); ?>

<p>Il y a <?= $request->rowCount() ?> films disponibles</p>


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