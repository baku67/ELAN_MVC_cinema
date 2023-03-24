<?php

    $results = $searchQuery->fetchAll();
    ob_start();
    $nbrResults = 0; 
    $suffixePluriel = "";
?>

    <div class="subtitleDiv">
        <h2 class="movieDetailTitle"><span style="font-size:80%;">Recherche</span> "<?= $searchInput ?>"</h2>
        <div class="underlineElem"></div>
    </div>

    <!-- Compteur de résultats de recherche -->
    <p>
        <?php 
                if (count($results) > 1) {
                    $suffixePluriel = "s";
                }
                foreach ($results as $result) {
                    $nbrResults += 1;
                }
        ?>
        <p><?= $nbrResults ?> résultat<?= $suffixePluriel ?></p>
    </p>



    <div class="gridSearchResults">

<?php
    foreach ($results as $result) {
        // Adaptation de l'url action en fonction du typeBDD de l'élément recherché cliqué
        $actionDetailType = $result["type"];
        switch ($actionDetailType) {
            case "movie":
                $actionDetailType = "movieDetails&id=" . $result["id"];
                break;

            case "actor":
                $actionDetailType = "actorDetails&id=" . $result["id"];
                break;

            case "director":
                $actionDetailType = "listDirectors&id=" . $result["id"];
                break;
        }      
?>
        <a href="index.php?action=<?= $actionDetailType ?>">
            <div class="searchCard">
                <?php
                    if ($result["type"] == "movie") {
                        $typeClass = "searchCardTypeMovie";
                        $titleClass = "searchCardTitleMovie";
                    }
                    else if (($result["type"] == "actor") || ($result["type"] == "director")) {
                        $typeClass = "searchCardTypePerson";
                        $titleClass = "searchCardTitlePerson";
                    }
                ?>
                <div class="searchCardImgWrapper">
                    <img class="searchCardImg" src="<?= $result["img"] ?>" alt="">
                </div>
                <p class="<?= $titleClass ?>" ><?= $result["title"] ?></p>
                <div class="<?= $typeClass ?>"><?= ucfirst($result["type"]) ?></div>
            </div>
        </a>


<?php
    }
    ?>
    </div>

    <?php

    $contenu = ob_get_clean();

    $activeNavHome = "activeNav";
    $activeNavMovies = "";
    $activeNavActors = "";
    $activeNavDirectors = "";
    $activeNavAdmin = "";

    $titre = "Recherche";
    $titre_secondaire = "";

    require "view/template.php";
    ?>
