<?php
session_start();
$titre="Accueil  ";
if($_SESSION['utilisateur']===null){
    header('Location:identifie.php');
}
if(isset($_GET['produit'])){
    
} 
require('utilitaires/fonctions.php');
    require('utilitaires/connexion.php');
    
   
    $produit=ProduitsModif($pdo,$_GET['suppri']);
    require('utilitaires/entete/head.php');
    if(isset($_GET['suppri'])){
         $id=$_GET['suppri'];
         if(SupprimerProd($pdo,$id)){
                  
                  setcookie('succes','Le Produit a été Supprimer avec succes',time()+3);
                  header('Location:index.php');exit();
                  
         }
    }
    

    
?>
