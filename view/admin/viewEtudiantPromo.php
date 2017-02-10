<div id="succes"></div>
<div id="echec"></div>
<?php
/**
 * Created by PhpStorm.
 * User: ENZO
 * Date: 10/01/2017
 * Time: 15:54
 */
echo "<div class='panel panel-primary'><div class='panel-heading'><b>Etudiants $nomPromo :</b> </div><div class='panel-body'>";
echo "<table class='table_promo'>";

$etudiants = ModelPromo::etuProm($nomPromo);

foreach ($etudiants as $etudiant){
    echo "<tr><td>";
    echo "Nom : {$etudiant->getNomEtud()} </br>
              Prénom : {$etudiant->getPrenomEtud()}</br>
              Mail : <b>{$etudiant->getMailEtud()}</b></br>";
    if(ModelChoisir::existeDeja($etudiant->getMailEtud())){
        echo "<i>questionnaire envoyé</i>
                <button class='supprimerQuestionnaire btn btn-danger'>Supprimer questionnaire</button>";
    }
    echo "</td></tr>";
}
echo "</table></div></div>";

?>
