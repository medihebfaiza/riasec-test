
<div id="promoError"></div>
<?php
/**
 * Created by PhpStorm.
 * User: ENZO
 * Date: 22/12/2016
 * Time: 16:59
 */


foreach ($promotions as $promotion){
    $nomPromo =$promotion->getNomPromo();

    echo "<div class='promoName'>
            <b class='nom_de_la_promo' id='$nomPromo'><h3><span class='label label-primary'>$nomPromo : </span></h3></b>
            <div class='codePromo'>
                <strong>Code : </strong> <i>{$promotion->getCode()}</i>
                <input value='{$promotion->getCode()}'/>
                <button id='modifierCodeProm'class='btn btn-success'>modifier</button>
            </div> <button class='displayAllEtu btn btn-default' id='$nomPromo'>Voir Etudiants</button>
            </div> ";
}
