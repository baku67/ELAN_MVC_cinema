<?php ob_start(); ?>

    <p class="countElems">Il y a <?= $request->rowCount() ?> acteurs</p>

    <div class="subtitleDiv">
        <h2 class="movieListTitle">Acteurs</h2>
        <div class="underlineMovieListTitle"></div>
    </div>

    <ul class="actorsListGrid">
        <?php
        foreach ($request->fetchAll() as $actor) {
        ?>  
            <a href="index.php?action=actorDetails&id=<?= $actor['actor_id'] ?>" class="actorsCard">
                <li>
                    <div class="personCardImgWrapper">
                        <img class="personCardImg" src="<?= "./uploads/personImg/" . $actor['person_imgUrl'] ?>">
                    </div>
                    <p class="actorCardName"><?= $actor["actorName"] ?></p>
                </li>
            </a>
        <?php
        }
        ?>
    </ul>

    <!--
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
        -->



<?php 
    $activeNavHome = "";
    $activeNavMovies = "";
    $activeNavActors = "activeNav";
    $activeNavDirectors = "";
    $activeNavAdmin = "";

    $titre = "Liste des acteurs";
    $titre_secondaire = "";
    $contenu = ob_get_clean();

    require "view/template.php";
?>