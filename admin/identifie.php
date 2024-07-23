
<?php
require('utilitaires/connexion.php');
require('utilitaires/fonctions.php');
$error=false;


    if(isset($_POST['email']) AND isset($_POST['mdp'])){
        $email=$_POST['email'];
        $mdp=$_POST['mdp'];
        $utilisateur=Utilisateur($pdo,$email,$mdp);
        if($utilisateur != null){
            $_SESSION['utilisateur']=$utilisateur;
            header('Location: index.php');
        }else{
            $error=true;
        }

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
  <body class="text-center bg-dark " >

<main class="form-signin  " >
  <form method="post">
    <img class="mb-4" src="../css/images/Capture.PNG" alt="" width="200" height="150">
    <h1 class="h3 mb-3 fw-normal  text-white">Connecter vous</h1>

    <div class="form-floating">
      <input type="email" name="email" class="form-control  <?php if($error) :?>is-invalid<?php endif ?> " value="<?php if($error) :?><?= $_POST['email']?><?php endif ?>" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput validationServer03">Adresse Mail </label>
        <div id="validationServer03Feedback" class="invalid-feedback">
        Mot de passe ou Email Invalide
        </div>
       
    </div>
    <div class="form-floating mt-2">
      <input type="password" required name="mdp" class="form-control <?php if($error) :?>is-invalid<?php endif ?>" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Mot de Passe</label>
      <div id="validationServer03Feedback" class="invalid-feedback">
        Mot de passe ou Email Invalide
        </div>
    </div>

    <button class="w-100 btn btn-lg btn-primary" type="submit">Se connecter</button>
    
    <p class="mt-5 mb-3 text-muted">&copy; 2023–2024</p>
  </form>
</main>



  </body>


</html>
