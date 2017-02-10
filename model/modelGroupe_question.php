<?php

/**
 * Created by PhpStorm.
 * User: ENZO
 * Date: 19/11/2016
 * Time: 19:50
 */
require_once "model.php";
class ModelGroupe_question extends Model
{
    static $table = "Groupe_question";
    static $primary = "num_groupe";

    private $num_groupe;

    /**
     * ModelGroupeQuestion constructor.
     * @param $num_groupe
     */
    public function __construct($num_groupe=NULL)
    {
        if(!is_null($num_groupe))
            $this->num_groupe = $num_groupe;
    }


    /**
     * @return mixed
     */
    public function getNumGroupe()
    {
        return $this->num_groupe;
    }




}