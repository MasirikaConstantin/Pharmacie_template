<?php
session_start();
setlocale(LC_ALL, 'fr_FR.utf8');
//date_default_timezone_set('Europe/Paris');

$titre="Activités  ";
if($_SESSION['utilisateur']===null){
         header('Location:identifie.php');
     }
require('utilitaires/connexion.php');


$utilisateur=$_SESSION['utilisateur'];
$date=Date("d-m-Y");
/*$dates= new DateTime();
$forma=new IntlDateFormatter('fr_FR', IntlDateFormatter::LONG,IntlDateFormatter::NONE);
$date2=$forma->format($dates);
*/
if(isset($_POST['date'])){
  $t=$_POST['date'];
  $timestate=strtotime($t);
  $date=date('d-m-Y',$timestate);

  $dates= new DateTime();
  //var_dump($date);
  /*
$forma=new IntlDateFormatter('fr_FR', IntlDateFormatter::LONG,IntlDateFormatter::NONE);
$date2=$forma->format($timestate);*/
  //var_dump($date2);
}

if(isset($_POST['date2'])){
  $t=$_POST['date2'];
  $timestate=strtotime($t);
  $date=date('d-m-Y',$timestate);

  $dates= new DateTime();
  //var_dump($dates);
  /*
$forma=new IntlDateFormatter('fr_FR', IntlDateFormatter::LONG,IntlDateFormatter::NONE);
$date2=$forma->format($timestate);
  //var_dump($date2);*/
}
$query=$pdo->prepare('SELECT * FROM facture WHERE  date=:date order by id desc');
$query->execute([
  'date'=>$date
]);
$donnees=$query->fetchAll();
if(isset($_POST['num'])){
  
$query=$pdo->prepare('SELECT * FROM facture WHERE id=:idv order by id desc');
$query->execute([
 
  'idv'=>$_POST['num']
]);
$donnees=$query->fetchAll();
}
  
$query=$pdo->prepare('SELECT * FROM users  ');
$query->execute();
$agent=$query->fetchAll();
$id_agent=null;
$id_agents=null;
$noma=null;
require('utilitaires/entete/head.php');
if(isset($_POST['ice-cream-choice'])){
         if(!empty($_POST['ice-cream-choice'])){
         $id_agent=idagent($_POST['ice-cream-choice']);
         
$query=$pdo->prepare('SELECT * FROM facture WHERE id_vendeur=:id  order by id desc');
$query->execute([
  'id'=>$id_agent,
  
]);
$donnees=$query->fetchAll();
}
}

if(isset($_POST['ice-cream-choice'],$_POST['date'])){
         if(!empty($_POST['ice-cream-choice'])){
                  $id_agent=idagent($_POST['ice-cream-choice']);
                                    
                  $query=$pdo->prepare('SELECT * FROM facture WHERE id_vendeur=:id and date=:date order by id desc');
                  $query->execute([
                  'id'=>$agent['id'],
                  'date'=>$date
                  ]);
                  $donnees=$query->fetchAll();
         }}

  if(isset($_POST['nom_agent'],$_POST['date2'])){

  if(!empty($_POST['nom_agent'])){
    $t=$_POST['date2'];
  $timestate=strtotime($t);
  $date2=date('d-m-Y',$timestate);
  
           $id_agents=idagent($_POST['nom_agent']);
           $query=$pdo->prepare('SELECT * FROM users WHERE id=:id ');
           $query->execute([
           'id'=>$id_agents,
           ]);
           $a=$query->fetch();
           $noma=$a['nom']."  ".$a['postnom']."  ".$a['prenom'];
                             
           $query=$pdo->prepare('SELECT * FROM facture WHERE id_vendeur=:id and date=:date order by id desc');
           $query->execute([
           'id'=>$id_agents,
           'date'=>$date2
           ]);
           $donnees=$query->fetchAll();
           foreach($donnees as $s){
            echo($s['date']."<br>");
           }
  }}
?>
<style>
         label {
  display: block;
  margin-bottom: 10px;
}

</style>
<div class="container mb-4">
  
  <div class="row align-items-md-stretch">
    <div class="col-md-6 border border-5">
      <h5 class="text-center" >Rechercher rapide</h5>
      <div class="">
        <div class="md-1 ">
          <div class="container">
            <form method="post" class="row g-3">
              <label  for="ice-cream-choice">Chercher un Agent</label>
              <input class="form-control" list="ice-cream-flavors" value="<?php if($id_agent) :?><?= $_POST['ice-cream-choice']?><?php endif ?>" onchange="this.form.submit()" id="ice-cream-choice" name="ice-cream-choice" />
              <datalist id="ice-cream-flavors"  >

                <?php foreach($agent as $k) :?>
                <option value="<?= $k['id'].' '.$k['nom']." ".$k['postnom'].' '." ".$k['prenom'] ?>"></option>
                <?php endforeach ?>
              </datalist>
            </form>
          </div>
        </div>
      </div>
      <hr>

      <div class="mb-3">

        <div class="md-1 ">
          <h6 class="text-center" >Vérifier par date</h6>
          <form method="post" >
            <input name="date" onchange="this.form.submit()" type="date" class="form-control" >
          </form>
          <hr>
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
        </div>
      </div>  
    </div>


      <div class="col-md-6 border border-5">
      <h5 class="text-center" >Rechercher Avancée</h5>
      <div class=" ">
        <div class="md-1 ">
          <div class="container">
            <form method="post" class="row g-3">
              <label  for="ice-cream-choice">Chercher un Agent</label>
              <input class="form-control" placeholder="Entrez le Nom" list="ice-cream-flavors" value="<?php if($id_agents) :?><?= $_POST['nom_agent']?><?php endif ?>" id="ice-cream-choice" name="nom_agent" />
              <datalist id="ice-cream-flavors"  >

                <?php foreach($agent as $k) :?>
                <option value="<?= $k['id'].' '.$k['nom']." ".$k['postnom'].' '." ".$k['prenom'] ?>"></option>
                <?php endforeach ?>
              </datalist>
          
          </div>
        </div>
      </div>

      <div class="">

        <div class="md-1 ">
          <h6 class="text-center" >Vérifier par date</h6>
          
            <input name="date2" type="date" class="form-control" >
          
          <hr>
          <div class=" d-grid col-3 mx-auto">
              <button type="submit" class="btn btn-primary ">Rechercher</button>
            </div>
        </div>
      </div>
      </form>

      </div>
    </div>

    
</div>
</div>

  <div class="container shadow-lg p-3 mb-6  bg-body rounded" style="margin-top:5px ;" >
    <p class="display-6 text-center" >  Vos Activités du  <?=$date ?></p>
   <h4><span class="badge bg-primary rounded-pill"><?= count($donnees) ?>  </span><?php if($noma):?><?= "    Activités de "."$noma" ?><?php endif?></h4>

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
            <div class="d-grid gap-2 col-4 mx-auto mb-3">
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

