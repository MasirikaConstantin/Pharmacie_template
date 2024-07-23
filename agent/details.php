<?php

session_start();
setlocale(LC_ALL, 'fr_FR.utf8');
//date_default_timezone_set('Europe/Paris');

$titre="Activités  ";
if($_SESSION['agent']===null){
    header('Location:../index.php');
}
require('utilitaires/connexion.php');


$agent=$_SESSION['agent'];

  if(isset($_GET['donnee'])){
    $id=$_GET['donnee'];
  $query=$pdo->prepare('SELECT * FROM facture WHERE id =?');
        $query->execute([$id]);
        $mesproduits=$query->fetch();
  }
//var_dump($mesproduits);
$tva=$mesproduits['tva'];


    $lesids=$mesproduits['id_produit'];
    $prix=$mesproduits['total'];
//var_dump($lesids);
$tab=explode(",", $lesids);
//var_dump($tab);
$tabs2=explode(",", $mesproduits['qtepr']);
//var_dump($tabs2);
$quantite=array_combine($tab,$tabs2);
$req=$pdos->prepare('SELECT * FROM produits WHERE id IN ('.$lesids.')');
$req->execute();
$produits=$req->fetchAll();





//var_dump($produits);

require('utilitaires/entete/head.php');

//require('bootstrap.php');
?>



<div class="d-grid gap-2 col-4 mx-auto">
<div class="md-2 ">
              <h6 class="text-center" ><?= $mesproduits['id']?></h6>
                
                </div>
</div>  


  

<div class="container">

  <div class="container">
    <form action="" method="post">
      <table class="table" id="monTableau" >
        <thead>
          <tr>
            <th scope="col">N°</th>
            <th scope="col">Nom</th>
            <th scope="col">Quantité</th>
            <th scope="col">Prix + TVA(<?= $tva*100?>%)</th>
          </tr>
        </thead>
        <tbody>
        <?php $i=1; foreach ($produits as $pr) :?>
          <tr>
            <th scope="row"><?= $i++ ?></th>
            <td><?= $pr['nom'] ?></td>
            <td><?= $quantite[$pr['id']] ?></td>
            <td><?= number_format(($pr['prix']*($tva+1)), 3," , ",' ') ?></td>
            
          </tr>
          
         <?php endforeach ?>
        </tbody>
      </table>
        
     
  
    <div class="d-grid gap-2 mb-3 col-6 mx-auto">
    <h4 class="text-center" ><?= number_format($mesproduits['total'], 2, ' , ','  ');?> Fc</h4>
    </div>
    </form>
  </div>
</div>


<?php
//var_dump($produits);

require('utilitaires/entete/foot.php');
?>

