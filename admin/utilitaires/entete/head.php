
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if(isset($titre)) :?><?= $titre?>|  Pharma<?php else: ?><?='Pharma'?><?php endif?></title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/blog.css">
    <style>
        @font-face {
            font-family: 'Google';
            src: url('../css/fonts/google/ProductSans-Regular.ttf');
            font-weight: 500;
            
        }
        body{
            font-family: 'Google';
        }
        h1{
          font-family: 'Google';
        }
        h2{
          font-family: 'Google';
        }
        h5{
          font-family: 'Google';
        }
        h4{
          font-family: 'Google';
        }
        h6{
          font-family: 'Google';
        }
    </style>
</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top py-1" aria-label="Ninth navbar example">
    <div class="container-xl">
      <a class="navbar-brand" href="index.php" style="font-size:30px" >Ma Pharmacie</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample07XL" aria-controls="navbarsExample07XL" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExample07XL">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link <?php if(isset($n)):?>active <?php endif?>" aria-current="page" href="index.php">Accueil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php if(isset($nd)):?>active <?php endif?>" href="activites.php">Activités</a>
          </li>
          <li class="nav-item">
            <a class="nav-link  <?php if(isset($au)):?>active <?php endif?>" href="autres.php" >Autres</a>
          </li>
          <>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown07XL" data-bs-toggle="dropdown" aria-expanded="false">Historiques</a>
            <ul class="dropdown-menu" aria-labelledby="dropdown07XL">
              <li><a class="dropdown-item" href="exe.php">Configuration</a></li>
              <li><a class="dropdown-item" href="rapport.php">Rapport</a></li>
              <li><a class="dropdown-item" href="agent.php">Agents</a></li>
            </ul>
          </li>
          
        </ul>
       
        <div class="d-flex">>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li>
            <a  class="nav-link text-white  me-2"> <?= $utilisateur['nom'].'  '.$utilisateur['postnom'].'  '.$utilisateur['prenom'] ?> </a>
            </li>

            <li>
            <a href="utilitaires/deconnecter.php" class="btn btn-primary">Se deconnecter</a>
            </li>
        
      </div>
      </div>
    </div>
  </nav>
<div class="container" style="margin-top :20px;" ></div>