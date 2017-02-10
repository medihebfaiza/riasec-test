<?php

/**
 * Created by PhpStorm.
 * User: ENZO
 * Date: 26/11/2016
 * Time: 01:07
 */
require_once('model.php');
class ModelAdmin extends Model
{
    static $table ="Admin";
    static  $primary = "mail_admin";

    private $mail_admin;
    private $nom_admin;
    private $prenom_admin;
    private $mot_de_passe;

    /**
     * modelAdmin constructor.
     * @param $mail_admin
     * @param $nom_admin
     * @param $prenom_admin
     * @param $mot_de_passe
     */
    public function __construct($mail_admin=NULL, $nom_admin=NULL, $prenom_admin=NULL, $mot_de_passe=NULL)
    {
        if(!is_null($mail_admin) && ! is_null($nom_admin) && ! is_null($prenom_admin) && !is_null($mot_de_passe)){
            $this->mail_admin = $mail_admin;
            $this->nom_admin = $nom_admin;
            $this->prenom_admin = $prenom_admin;
            $this->mot_de_passe = $mot_de_passe;
        }

    }

    /**
     * @return mixed
     */
    public function getMailAdmin()
    {
        return $this->mail_admin;
    }

    /**
     * @return mixed
     */
    public function getNomAdmin()
    {
        return $this->nom_admin;
    }

    /**
     * @return mixed
     */
    public function getPrenomAdmin()
    {
        return $this->prenom_admin;
    }

    /**
     * @return mixed
     */
    public function getMotDePasse()
    {
        return $this->mot_de_passe;
    }





}