<?php
require('utilitaires/vendor/autoload.php');


session_start();
require("panier/db.class2.php");
require("panier/panier.class.php");
require('utilitaires/connexion.php');

    //$produitsPa=[];
    $pdo=new DB;
    $panier=new panier($pdo);
date_default_timezone_set('Africa/Kinshasa');

$ids=array_keys($_SESSION['panier']);
            
//dump($ids);
  //       $ids=[];
$agent=$_SESSION['agent'];
$ad=$agent['nom'].' '.$agent['postnom'].' '.$agent['prenom'].' '.$agent['id'];
    $produits=$pdo->query('SELECT * FROM produits WHERE id IN ('.implode(',',$ids).')');
    
    
      $query=$pdos->prepare('select * FROM client WHERE id=:id');

      $query->execute(array(
          'id'=>$_GET['id']
              
      ));
    //  $i="";
      $cl=$query->fetch();
    
      $i=implode(',',array_column($produits,'prix'));
      $querys=$pdos->prepare('SELECT id FROM facture  ORDER BY id DESC');

      $querys->execute();
    //  $i="";
      $nu=$querys->fetch();
      $remise=1.5;

      $tot=$panier->total($tva);
      $remise1=($tot/100)*$remise;
      $totalapayer=$tot-$remise1;
      //$nu=$pr['id'];
//if(isset($_POST['valider'])){
  $pro=implode(',',$ids);
  $qtepr=implode(",",$_SESSION['panier']);
  $qt=$panier->count();
  $id_agent=$agent['id'];
  $id_client=$cl['id'];
  $total=$totalapayer; #$panier->total($tva);
  $date=Date("d-m-Y");
  $heure=Date("H:i:s");
  $lesprix=$i;
  $m=Date('m');
  
  $query=$pdos->prepare('INSERT INTO facture (id_produit,qte,qtepr, id_vendeur,id_acheteur,total,date,heure,lesprix,tva,mois)
  VALUES(:id_produit,:qte,:qtepr, :id_vendeur,:id_acheteur,:total,:date,:heure,:lesprix,:tva,:mois)');
  $query->execute([
    'id_produit' =>$pro,
    'qte' =>$qt,
    'qtepr' =>$qtepr,
    'id_vendeur' =>$id_agent,
    'id_acheteur' =>$id_client,
    'total' =>$total,
    'date' =>$date,
    'heure' =>$heure,
    'lesprix' =>$lesprix,
    'tva'=>$tva,
    'mois'=>$m


  
  ]);

//}
$i=0;
$a=[];
$somme=0;
foreach ($produits as $pr) {
  $i++;
    $a[] = [
        'num' => $i,
        'nom' => $pr['nom'],
        'ref' => $pr['id_med'],
        'quantite' => $_SESSION['panier'][$pr['id']],
        'prix_ttc' => $pr['prix'] * ($tva + 1),
        'pri'=> $pr['prix'] * ($tva + 1)*$_SESSION['panier'][$pr['id']],
    ];
    $somme += ($pr['prix'] * ($tva + 1))*$_SESSION['panier'][$pr['id']];
    $modifications[]=[
      'id'=>$pr['id'],
      'quantite'=>$pr['quantite']-$_SESSION['panier'][$pr['id']]
    ];
}

//$a = array_merge($a, $produits);
//dump($modifications);
foreach($a as $p) {
//echo($p['num']. '        '. $p['nom'].'   --  '.$p['quantite']. '    --   '. $p['prix_ttc'].'<br>');

}
//dump( number_format($somme,2,' , ','  ')."  Fc");
$client=$cl['nom'].'  '.$cl['prenom'];
$adresse=$cl['prenom'];
//dump($client);


//var_dump( number_format($panier->total($tva),2,' , ','  ')."  Fc");
//var_dump($panier->count());

?>