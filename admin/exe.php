<?php
session_start();
if($_SESSION['utilisateur']===null){
    header('Location:identifie.php');
}
require('utilitaires/fonctions.php');
    require('utilitaires/connexion.php');
    $nd="/admin/activites.php";
    
    $utilisateur=($_SESSION['utilisateur']);
    $succes=null;
    $error=null;
    if(isset($_POST['ajour'])){
      $nombres=$_POST['ajour'];
      $nombre=$nombres/100;
      if(is_numeric($nombre)){
        $query=$pdo->prepare('UPDATE configuration SET montant=:montant WHERE id=:id');

        $query->execute(array(
        'id'=>1,
        'montant'=>$nombre,
        ));
        if($query){
          $succes='Mises à jours réusi';
        }else{
          $error='Une erreur est survenue';
        }
      }else{
        $error="Insérer les bonnes informations";
      }

    }
  
    require('utilitaires/entete/head.php');
?>


<?php
//var_dump($_SERVER)

?>





        
<div class="container mb-3">
<div class="card text-center">
  <div class="card-header">
  <h4>Config</h3>
  </div>
  <div class="card-body">
    
    
    <form class="row g-3 needs-validation" method="post" >
      <div class=" mb-3">
        <h5>Quelques Configuration</h5>
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
    
        
      <form method="post" class="row g-3">
  <div class="col-auto">
    <label for="staticEmail2" class="visually-hidden">TVA</label>
    <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="T . V . A">
  </div>
  <div class="col-auto">
    <label for="inputPassword2" class="visually-hidden">T.V.A</label>
    <input type="text" class="form-control" name="ajour" value="<?php if($error) :?><?= $_POST['ajour'] ?><?php endif ?>" id="inputPassword2" placeholder="tva">
  </div>
  <div class="col-auto">
    <button type="submit" class="btn btn-primary mb-3">Mettre à jours</button>
  </div>
</form>
      
          
      
      
      
      
              <!--div class="d-grid gap-3  d-md-flex justify-content-md-center">

                <button  type="submit" name="creer" class="btn btn-primary">Créer</button>
                <a href="index.php" class="btn btn-danger">Quitter</a>
              </div-->
    </form>
  </div>
  <div class="card-footer text-muted">
    Pharma
  </div>
</div>


</div>











<?php

require('utilitaires/entete/foot.php');
?>
