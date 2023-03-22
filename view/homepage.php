<?php
    $titre = "Accueil";
    $titre_secondaire = "";
    $style = "";
    ob_start();
?>

    <div id="gridHomepage">

        <div id="newsDiv">
            <div class="subtitleDiv">
                <h2>Actualités</h2>
                <div class="underlineElem"></div>
            </div>

            <div class="newsListDiv">   
                <ul>
                    <?php 
                    foreach ($newsList as $news) {
                    ?>
                        <li class="newsCard">
                            <div class="newsImgWrapper">
                                <img class="newsImg" src="<?= $news["imgUrl"] ?>">
                            </div>
                            <!-- <p class="newsTitle"><?= $news["title"] ?></p> -->
                            <p class="newsContent"><?= $news["content"] ?></p>
                            <p class="newsPubDate"><?= $news["publishDate"]?></p>
                        </li>

                    <?php
                    }
                    ?>
                </ul>
            </div>

        </div>

        <div id="lastAddDiv">
            <div class="subtitleDiv">
                <h2>Derniers ajouts</h2>
                <div class="underlineElem"></div>
            </div>

            <div class="lastAddListDiv">   
                <ul>
                <?php 
                    $todaysDate = new DateTime (date('Y-m-d'));
                
                    foreach ($lastAddsList as $lastAdd) {
                        $addDate = new DateTime ($lastAdd["create_Time"]);
                        $delaiPublication = $addDate->diff($todaysDate)->format('%dj %Hh');  
                        
                        if ($lastAdd["type"] == "movie") {
                            $style = "newsMovie";
                            $styleLabel = "styleMovieLabel";
                        }
                        else if ($lastAdd["type"] == "person") {
                            $style = "newsPerson";
                            $styleLabel = "stylePersonLabel";
                        }
                        else {
                            $style = "HS";
                        }
                    ?>
                        <!-- Englober avec des <a href="detail"> oula -->
                        <li class="lastAddCard">
                            <p class="lastAddType <?= $styleLabel ?>"><?= ucfirst($lastAdd["type"]) ?></p>
                            <!-- Ptit label/tag acteur/film meme color et voir pour le bg gradient hover color -->
                            <div class="lastAddImgWrapper <?= $style ?>">
                                <img class="lastAddImg" src="<?= $lastAdd["imgUrl"] ?>">
                            </div>
                            <p class="lastAddTitle"><?= $lastAdd["title"] ?></p>
                            <p class="lastAddPubDate"><?= "il y a " . $delaiPublication ?></p>
                        </li>

                    <?php
                    }
                    ?>
                </ul>
            </div>

        </div>

    </div>





<?php 
    $activeNavHome = "activeNav";
    $activeNavMovies = "";
    $activeNavActors = "";
    $activeNavDirectors = "";
    $activeNavAdmin = "";

    $contenu = ob_get_clean();
    require "view/template.php";
?>
