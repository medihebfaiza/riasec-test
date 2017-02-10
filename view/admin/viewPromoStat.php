<?php
  foreach($promotions as $promo){
    echo "<a
    href='index.php?control=userSimple&action=stats&promo={$promo->getNomPromo()}' class='btn btn-primary btn-block' role='button'>
    {$promo->getNomPromo()}";
    echo "</a>";
  }

 ?>
