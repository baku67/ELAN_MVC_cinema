<?php
    $titre = "Accueil";
    $titre_secondaire = "";
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
                    foreach ($lastAddsList as $lastAdd) {
                    ?>
                        <!-- Meme cards pour Movie/Person (avec color diff) et différentes des Actus -->
                        <li class="newsCard">
                            <div class="newsImgWrapper">
                                <img class="newsImg" src="<?= $lastAdd["imgUrl"] ?>">
                            </div>
                            <p class="newsTitle"><?= $lastAdd["title"] ?></p>
                            <!-- <p class="newsContent"><?= $lastAdd["content"] ?></p> -->
                            <p class="newsPubDate"><?= $lastAdd["publishDate"]?></p>
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
