<?php
/**
 * Created by PhpStorm.
 * User: ENZO
 * Date: 30/10/2016
 * Time: 01:26
 */
?>

<div id="erreurConnexion">
    <!-- sera rempli par le script js en cas d'erreur-->
</div>


<div class="container" id="formConnexionAdmin">
  <!-- formulaire de connexion -->
  <form>
    <div class="form-group">
      <label>Identifiant : </label>
      <input id="mailAdm" class="form-control" placeholder="email" type="email"/>
    </div>
    <div class="form-group">
      <label>Mot de passe : </label>
      <input type="password" id="mdpAdm" class="form-control" placeholder="clé de connexion"/></br>
    </div>
    <button  id="connexionAdm" class="btn">Connexion</button> </br>
  </form>
</div>
