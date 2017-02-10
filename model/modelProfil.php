<?php

require_once ('model.php');

class ModelProfil extends Model
{
    static $table = "Profil";
    static $primary = "nom_profil";

    private $nom_profil;
    private $description;

 
    public function __construct($nom_profil= NULL, $description = NULL)
    {
        if (!is_null($nom_profil) && !is_null($description)) {
            $this->nom_profil = $nom_profil;
            $this->description = $description;
        }

    }


    public function getNomProfil()
    {
        return $this->nom_profil;
    }

    public function getDescription()
    {
        return $this->description;
    }

}