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
$date=Date("d-m-Y");
//$date2=$forma->format($dates);

if(isset($_POST['date'])){
  $t=$_POST['date'];
  $timestate=strtotime($t);
  $date=date('d-m-Y',$timestate);

  $dates= new DateTime();
  //var_dump($dates);
//$forma=new IntlDateFormatter('fr_FR', IntlDateFormatter::LONG,IntlDateFormatter::NONE);
//$date2=$forma->format($timestate);
  //var_dump($date2);
}
$query=$pdo->prepare('SELECT * FROM facture WHERE id_vendeur=:id and date=:date order by id desc');
$query->execute([
  'id'=>$agent['id'],
  'date'=>$date
]);
$donnees=$query->fetchAll();
if(isset($_POST['num'])){
  
$query=$pdo->prepare('SELECT * FROM facture WHERE id_vendeur=:id and id=:idv order by id desc');
$query->execute([
  'id'=>$agent['id'],
  'idv'=>$_POST['num']
]);
$donnees=$query->fetchAll();
}

require('utilitaires/entete/head.php');


?>
<div class="d-grid gap-2 col-4 mx-auto">
  <h5 class="text-center " >Seul vos factures sont disponible</h5>
<div class="md-2 ">
              <h6 class="text-center" >Vérifier par date</h6>
                <form method="post" >
                  
                  <input name="date" onchange="this.form.submit()" type="date" class="form-control" >
                
                </form>
                <h6 class="text-center" >Vérifier par Numéro</h6>
                


                <form method="post" class="row g-3">
                  
                  <div class="col-auto">
                    <label for="inputPassword2" class="visually-hidden">Password</label>
                    <input name="num" onchange="this.form.submit()" type="text" class="form-control" id="inputPassword2" placeholder="Num">
                  </div>
                  <div class="col-auto">
                    <button type="submit" class="btn btn-primary mb-3">Rechercher</button>
                  </div>
                </form>

</div>  </div>  

  <div class="container shadow-lg p-3 mb-6  bg-body rounded" style="margin-top:70px ;" >
    <p class="display-6 text-center" >  Vos Activités du  <?=$date?></p>
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3   ">
      <?php if($donnees) :?>
      <?php foreach($donnees as $a) :?>
          <?php  $tabs=explode(",", $a['id_produit']);?>
          <div class="col  p-3 mb-5  ">
            <div class="card shadow-sm ">
              <div class="card-body  ">
                <ul>
                  <li>Nombre de produit : <strong><?= count($tabs) ?></strong> </li>
                  <li>Quantité : <strong><?= $a['qte'] ?></strong></li>
                  <li>Prix : <strong><?=  number_format($a['total'] ,2, ',','  ')?> $</strong></li>
                  <li>Date d'achat : <strong><?= $a['date'] ?></strong></li>
                </ul>
                <a href="details.php?donnee=<?= $a['id']?>" class="">Plus des détailles</a>
              </div>
            </div>
          </div>
     
          <?php endforeach ?> 
          <?php else : ?> 
            <div class="d-grid gap-2 col-4 mx-auto">
            <div class="alert alert-danger">
              <h5 class="text-center">Aucune Activités </h5>
              </div></div>
          <?php endif ?> 

      </div>
        
  </div>











<?php
//var_dump($produits);

require('utilitaires/entete/foot.php');
?>

