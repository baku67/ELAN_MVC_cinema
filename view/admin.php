<?php
    $titre = "Admin";
    $titre_secondaire = "";
    $genreList = $requestGenre->fetchAll();
    ob_start();
?>

    <div class="adminContainer">
    
        <div class="formMovieWrapper">
            <h3 id="formMovieTitle" class="formTitle">Ajouter un film <i id="chevronCollapse" class="fa-solid fa-chevron-down"></i></h3>
            <form id="formMovieContent" class="form" action="index.php?action=addMovie" method="POST" enctype="multipart/form-data">
                

                <div class="formContent">
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
                        <label for="file">Affiche:</label>
                        <input type="file" id="file" name="file" accept="image/png, image/jpeg">
                    </div>


                    <div>
                        <p></p>
                        <fieldset>
                            <legend>Genre(s):</legend>
                            <?php
                            foreach($genreList as $genre) {
                            ?>
                                <label for="<?= $genre["movieGenre_id"] ?>"><?= $genre["movieGenre_label"] ?></label>
                                <input value="<?= $genre["movieGenre_id"] ?>" name="genre[]" id="<?= $genre["movieGenre_id"] ?>" type="checkbox">
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

                    <input class="formSubmitButton" type="submit" name="submit" value="Ajouter">
                </div>
                
                <script>
                    $(':radio').change(function() {
                        console.log('New star rating: ' + this.value);
                    });

                    // var toggleMovie = false;

                    document.getElementById('formMovieTitle').addEventListener("click", function() {
                        if (document.getElementById("formMovieContent").className == "form" || document.getElementById("formMovieContent").className == "form animFormCollapse") {
                            document.getElementById("formMovieContent").classList.toggle("animFormShow");
                            document.getElementById("chevronCollapse").classList.toggle("rotateChevronShow");
                        }
                        else {
                            document.getElementById("formMovieContent").classList.toggle("animFormCollapse");
                            document.getElementById("chevronCollapse").classList.toggle("rotateChevronCollapse");
                        }
                    })
                </script>
                
            </form>
        </div>


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



        <p>Ajouter un genre:</p>
        <form action="index.php?action=addGenre" method="post">
            <label for="genreTitle"></label>
            <input name="genreTitle" type="text" placeholder="Ex: Drame, Fiction, ...">
            <input type="submit" name="submit" value="Ajouter">
        </form>

        <p>Ajouter un role:</p>
        <form action="index.php?action=addRole" method="post">
            <label for="roleName"></label>
            <input name="roleName" type="text" placeholder="Ex: Zorro, Tinky Winky, ...">
            <input type="submit" name="submit" value="Ajouter">
        </form>

    </div>







<?php 
    $activeNavHome = "";
    $activeNavMovies = "";
    $activeNavActors = "";
    $activeNavDirectors = "";
    $activeNavAdmin = "activeNav";

    $contenu = ob_get_clean();
    require "view/template.php";
?>
