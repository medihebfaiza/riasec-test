<?php

include_once ('model.php');
include_once ('modelPromo.php');
class ModelEtudiant extends Model
{
    static $table = "Etudiant" ;
    static $primary = "mail_etud" ;

    private $mail_etud;
    private $nom_etud;
    private $prenom_etud;
    private $nom_promo;

    /**
     * ModelEtu constructor.
     */
    public function __construct($mail=NULL, $nom=NULL, $prenom=NULL, $promo=NULL)
    {
        if(!is_null($mail) && !is_null($nom) && !is_null($prenom) && !is_null($promo)){
            $this->mail_etud = $mail;
            $this->nom_etud = $nom;
            $this->prenom_etud = $prenom;
            $this->nom_promo = $promo;
        }

    }


    /**
     * @param $mailEtu
     * Retourne le mot de passe de la promo de l'etudiant passe en parametre (par son mail)
     */
    public static function codePromo($mailEtu){
        $sql ='SELECT P.code
                FROM Promo P, Etudiant E
                WHERE  E.mail_etud=:cle AND
                       P.nom_Promo = E.nom_promo ';
        /*
         * On utilise une requete sql
         * On affiche pas directement $mailEtu pour eviter les injections sql
         * on cache donc le parametre le requete jusqu'a qu'on l'execute avec la requete preparee
         */
        try{
            // requête preparée
            $req_prep =  Model::$pdo->prepare($sql);
            $req_prep->bindParam(':cle', $mailEtu);
            $req_prep->execute(); // execution de la requete
            return $req_prep->fetch();
        }catch (PDOException $e){
            echo "erreur";
            return "erreur";
        }

    }


    /**
     * @param $mailEtu
     * Envoie le code de la promo sur la boite mail de l'étudiant
     * Ne retourne rien
     */
    public static function sendCodeByMail($mailEtu){
        /*
         * On recupere le code de la promo associe a l'etudiant
         * On envoie ce code par mail grace a la fonction mail
         */
        $etudiant = static::select($mailEtu);
        $promo = ModelPromo::select($etudiant->getNomPromo());

        $to = $mailEtu;
        $subject = "Code pour le test RIASEC";
        $message= "{$promo->getCode()}";
        $headers = "From: \"Lysianne BUISSON-LOPEZ\"<lysiane.lopez@umontpellier.fr>"."\n";
        mail($to, $subject, $message,$headers);
        return "succes";


      /*  $sql = "SELECT P.code
                FROM Promo P, Etudiant E
                WHERE P.nom_promo=E.nom_promo AND E.mail_etud=:cle";
        try{
            // requête preparée permet d'�viter les injections sql
            $req_prep =  Model::$pdo->prepare($sql);
            $req_prep->bindParam(':cle', $mailEtu);
            $req_prep->execute(); // execution de la requete

            if($req_prep->fetch()){ // si le resultat n'est pas vide
                $resultat = $req_prep->fetch();



                return   $req_prep->fetch()  ;//"succes";
            }else{
                return"erreur";
            }

        }catch (PDOException $e){
            return "erreur";
        } */

    }

    /**
     * @param $str
     * Retourne tous les mails dont le nom le prenom ou le mail
     * commencent par $str
     */
    public static function commencePar($str){
        $sql ="SELECT *
                FROM Etudiant E
                WHERE  E.mail_etud LIKE :cle OR
                        E.nom_etud  LIKE :cle OR
                        E.prenom_etud LIKE :cle";

        try{
            // requête preparée permet d'eviter les injections sql
            $req_prep =  Model::$pdo->prepare($sql);
            $req_prep->execute(array(":cle" => $str."%"));
            $req_prep->setFetchMode(PDO::FETCH_CLASS, "ModelEtudiant" );
            return $req_prep->fetchAll();
        }catch (PDOException $e){
            echo "erreur";
            return ;
        }


    }


    // automatiquement genéré

    /**
     * @return mixed
     */
    public function getMailEtud()
    {
        return $this->mail_etud;
    }

    /**
     * @return mixed
     */
    public function getNomEtud()
    {
        return $this->nom_etud;
    }

    /**
     * @return mixed
     */
    public function getPrenomEtud()
    {
        return $this->prenom_etud;
    }

    /**
     * @return mixed
     */
    public function getNomPromo()
    {
        return $this->nom_promo;
    }



}
