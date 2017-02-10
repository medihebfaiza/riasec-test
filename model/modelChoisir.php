<?php


include_once ('model.php');
include_once('modelProfil.php');



class ModelChoisir extends Model
{
    static $table = "Choisir";
    static $primary = "mail_etud";


    private $mail_etud;
    private $nom_profil;
    private $pourcentage;


    /**
     * ModelChoisir constructor.
     * @param null $mail_etud
     * @param null $nom_profil
     * @param null $pourcentage
     * construit un objet de type ModelChoisir
     */
    public function __construct($mail_etud = NULL, $nom_profil= NULL, $pourcentage = NULL)
    {
        if (!is_null($mail_etud) && !is_null($nom_profil) && !is_null($pourcentage)) {
            $this->mail_etud= $mail_etud;
            $this->nom_profil = $nom_profil;
            $this->pourcentage = $pourcentage;
        }

    }


    /**
     * @param $mail un mail
     * @param $profil un profil
     * @param $pourcentage un pourcentage (float ou int)
     * @return string
     * insère un tuple dans la BD
     * succès si tout ce passe bien echec sinon
     */
    public static  function insertResultat ($mail, $profil, $pourcentage){
        $sql ='INSERT INTO Choisir(mail_etud, nom_profil, pourcentage)
                    VALUES (:cle, :p, :pr)';
        try{
            // requête preparée permettre d'eviter les injections sql
            $req_prep =  Model::$pdo->prepare($sql);
            $value = array(":cle" => $mail, ":p" => $profil, ":pr" => $pourcentage);
            $req_prep->execute($value); // execution de la requete
            return "succes";
        }catch (PDOException $e){
            return "echec";
        }

}

    /**
     * @param $mailEtu un mail etudiant
     * @return bool|string
     * resultat: True si le mail existe deja dans la table choisir
     *  <=> le questionnaire a déjà été réalisé par l'étudiant
     */
     public static function existeDeja($mailEtu){
         $sql = "SELECT mail_etud
                  FROM Choisir 
                  WHERE mail_etud=:cle";
         try{
            $req_prep =  Model::$pdo->prepare($sql);
            $req_prep->bindParam(':cle', $mailEtu);
            $req_prep->execute(); // execution de la requete

            if($req_prep->fetch()){ // si le resultat n'est pas vide
                return true; }
            else {
                return false;}

        }catch (PDOException $e){
            echo "erreur";
            return "erreur";
        }
    }

    /**
     * @param $mail un mail etudiant
     * @return string
     * supprime toutes les occurences d'un mail dans la table choisir
     */
    public static  function deleteReponses($mail){
    // Marion : fonction qui supprime les donnees de la table choisir concernant le mail donne en parametre
    // Fonction utilise par l'admin s'il veut supprimer les resultats d'un etudiant
        $sql ='DELETE FROM Choisir WHERE mail_etud=:cle';
        try{
            // requête preparée permettre d'eviter les injections sql
            $req_prep =  Model::$pdo->prepare($sql);
            $value = array(":cle" => $mail);
            $req_prep->execute($value); // execution de la requete
            return "succes";
        }catch (PDOException $e){
            return "echec";
        }
    }

    /**
     * @param $mailEtu un mail etudiant
     * @param $profil un profil
     * envoit un mail a un etudiant de son profil
     * et de la description de ce profil
     */
    public static function sendResultatByMail($mailEtu, $profil){
// Marion : fonction qui envoie le resultat du test sur le mai de l'etudiant
// Le resultat envoye correspond au profil principal et sa description
		$prof=ModelProfil::select($profil);
		$desc=$prof->getDescription();

       $to = $mailEtu;
       $subject = "Voici vos résultats concernant le test RIASEC";
       $message="<html><body>";
       $message .= "<head> <meta http-equiv=\"Content-Type\" content=\"text/html\"; charset=\"UTF-8\"></head>";
       $message.= "Vous êtes $profil</br>";
       $message.= $desc;
       $message.="</br>";
       $message.= "</html></body>";
       $headers  = 'MIME-Version: 1.0' . "\r\n";
       $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
       $headers .= "From: \"Lysianne BUISSON-LOPEZ\"<lysiane.lopez@umontpellier.fr>"."\n";
       mail($to, $subject, $message,$headers);

        }

    /**
     * @param $nomPromo le nom d'une promo
     * @return string
     * renvoit un tableau du nombre d'etudiant par profil
     */
     public static function statistiquesPromo($nomPromo){
         $sql = 'SELECT P.nom_profil, COUNT(C.mail_etud) 
                 FROM Profil P
                 LEFT OUTER JOIN Choisir C ON P.nom_profil=C.nom_profil
                 LEFT OUTER JOIN Etudiant E ON C.mail_etud=E.mail_etud
                 WHERE E.nom_promo=:cle AND C.pourcentage =
                 (SELECT MAX(C2.pourcentage) 
                  FROM Choisir C2
                  WHERE C2.mail_etud=C.mail_etud) 
                  GROUP BY P.nom_profil';
         // On fait un max pour selectionner le plus grand pourcentage et donc garder un seul profil par eleve
         // Le groupBy de la fin est obligatoire pour grouper les resultats par nom_profil
         try{
            $req_prep =  Model::$pdo->prepare($sql);
            $req_prep->bindParam(':cle', $nomPromo);
            $req_prep->execute(); // execution de la requete
            return $req_prep->fetchAll();

        }catch (PDOException $e){
            return "erreur";
        }
    }


    /*
     * Getteur généré automatiquement, permet de récupérer des attributs de l'objet
     */


    public function getMailEtud()
    {
        return $this->mail_etud;
    }

    public function getNomProfil()
    {
        return $this->nom_profil;
    }

    public function getPourcentage()
    {
        return $this->pourcentage;
    }

}
