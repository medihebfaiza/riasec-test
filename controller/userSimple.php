<?php
/**
 * Created by PhpStorm.
 * User: ENZO
 * Date: 08/12/2016
 * Time: 16:34$
 */

require_once ("{$ROOT}{$DS}model{$DS}modelEtudiant.php");
require_once ("{$ROOT}{$DS}model{$DS}modelProfil.php");
require_once ("{$ROOT}{$DS}model{$DS}modelChoisir.php");
require_once ("{$ROOT}{$DS}model{$DS}modelAdmin.php");
if(isset($_GET['action']))
    $action = $_GET['action'];
else
    $action = "accueil";
$title="connexion";
switch ($action){
    case 'accueil':
        // page d'accueil permettant de choisir la connexion
        $view = "accueil";
        require "{$ROOT}{$DS}view{$DS}view.php";
        break;
    case 'apropos':
        // page donnant les informations sur le test
        $view = "apropos";
        $title ="A propos";
        require "{$ROOT}{$DS}view{$DS}view.php";
        break;
    case 'oubli':
        if(isset($_SESSION['etudiant']) or isset($_SESSION['admin'])){
            $view = "erreur";
            $messageErreur = "vous êtes deja connecté";
        }else{
            $view = "oubli";
        }
        require "{$ROOT}{$DS}view{$DS}view.php";
        break;
    case 'stats':
        $view = "stats";
        require "{$ROOT}{$DS}view{$DS}view.php";
        break;

    case 'descriptionProfil':
      if(isset($_POST['profil']) ){
        $profil = ModelProfil::select($_POST['profil']);
        echo $profil->getDescription();
     }else{
          $view = "erreur";
          $messageErreur = "Accès interdis";
          require "{$ROOT}{$DS}view{$DS}view.php";
      }
     break;

    case 'displaysStat':
        if(isset($_SESSION['etudiant'])){
            $etudiant = ModelEtudiant::select($_SESSION['etudiant']);
            $resultat = ModelChoisir::statistiquesPromo($etudiant->getNomPromo());
            $stat [6];
            for($j=0;$j<6;$j++)
                $stat[$j]=0;
            $i=0;
            foreach ($resultat as $row){
               switch ($row[0]){ // tries
                   case 'Réaliste':
                       $stat[0]=intval($row[1]); // caster en int
                       break;
                   case 'Investigatif':
                       $stat[1]=intval($row[1]);
                       break;
                   case 'Artistique':
                       $stat[2]=intval($row[1]);
                       break;
                   case 'Social':
                       $stat[3]=intval($row[1]);
                       break;
                   case 'Entrepreneur':
                       $stat[4]=intval($row[1]);
                       break;
                   case 'Conventionnel':
                       $stat[5]=intval($row[1]);
                       break;
               }
               $i++;
            }
            echo json_encode($stat);
        }else if(isset($_SESSION['admin'])){

        }

        break;


}
