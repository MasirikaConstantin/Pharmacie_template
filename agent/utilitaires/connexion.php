<?php


try{
        
    $pdo = new PDO('sqlite:../bdd/pharmacie.db',null,null, [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
}catch(PDOException $e){
    
    echo('<div class="container">
        <div class="alert alert-danger">
            Impossible de se connecter <h6>'.$e->getMessage().'</h6>
        </div>
    </div>');die;

}


try{
        
    $pdos = new PDO('sqlite:../bdd/pharmacie.db',null,null, [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
}catch(PDOException $e){
    
    echo('<div class="container">
        <div class="alert alert-danger">
            Impossible de se connecter <h6>'.$e->getMessage().'</h6>
        </div>
    </div>');die;

}
$req=$pdos->query('SELECT * FROM configuration WHERE id=1');
$req->execute();
$t=$req->fetch();

$tva=$t['montant'];

?>