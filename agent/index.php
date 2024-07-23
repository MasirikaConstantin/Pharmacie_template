<?php
require('utilitaires/vendor/autoload.php');

session_start();
$titre="Accueil  ";
if($_SESSION['agent']===null){
    header('Location:../index.php');
}

$agent=$_SESSION['agent'];

if(isset($_COOKIE['succes'])){
    $succes=$_COOKIE['succes'];
} 

require('utilitaires/connexion.php');

require('utilitaires/fonctions.php');
    $n="null";
   
    $produits=Produits($pdo);
    $client=client($pdo);
    require("panier/panier.class.php");
    
    require("panier/db.class2.php");
        $pdo=new DB;
      $panier=new panier($pdo);

    require('utilitaires/entete/head.php');
    




    $ids=array_keys($_SESSION['panier']);
            
    //var_dump($ids);die;
      //       $ids=[];
    
        $produitsPa=$pdo->query('SELECT * FROM produits WHERE id IN ('.implode(',',$ids).')');
  
    
        if(isset($_GET['del'])){
             $panier->del($_GET['del']);
             header('Location: index.php');
        }
        if(isset($_POST['valider'])){
          $_SESSION['facture']=$_SESSION['panier'];
          header('Location: facture.php');
        }
        //var_dump($_SESSION['panier']);
        
if(isset($_POST['nom'])){
  //var_dump($_POST['nom']);
  
  NouvaClient($pdos,$_POST['nom'],$_POST['pre'],$_POST['adresse'],$_POST['contact']);
  $url='facture.php?id=' . $pdos -> lastInsertId();
  
  $_POST['nom']===null;
  $_POST['pre']===null;
  $_POST['adresse']===null;
  $_POST['contact']===null;
  header('Location: index.php');

    /*echo('
  <a href='.$url.' id="1" onload="setTimeout(function  () {
      window.open('.$url.',"_blank")
    },1000 )" target="_blank"></a>');*/
        
//  echo('<a href='.$url.' onmouseover="open('.$url.')" >dd</a>');
//  header('Location: facture.php?id=' . $pdos -> lastInsertId());
  
  //header('Location: index.php');
}
    if(isset($_POST['vider'])){
      unset($_SESSION['panier']);
      header('Location: index.php');
    }
?>


<?php
//var_dump($_SERVER['SCRIPT_NAME']);

?>

<script>
  const lien=document.getElementById('1')
  lien.click();
</script>

<main class="">
  <div class="row g-5 border border-5">
    <div class="col-md-6 ">
      <div class="container ">
        <h1 class="text-bold"> Tous les Médicaments</h1>
<!--label for="" id="monLabel"></label-->

        <article class="blog-post">
        

          <div class="container ">
    
            <div class="container ">
              <?php if(isset($succes)) :?>
                <div class="alert alert-success">
                  <h5 class="text-center" ><?= $succes ?></h5>
                </div>
              <?php endif ?>
      
              <div class="container " style="margin-top:12px">
                <form class="d-flex mb-3">
                  <input class="form-control me-2 w-100 " type="search" id="myInput" onkeyup="filterTable()" placeholder="Filtrer par nom" aria-label="Search">
                
                </form>
              </div>
              <form action="" method="post">
                <table id="myTable" class="table table-striped border border-5">
                  <thead>
                    <tr>
                      <th scope="col">Idéntinfiant</th>
                      <th scope="col">Libellé</th>
                      <th scope="col">Prix</th>
                      <th scope="col">Qté</th>
                      <th scope="col">Action 1</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($produits as $p) :?>
                      <tr id="tr">
                        <th scope="row"><?=$p['id_med']?></th>
                        <td><?=$p['nom']?></td>
                        <td><?= number_format($p['prix'], 2, ' , ','  ');?> Fc</td>
                        <td><?=$p['quantite']?></td>
                        <td><a class="addPanier" href="panier/addpanier.php?id=<?=$p['id']?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Ajouter Au Panier" ><i class="bi bi-cart-plus-fill"></i></a></td>
                      </tr>
                    <?php endforeach ?>
                
                  </tbody>
                </table>
              </form>
            </div>
          </div>
        </article>
      </div>
    </div>

    <div class="col-md-6 ">
      <div class="position-sticky border border-5" style="top: 6rem;">
      <div class="container blog-post " >
        <div class="container ">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-primary mb-3">Panier en Cours</span>
        <a href="panier.php"  class="btn btn-link" >Voir le panier</a>
          
          <span>Nombre : <span class="badge bg-primary rounded-pill"><?= $panier->count()?></span></span>
        </h4>
        <ul class="list-group mb-3 border border-5">
         <form action="" method="post">
                  <table class="table">
                           <thead>
                                    <tr>
                                             <th scope="col">N°</th>
                                             <th scope="col">Nom</th>
                                             <th scope="col">Quantité</th>
                                             <th scope="col">Prix + TVA(<?= $tva*10?>%)</th>
                                             <th scope="col">Action</th>
                                    </tr>
                           </thead>
                           <tbody>
                           <?php $i=1; foreach ($produitsPa as $pr) :?>

                                    <tr   >
                                                      <th scope="row"><?= $i++ ?></th>
                                                      <td><?= $pr['nom'] ?></td>
                                                      <td>
                                                               <div class="row g-3">
                                                                        <div class="col-auto">
                                                                        <div class="col-auto">
                           <input type="number" class="form-control" name="panier[quant][<?=$pr['id']?>]" onchange="this.form.submit()" value="<?php if(isset($_SESSION['panier'][$pr['id']])):?><?= $_SESSION['panier'][$pr['id']] ?><?php endif?>">
                                                                        </div></div>
                           </div>
                                                      </td>
                                                      <td><?= number_format(($pr['prix']*($tva+1)), 3," , ",' ') ?></td>
                                                      <td><a href="index.php?del=<?= $pr['id'] ?>"data-bs-toggle="tooltip" data-bs-placement="top" title="Supprimer du Panier"> <i class="bi bi-cart-x"></i></a></td>

                                    </tr>
                                    <?php endforeach ?>

                           
                           </tbody>
                  </table>

                

                        <!--div class="d-grid gap-2 mb-3 col-6 mx-auto">
                      <button class="btn btn-secondary" type="submit">Actualiser</button>
                      </div-->
            </form>
          <form action="" method="post">
            
          <div class="d-grid gap-2 mb-3 col-6 mx-auto">
                      <button  type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Ajouter un client</button>
                      

                      </div>
          </form>

          
          <li class="list-group-item d-flex justify-content-between">
            <span>Total (Fc)</span>
            Sans TVA : <strong><?=number_format($panier->totalsanttva(), 3,',',' ') ?> Fc</strong> et  Avec TVA : <strong> <?=number_format($panier->total($tva), 3,',',' ') ?> Fc</strong> 
          </li>
        </ul>
                            <?php if($_SESSION['panier']) :?>
                      
        <div class="container border border-5 ">
        <div class="d-grid gap-2 mt-2 col-6 mx-auto">
