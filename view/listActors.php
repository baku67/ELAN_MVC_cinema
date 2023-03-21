<?php ob_start(); ?>

<p>Il y a <?= $request->rowCount() ?> acteurs</p>
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
            foreach($request->fetchAll() as $actor) {
            ?>
                <tr>
                    <td><?= $actor["actorName"] ?></td>
                    <td><a href="index.php?action=actorDetails&id=<?= $actor["actor_id"] ?>">Voir fiche détaillée</a></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>



<?php 
    $activeNavHome = "";
    $activeNavMovies = "";
    $activeNavActors = "activeNav";
    $activeNavDirectors = "";
    $activeNavAdmin = "";

    $titre = "Liste des acteurs";
    $titre_secondaire = "Liste des acteurs";
    $contenu = ob_get_clean();

    require "view/template.php";
?>