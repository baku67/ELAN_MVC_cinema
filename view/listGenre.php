<?php ob_start(); ?>

<p>Il y a <?= $request->rowCount() ?> Genres</p>


    <table>
        <thead>
            <tr>
                <th>Nom</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($request->fetchAll() as $genre) {
            ?>
                <tr>
                    <td><?= $genre["genre_label"] ?></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>




<?php 
    $titre = "Liste des genres";
    $titre_secondaire = "Liste des genres";
    $contenu = ob_get_clean();

    require "view/template.php";
?>