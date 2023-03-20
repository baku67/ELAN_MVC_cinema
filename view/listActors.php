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

    <br>

    <p>Ajouter un acteur:</p>
    <form action="index.php?action=addActor" method="post">
        <label for="actorFirstName">Prénom:</label>
        <input name="actorFirstName" id="actorFirstName" type="text" placeholder="">
        <label for="actorLastName">Nom:</label>
        <input name="actorLastName" id="actorLastName" type="text" placeholder="">
        <fieldset>
            <legend>Genre:</legend>
            <div>
                <input type="radio" id="femme" name="actorGender" value="femme"
                        checked>
                <label for="femme">Femme</label>
            </div>
            <div>
                <input type="radio" id="homme" name="actorGender" value="homme">
                <label for="homme">Homme</label>
            </div>
            <div>
                <input type="radio" id="autre" name="actorGender" value="autre">
                <label for="autre">Autre</label>
            </div>
        </fieldset>
        <label for="actorBirthDate">Date de naissance:</label>
        <input name="actorBirthDate" id="actorBirthDate" type="date" placeholder="">

        <input type="submit" name="submit" value="Ajouter">
    </form>




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