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
        
        
        <title><?= $titre ?></title>
    </head>

    <body>

        <header>

        </header>


        <main>
            <h2><?= $titre_secondaire ?></h2>
            <?= $contenu ?>
        </main>


        <footer>

        </footer>

    </body>

    
</html>