<?php


include_once "model.php";
include_once ('modelQuestion.php');

class ModelQuestion extends Model
{
    static $table = "Proposition";
    static $primary = "id_prop";

    private $id_prop;
    private $libelle;
    private $num_groupe;
    private $nom_profil;


    public function __construct($id = NULL, $lib = NULL, $groupe = NULL, $profil = NULL)
    {
        if (!is_null($id) && !is_null($lib) && !is_null($groupe) && !is_null($profil)) {
            $this->id_prop = $id;
            $this->libelle = $lib;
            $this->num_groupe = $groupe;
            $this->nom_profil = $profil;
        }

    }

    /**
     * @return null
     */
    public function getIdProp()
    {
        return $this->id_prop;
    }

    /**
     * @return null
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * @return null
     */
    public function getNumGroupe()
    {
        return $this->num_groupe;
    }

    /**
     * @return null
     */
    public function getNomProfil()
    {
        return $this->nom_profil;
    }


    /**
     * @param $idGroup
     * Fonction qui donne toutes les questions d'un groupe
     *
     */
    public static function getQuestionByGroup ($idGroup){
        $sql = "SELECT * FROM
                Proposition P
                 WHERE P.num_groupe = :cle";
        try{
            // requête preparée permet d'eviter les injections sql
            $req_prep =  Model::$pdo->prepare($sql);
            $req_prep->bindParam(':cle', $idGroup);
        } catch (PDOException $e){
            echo "erreur";
            return ;
        }
        $req_prep->execute();
        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelQuestion' );
        return $req_prep->fetchAll();
    }

    /**
     * @param $key
     * @param $lib
     * Fonction qui met à jour le libellé de la question
     * Pour cela on passe en parametre la clé du tuple que l'on veut modifier
     * Fonction utilisee par l'admin
     */
    public static function update($key, $lib){
        $sql = "UPDATE Proposition 
                SET libelle=:lib
                WHERE id_prop=:cle";

        try{
            $req_prep =  Model::$pdo->prepare($sql);
            $value = array(':cle' => $key,
                ':lib' => $lib);
            $req_prep->execute($value);

            return "succes";
        }catch (PDOException $e){
            return "echec";
        }


    }
}