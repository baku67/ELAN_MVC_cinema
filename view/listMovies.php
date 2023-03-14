<?php 
    ob_start(); 
    $genreList = $requestGenre->fetchAll();
?>

<p>Il y a <?= $request->rowCount() ?> films disponibles</p>
<a href="index.php">Revenir à l'accueil</a>

    <p>Filtrer par genre</p>
    <?php 
    if (!isset($_SESSION["filters"])) {
    ?>
        <ul id="movieFilterGenreList">
            <!-- For each genre créer le bouton filtre (+localstorage pour garder et cumuler ?) -->
            <?php 
            foreach($genreList as $genre) {
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
            foreach($genreList as $genre) {
            ?>
                <?php
                // if(!in_array($genre["movieGenre_id"], $_SESSION["filters"][0])) {
                ?>
                    <li><a href="index.php?action=listMoviesFiltered&filterId=<?= $genre["movieGenre_id"] ?>&filterLabel=<?= $genre["movieGenre_label"] ?>"><?= ucfirst($genre["movieGenre_label"]) ?></a></li>
                <?php
                // }
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
        foreach($_SESSION["filters"] as $filter)
        ?>
            <span class="filterActiv"><?= ucfirst($filter["filterLabel"]) ?><a href="index.php?action=removeFilter&id=<?= $filter["filterId"] ?>" class="removeFilter">&times;</a></span>
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


    <form class="form" action="index.php?action=addMovie" method="POST">
        <h3>Ajouter un film:</h3>
        <input type="hidden" name="type" value="addMovieForm">
        <div>
            <label for="movieTitle">Titre:</label>
            <input name="movieTitle" type="text" placeholder="Ex: Titanic, Star Wars, ...">
        </div>
        <div>
            <label for="moviePublishDate">Année de sortie:</label>
            <!-- <input name="moviePublishDate" type="number" min="1900" max="2099" step="1" value="2023"> -->
            <input name="moviePublishDate" type="date">
        </div>
        <div>
            <label for="movieLength">Durée:</label>
            <input name="movieLength" type="number" placeholder="en minutes">
        </div>
        <div>
            <label for="movieSynopsis">Synopsis:</label>
            <textarea name="movieSynopsis"></textarea>
        </div>
        <div>
            <label for="movieDirector">Réalisateur:</label>
            <select name="movieDirector">
                <option value="">-- Veuillez choisir un réalisateur</option>
                <?php 
                    foreach ($requestDirectorsSelect->fetchAll() as $director) {
                ?>
                        <option value="<?= $director["director_id"] ?>"><?= $director["Director"] ?></option>
                <?php
                    }
                ?>
            </select>
        </div>
        <div>
            <label for="movieImage">Affiche:</label>
            <input type="file" name="movieImage" accept="image/png, image/jpeg">
        </div>


        <div>
            <p></p>
            <fieldset>
                <legend>Genre(s):</legend>
                <?php
                foreach($genreList as $genre) {
                ?>
                    <label for="<?= $genre["movieGenre_id"] ?>"><?= $genre["movieGenre_label"] ?></label>
                    <input name="<?= $genre["movieGenre_id"] ?>" id="<?= $genre["movieGenre_id"] ?>" type="checkbox">
                <?php
                }
                ?>
            </fieldset>
        </div>

        

        <div class="rating">
            <label>
                <input type="radio" name="stars" value="1" />
                <span class="icon">★</span>
            </label>
            <label>
                <input type="radio" name="stars" value="2" />
                <span class="icon">★</span>
                <span class="icon">★</span>
            </label>
            <label>
                <input type="radio" name="stars" value="3" />
                <span class="icon">★</span>
                <span class="icon">★</span>
                <span class="icon">★</span>   
            </label>
            <label>
                <input type="radio" name="stars" value="4" />
                <span class="icon">★</span>
                <span class="icon">★</span>
                <span class="icon">★</span>
                <span class="icon">★</span>
            </label>
            <label>
                <input type="radio" name="stars" value="5" />
                <span class="icon">★</span>
                <span class="icon">★</span>
                <span class="icon">★</span>
                <span class="icon">★</span>
                <span class="icon">★</span>
            </label>
        </div>

        <br>

        <input type="submit" name="submit" value="Ajouter">

        
        <script>
            $(':radio').change(function() {
                console.log('New star rating: ' + this.value);
            });
        </script>


        
    </form>




<?php 
    $titre = "Liste des films";
    $titre_secondaire = "Liste des films";
    $contenu = ob_get_clean();

    require "view/template.php";
?>