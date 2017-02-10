<?php

/**
 * Created by PhpStorm.
 * User: MARION
 * Date: 22/12/2016
 * Time: 10:33
 */
require_once ('model.php');
include_once  ('modelEtudiant.php');
class ModelPromo extends Model
{
    static $table = "Promo";
    static $primary = "nom_promo";

    private $nom_promo;
    private $code;

 
    public function __construct($nom_promo = NULL, $code = NULL)
    {
        if (!is_null($nom_promo) && !is_null($code)) {
            $this->nom_promo = $nom_promo;
            $this->code = $code;
        }

    }


    /**
     * @param $key
     * Marion : fonction qui retourne tous les etudiants de la promo passee en parametre
     */
    public static function etuProm($key){
        $sql = "SELECT * FROM
                Etudiant E
                 WHERE E.nom_promo = :cle";
        try{
            // requête preparée permet d'eviter les injections sql
            $req_prep =  Model::$pdo->prepare($sql);
            $req_prep->bindParam(':cle', $key);
        } catch (PDOException $e){
            echo "erreur";
            return ;
        }
        $req_prep->execute();
        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelEtudiant' );
        return $req_prep->fetchAll();

    }


    public static function updateCode($nomPromo, $code){
// Marion : fonction qui mets a jour le code de la promo
// Elle sera utilisee par l'adin s'il veut changer le code d'une promo
        $sql = "UPDATE Promo
                SET code=:codeP
                WHERE nom_promo=:nameP";

        try{
            $req_prep =  Model::$pdo->prepare($sql);
            $req_prep->execute(array(
                ':nameP' => $nomPromo,
                ':codeP' => $code
            ));
            return "succes";


        }catch (PDOException $e){
            return "echec";
        }
        //return "succes"; // la requete s'est executee avec succes


    }


    public function getNomPromo()
    {
        return $this->nom_promo;
    }

    public function getCode()
    {
        return $this->code;
    }

}