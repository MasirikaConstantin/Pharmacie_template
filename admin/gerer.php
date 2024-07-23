<?php
session_start();
require('utilitaires/fonctions.php');
require('utilitaires/connexion.php');
$succes=null;
if(isset($_GET['pr'])){
  $id=(int)$_GET['pr'];
  $produit=ProduitsModif($pdo,$id);

  if(isset($_POST['modif'])){
  
        $nom=$_POST['nom'];
        $prix=$_POST['prix'];
        $quantite=$_POST['quantite'];
        $commentaire=$_POST['commentaire'];

        if(ModifierMedicament($pdo,$id,$nom,$prix,$quantite,$commentaire)){
          setcookie('succes','Médicament modifier avec succes',time()+3);
          header('Location:index.php');
        }
      
    }

}else{
  $id_med=random_word();
      
    if(isset($_POST['nom'],$_POST['prix'],$_POST['commentaire'])){
      if(!empty($_POST['nom'])AND !empty($_POST['prix'])){
          $nom=$_POST['nom'];
          $prix=$_POST['prix'];
          $quantite=$_POST['quantite'];
          $commentaire=$_POST['commentaire'];

          if(CreerMedicament($pdo,$id_med,$nom,$prix,$quantite,$commentaire)){
            $succes='Médicament créer avec succes';
          }
        }
    }
}
require('utilitaires/entete/head.php');
?>
<div class="container mb-3">
<div class="card text-center">
  <div class="card-header">
  <?php if(isset($_GET['pr'])): ?>Apporter une Modification<?php else:?>Nouveau Produit<?php endif?>
  </div>
  <div class="card-body">
    <?php if($succes) :?>
      <div class="alert alert-success">
        <?= $succes ?>
      </div>
    <?php endif ?>
    <form action="" method="post">
      <div class=" mb-3">
        <h5><?php if(isset($_GET['pr'])): ?><?= $produit['id_med']?><?php else:?><?= $id_med?><?php endif?></h5>
      </div>

      <div class="form-floating mb-3">
        <input type="text" class="form-control" id="floatingInput" name="nom" value="<?php if(isset($_GET['pr'])): ?><?= $produit['nom']?><?php endif?>"   required>
        <label for="floatingInput">Libellé(nom)</label>
      </div>
      <div class="form-floating mb-3">
        <input type="text" class="form-control" id="floatingPassword" name="prix" value="<?php if(isset($_GET['pr'])) :?><?= $produit['prix']?><?php endif?>" required>
        <label for="floatingPassword">Prix</label>
      </div>

      <div class="form-floating mb-3">
        <input type="number" class="form-control" id="floatingPassword" name="quantite"  value="<?php if(isset($_GET['pr'])): ?><?= $produit['quantite']?><?php endif?>" required>
        <label for="floatingPassword">Quantité</label>
      </div>
      <div class="form-floating mb-3">
        <textarea class="form-control" name="commentaire" style="height: 150px" value="" placeholder="Entrer un commentaire ici ..." id="floatingTextarea"><?php if(isset($_GET['pr'])): ?><?= $produit['commentaire']?><?php endif?></textarea>
        <label for="floatingTextarea">Commentaire</label>
      </div>


      <button  type="submit" name="modif" class="btn btn-primary"><?php if(isset($_GET['pr'])): ?>Sauvegarder <?php else:?>Créer<?php endif?></button>
      <a href="index.php" class="btn btn-danger">Quitter</a>
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