<!DOCTYPE html>
<html>

    <head>
        <title> <?php echo $title; ?></title>
        <meta charset="UTF-8">
        <link rel="icon" type="image/png" href="ressources/img/logo_polytech.png" />

        <link rel="stylesheet" href="ressources/jquery-ui-1.12.1/jquery-ui.css">
        <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <!-- ajout du CSS personalisé -->
        <link rel="stylesheet" type="text/css" href="ressources/style.css">
    </head>

    <?php
        $accueil ="index.php?control=userSimple";
        if(isset($_SESSION['admin'])){
            $accueil="index.php?control=admin&action=connecte";
        }else if(isset($_SESSION['etudiant'])){
            $accueil="index.php?control=etu&action=connecte";
        } // href du lien du header
    ?>

    <body>
        <header>
          <nav class="navbar">
           <div class="container-fluid">
             <div class="navbar-header">
               <a class="navbar-brand" id="titre" href="<?php echo $accueil; ?>">Test de John Holland</a>
             </div>
             <ul class="nav navbar-nav">
                 <li><a href="<?php echo $accueil; ?>">Accueil</a></li>
                 <li><a href="index.php?control=userSimple&action=apropos">À propos</a></li>
             </ul>
             <?php
             if(isset($_SESSION['admin'])){
                 require ("forme/navAdmin.php");
             }else if(isset($_SESSION['etudiant'])){
                 require ("forme/navEtu.php");
             }
             ?>
            </div>
          </nav>
            <!--<h1>Test RIASEC</h1>-->
        </header>




        <div class="wrapper">
            <?php
            // view generique
            // va chercher les view corespondante aux controlleur et à l'action
            $filepath = "{$ROOT}{$DS}view{$DS}{$controller}{$DS}"; // chemin jusqu'au fichier view
            $filename = "view".ucfirst($view) . '.php';  // nom du fichier
            require "{$filepath}{$filename}";
            ?>

        </div>

       <?php
        require ("forme/footer.php");
        ?>

        <script type="text/javascript" src="ressources/jquery.js"></script>
        <script type="text/javascript" src="ressources/form.js"></script>
        <script type="text/javascript" src="ressources/script.js"></script>
        <script type="text/javascript" src="ressources/jquery-ui-1.12.1/jquery-ui.js"></script>
        <script type="application/javascript" src="ressources/jquery-ui-1.12.1/jquery-ui.min.js"></script>
        <script src="ressources/RGraph/libraries/RGraph.common.core.js"></script>
        <script src="ressources/RGraph/libraries/RGraph.common.tooltips.js"></script>
        <script src="ressources/RGraph/libraries/RGraph.common.dynamic.js"></script>
        <script src="ressources/RGraph/libraries/RGraph.common.effects.js"></script>
        <script src="ressources/RGraph/libraries/RGraph.pie.js"></script>
        <script src="ressources/RGraph/libraries/RGraph.radar.js"></script>
        <!-- Bootstrap JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
                integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
                crossorigin="anonymous">
        </script>
    </body>


</html>
