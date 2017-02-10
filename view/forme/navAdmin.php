
  <?php

      /**
       * Created by PhpStorm.
       * User: ENZO
       * Date: 28/12/2016
       * Time: 00:18
       */

      $admin = ModelAdmin::select($_SESSION['admin']);
      $nom = $admin->getNomAdmin();
      $prenom = $admin->getPrenomAdmin();

      echo "<ul class='nav navbar-nav navbar-right'>";
      echo "<li><a id='identifiant'><span class='glyphicon glyphicon-user'></span> $nom $prenom (<i>admin</i>) </a></li>";
      echo "<li><a id='deconnexionAdmin' href=''><span class='glyphicon glyphicon-log-in'></span> Déconnexion</a></li>";
      echo "</ul>";

  ?>
