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
                    <!-- foreach elem ajouter un <li> -->
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
