<?php
$titre="connexion";
require('admin/utilitaires/fonctions.php');


$pdo = new PDO('sqlite:bdd/pharmacie.db',null,null, [
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

session_start();
$error=null;
$ml=null;
$cd=null;
$succes=null;
  if($_SESSION['agent']===null){
    header('Location: index.php');
  }
$agent=$_SESSION['agent'];
if(!empty($_POST)){
    $n1=$_POST['n1'];
    $n2=$_POST['n2'];
    if($n1 != $n2){
      $error="Les mots de passes doivent être semblabe";
    }else{
      $query=$pdo->prepare('UPDATE users SET mdp=:mdp WHERE id=:id');

        $modif=$query->execute(array(
        'id'=>$agent['id'],
        'mdp'=>$n2,
        ));
        if($modif){
          $succes="Mot de passe modifer avec succes";
        }else{
          $error='Une erreur est survenue';    
        }
    }
    //$error=true;
    $ml=$_POST['n1'];
    $cd=$_POST['n2'];
    //var_dump($ml);
}
?>

<html lang="en"  >


<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>S'identifier</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/sign.css">
    
<meta name="theme-color" content="#7952b3">



<style>
     @font-face {
            font-family: 'Google';
            src: url('../css/fonts/google/ProductSans-Regular.ttf');
            font-weight: 500;
            
        }
        body{
            font-family: 'Google';
        }
</style>
  </head>
<div class="b-example-divider"></div>

<div class="container col-xl-10 col-xxl-8 px-4 py-5">
  <div class="row align-items-center g-lg-5 py-5">
    
    <div class="col-lg-5 text-center text-lg-start">
    <img src="css/images/Capture.PNG" srcset="" class="shadow-lg p-3 mb-5 bg-body rounded" style="width: 100%; height: 90%;  ">
      <!-- h1 class="display-4 fw-bold lh-1 mb-3">Vertically centered hero sign-up form</h1>
      <p class="col-lg-10 fs-4">Below is an example form built entirely with Bootstrap’s form controls. Each required form group has a validation state that can be triggered by attempting to submit the form without completing it.</p-->
    </div>
    <div class="col-md-10 mx-auto col-lg-5">
      <form class="p-4 p-md-5 border rounded-3 bg-light" method="post">
    <h5 class="text-center mb-3" >Création de mot de passe</h5>
        <?php if($succes):?>
        <div class="alert alert-success text-center">
          <h5><?=$succes?></h5>
          <a href="index.php" class="w-100 btn btn-lg btn-primary" type="submit">Se Connecter</a>
        </div>
        <?php endif ?>
        <div class="form-floating mb-3">
          
          <input type="password" name="n1" class="form-control <?php if($error):?> is-invalid" <?php endif ?>  value="<?php if($error):?> <?= $ml ?> <?php endif ?>" id="floatingInput" placeholder="nom@example.com">
          <label for="floatingInput"> Nouveau Mot de passe</label>
          <?php if($error):?>
                  <div  class=" text-center invalid-feedback">
                  <small  ><?= $error ?> </small>
            </div>
            <?php endif ?>
        </div>
        <div class="form-floating mb-3">
          <input type="password" name="n2" class="form-control <?php if($error):?> is-invalid" <?php endif ?>id="floatingPassword" value="<?php if($error):?> <?= $cd ?> <?php endif ?>" placeholder="Mot de passe">
          <label for="floatingPassword">Repeter le Mot de passe</label>
                  <?php if($error):?>
                  <div  class="text-center invalid-feedback">
                  <small><?= $error ?> </small>
                </div>
            <?php endif ?>
        </div>
       
        
        <button class="w-100 btn btn-lg btn-primary" type="submit">Creer</button>
        
        <hr class="my-4"> 
      
      </form>
      
    </div>
  </div>
</div>

<div class="b-example-divider"></div>

