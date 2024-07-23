<?php
$titre='  Facturier';
session_start();
require("panier/db.class2.php");
require("panier/panier.class.php");
require('utilitaires/connexion.php');

    //$produitsPa=[];
    $pdo=new DB;
    $panier=new panier($pdo);
date_default_timezone_set('Africa/Kinshasa');

$ids=array_keys($_SESSION['panier']);
            
//var_dump($ids);die;
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
    
}

//$a = array_merge($a, $produits);

foreach($a as $p) {
//echo($p['num']. '        '. $p['nom'].'   --  '.$p['quantite']. '    --   '. $p['prix_ttc'].'<br>');

}
//var_dump( number_format($somme,2,' , ','  ')."  Fc");
$client=$cl['nom'].'  '.$cl['prenom'];
$adresse=$cl['prenom'];
//var_dump($client);


//var_dump( number_format($panier->total($tva),2,' , ','  ')."  Fc");
//var_dump($panier->count());


  require('lib/makefont/makefont.php');
    
  


//if(isset($_POST['oo'])){
  require('lib/fpdf.php');

//MakeFont('lib/ProductSans-Regular.ttf','cp1252');
  //$pdf = new FPDF("P",'mm',array(210,120));
  $pdf = new FPDF("P",'mm',"A4");

  //$pdf->DefPageSize(12,12);
  $pdf->AddPage();
  $pdf->SetMargins(10,10);
  $pdf->AddFont('ProductSans','','ProductSans-Regular.php');
  $pdf->SetFont("ProductSans","",12);
  
  $pdf->Cell(20,10,'Pharmacie Pharma Pour tous');
  $pdf->SetFont("ProductSans","",10);
  $pdf->Ln(6);
  $pdf->Image('Capture.png', 10, 19, 30, 20);
  $pdf->Ln(20);
  $pdf->Cell(70,10,'Adresse : Kindele bIS.','C');
  $pdf->ln(4);
  $pdf->Cell(15,10,'Contact:');
  $pdf->SetFont("Arial","B",10);
  $pdf->Cell(100,10,'+243 976075391','C');
  $pdf->Cell(12,10,'User : ');
  $pdf->SetFont("ProductSans","",10);

  $pdf->Cell(12,10,$ad);
  
  $pdf->ln(4);
  $pdf->SetFont("ProductSans","",10);
  
  $pdf->Cell(15,10,'Email:');

  $pdf->SetFont("Arial","B",10);
  $pdf->Cell(100,10,'elconstant73@gmail.com','C');
  $pdf->Cell(27,10,utf8_decode('Imprimé le : '));
  $pdf->SetFont("ProductSans","",10);

  $pdf->Cell(9,10,utf8_decode(Date("d-m-Y")),0,0,'C');
  $pdf->Ln(4);
  $pdf->Cell(115,10,);

  $pdf->Cell(17,10,utf8_decode('Heure  : '));
  $pdf->SetFont("ProductSans","",10);

  $pdf->Cell(9,10,utf8_decode(Date("H:i:s")),0,0,'C');
  
  $pdf->Ln();
  $pdf->SetFont("ProductSans","",8);

  
  $pdf->SetFont("ProductSans","",12);
  $pdf->Cell(180,5,utf8_decode('Facture N° : '.$nu['id']+1 .'                                                Nom du client  : '.$client),1,0);

  $pdf->SetFont("ProductSans","",8);

  $pdf->Ln();

  $pdf->Cell(15,5,utf8_decode('Num'),1,0,'C');
  $pdf->Cell(50,5,utf8_decode('Produit'),1,0,'C');
  $pdf->Cell(30,5,utf8_decode('Unité'),1,0,'C');
  $pdf->Cell(20,5,utf8_decode('Qté'),1,0,'C');
  $pdf->Cell(25,5,utf8_decode('P Unite'),1,0,'C');
  $pdf->Cell(40,5,utf8_decode('P Total'),1,0,'C');


  $pdf->Ln();
  foreach ($a as $k){
    $pdf->Cell(15,5, utf8_decode($k['num']),1,0,'C');
    $pdf->Cell(50,5, utf8_decode($k['nom']),1,0);
    $pdf->Cell(30,5, utf8_decode('Pièces'),1,0,'C');
    $pdf->Cell(20,5, utf8_decode($k['quantite']),1,0,'C');
    $pdf->Cell(25,5, utf8_decode(number_format($k['prix_ttc'],3,' ,','  ')),1,0,'R');
    $pdf->Cell(40,5, utf8_decode(number_format(($k['pri']),3,' ,','  ')),1,0,'R');



    $pdf->Ln();

  }
  $pdf->SetFont("ProductSans","",10);
  
  $pdf->Cell(100,12,utf8_decode("Total article :  ".'  '.count($a)));
  $pdf->Cell(17,12,utf8_decode("Total : "));
  $pdf->SetFont("Arial","B",10);

  $pdf->Cell(20,12,utf8_decode(number_format(($tot),3,' , ','  '))." FC");

  $pdf->Ln(8);
  $pdf->SetFont("ProductSans","",10);
  

  $pdf->Cell(23,10,utf8_decode("Total article :  ".'  '));
  $pdf->SetFont("Arial","B",10);

  $pdf->Cell(77,10,utf8_decode($panier->count()));

  $pdf->SetFont("ProductSans","",10);
  

  $pdf->Cell(35,12,utf8_decode("Remise  % :     ".$remise ."%  :"));
  $pdf->SetFont("Arial","B",10);

  $pdf->Cell(15,12,utf8_decode(number_format(($remise1),3,' , ','  '))." FC");
  $pdf->Ln(8);
  $pdf->SetFont("ProductSans","",10);

  $pdf->Cell(100,12,'');

  $pdf->Cell(23,12,utf8_decode("Total à payer  : "));
  $pdf->SetFont("Arial","B",12);

  $pdf->Cell(20,12,utf8_decode(number_format(($totalapayer),3,' , ','  '))." FC");

  /*
  $pdf->SetFont("Arial","BI",10);

  $pdf->Cell(140,5, utf8_decode('Total'),1,0,'C',);
  $pdf->Cell(40,10, utf8_decode(number_format(($tot),2,',',' '))." FC",1,0,'R');
  $pdf->Ln();
  $pdf->SetFont("ProductSans","",8);

  $pdf->Ln(10);
  $pdf->Write(4,utf8_decode("- Assurez-vous que la facture est claire et lisible. Les informations importantes,      telles que la date d'achat, le numéro de commande et le montant total, doivent    être faciles à trouver"."\n"));

$pdf->Ln(3);

  $pdf->Write(3,utf8_decode("- Stockez la facture dans un endroit sûr. "."\n"));
  $pdf->Ln(-10);
  $pdf->Cell(30,33,utf8_decode("Date : ".Date("d-m-Y")),0,0,'C');
  $pdf->Cell(30,33,utf8_decode("Heure : ".Date("H:i:s")),0,0,'C');
  $pdf->Cell(30,33,utf8_decode("Par : ".$ad),0,0,'C');

*/
  
  
  

  $pdf->Output();
