<?php ob_start(); ?>

    <p class="countElems">Il y a <?= $request->rowCount() ?> réalisateurs</p>

    <div class="subtitleDiv">
        <h2 class="movieListTitle">Réalisateurs</h2>
        <div class="underlineMovieListTitle"></div>
    </div>


    <ul class="directorsListGrid">
        <?php
        foreach ($request->fetchAll() as $dir) {
        ?>  
            <a href="index.php?action=directorDetails&id=<?= $dir['director_id'] ?>" class="actorsCard">
                <li>
                    <div class="personCardImgWrapper">
                        <img class="personCardImg" src="<?= $dir['person_imgUrl'] ?>">
                    </div>
                    <p class="directorCardName"><?= $dir["director_name"] ?></p>
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
    -->



<?php 
    $activeNavHome = "";
    $activeNavMovies = "";
    $activeNavActors = "";
    $activeNavDirectors = "activeNav";
    $activeNavAdmin = "";

    $titre = "Liste des réalisateurs";
    $titre_secondaire = "";
    $contenu = ob_get_clean();

    require "view/template.php";
?>