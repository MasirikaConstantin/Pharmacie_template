<?php
class panier{
private $pdo;
         public function __construct($pdo){
                  if(!isset($_SESSION)){
                           session_start();
                  }
                  if(!isset($_SESSION['panier'])){
                           $_SESSION['panier']=[];
                  }
                  $this->pdo=$pdo;
                  
    if(isset($_POST['panier']['quant'])){
        $ids=array_keys($_SESSION['panier']);
        $produits=$this->pdo->query('SELECT * FROM produits WHERE id IN ('.implode(',',$ids).')');
        dump($_POST['panier']);

        foreach($_POST['panier']['quant'] as $id => $quant) {
            foreach($produits as $item) {
                //if ($item['id'] == $id) {
                    if ($item['quantite'] >= $id) {
                        $this->recalc();
                    } else {
                        echo "La quantité de l'élément avec l'ID $id dans \$tab2 est inférieure à celle de \$tab1.\n";
                    }
                //}
            }
        }
        
        /*foreach ($produits as $pr) {
        dump((int)$_POST['panier']['quant'][$pr['id']]);

            if((int)$_POST['panier']['quant'][$pr['id']] < $pr['quantite']){

                    
            }else{

            }
     } */
     
    }
}
         public function recalc(){
                  //var_dump($_POST);


                $_SESSION['panier']=$_POST['panier']['quant'];
                   
               }
         public function add($produit_id){
                  if(isset($_SESSION['panier'][$produit_id])){
                           $_SESSION['panier'][$produit_id]++;
                  }else{
                           $_SESSION['panier'][$produit_id]=1;
                  }
         }
         public function del($produit_id){
                  unset($_SESSION['panier'][$produit_id]);
         }
         public function total($t){
                  $total=0;
                  $ids=array_keys($_SESSION['panier']);
            
                  
                  
                           $produits=$this->pdo->query('SELECT * FROM produits WHERE id IN ('.implode(',',$ids).')');

                  
                  foreach($produits as $produit){
                           $total+=($produit['prix']*$_SESSION['panier'][$produit['id']])*($t+1);
                  }
                  return $total;
         
         }
         public function totalsanttva(){
            $total=0;
            $ids=array_keys($_SESSION['panier']);
      
            
            
                     $produits=$this->pdo->query('SELECT * FROM produits WHERE id IN ('.implode(',',$ids).')');

            
            foreach($produits as $produit){
                     $total+=($produit['prix']*$_SESSION['panier'][$produit['id']]);
            }
            return $total;
   
   }
         public function count(){
                  return array_sum($_SESSION['panier']);
         }
         
         
}
?>