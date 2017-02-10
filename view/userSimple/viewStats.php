<div id="statPromo" class="well well-lg">
<?php
/**
 * Created by PhpStorm.
 * User: Marion
 * Date: 12/01/2017
 * Time: 16:19
 */

 function tableau($promo){
   $resultat = ModelChoisir::statistiquesPromo($promo);
   $stat [6];
   for($j=0;$j<6;$j++)
       $stat[$j]=0;
   $i=0;
   foreach ($resultat as $row){
      switch ($row[0]){ // tries
          case 'Réaliste':
              $stat[0]=intval($row[1]); // caster en int
              break;
          case 'Investigatif':
              $stat[1]=intval($row[1]);
              break;
          case 'Artistique':
              $stat[2]=intval($row[1]);
              break;
          case 'Social':
              $stat[3]=intval($row[1]);
              break;
          case 'Entrepreneur':
              $stat[4]=intval($row[1]);
              break;
          case 'Conventionnel':
              $stat[5]=intval($row[1]);
              break;
      }
      $i++;
   }
   return json_encode($stat);
 }

if(isset($_SESSION['etudiant'])){
    $etudiant = ModelEtudiant::select($_SESSION['etudiant']);
    $var = tableau($etudiant->getNomPromo());
    echo "<div id='tabStats'>$var</div>";
    echo "<center><h3>Statistiques des ",$etudiant->getNomPromo(),"</h3></center>";

}else if(isset($_SESSION['admin']) and isset($_GET['promo'])){
  $var =tableau($_GET['promo']);
  echo "<div id='tabStats'>$var</div>";
  echo "<center><h3>Statistiques des ",$_GET['promo'],"</h3></center>" ;
}
?>


  <center>
      <canvas id='tarte' width='480' height='250'></canvas>
  </center>
</div>
