<?php
/**
 * Created by PhpStorm.
 * User: ENZO
 * Date: 15/10/2016
 * Time: 20:36
 */

require_once "{$ROOT}{$DS}model{$DS}modelEtudiant.php";
require_once "{$ROOT}{$DS}model{$DS}modelGroupe_question.php";
require_once "{$ROOT}{$DS}model{$DS}modelQuestion.php";
require_once "{$ROOT}{$DS}model{$DS}modelChoisir.php";

if(isset($_GET['action']))
    $action = $_GET['action'];
else
    $action = "identification";

$title="etudiant";

switch ($action){
    /*
     *a chaque action il faut changer la valeur de la variable $view
     * la variable utilisé dans le fichier view.php
     * la plupart du temps $view = $action mais il est necessaire de la redefinir
     * si avec un action on veut accèder à une page qui n'est pas celle prévue au depart
     * (cf viewErreur il n'y a pas d'action erreur)
     */
    case 'identification':
        if(!isset($_SESSION['etudiant'])){
            /* si l'etudiant n'est pas connété car ça ne sert à rien et
             *  provoquerait une erreur de se reconnecter alors que l'etudiant l'est deja
            */
            $view = $action;
            $title="connexion - etudiant";
        }else{
            $view = "home";

        }

        require "{$ROOT}{$DS}view{$DS}view.php";
        break;

    case 'infoQuestionnaire':
        if(isset($_SESSION['etudiant'])){
           $view ="DescriptionQuestionnaire";
        }else{
            $view = "erreur";
            $title="erreur";
            $messageErreur ="vous n'êtes pas connecté";
        }
        require "{$ROOT}{$DS}view{$DS}view.php";

        break;

    case 'questionnaire': // action pour accéder au questionnaire
        if(isset($_SESSION['etudiant'])){ // si l'etudiant est connecté
            if(ModelChoisir::existeDeja($_SESSION['etudiant'])){
                $view= "home";
            }else{
                $view = "questionnaire";
            }
        }else{ // si l'etudiant n'est pas connecté on renvoit sur la page erreur
            $view = "Erreur";
            $messageErreur="Ce site permet de réaliser un questionnaire
                            donnant le profil de l'utilisateur.
                            Si vous n'êtes pas étudiants de Polytech Montpellier,
                            ce site n'est pas pour vous, dans le cas contraire,
                            veuillez vous connecter à l'adresse suivante</br>
                            <a href='index.php?control=userSimple'>
                                page d'identification
                            </a>";
        }
        require "{$ROOT}{$DS}view{$DS}view.php";
        break;

    case 'connecte':
        if(isset($_SESSION['etudiant'])){
            $view = "home";
        }else{
            $view = "erreur";
            $messageErreur = "Vous n'êtes pas connecté <a href='index.php?'> Page de connexion </a>";
        }
        require "{$ROOT}{$DS}view{$DS}view.php";
        break;


    case 'deconnexion':
        if(isset($_SESSION['etudiant'])){
            session_destroy();
            echo "succes";
        }else{
            $view = "erreur";
            $title="erreur";
            $messageErreur ="vous n'êtes pas connecté";
            require "{$ROOT}{$DS}view{$DS}view.php";
        }

        break;





    /*
     * action avec Js
     * ces action resulte d'un appel d'un page Js
     */
    case 'autoComplete': // methode d'autoCompletion
        if(isset($_GET['term'])){
            $motRecherche = trim(strip_tags($_GET['term']));
            $resultat = array();
            foreach ( ModelEtudiant::commencePar($motRecherche) as $etudiant){
                array_push($resultat, $etudiant->getMailEtud());
            }

            echo json_encode($resultat);
            // il n'y a pas de require car on ne change pas de view
        }else{
            $view = "erreur";
            $messageErreur ="accès refusé";
            require "{$ROOT}{$DS}view{$DS}view.php";
        }

        break;

    case 'sendByMail':  // retour de ajax
        if(isset($_POST['mail'])){
            echo ModelEtudiant::sendCodeByMail($_POST['mail']);
        }else{
            $view = "erreur";
            $messageErreur = "erreur";
            require "{$ROOT}{$DS}view{$DS}view.php";
        }
        break;


    case 'verifConnexion': // methode de connexion par ajax
        if(isset($_POST['mail']) && isset($_POST['mdp'])){
            $mail =$_POST['mail'];
            $mot_de_passe = $_POST['mdp'];
            $etu = ModelEtudiant::select($mail);
            if(! is_null($etu)){
                $promo = ModelEtudiant::codePromo($mail); // récupère la promo associe à l'etudiant
                if($promo[0]== $mot_de_passe){ //si le code promo est egal à celui passé en parametre
                    $_SESSION['etudiant'] = $mail; // creation d'une session et l'etudiant est connecté
                    echo "succes";
                }else{
                    echo "$promo[0]";
                }
            }else{
                echo "deuxieme erreur ";
            }

        }else{
            $view = "erreur";
            $messageErreur = "erreur";
            require "{$ROOT}{$DS}view{$DS}view.php";
        }
        break;

    case 'sendQuestionnaire': // ajax
        if(isset($_POST['resultat']) and isset($_POST['profils'])) {
            $resFrom =$_POST['resultat'] ;
            $resultatRequete="";
            $allProfils = $_POST['profils'];
            $i=0; // un compteur
           foreach($resFrom as $row){

              $profil = $allProfils[$i];
              $pourcentage = $resFrom[$i];

               if($resultatRequete != "echec"){
                   $resultatRequete = ModelChoisir::insertResultat($_SESSION['etudiant'], $profil, $pourcentage);
                   //insertion dans la BD
               }
                $i ++;
            }
              echo $resultatRequete;

        }else{
            $view = "erreur";
            $messageErreur ="accès refusé";
            require "{$ROOT}{$DS}view{$DS}view.php";
        }
        break;

   case 'resultatByMail':
        if(isset($_POST['profil']) ) {
            ModelChoisir::sendResultatByMail($_SESSION['etudiant'], $_POST['profil']);
            echo "succes";
        }else{
            $view = "erreur";
            $messageErreur ="accès refusé";
            require "{$ROOT}{$DS}view{$DS}view.php";
        }
        break;

    case 'dejaFait':// on regarde si on a deja fait le questionnaire
        if(isset($_SESSION['etudiant'])){
            if(ModelChoisir::existeDeja($_SESSION['etudiant'])){ // si le questionnaire à deja etait réalisé
                echo "fait";
            }else{
                echo "non-réalisé";
            }
        }else{
            $view = "erreur";
            $messageErreur ="accès refusé";
            require "{$ROOT}{$DS}view{$DS}view.php";
        }
        break;








}
