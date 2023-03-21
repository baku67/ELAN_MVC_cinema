<?php 
    ob_start(); 
    $genreList = $requestGenre->fetchAll();
    $movieList = $request->fetchAll();
    // var_dump($lastMovieId);
?>

<div class="movieContent">

    <p class="countElems">Il y a <?= $request->rowCount() ?> films disponibles</p>
    <!-- <a href="index.php">Revenir à l'accueil</a> -->

        <div class="filtersContainer">
            <p class="filterIcon"><i class="fa-solid fa-filter-circle-xmark"></i></p>
            <?php 
            if (!isset($_SESSION["filters"])) {
            ?>
                <ul id="movieFilterGenreList">
                    <!-- For each genre créer le bouton filtre (+localstorage pour garder et cumuler ?) -->
                    <?php 
                    foreach($genreList as $genre) {
                    ?>
                        <li>
                            <a style="color:<?= $genre["genreColor"] ?>; border: 2px solid <?= $genre["genreColor"] ?>" href="index.php?action=listMoviesFiltered&filterId=<?= $genre["movieGenre_id"] ?>&filterLabel=<?= $genre["movieGenre_label"] ?>"><?= ucfirst($genre["movieGenre_label"]) ?><img class="genreImg" src="<?= $genre["genreImgUrl"]?>"></a>
                        </li>
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
                            <li>
                                <a href="index.php?action=listMoviesFiltered&filterId=<?= $genre["movieGenre_id"] ?>&filterLabel=<?= $genre["movieGenre_label"] ?>"><?= ucfirst($genre["movieGenre_label"]) ?><img class="genreImg" src="<?= $genre["genreImgUrl"]?>"></a>
                            </li>
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
        </div>
        

        <br><div style="display:inline-flex">
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
                // echo "Aucun filtre actif";
            ?>
                <p> Aucun filtre actif</p>
            <?php
            }
            ?>
        </div>



        <!-- pour chaque genre, créer une section 
            foreach ($genreList->fetchAll() as $genre) {
        FIN -->

        <div id="moviesContainer">
            <div class="subtitleDiv">
                <h2>Catalogue</h2>
                <div class="underlineElem"></div>
            </div>

            <div class="movieListDiv">   
                <ul id="movieListGrid">
                    <?php 
                    function convertToHoursMins($time, $format = '%02d:%02d') {
                        if ($time < 1) {
                            return;
                        }
                        $hours = floor($time / 60);
                        $minutes = ($time % 60);
                        return sprintf($format, $hours, $minutes);
                    }

                    foreach ($movieList as $movie) {
                        $movieLengthFormatted = convertToHoursMins($movie["movie_length"], '%02d h %02d m');
                        $moviePubDateYear = substr($movie["movie_frenchPublishDate"], 0, 4);
                    ?>
                        <a href="index.php?action=movieDetails&id=<?= $movie["movie_id"] ?>">
                            <li class="movieCard">
                                <div class="movieImgWrapper">
                                    <img class="movieImg" src="<?= "./uploads/moviesImg/" . $movie["movie_imgUrl"] ?>">
                                </div>

                                <div class="movieContentWrapper">
                                    <div class="movieTitleContainer">
                                        <p class="movieTitle yellow"><?= $movie["movie_title"] ?></p>
                                        <div class="underlineMovieTitle"></div>
                                    </div>

                                    <!-- Affichage des genres (tags) de chaque card Movie
                                    <div class="">
                                    </div>
                                    -->
                                    
                                    <p class="movieSynopsisCard"><?= $movie["movie_synopsis"] ?></p>

                                    <div class="movieInfosLine">
                                        <p class="movieRating"><?= $movie["movie_rating"]?> <i class="yellow fa-solid fa-star"></i></p>
                                        <p class="movieLength"><?= $movieLengthFormatted ?></p>
                                    </div>

                                    <p class="moviePubDate"><?= $moviePubDateYear ?></p>
                                </div>
                            </li>
                        </a>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </div>









        <table id="movieListTable">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Année de sortie</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach($movieList as $movie) {
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


        <script>
            // $(document).ready( function () {
            //     $('#movieListTable').DataTable();
            // } );
        </script>


    </div>




<?php 
    $activeNavHome = "";
    $activeNavMovies = "activeNav";
    $activeNavActors = "";
    $activeNavDirectors = "";
    $activeNavAdmin = "";

    $titre = "Liste des films";
    $titre_secondaire = "";
    $contenu = ob_get_clean();

    require "view/template.php";
?>