<?php
         session_start();
         setlocale(LC_ALL, 'fr_FR.utf8');
         //date_default_timezone_set('Europe/Paris');
         
         $titre="Plus d'activités  ";
         if($_SESSION['utilisateur']===null){
           header('Location:identifie.php');
         }
         require('utilitaires/connexion.php');
         if($_GET['id']===null){
                  header("Location: agent.php");
         }
         
         $utilisateur=$_SESSION['utilisateur'];

         $totalprix=0;
         
$req=$pdo->prepare('SELECT * FROM mois');
$req->execute();
$mois=$req->fetchAll();
$annee=2016;
($date=(int)date('Y'));
$id=(int)$_GET['id'];
$matr=$_GET['matr'];
$req=$pdo->prepare('SELECT * FROM users WHERE matricule=:id');
$req->execute(["id"=>$matr]);
$agen=$req->fetch();
if(isset($_POST['annee'])){
         if($_POST['mois']==='Selectionner un mois'){
         $datev=$_POST['annee'];
         $a="01-01-$datev ";
         $b="31-12-$datev";
         $req=$pdo->prepare('SELECT * FROM facture WHERE id_vendeur=:id AND date BETWEEN :deb AND :fin');

         $req->execute(
                  [        
                           "id"=>$id,
                           "deb"=>$a,
                           "fin"=>$b
                  ]
         );

         
         $donnees=$req->fetchAll();
         }else{
                  $datev=$_POST['annee'];
                  $a="01-01-$datev ";
                  $b="31-12-$datev";
                  $m=$_POST['mois'];
                  
                  $reqs=$pdo->prepare('SELECT * FROM facture WHERE id_vendeur=:id AND mois=:m AND date BETWEEN :deb AND :fin ORDER BY id desc');

                  $reqs->execute(
                           [        
                                    "id"=>$id,
                                    "m"=>$m,
                                    "deb"=>$a,
                                    "fin"=>$b
                           ]
                  );
                  
                  
                  $donnees=$reqs->fetchAll();
                  
         }        
}



require('utilitaires/entete/head.php');


?>

<div class="container">
  <a href="agent.php?agent=<?=$_GET['id']?>">Retour</a>
        <h4 class="text-center" ><?= $agen['nom'] . " ".$agen['prenom'] ?></h4>
         <form action="" method="post">
         <select class="form-select mb-3" name="annee" onchange="this.form.submit()" aria-label="Default select example">
                  <option selected>Selectionner une année</option>
                  <?php for($i=$annee; $i<=$date; $i++):?>
                  <option <?php if($_POST['annee']==$i ):?><?='selected' ?><?php endif ?>  value="<?=$i?>"><?=$i?></option>
                  <?php endfor ?>
         </select>
         <select name="mois" class="form-select" onchange="this.form.submit()" aria-label="Default select example">
                  <option  >Selectionner un mois</option>
                  <?php foreach($mois as $m) :?>
                  <option <?php if($_POST['mois']==$m['id'] ):?><?='selected' ?><?php endif ?> value="<?=$m['id'] ?>"><?=$m['nom'] ?></option>
                  <?php endforeach ?>
         </select>
         </form>
</div>
<div class="container">
<table class="table">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">Quantité</th>
      <th scope="col">QtAchete</th>
      <th scope="col">Total</th>
      <th scope="col">tva</th>
      <th scope="col">Date</th>
      <th scope="col">Heure</th>

    </tr>
  </thead>
  <tbody>
         <?php foreach($donnees as $d) :?>
    <tr>
      <th scope="row"><?= $d['id'] ?></th>
      <td><?= $d['qte'] ?></td>
      <td><?= $d['qtepr'] ?></td>
      <td><?= number_format($d['total'],2," , ", " " )?>Fc</td>
      <td><?= $d['tva']*100 ?> %</td>
      <td><?= $d['date']?> </td>
      <td><?= $d['heure']?></td>

    </tr>
    <?php
         $totalprix+=$d['total']
    ?>
    <?php endforeach?>
  </tbody>
</table>
<strong><?= number_format($totalprix,2," , ", " ") ?> </strong>Fc
</div>


<?php
//var_dump($produits);

require('utilitaires/entete/foot.php');
?>

