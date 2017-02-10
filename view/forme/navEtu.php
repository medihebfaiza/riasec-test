
  <?php
  /**
   * Created by PhpStorm.
   * User: ENZO
   * Date: 28/12/2016
   * Time: 00:18
   */

  require_once "{$ROOT}{$DS}model{$DS}modelEtudiant.php";


  $etudiant = ModelEtudiant::select($_SESSION['etudiant']);
  $nom = $etudiant->getNomEtud();
  $prenom = $etudiant->getPrenomEtud();

  echo "<ul class='nav navbar-nav navbar-right'>";
  echo "<li><a id='identifiant'><span class='glyphicon glyphicon-user'></span> $nom $prenom (<i>étudiant</i>) </a></li>";
  echo "<li><a id='deconnexionEtu' href=''><span class='glyphicon glyphicon-log-in'></span> Déconnexion</a></li>";
  echo "</ul>";

  ?>
