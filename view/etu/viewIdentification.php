<?php
/**
 * Created by PhpStorm.
 * User: ENZO
 * Date: 15/10/2016
 * Time: 20:43
 */
?>

  <div class="container" id="formConnexionEtud">
    <!-- formulaire de connexion -->
    <form>
      <div class="form-group">
        <label>Identifiant : </label>
        <input id="mail" class="form-control" placeholder="Mail étudiant" type="email"/>
      </div>
      <div class="form-group">
        <label>Mot de passe : </label>
        <input type="password" class="form-control" id="mdp" placeholder="Clé de connexion"/>
      </div>
        <p><a href="index.php?action=oubli">Je n'ai pas reçu le code d'identification</a></p>
        <div>Vous ne pouvez effectuer qu'une seule fois ce test. Vos résultats resteront anonymes</div></br>
        <div id="erreurConnexion" class='alert alert-danger'>
            <!-- sera rempli par le script js en cas d'erreur-->
        </div>
        <button  id="connexionEtu" class="btn">Connexion</button></br>
    </form>
  </div>
