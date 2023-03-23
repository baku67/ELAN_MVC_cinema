<?php
    $titre = "Admin";
    $titre_secondaire = "";
    $genreList = $requestGenre->fetchAll();
    ob_start();
?>

    <script>
        $( function() {
            $.widget( "custom.iconselectmenu", $.ui.selectmenu, {
            _renderItem: function( ul, item ) {
                var li = $( "<li>" ),
                wrapper = $( "<div>", { text: item.label } );
        
                if ( item.disabled ) {
                li.addClass( "ui-state-disabled" );
                }
        
                $( "<span>", {
                style: item.element.attr( "data-style" ),
                "class": "ui-icon " + item.element.attr( "data-class" )
                })
                .appendTo( wrapper );
        
                return li.append( wrapper ).appendTo( ul );
            }
            });
        
            $( "#people" )
            .iconselectmenu()
            .iconselectmenu( "menuWidget")
                .addClass( "ui-menu-icons avatar" );

            $( "#actorSelect" )
            .iconselectmenu()
            .iconselectmenu( "menuWidget")
                .addClass( "ui-menu-icons avatar" );

            $( "#movieSelect" )
            .iconselectmenu()
            .iconselectmenu( "menuWidget")
                .addClass( "ui-menu-icons avatar" );

            // $( "#roleSelect" )
            // .iconselectmenu()
            // .iconselectmenu( "menuWidget")
            //     .addClass( "ui-menu-icons avatar" );
        } );
    </script>

    <style>
        h2 {
        margin: 30px 0 0 0;
        }
        fieldset {
        border: 0;
        }
        label {
        display: block;
        }
    
        /* select with CSS avatar icons */
        option.avatar {
        background-repeat: no-repeat !important;
        padding-left: 20px;
        }
        .avatar .ui-icon {
        background-position: left top;
        }
    </style>




    <div class="adminContainer">

        <div class="subtitleDiv">
            <h2 class="movieListTitle">Espace Administrateur</h2>
            <div class="underlineMovieListTitle"></div>
        </div>
    
        <div class="formMovieWrapper">
            <h3 id="formMovieTitle" class="formTitle">Ajouter un film <i id="chevronCollapseMovie" class="fa-solid fa-chevron-down"></i></h3>
            <form id="formMovieContent" class="form" action="index.php?action=addMovie" method="POST" enctype="multipart/form-data">
                

                <div class="formContent">
                    <input type="hidden" name="type" value="addMovieForm">
                    <div>
                        <label class="labelLight" for="movieTitle">Titre:</label>
                        <input class="inputForm" name="movieTitle" type="text" placeholder="Ex: Titanic, Star Wars, ..." required>
                    </div>
                    <div>
                        <label class="labelLight" for="moviePublishDate">Année de sortie:</label>
                        <!-- <input name="moviePublishDate" type="number" min="1900" max="2099" step="1" value="2023"> -->
                        <input class="inputForm" name="moviePublishDate" type="date" required>
                    </div>
                    <div>
                        <label class="labelLight" for="movieLength">Durée:</label>
                        <input class="inputForm" name="movieLength" type="number" placeholder="En minutes" required>
                    </div>
                    <div>
                        <label class="labelSynopsis" for="movieSynopsis">Synopsis:</label>
                        <textarea class="inputForm textareaSynopsis" rows="7" name="movieSynopsis"></textarea>
                    </div>
                    <div>
                        <label class="labelLight" for="people">Réalisateur:</label>
                        <select id="people" class="inputForm" name="movieDirector" required>
                            <option value="">-- Veuillez choisir un réalisateur</option>
                            <?php 
                                foreach ($requestDirectorsSelect->fetchAll() as $director) {
                                    $pathAvatar = $director["person_imgUrl"];
                                    $finalPath = str_replace("personImg/", "personImg/avatarSelect/", $pathAvatar);
                            ?>

                                    <option data-class="avatar" data-style="background-image: url(<?= $finalPath ?>);" value="<?= $director["director_id"] ?>">
                                        <!-- <img src="<?= $director["person_imgUrl"] ?>"> -->
                                        <?= $director["Director"] ?>
                                    </option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                    <div>
                        <label class="labelLight" for="file">Affiche:</label>
                        <input class="inputForm" type="file" id="file" name="file" accept="image/png, image/jpeg">
                    </div>


                    <div>
                        <fieldset class="genreCheckBoxDiv" required>
                            <legend class="labelLight">Genre(s):</legend>
                            <?php
                            foreach($genreList as $genre) {
                            ?>
                                <input value="<?= $genre["movieGenre_id"] ?>" name="genre[]" id="<?= $genre["movieGenre_id"] ?>" type="checkbox">
                                <label for="<?= $genre["movieGenre_id"] ?>"><?= ucfirst($genre["movieGenre_label"]) ?></label>
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
                    document.getElementById('formMovieTitle').addEventListener("click", function() {
                        if (document.getElementById("formMovieContent").className == "form" || document.getElementById("formMovieContent").className == "form animFormCollapse") {
                            document.getElementById("formMovieContent").classList.toggle("animFormShow");
                            document.getElementById("chevronCollapseMovie").classList.toggle("rotateChevronShow");
                            document.getElementById("formMovieTitle").style.borderBottomLeftRadius = "0px";
                            document.getElementById("formMovieTitle").style.borderBottomRightRadius = "0px";

                        }
                        else {
                            document.getElementById("formMovieContent").classList.toggle("animFormCollapse");
                            document.getElementById("chevronCollapseMovie").classList.toggle("rotateChevronCollapse");
                            document.getElementById("formMovieTitle").style.borderBottomLeftRadius = "7px";
                            document.getElementById("formMovieTitle").style.borderBottomRightRadius = "7px";
                        }
                    })
                </script>
                
            </form>
        </div>


        <div class="formMovieWrapper">
            <h3 id="formActorTitle" class="formTitle">Ajouter un acteur <i id="chevronCollapseActor" class="fa-solid fa-chevron-down"></i></h3>
            <form id="formActorContent" class="form" action="index.php?action=addActor" method="post">
                <div class="formContent">
                    <label class="labelLight" for="actorFirstName">Prénom:</label>
                    <input class="inputForm" name="actorFirstName" id="actorFirstName" type="text" placeholder="">
                    <label class="labelLight" for="actorLastName">Nom:</label>
                    <input class="inputForm" name="actorLastName" id="actorLastName" type="text" placeholder="">
                    <fieldset style="display:inline-flex;">
                        <legend class="labelLight">Genre:</legend>
                        <div style="margin: 0 3px;">
                            <input type="radio" id="femme" name="actorGender" value="femme"
                                    checked>
                            <label for="femme">Femme</label>
                        </div>
                        <div style="margin: 0 3px;">
                            <input type="radio" id="homme" name="actorGender" value="homme">
                            <label for="homme">Homme</label>
                        </div>
                        <div style="margin: 0 3px;">
                            <input type="radio" id="autre" name="actorGender" value="autre">
                            <label for="autre">Autre</label>
                        </div>
                    </fieldset>
                    <label class="labelLight" for="actorBirthDate">Date de naissance:</label>
                    <input class="inputForm" name="actorBirthDate" id="actorBirthDate" type="date" placeholder="">

                    <label class="labelLight" for="file">Portrait:</label>
                    <input class="inputForm" type="file" id="file" name="file" accept="image/png, image/jpeg">

                    <br>
                    <input class="formSubmitButton" type="submit" name="submit" value="Ajouter">
                </div>

                <script>
                    document.getElementById('formActorTitle').addEventListener("click", function() {
                        if (document.getElementById("formActorContent").className == "form" || document.getElementById("formActorContent").className == "form animFormCollapse") {
                            document.getElementById("formActorContent").classList.toggle("animFormShow");
                            document.getElementById("chevronCollapseActor").classList.toggle("rotateChevronShow");
                            document.getElementById("formActorTitle").style.borderBottomLeftRadius = "0px";
                            document.getElementById("formActorTitle").style.borderBottomRightRadius = "0px";
                        }
                        else {
                            document.getElementById("formActorContent").classList.toggle("animFormCollapse");
                            document.getElementById("chevronCollapseActor").classList.toggle("rotateChevronCollapse");
                            document.getElementById("formActorTitle").style.borderBottomLeftRadius = "7px";
                            document.getElementById("formActorTitle").style.borderBottomRightRadius = "7px";
                        }
                    })
                </script>
            </form>
        </div>




        <div class="formDirWrapper">
            <h3 id="formDirTitle" class="formTitle">Ajouter un réalisateur <i id="chevronCollapseDir" class="fa-solid fa-chevron-down"></i></h3>
            <form id="formDirContent" class="form" action="index.php?action=addDirector" method="post">
                <div class="formContent">
                    <label class="labelLight" for="dirFirstName">Prénom:</label>
                    <input class="inputForm" name="dirFirstName" id="dirFirstName" type="text" placeholder="">
                    <label class="labelLight" for="dirLastName">Nom:</label>
                    <input class="inputForm" name="dirLastName" id="dirLastName" type="text" placeholder="">
                    <fieldset style="display:inline-flex;">
                        <legend class="labelLight">Genre:</legend>
                        <div style="margin: 0 3px;">
                            <input type="radio" id="femme" name="dirGender" value="femme"
                                    checked>
                            <label for="femme">Femme</label>
                        </div>
                        <div style="margin: 0 3px;">
                            <input type="radio" id="homme" name="dirGender" value="homme">
                            <label for="homme">Homme</label>
                        </div>
                        <div style="margin: 0 3px;">
                            <input type="radio" id="autre" name="dirGender" value="autre">
                            <label for="autre">Autre</label>
                        </div>
                    </fieldset>
                    <label class="labelLight" for="dirBirthDate">Date de naissance:</label>
                    <input class="inputForm" name="dirBirthDate" id="dirBirthDate" type="date" placeholder="">

                    <label class="labelLight" class="labelLight" for="file">Portrait:</label>
                    <input class="inputForm" class="inputForm" type="file" id="file" name="file" accept="image/png, image/jpeg">

                    <br>

                    <input class="formSubmitButton" type="submit" name="submit" value="Ajouter">
                </div>

                <script>
                    document.getElementById('formDirTitle').addEventListener("click", function() {
                        if (document.getElementById("formDirContent").className == "form" || document.getElementById("formDirContent").className == "form animFormCollapse") {
                            document.getElementById("formDirContent").classList.toggle("animFormShow");
                            document.getElementById("chevronCollapseDir").classList.toggle("rotateChevronShow");
                            document.getElementById("formDirTitle").style.borderBottomLeftRadius = "0px";
                            document.getElementById("formDirTitle").style.borderBottomRightRadius = "0px";
                        }
                        else {
                            document.getElementById("formDirContent").classList.toggle("animFormCollapse");
                            document.getElementById("chevronCollapseDir").classList.toggle("rotateChevronCollapse");
                            document.getElementById("formDirTitle").style.borderBottomLeftRadius = "7px";
                            document.getElementById("formDirTitle").style.borderBottomRightRadius = "7px";
                        }
                    })
                </script>
            </form>
        </div>

        <div class="formCastingWrapper">
            <h3 id="formCastingTitle" class="formTitle">Ajouter un casting <i id="chevronCollapseCasting" class="fa-solid fa-chevron-down"></i></h3>
            <form id="formCastingContent" class="form" action="index.php?action=addCasting" method="post">
                <div class="formContent" id="formContent">

                        <label class="labelLight" for="movieSelect">Film</label>
                        <select id="movieSelect" class="inputForm" name="movieSelect" required>
                            <option value="">-- Veuillez choisir un film</option>
                            <?php 
                                foreach ($requestMovieSelect->fetchAll() as $movie) {
                                    $pathAvatar = $movie["movie_imgUrl"];
                                    $finalPath = str_replace("moviesImg/", "moviesImg/avatarSelect/", $pathAvatar);
                            ?>
                                    <option data-class="avatar" data-style="background-image: url(<?= $finalPath ?>);" value="<?= $movie["movie_id"] ?>">
                                        <?= $movie["movie_title"] ?>
                                    </option>
                            <?php
                                }
                            ?>
                        </select>

                        <label class="labelLight" for="actorSelect">Acteur</label>
                        <select id="actorSelect" class="inputForm" name="actorSelect" required>
                            <option value="0">-- Veuillez choisir un acteur</option>
                            <?php 
                                foreach ($requestActorsSelect->fetchAll() as $actor) {
                                    $pathAvatar2 = $actor["person_imgUrl"];
                                    $finalPath2 = str_replace("personImg/", "personImg/avatarSelect/", $pathAvatar2);
                            ?>
                                    <option data-class="avatar" data-style="background-image: url(<?= $finalPath2 ?>);" value="<?= $actor["actor_id"] ?>">
                                        <?= $actor["actorName"] ?>
                                    </option>
                            <?php
                                }
                            ?>
                        </select>

                        <label class="labelLight" for="roleSelect">Rôle</label>
                        <select id="roleSelect" class="inputForm" name="roleSelect" required>
                            <option value="">-- Veuillez choisir un rôle</option>
                            <?php 
                                foreach ($requestRoleSelect->fetchAll() as $role) {
                            ?>
                                    <option value="<?= $role["role_id"] ?>">
                                        <?= $role["role_name"] ?>
                                    </option>
                            <?php
                                }
                            ?>
                        </select>

                        <br>

                        <input class="formSubmitButton" type="submit" name="submit" value="Ajouter">

                </div>
            </form>

            <script>
                // TEST ajout dynamique des champ (mais necessite ajax)
                $acteurSelect = document.createElement('select');
                $acteurSelect.id = "actorSelect";
                $acteurSelect.className = "inputForm";
                $acteurSelect.name = "inputForm";
                $acteurSelect.required = "true";

                document.getElementById("actorSelect").addEventListener("change", function() {
                    if (document.getElementById("actorSelect").value !== "-- Veuillez choisir un acteur") {
                        document.getElementById("formContent").append()
                    }
                });
                

                document.getElementById('formCastingTitle').addEventListener("click", function() {
                    if (document.getElementById("formCastingContent").className == "form" || document.getElementById("formDirContent").className == "form animFormCollapse") {
                        document.getElementById("formCastingContent").classList.toggle("animFormShow");
                        document.getElementById("chevronCollapseCasting").classList.toggle("rotateChevronShow");
                        document.getElementById("formCastingTitle").style.borderBottomLeftRadius = "0px";
                        document.getElementById("formCastingTitle").style.borderBottomRightRadius = "0px";
                    }
                    else {
                        document.getElementById("formCastingContent").classList.toggle("animFormCollapse");
                        document.getElementById("chevronCollapseCasting").classList.toggle("rotateChevronCollapse");
                        document.getElementById("formCastingTitle").style.borderBottomLeftRadius = "7px";
                        document.getElementById("formCastingTitle").style.borderBottomRightRadius = "7px";
                    }
                })
            </script>
        </div>


        <br><div style="width:75%; height:1px; background-color:var(--secondary-color); margin:0 auto;"></div><br>

        <div class="formGenreWrapper">
        <h3 id="formGenreTitle" class="formTitle">Ajouter un genre <i id="chevronCollapseGenre" class="fa-solid fa-chevron-down"></i></h3>
            <form id="formGenreContent" class="form" action="index.php?action=addGenre" method="post">
                <div class="formContent">
                    <label class="labelLight" for="genreTitle"></label>
                    <input class="inputForm" name="genreTitle" type="text" placeholder="Ex: Drame, Fiction, ...">
                    <input class="formSubmitButton" type="submit" name="submit" value="Ajouter">
                </div>
            </form>

            <script>
                document.getElementById('formGenreTitle').addEventListener("click", function() {
                    if (document.getElementById("formGenreContent").className == "form" || document.getElementById("formGenreContent").className == "form animFormCollapse") {
                        document.getElementById("formGenreContent").classList.toggle("animFormShow");
                        document.getElementById("chevronCollapseGenre").classList.toggle("rotateChevronShow");
                        document.getElementById("formGenreTitle").style.borderBottomLeftRadius = "0px";
                        document.getElementById("formGenreTitle").style.borderBottomRightRadius = "0px";
                    }
                    else {
                        document.getElementById("formGenreContent").classList.toggle("animFormCollapse");
                        document.getElementById("chevronCollapseGenre").classList.toggle("rotateChevronCollapse");
                        document.getElementById("formGenreTitle").style.borderBottomLeftRadius = "7px";
                        document.getElementById("formGenreTitle").style.borderBottomRightRadius = "7px";
                    }
                })
            </script>
        </div>

        <div class="formRoleWrapper">
        <h3 id="formRoleTitle" class="formTitle">Ajouter un rôle <i id="chevronCollapseRole" class="fa-solid fa-chevron-down"></i></h3>
            <form id="formRoleContent" class="form" action="index.php?action=addRole" method="post">
                <div class="formContent">
                    <label class="labelLight" for="roleName"></label>
                    <input class="inputForm" name="roleName" type="text" placeholder="Ex: Zorro, Tinky Winky, ...">
                    <input class="formSubmitButton" type="submit" name="submit" value="Ajouter">
                </div>
            </form>

            <script>
                document.getElementById('formRoleTitle').addEventListener("click", function() {
                    if (document.getElementById("formRoleContent").className == "form" || document.getElementById("formRoleContent").className == "form animFormCollapse") {
                        document.getElementById("formRoleContent").classList.toggle("animFormShow");
                        document.getElementById("chevronCollapseRole").classList.toggle("rotateChevronShow");
                        document.getElementById("formRoleTitle").style.borderBottomLeftRadius = "0px";
                        document.getElementById("formRoleTitle").style.borderBottomRightRadius = "0px";
                    }
                    else {
                        document.getElementById("formRoleContent").classList.toggle("animFormCollapse");
                        document.getElementById("chevronCollapseRole").classList.toggle("rotateChevronCollapse");
                        document.getElementById("formRoleTitle").style.borderBottomLeftRadius = "7px";
                        document.getElementById("formRoleTitle").style.borderBottomRightRadius = "7px";
                    }
                })
            </script>
        </div>

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
