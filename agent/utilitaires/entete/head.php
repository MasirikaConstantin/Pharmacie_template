<?php
//require('../vendor/autoload.php')
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if(isset($titre)) :?><?= $titre?>|  Pharma<?php else: ?><?='Pharma'?><?php endif?></title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/blog.css">
    <link rel="stylesheet" href="../css/bootstrap-icons/bootstrap-icons.css">
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
        .icons {
      display: grid;
      max-width: 100%;
      grid-template-columns: repeat(auto-fit, minmax(100px, 1fr) );
      gap: 1.25rem;
    }
    .icon {
      background-color: var(--bs-light);
      border-radius: .25rem;
    }
    .bi {
      margin: .25rem;
      font-size: 1.5rem;
    }
    .label {
      font-family: var(--bs-font-monospace);
    }
    .label {
      display: inline-block;
      width: 100%;
      overflow: hidden;
      padding: .25rem;
      font-size: .625rem;
      text-overflow: ellipsis;
      white-space: nowrap;
    }
    </style>
</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top py-1" aria-label="Ninth navbar example">
    <div class="container-xl">
      <a class="navbar-brand" href="index.php" style="font-size:30px" > Pharmacie</a>
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
          
              
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown07XL" data-bs-toggle="dropdown" aria-expanded="false">Historiques</a>
            <ul class="dropdown-menu" aria-labelledby="dropdown07XL">
              <li><a class="dropdown-item" href="exe.php">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </li>
          <li class="nav-item">
          <body  onLoad="showtime()">
                            
                            <form name = "clock">
                            <input disabled type= "test" class="form-control" name = "clock" size = 10 value="">
                            </form>

          </body></li>
        </ul>
       
        <div class="d-flex">>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li>
            <a  class="nav-link text-white  me-2"> <?= $agent['nom'].'  '.$agent['postnom'].'  '.$agent['prenom'] ?> </a>
            </li>

            <li>
            <a href="utilitaires/deconnecter.php" class="btn btn-primary">Se deconnecter</a>
            </li>
        
      </div>
      </div>
    </div>
  </nav>
<div class="container" style="margin-top :20px;" ></div>