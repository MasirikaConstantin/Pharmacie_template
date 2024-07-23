<?php
  require("panier.class.php");
  require("../db.class.php");
  $db=new DB;
  $panier=new panier($db);
         $json=['error'=>true];
  if(isset($_GET['id'])){
         $produit=$db->query('SELECT * FROM produits WHERE id=:id',(['id'=>$_GET['id']]));
         
         
         if(empty($produit)){
                  $json['message']="Ce Produit n'existe pas ";
         }
         $panier->add($produit["id"]);
         $json['error']=false;
         $json['message']='Le Produit a bien était ajouter ';
  }else{
         $json['message']='Rien à signaler';
  }
  echo json_encode($json);
  ?>