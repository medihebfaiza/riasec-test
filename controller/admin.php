<?php
/**
 * Created by PhpStorm.
 * User: ENZO
 * Date: 15/10/2016
 * Time: 20:36
 */

require_once "{$ROOT}{$DS}model{$DS}modelAdmin.php";
require_once "{$ROOT}{$DS}model{$DS}modelGroupe_question.php";
require_once "{$ROOT}{$DS}model{$DS}modelQuestion.php";
require_once "{$ROOT}{$DS}model{$DS}modelPromo.php";
require_once "{$ROOT}{$DS}model{$DS}modelChoisir.php";


if(isset($_GET['action']))
    $action = $_GET['action'];
else
    $action = "identification";

$title= "admin"; // titre de la page

/*
 * les $view = erreur surviennent lorsque l'utilisateur essaie d'accéder
 * à un url dont il n'a pas les droits, par exemple s'il n'est pas connecter
 */

switch ($action){
    case 'identification':
        if(isset($_SESSION['admin'])){ // si l'admin est deja connecté
            $view = "home";
        }else{
            $view = "identification";
            $title="connexion - admin";
            require "{$ROOT}{$DS}view{$DS}view.php";
        }

        break;


    case 'connecte':
        if(isset($_SESSION['admin'])){ //si un admin est connecté
            $view = "home";
        }else{
            $view = "erreur";
            $title="erreur";
            $messageErreur = "vous n'êtes pas connecté <a href='index.php?'> page de connection </a>";
        }

        require "{$ROOT}{$DS}view{$DS}view.php";
        break;

    case 'questionnaire':
        if(isset($_SESSION['admin'])){ //si un admin est connecté
            $view = "questionnaire";
        }else{
            $view = "erreur";
            $title="erreur";
            $messageErreur = "vous n'êtes pas connecté <a href='index.php?'> page de connection </a>";
        }
        require "{$ROOT}{$DS}view{$DS}view.php";
        break;

    case 'stats':
        if(isset($_SESSION['admin'])){ //si un admin est connecté
            $view = "stats";
        }else{
            $view = "erreur";
            $title="erreur";
            $messageErreur = "vous n'êtes pas connecté <a href='index.php?'> page de connection </a>";
        }
        require "{$ROOT}{$DS}view{$DS}view.php";
        break;

    case 'promotion':
        if(isset($_SESSION['admin'])){ //si un admin est connecté
            $view = "promotion";
            $promotions = ModelPromo::getAll();
        }else{
            $view = "erreur";
            $title="erreur";
            $messageErreur = "vous n'êtes pas connecté <a href='index.php?'> page de connection </a>";
        }
        require "{$ROOT}{$DS}view{$DS}view.php";
        break;

    case 'statPromo':
      if(isset($_SESSION['admin'])){
        $view="promoStat";
        $promotions = ModelPromo::getAll(); // recupération de toute les promotions
      }else{
        $view = "erreur";
        $title="erreur";
        $messageErreur = "vous n'êtes pas connecté <a href='index.php?'> page de connection </a>";
      }
      require "{$ROOT}{$DS}view{$DS}view.php";
      break;


    case 'etudiants':
        if(isset($_SESSION['admin']) and isset($_GET['promo'])){ //si un admin est connecté
            $view = "EtudiantPromo";
            $nomPromo = $_GET['promo'];

        }else{
            $view = "erreur";
            $title="erreur";
            $messageErreur = "vous n'êtes pas connecté <a href='index.php?'> page de connection </a>";
        }
        require "{$ROOT}{$DS}view{$DS}view.php";
        break;


    /*
     * issu d'appel ajax
     */

    case 'updateQuestion': // mets à jour une question
        if(isset($_POST['idProp']) and isset($_POST['libProp'])){
            $res =ModelQuestion::update($_POST['idProp'], $_POST['libProp']);
                //met à jour le tuple
            echo $res;
        }else{
            $view = "erreur";
            $title="erreur";
            $messageErreur ="accès refusé";
            require "{$ROOT}{$DS}view{$DS}view.php";
        }
        break;

    case 'updatePromo': // change le mot de passe d'une promo

        if(isset($_POST['nomPromo']) and isset($_POST['code'])){
            $res =ModelPromo::updateCode($_POST['nomPromo'] , $_POST['code']);
            echo $res;

        }else{
            $view = "erreur";
            $title="erreur";
            $messageErreur ="accès refusé";
            require "{$ROOT}{$DS}view{$DS}view.php";
        }
        break;

    case 'suppr': // supprimer un questionnaire
        if(isset($_POST['mail'])){
            echo ModelChoisir::deleteReponses($_POST['mail']);
        }else {
            $view = "erreur";
            $title = "erreur";
            $messageErreur = "vous n'êtes pas connecté";
            require "{$ROOT}{$DS}view{$DS}view.php";
        }
        break;

    case 'verifConnexion':
        if(isset($_POST['mail']) && isset($_POST['mdp'])){
            $mail =$_POST['mail'];
            $mot_de_passe = $_POST['mdp'];
            $adm =ModelAdmin::select($mail);
            if(!is_null($adm)){
                if($adm->getMotDePasse() == $mot_de_passe) {
                    $_SESSION['admin']= $mail;
                    echo "succes";
                }else{
                    echo "echec";
                }

            }else{
                echo "echec";
            }
        }else{
            $view = "erreur";
            $title="erreur";
            $messageErreur ="accès refusé";
            require "{$ROOT}{$DS}view{$DS}view.php";
        }
        break;


    case 'verifConnexion':
        if(isset($_POST['mail']) && isset($_POST['mdp'])){
            $mail =$_POST['mail'];
            $mot_de_passe = $_POST['mdp'];
            $adm =ModelAdmin::select($mail);
            if(!is_null($adm)){
                if($adm->getMotDePasse() == $mot_de_passe) {
                    $_SESSION['admin']= $mail;
                    echo "succes";
                }else{
                    echo "echec";
                }

            }else{
                echo "echec";
            }
        }else{
            $view = "erreur";
            $title="erreur";
            $messageErreur ="accès refusé";
            require "{$ROOT}{$DS}view{$DS}view.php";
        }
        break;


    case 'deconnexion': // permet de deconnecter les admin et les etudiants
        if(isset($_SESSION['admin'])){
            session_destroy();
            echo "succes";
        }else{
            $view = "erreur";
            $title="erreur";
            $messageErreur ="vous n'êtes pas connecté";
            require "{$ROOT}{$DS}view{$DS}view.php";
        }

        break;


}
