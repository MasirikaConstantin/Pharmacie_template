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
         
$query=$pdo->prepare('SELECT * FROM users WHERE attrib="Vendeur"');
$query->execute();
$agent=$query->fetchAll();
$ver=null;
if(isset($_GET['agent'])){
    $ver=$_GET['agent'];
              
    $query=$pdo->prepare('SELECT * FROM users WHERE matricule=:mat');
    $query->execute([
      'mat'=>$ver
    ]);
    $agentsel=$query->fetch();
    
    
    
    $query=$pdo->prepare('SELECT COUNT(*) FROM facture WHERE id_vendeur=:mat');
    $query->execute([
      'mat'=>$agentsel['id']
    ]);
    $count=$query->fetch();
    
    //var_dump($count);
    $nombre=$count['COUNT(*)'];

      
    $query=$pdo->prepare('SELECT SUM(total) FROM facture WHERE id_vendeur=:mat');
    $query->execute([
      'mat'=>$agentsel['id']
    ]);
    $co=$query->fetch();
    
    $total=$co["SUM(total)"];
    
    $nombre=$count['COUNT(*)'];
}

require('utilitaires/entete/head.php');
?>


<div class="row align-items-md-stretch mb-2">
         <div class="col-md-6">
                  <div class="container" style="margin-top:12px">
                           <form class="d-flex mb-3">
                                    <input class="form-control me-2 w-100 " type="search" id="myInput"
                                             onkeyup="filterTable()" placeholder="Filtrer par nom" aria-label="Search">

                           </form>
                  </div>
                  <form action="" method="post">
                           <table id="myTable" class="table table-bordered border-primary">
                                    <thead>
                                             <tr>
                                                      <th scope="col">Matricule</th>
                                                      <th scope="col">Nom</th>
                                                      <th scope="col">Post-nom</th>
                                                      <th scope="col">Sexe</th>
                                                      <th scope="col">Contact</th>
                                                      <th scope="col">Action</th>


                                             </tr>
                                    </thead>
                                    <tbody>
                                             <?php foreach($agent as $a) : ?>
                                             <tr>
                                                      <th scope="row"><?=$a['matricule'] ?></th>
                                                      <td><?=$a['nom'] ?></td>
                                                      <td><?=$a['postnom'] ?></td>
                                                      <td><?=$a['sexe'] ?></td>
                                                      <td><?=$a['contact'] ?></td>
                                                      <td><a href="agent.php?agent=<?=$a['matricule'] ?>" name="agent"
                                                                        class="btn btn-link">Consulter</a></td>

                                             </tr>
                                             <?php endforeach ?>
                                    </tbody>
                           </table>
                  </form>
         </div>




         <div class="col-md-6">
                  <div class="h-100 p-5 bg-light border rounded-3">
                           <?php if($ver) :?>
                           <div class="container mb-3">
                                    <div class="card text-center">

                                             <div class="card-body">


                                                      <form class="row g-3 needs-validation" method="post">
                                                               <div class=" mb-3">
                                                                        <h5>Matricule : <?=$agentsel['matricule']?></h5>
                                                               </div>
                                                               <?php if($succes) :?>
                                                               <div class="alert alert-success">
                                                                        <?= $succes ?>
                                                               </div>
                                                               <?php endif ?>
                                                               <?php if($error) :?>
                                                               <div class="alert alert-danger">
                                                                        <?= $error ?>
                                                               </div>
                                                               <?php endif ?>
                                                               <div class="col-md-4">
                                                                        <div class="form-floating mb-3">
                                                                                 <input type="text" class="form-control"
                                                                                          id="floatingInput" name="nom"
                                                                                          value="<?= $agentsel['nom'] ?>"
                                                                                          required>
                                                                                 <label for="floatingInput">Nom</label>
                                                                        </div>
                                                               </div>
                                                               <div class="col-md-4">
                                                                        <div class="form-floating mb-3">
                                                                                 <input type="text" class="form-control"
                                                                                          id="floatingPassword"
                                                                                          name="post"
                                                                                          value="<?= $agentsel['postnom'] ?>"
                                                                                          required>
                                                                                 <label
                                                                                          for="floatingPassword">Post-Nom</label>
                                                                        </div>
                                                               </div>

                                                               <div class="col-md-4">
                                                                        <div class="form-floating mb-3">
                                                                                 <input type="text" class="form-control"
                                                                                          id="floatingPassword"
                                                                                          name="prenom"
                                                                                          value="<?= $agentsel['prenom'] ?>"
                                                                                          required>
                                                                                 <label
                                                                                          for="floatingPassword">Prénom</label>
                                                                        </div>
                                                               </div>

                                                               <div class="col-md-4">
                                                                        <div class="form-floating mb-3">
                                                                                 <input type="text" class="form-control"
                                                                                          id="floatingPassword"
                                                                                          name="adresse"
                                                                                          value="<?= $agentsel['adresse'] ?>"
                                                                                          required>
                                                                                 <label
                                                                                          for="floatingPassword">Adresse</label>
                                                                        </div>
                                                               </div>

                                                               <div class="col-md-4">
                                                                        <div class="form-floating mb-3">
                                                                                 <input type="text" class="form-control"
                                                                                          id="floatingPassword"
                                                                                          name="contact"
                                                                                          value="<?= $agentsel['contact']; ?>"
                                                                                          required>
                                                                                 <label
                                                                                          for="floatingPassword">Contact</label>
                                                                        </div>
                                                               </div>

                                                               <div class="col-md-4">
                                                                        <div class="form-floating mb-3">
                                                                                 <input type="email"
                                                                                          class="form-control"
                                                                                          id="floatingPassword"
                                                                                          name="email"
                                                                                          value="<?= $agentsel['email'] ?>"
                                                                                          required>
                                                                                 <label
                                                                                          for=" validationServer03">Email</label>
                                                                                 <?php if($error): ?>
                                                                                 <div id="validationServer03Feedback"
                                                                                          class="invalid-feedback">
                                                                                          Compte mail déjà utilisé
                                                                                 </div>
                                                                                 <?php endif?>
                                                                        </div>

                                                               </div>

                                                                <div>
                                                                  
                                                                    Nombre des produits : <strong> <?= $nombre?></strong> Total déjà vendu :<strong> <?= number_format($total, 0, '','  ');?> Fc </strong>
                                                                  
                                                                </div>

                                                               <div
                                                                        class="d-grid gap-3  d-md-flex justify-content-md-center">

                                                                        <a href="plus.php?id=<?=$agentsel['id']?>&matr=<?=$agentsel['matricule']?>" class="btn btn-link">Consulter Plus</a>

                                                               </div>
                                                      </form>
                                             </div>
                                             <div class="card-footer text-muted">
                                                      Pharma
                                             </div>
                                    </div>


                           </div>











                           <?php else: ?>
                           <div class="alert alert-success">
                                    <h4 class="text-center">Aucun Sélectionner </h4>
                           </div>
                           <?php endif ?>
                  </div>
         </div>
</div>



</div>
<?php
//var_dump($produits);

require('utilitaires/entete/foot.php');
?>