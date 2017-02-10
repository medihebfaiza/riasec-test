
<div id="questionnaireError"></div>
<?php
/**
 * Created by PhpStorm.
 * User: ENZO
 * Date: 18/12/2016
 * Time: 04:26
 */


$groupes = ModelGroupe_question::getAll(); // on recupere tous les groupes de questions
foreach ($groupes as $groupe){ // pour chaque groupe on fait

    echo "<div class='panel panel-primary'><div class='panel-heading'><h4>Groupe {$groupe->getNumGroupe()} :</h4></div><div class='panel-body'>"; // affiche le groupe des questions
    echo "<table class='groupeQuestion'>";

    $questions = ModelQuestion::getQuestionByGroup($groupe->getNumGroupe());

    foreach ($questions as $question){

        echo "<tr><td>";
        echo "<div class='idQuestion'>{$question->getIdProp()}</div>
                <span>{$question->getLibelle()}</span> ";
        echo '<input class="inputQuestion" size="90" value="'.$question->getLibelle().'"/>';
        // j'utilise des simple quote ici car il y a deja des simples quote dans les libellés
        // ce qui coupe le texte
        echo "<button class='updateQuestion btn btn-primary btn-md'>modifier</button>";
        echo "</td></tr>";
    }
    echo "</table></div></div>";

}
