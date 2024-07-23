<?php
class DB{
         private $db;
         private $pdo;
         public function __construct(){
                  
                  try{
                  
                           $this->db = new PDO('sqlite:../bdd/pharmacie.db',null,null, [
                           PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                           PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
                           );
                  }catch(PDOException $e){
                           
                           die('<div class="container">
                           <div class="alert alert-danger">
                           Impossible de se connecter <h6>'.$e.'</h6>
                           </div>
                           </div>');
     
                  }
     
         }
         
         public function query($sql, $data=[]){
                  $req=$this->db->prepare($sql);
                  $req->execute($data);
                  return $req->fetchAll();
         }
         public function client($pdo){
            
                  $query=$this->db->prepare('SELECT * FROM client ORDER BY id desc');
                  $query->execute();
              
                      $produits =$query->fetchAll();
                  return $produits;
                  }
         
}
?>