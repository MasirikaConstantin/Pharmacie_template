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
    $matr=randomagent();
    if(isset($_POST['creer'])){
      $nom=$_POST['nom'];
      $post=$_POST['post'];
      $prenom=$_POST['prenom'];
      $adresse=$_POST['adresse'];
      $contact=$_POST['contact'];
      $email=$_POST['email'];
      $sexe=$_POST['sexe'];
      $attribut=$_POST['attribut'];
      
      if($nom!=null){
            $query=$pdo->prepare('SELECT * FROM users WHERE matricule = :matricule');
            $query->execute(['matricule' =>$matr]);;
            $verif =$query->fetch();
            //var_dump($verif);
            if($verif===false){
                $query=$pdo->prepare('SELECT * FROM users WHERE email = :email');
                $query->execute(['email' =>$email]);;
                $verif2 =$query->fetch();
                if($verif2===false){
                    CreerAgent($pdo,$matr,$nom,$post,$prenom,$sexe,$adresse,$contact,$attribut,$email);
                    $succes='Agent créer avec succes';
                }else{
                  $error='Compte mail existant';
                }
                
            }else{
              $error='Une erreur est survenue veillez recommencer ';
            }
        
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
  <h4>Créer un  Employer</h3>
  </div>
  <div class="card-body">
    
    
    <form class="row g-3 needs-validation" method="post" >
      <div class=" mb-3">
        <h5>Matricule : <?=$matr?></h5>
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
            <input type="text" class="form-control" id="floatingInput" name="nom" value="<?php if($error): ?><?= $_POST['nom']?><?php endif?>"   required>
            <label for="floatingInput">Nom</label>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingPassword" name="post" value="<?php if($error): ?><?= $_POST['post']?><?php endif?>" required>
            <label for="floatingPassword">Post-Nom</label>
          </div>
        </div>

        <div class="col-md-4">
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingPassword" name="prenom"  value="<?php if($error): ?><?= $_POST['prenom']?><?php endif?>" required>
            <label for="floatingPassword">Prénom</label>
          </div>
        </div>
        
        <div class="col-md-4">
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingPassword" name="adresse"  value="<?php if($error): ?><?= $_POST['adresse']?><?php endif?>" required>
            <label for="floatingPassword">Adresse</label>
          </div>
        </div>

        <div class="col-md-4">
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingPassword" name="contact"  value="<?php if($error): ?><?= $_POST['contact']?><?php endif?>" required>
            <label for="floatingPassword">Contact</label>
          </div>
        </div>

        <div class="col-md-4">
          <div class="form-floating mb-3">
            <input type="email" class="form-control <?php if($error): ?> is-invalid"<?php endif?> id="floatingPassword" name="email"  value="<?php if($error): ?><?= $_POST['email']?><?php endif?>" required>
            <label for=" validationServer03">Email</label>
            <?php if($error): ?>
                <div id="validationServer03Feedback" class="invalid-feedback">
                  Compte mail déjà utilisé
                </div>
            <?php endif?> 
          </div>
          
        </div>
      
        <div class="col-md-6">
          <div class="form-floating">
            <select class="form-select" name="sexe" id="floatingSelect" aria-label="Floating label select example">
              
              <option value="M">Masculin</option>
              <option value="F">Feminin</option>
              <option value="P">Personaliser</option>
            </select>
            <label for="floatingSelect">Sexe</label>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-floating">
            <select class="form-select" name="attribut" id="floatingSelect" aria-label="Floating label select example">
              
              <option value="Vendeur">Vendeur</option>
              <option value="admin">Administrateur</option>
              <option value="sup">Superviseur</option>
            </select>
            <label for="floatingSelect">Attribut</label>
          </div>
        </div>
        <div class=" mb-3">
        <small style="color:red" >*Après la création un mot de passe par defaut lui ai attribuer*</small>
      </div>
      
              <div class="d-grid gap-3  d-md-flex justify-content-md-center">

                <button  type="submit" name="creer" class="btn btn-primary">Créer</button>
                <a href="index.php" class="btn btn-danger">Quitter</a>
              </div>
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
