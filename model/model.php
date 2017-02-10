<?php
require_once "{$ROOT}{$DS}config{$DS}conf.php";

class Model{

    /*
     * les variables table et primary sont definies dans
     * les classes héritant de Model
     */
    public static $pdo;

    public static function Init(){
        $host = conf::getHostname();
        $dbname= conf::getDataBase();
        $login= conf::getLogin();
        $pass= conf::getPassword();
        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
        try{
            self::$pdo = new PDO("mysql:host=$host;dbname=$dbname",$login,$pass,$pdo_options);

        }catch(PDOException $e) {
            echo $e->getMessage(); // affiche un message d'erreur
            die();}

    }

    /**
     * @return mixed
     * donne tous les elements de la table
     */
    public static function getAll(){
        $SQL="SELECT * FROM ".static::$table;
        try{
            $req_prep = Model::$pdo->query($SQL);
            //print_r( $req_prep );


            $nomModel =  "Model".static::$table ; // concatenation de 2 chaine de caractere
            $req_prep->setFetchMode(PDO::FETCH_CLASS, $nomModel );
                // setFetchMode creer des objet du type du model
            return $req_prep->fetchAll();
                // fetchAll creer un tableau à 2D avec tous les resultats de requetes
                // on à chaque que tuple et pour chaque tuple on à les attributs associé
        } catch(PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href="www.google.com"> retour a la page d\'accueil </a>';
            }
            die();
        }
    }


    /**
     * @param $key
     * @return null
     * selectionne une ligne de la table lorsque la clé est égal au parametre
     */
    static function select($key) {
        $sql = "SELECT * from ".static::$table." WHERE ".static::$primary."=:nomVar";
        // requete de selection
        try{
            $req_prep = Model::$pdo->prepare($sql);
            $req_prep->bindParam(":nomVar", $key);
            // lors de l'exécution :nomVar sera remplacé par $key
            // eviter les attaques dictionnaire
            $req_prep->execute();
            $nomModel =  "Model".static::$table ; // concactenation de 2 chaine de caractere
            $req_prep->setFetchMode(PDO::FETCH_CLASS, $nomModel );


            if ($req_prep->rowCount()==0){
                return null;
                die();// Vérifier si $req_prep->rowCount() != 0
            }else{
                $rslt = $req_prep->fetch();
                return $rslt;}
        } catch(PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

    /**
     * @return mixed
     * compte le nombre de tuple de la table
     */
    public static function countElem(){
        $sql = 'SELECT count(:elem) AS ResCount
                FROM '.static::$table;
        try{
            $req_prep = Model::$pdo->prepare($sql);
            $req_prep->bindParam(':elem', static::$primary);
            $req_prep->execute();

        }catch (PDOException $e){
            if(Conf::getDebug())
                echo $e->getMessage(); // affiche un message d'erreur
            else
                echo "une erreur est survenue <a href='index.php> retour à la page d\'accueil</a>";
            die();

        }
        return $req_prep->fetch();
    }




    // verifie si un forme existe dans une table
    /**
     * @param $tab
     * insère un tuble dans la table
     * $tab doit contenir autant d'forme que la table a d'attribut
     * et tous les elements doivent être dans l'ordre
     */
    static function insert($tab){
        $sql = "INSERT INTO ".static::$table." VALUES(";
        foreach ($tab as $cle => $valeur){
            $sql .=" :".$cle.",";
        }
        $sql=rtrim($sql,",");
        $sql.=");";
        try{
            $req_prep = Model::$pdo->prepare($sql);
            $values = array();
            foreach ($tab as $cle => $valeur){
                $values[":".$cle] = $valeur;
            }
            $req_prep->execute($values);
        }catch(PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href="https://infolimon.iutmontp.univ-montp2.fr/~contremoulinp/TD6/index.php"> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

    /**
     * @param $key: clé de la table
     * @return int
     * supprime un tuple dans la base de donnée
     */
    function delete($key) {
        $sql = "DELETE FROM ".static::$table." WHERE ".static::$primary."=:nom_var";
        try{
            $req_prep = Model::$pdo->prepare($sql);
            $req_prep->bindParam(":nom_var", $key);
            $req_prep->execute();
            return 0;
        } catch(PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            }
            return -1;
            die();
        }
    }





}

Model::Init();

?>
