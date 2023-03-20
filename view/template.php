<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="public/css/style.css">
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
        
        <title><?= $titre ?></title>
    </head>

    <body>

        <header>
            <div id="title">
                <a href="index.php">
                    <h1>Terrine</h1>
                    <span>cinémas</span>
                </a>
            </div>

            <ul>
                <li class="<?= $activeNavHome ?>"><a href="index.php"><i class="fa-solid fa-house"></i></a></li>
                <li class="<?= $activeNavMovies ?>"><a href="index.php?action=listMovies">FILMS</a></li>
                <li class="<?= $activeNavActors ?>"><a href="index.php?action=listActors">ACTEURS</a></li>
                <li class="<?= $activeNavDirectors ?>"><a href="index.php?action=listDirectors">RÉALISATEURS</a></li>
                <li class="<?= $activeNavAdmin ?>"><a href="">Admin</a></li>
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

        </footer>

    </body>

    <!-- Pre-load FontAwesome -->
    <script type="text/javascript"> (function() { var css = document.createElement('link'); css.href = 'https://use.fontawesome.com/releases/v5.1.0/css/all.css'; css.rel = 'stylesheet'; css.type = 'text/css'; document.getElementsByTagName('head')[0].appendChild(css); })(); </script>

    
</html>