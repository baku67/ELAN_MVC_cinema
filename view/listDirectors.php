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



    <p>Ajouter un réalisateur:</p>
    <form action="index.php?action=addDirector" method="post">
        <label for="dirFirstName">Prénom:</label>
        <input name="dirFirstName" id="dirFirstName" type="text" placeholder="">
        <label for="dirLastName">Nom:</label>
        <input name="dirLastName" id="dirLastName" type="text" placeholder="">
        <fieldset>
            <legend>Genre:</legend>
            <div>
                <input type="radio" id="femme" name="dirGender" value="femme"
                        checked>
                <label for="femme">Femme</label>
            </div>
            <div>
                <input type="radio" id="homme" name="dirGender" value="homme">
                <label for="homme">Homme</label>
            </div>
            <div>
                <input type="radio" id="autre" name="dirGender" value="autre">
                <label for="autre">Autre</label>
            </div>
        </fieldset>
        <label for="dirBirthDate">Date de naissance:</label>
        <input name="dirBirthDate" id="dirBirthDate" type="date" placeholder="">

        <input type="submit" name="submit" value="Ajouter">
    </form>





<?php 
    $titre = "Liste des réalisateurs";
    $titre_secondaire = "Liste des réalisateurs";
    $contenu = ob_get_clean();

    require "view/template.php";
?>