<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="public/css/style.css">
        <link rel="stylesheet" href="public/css/stylePhone.css">
        <script src="public/js/script.js"></script>

        <!-- https://datatables.net/ -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css">
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>

        <!-- Font: Rigtheous/Roboto -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Righteous&family=Roboto+Condensed:ital,wght@0,300;0,400;0,700;1,300;1,400&display=swap" rel="stylesheet">        
        
        <!-- FontAwesome -->
        <script src="https://kit.fontawesome.com/698848973e.js" crossorigin="anonymous"></script>

        <!-- Img inside select Jquery https://jqueryui.com/selectmenu/#custom_render -->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="/resources/demos/style.css">
        <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
        
        <title><?= $titre ?></title>
    </head>

    <body>

        <header>
            <div id="title">
                <a href="index.php">
                    <h1>Terrine</h1>
                    <span>cinémas</span>
                </a>
                <svg class="titleSvgContainer">
                    <g>
                        <path class="titleSvgPath" id="logoSvg1" d="M 53.969 38.6358 L 54.1376 78.0918 Q 54.1862 82.4688 58.6904 82.476 L 94.6658 82.5924 Q 99.8522 82.5468 99.7556 78.1884 L 99.6704 38.7756 Q 99.6704 35.1714 95.5694 35.1096 L 57.0452 35.1096 Q 54.0068 35.121 54.0002 38.589">
                            <animate id="project_anim1" attributeName="fill" from="rgba(254, 204, 2, 0)" to="rgba(254, 204, 2, 1)" begin="2.3s" dur="0.6s" fill="freeze" repeatCount="1"></animate>
                        </path>
                    </g>
                </svg>
            </div>

            <ul>
                <a href="index.php">
                    <li class="<?= $activeNavHome ?>">
                        <i class="fa-solid fa-house"></i>
                    </li>
                </a>
                <a href="index.php?action=listMovies">
                    <li class="<?= $activeNavMovies ?>">
                        FILMS
                    </li>
                </a>
                <a href="index.php?action=listActors">
                    <li class="<?= $activeNavActors ?>">ACTEURS</li>
                </a>
                <a href="index.php?action=listDirectors">
                    <li class="<?= $activeNavDirectors ?>">RÉALISATEURS</li></a>
                <a href="index.php?action=admin">
                    <li class="<?= $activeNavAdmin ?>">Admin</li>
                </a>
            </ul>
        </header>


        <main>
            <div id="searchDiv">
                <form action="search" method="post">
                    <i id="searchIcon" class="fa-solid fa-magnifying-glass"></i>
                    <input id="inputSearch" type="text" placeholder="Entrez un film, un acteur ou un réalisateur...">
                    <input id="searchSubmit" type="submit" value="Go!">
                </form>
            </div>

            <h2><?= $titre_secondaire ?></h2>
            <?= $contenu ?>
        </main>


        <footer>
            <p>Terrine cinémas - 2023</p>
        </footer>

    </body>

    <!-- Pre-load FontAwesome -->
    <script type="text/javascript"> (function() { var css = document.createElement('link'); css.href = 'https://use.fontawesome.com/releases/v5.1.0/css/all.css'; css.rel = 'stylesheet'; css.type = 'text/css'; document.getElementsByTagName('head')[0].appendChild(css); })(); </script>

    
</html>