<form action="" method="post">
<button name="vider"  type="submit" class="btn btn-primary" >Vider le panier</button>

</form>                      

                      </div>
          <div class="container" style="margin-top:12px">
                <form class="d-flex mb-3">
                  <input class="form-control me-2 w-100 " type="search" id="myInput2" onkeyup="filterTableClient()" placeholder="Filtrer par nom" aria-label="Search">
                
                </form>
              </div>
              <form method="post">
                <table id="myTable2" class="table">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Nom</th>
                      <th scope="col">Contact</th>
                      <th scope="col">Adresse</th>
                      <th scope="col">Acheteur</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php foreach($client as $c) :?>
                    <tr id="trs" >
                      <th scope="row"><?=$c['id']?></th>
                      <td><?=$c['nom']?></td>
                      <td><?=$c['contact']?></td>
                      <td><?=$c['adresse']?></td>
                      <td><a href="facture.php?id=<?= $c['id'] ?>" target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" title="Valider le Panier"> <i class="bi bi-cart"></i></a></td>
                    </tr>
                    <?php endforeach ?>
                    
                  </tbody>
                </table>
          </form>
        </div>
        <?php endif ?>
      </div>
      </div>


      </div>
    </div>
  </div>

</main>


  <?php

  ?>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Nouveau Client</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      


      <form class="row g-3 needs-validation" action="index.php" method="post">
  <div class="col-md-6">
    <label for="validationCustom01" class="form-label">Nom </label>
    <input type="text" class="form-control" id="validationCustom01" value="" name="nom" >
    <div class="valid-feedback">
      Looks good!
    </div>
  </div>
  <div class="col-md-6">
    <label for="validationCustom02" class="form-label">Prenom</label>
    <input type="text" class="form-control" id="validationCustom02" value="" name="pre" >
    <div class="valid-feedback">
      Looks good!
    </div>
  </div>
  
  <div class="col-md-6">
    <label for="validationCustom03" class="form-label">Adresse</label>
    <input type="text" class="form-control" id="validationCustom03" name="adresse" >
    <div class="invalid-feedback">
      Please provide a valid city.
    </div>
  </div>
  
  <div class="col-md-6">
    <label for="validationCustom05" class="form-label">Contact</label>
    <input type="text" class="form-control" id="validationCustom05" name="contact" >
    <div class="invalid-feedback">
      Please provide a valid zip.
    </div>
  </div>
  

      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
        <button  type="submit"   class="btn btn-primary"  >Envoyer</button>
      </div>
    </div>
    </form>
  </div>
</div>
<?php
//var_dump($produits);

require('utilitaires/entete/foot.php');
?>