//}
if($query){
  unset($_SESSION['panier']);
  //header('Location: index.php');
}
?>


<!--form action="" method="post">
<label for="">Echo</label>
<input name="oo" value="KALEMBU MASIRIKA Constantin" type="text">
<button type="submit"   >IMPrddddd</button>
</form-->

<!--!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if(isset($titre)) :?><?= $titre?>  |  Pharma<?php else: ?><?='Pharma'?><?php endif?></title>
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
<body >
  
<a class="btn btn-outline-secondary" href="index.php">Retour</a>

<div class="container">
<?php //var_dump($date=Date("d-m-Y, H:i:s ")) ?>
  <div class="container">
    <form action="" method="post">
      <table class="table" id="monTableau" >
        <thead>
          <tr>
            <th scope="col">N°</th>
            <th scope="col">Nom</th>
            <th scope="col">Quantité</th>
            <th scope="col">Prix + TVA(<?= $tva*10?>%)</th>
            <th scope="col">Prix Total</th>

          </tr>
        </thead>
        <tbody>
        <?php $i=1; foreach ($produits as $pr) :?>
          
          <tr>
            <th scope="row"><?= $i++ ?></th>
            <td><?= $pr['nom'] ?></td>
            <td><?= $_SESSION['panier'][$pr['id']] ?></td>
            <td><?= number_format(($pr['prix']*($tva+1)), 3," , ",' ') ?></td>
            <td><?= number_format((($pr['prix']*$_SESSION['panier'][$pr['id']] )*($tva+1)), 3," , ",' ') ?></td>

          </tr>
          
         <?php endforeach ?>
        </tbody>
      </table>
        
     
  <form action="" method="post">
    <div class="d-grid gap-2 mb-3 col-6 mx-auto">
      <button name="valider" class="btn btn-secondary" type="submit">Valider</button>
    </div>
    </form>
    
  </div>
</div>
