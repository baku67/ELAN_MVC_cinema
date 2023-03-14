<?php ob_start(); ?>

<p>Il y a <?= $request->rowCount() ?> Réalisateurs</p>
<a href="javascript:history.go(-1)">Retour</a>


    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Details</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($request->fetchAll() as $director) {
            ?>
                <tr>
                    <td><?= $director["director_name"] ?></td>
                    <td><a href="index.php?action=directorDetails&id=<?= $director["director_id"] ?>">Voir fiche détaillée</a></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>




<?php 
    $titre = "Liste des réalisateurs";
    $titre_secondaire = "Liste des réalisateurs";
    $contenu = ob_get_clean();

    require "view/template.php";
?>