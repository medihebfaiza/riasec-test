<form id="questionnaire">
    <?php
    /**
     * Created by PhpStorm.
     * User: ENZO
     * Date: 20/11/2016
     * Time: 19:35
     * affichage du questionnaire
     */
    $groupes = ModelGroupe_question::getAll();
    foreach ($groupes as $groupe){
        echo "<div class='groupeQuestionEtu' id='{$groupe->getNumGroupe()}' >";
        /*$groupe est egal a un indice du tableau $grpQuestion
         * foreach = pour chaque forme du tableau on les traite séparement (boucle)
         * d'ou à chaque itération de la boucle $groupe vaut un la valeur à l'indice suivant
         */

        echo " <legend>Groupe {$groupe->getNumGroupe()}</legend>";
        $questions = ModelQuestion::getQuestionByGroup($groupe->getNumGroupe()); // on récupere toute les questionss par groupe
        // code pour afficher toutes les questions
        // ..
        foreach ($questions as $question){
            echo "<div class='row'>";
            echo "<div class='col-lg-10 col-md-10 col-sm-12'>";
            //pour afficher les id des propositions (que le caractére) et leurs libellées
            echo "<label>{$question->getIdProp()[strlen($question->getIdProp())-1]}. {$question->getLibelle()}</label>";
            echo "</div>";
            //EDIT: regrouper les trois boutons radio avec le même name qui est l'id de la proposition.
            echo "<div class='col-lg-2 col-md-2 col-sm-12'>";
            echo "<div class='buttonContainer'>";
            echo "<input type='radio' name='{$question->getIdProp()}' value='{$question->getIdProp()}1' id='{$question->getIdProp()}1'/>1 ";
            echo "<input type='radio' name='{$question->getIdProp()}' value='{$question->getIdProp()}2' id='{$question->getIdProp()}2'/>2 ";
            echo "<input type='radio' name='{$question->getIdProp()}' value='{$question->getIdProp()}3' id='{$question->getIdProp()}3'/>3 ";
            echo "</div></div></div>";
        }
        echo "</div>";
    }?>
    </br>
    <div id='verif' class='alert alert-danger' role='alert'>Veuillez choisir trois propositions</div><!-- pour la v�rification des propositions -->
    <div class="buttonContainer">
        <button type='button' id='precedent' class="btn">Precedent</button>
        <button type='button' id='suivant'class="btn">Suivant</button>
        <button type='button' id='envoyer' class="btn">Envoyer</button>
    </div>
</form>
<center>
<div id="resultatInsertion"></div>
<div id="RChart"></div>
<button id="resultatByMail" class="btn btn-success"> Envoyer resultat par mail</button>
</center>
</br>
