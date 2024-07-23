<?php
 
        function Utilisateur($pdo,$mail, $mdp){
             
            $query=$pdo->prepare('SELECT * FROM users WHERE email = :email');
            $query->execute(['email' =>$mail]);
        
                $agent =$query->fetch();
                
                if($agent === false){
                    
                    return null;
                }
                 
                
                if(($mdp === $agent['mdp'])){
                    if(session_status()=== PHP_SESSION_NONE){
                        session_start();
                    }
                    $_SESSION['auth']=$agent['id'];
                   
                    return $agent;
                }else{

                    return null;
                }

            
        }
        function Produits($pdo){
            try{
            $query=$pdo->prepare('SELECT * FROM produits');
            $query->execute();
        
                $produits =$query->fetchAll();
            }catch(PDOException $e){
    
                echo('
                        <link rel="stylesheet" href="../css/bootstrap.min.css">
                
                <div class="container " style="margin-top:100px" >
                    <div class="alert alert-danger">
                        Impossible de se connecter <h6>'.$e.'</h6>
                    </div>
                </div>');die;
            
            }
            return $produits;
        }
        function client($pdo){
            try{
            $query=$pdo->prepare('SELECT * FROM client ORDER BY id desc');
            $query->execute();
        
                $produits =$query->fetchAll();
            }catch(PDOException $e){
    
                echo('
                        <link rel="stylesheet" href="../css/bootstrap.min.css">
                
                <div class="container " style="margin-top:100px" >
                    <div class="alert alert-danger">
                        Impossible de se connecter <h6>'.$e.'</h6>
                    </div>
                </div>');die;
            
            }
            return $produits;
        }
        function ProduitsModif($pdo, $id){
            $query=$pdo->prepare('SELECT * FROM produits WHERE id = :id');
            $query->execute(['id' =>$id]);;
        
                $produits =$query->fetch();
            return $produits;
        }

        function Employer($pdo){
            $query=$pdo->prepare('SELECT * FROM users');
            $query->execute();;
            $emp =$query->fetchAll();
            return $emp;
        }

        
// Fonction qui génère un nombre aléatoire entre min et max
function random_number($min, $max) {
    return rand($min, $max);
  }
  
  // Fonction qui génère un mot composé de MED0001 et d’un nombre aléatoire
  function random_word() {
    // On choisit un nombre aléatoire entre 0 et 99999
    $number = random_number(0, 99999);
    // On ajoute des zéros devant le nombre si besoin pour avoir 4 chiffres
    $number = str_pad($number, 4, "0", STR_PAD_LEFT);
    // On concatène MED0001 et le nombre aléatoire
    $word = "MEDI0" . $number;
    // On retourne le mot généré
    return $word;
  }
  function randomagent() {
    // On choisit un nombre aléatoire entre 0 et 99999
    $number = random_number(0, 99999);
    // On ajoute des zéros devant le nombre si besoin pour avoir 4 chiffres
    $number = str_pad($number, 4, "0", STR_PAD_LEFT);
    // On concatène MED0001 et le nombre aléatoire
    $words = "0A1GNT" . $number;
    // On retourne le mot généré
    return $words;
  }


  function CreerMedicament($pdo,$id_med,$nom,$prix,$quantite,$commentaire){

    $query=$pdo->prepare('INSERT INTO produits (id_med,nom, prix,quantite,commentaire)
    VALUES(:id_med, :nom, :prix, :quantite, :commentaire)');
    $query->bindValue(':id_med', $id_med);
    $query->bindValue(':nom', $nom);
    $query->bindValue(':prix', $prix);
    $query->bindValue(':quantite', $quantite);
    $query->bindValue(':commentaire', $commentaire);
    
     $resultat=$query->execute();
    return $resultat;
  }

  function ModifierMedicament($pdo,$id,$nom,$prix,$quantite,$commentaire){
            
        $query=$pdo->prepare('UPDATE produits SET nom=:nom, prix=:prix, quantite=:quantite, commentaire=:commentaire WHERE id=:id');

        $query->execute(array(
        'id'=>$id,
        'nom'=>$nom,
        'prix'=>$prix,
        'quantite'=>$quantite,
        'commentaire'=>$commentaire
        ));
        return $query;
  }
  function SupprimerProd($pdo,$id){
    
        $query=$pdo->prepare('DELETE FROM produits WHERE id=:id');

        $query->execute(array(
            'id'=>$id
                
        ));
        return $query;
  }

  function CreerAgent($pdo,$matr,$nom,$post,$pre,$sexe,$adr,$cont,$attr,$email){

    $query=$pdo->prepare('INSERT INTO users (matricule,nom, postnom,prenom,sexe,adresse,contact,attrib,email,mdp)
    VALUES(:matricule,:nom, :postnom,:prenom,:sexe,:adresse,:contact,:attrib,:email,:mdp)');
    $query->bindValue(':matricule', $matr);
    $query->bindValue(':nom', $nom);
    $query->bindValue(':postnom', $post);
    $query->bindValue(':prenom', $pre);
    $query->bindValue(':sexe', $sexe);
    $query->bindValue(':adresse', $adr);
    $query->bindValue(':contact', $cont);
    $query->bindValue(':attrib', $attr);
    $query->bindValue(':email', $email);
    $query->bindValue(':mdp', "0000");

     $query->execute();
    
  }
  function agentVendeur($pdo,$mail, $mdp){
             
    $query=$pdo->prepare('SELECT * FROM users WHERE email = :email');
    $query->execute(['email' =>$mail]);

        $agent =$query->fetch();
        
        if($agent === false){
            
            return null;
        }
         
        
        if(($mdp === $agent['mdp'])){
            if($agent['attrib']==='Vendeur'){
                if(session_status()=== PHP_SESSION_NONE){
                    session_start();
                }
                $_SESSION['auth']=$agent['id'];
           
                return $agent;
            }else{
                return null;
            }
        }else{

            return null;
        }

    

    }
    function UtilisateurVendeur($pdo,string $mail,string $mdp){
             
        $query=$pdo->prepare('SELECT * FROM users WHERE email = :email');
        $query->execute(['email' =>$mail]);
    
            $utilisateur =$query->fetch();
            //var_dump($utilisateur);die();
            if($utilisateur === false){
                
                return null;
            }
             
            
            if(($mdp === $utilisateur['mdp'])){
            //var_dump($utilisateur['attrib']);die();
                
                if($utilisateur['attrib']==='Vendeur'){

                    if(session_status()=== PHP_SESSION_NONE){
                        session_start();

                    }
                    $_SESSION['auth']=$utilisateur['id'];
               var_dump($utilisateur['mdp']);
                    return $utilisateur;
                }else{
                    return null;
                }
            }else{
    
                return null;
            }
    
        
    }
    function NouvaClient($pdo,$id_med,$nom,$prix,$quantite){

        $query=$pdo->prepare('INSERT INTO client (nom,prenom,adresse,contact)
        VALUES(:id_med, :nom, :prix, :quantite)');
        $query->bindValue(':id_med', $id_med);
        $query->bindValue(':nom', $nom);
        $query->bindValue(':prix', $prix);
        $query->bindValue(':quantite', $quantite);
        
         $resultat=$query->execute();
        return $resultat;
      }
      /*require('connexion.php');
      $req=$pdos->query('SELECT * FROM configuration WHERE id=1');
      $req->execute();
      $t=$req->fetch();
    
      $tva=$t['montant'];*/
?>

