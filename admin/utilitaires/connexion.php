<?php


    
$pdo = new PDO('sqlite:../bdd/pharmacie.db',null,null, [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

function idagent($o){
    // Met la portion de chaine dans $chaine
$chaine = substr($o, 0, 3);

// Position du dernier espace
$espace = strrpos($chaine, " ");

// Test si il y a un espace
if ($espace) {
    // Si il y a un espace, coupe de nouveau la chaine
    $chaine = substr($chaine, 0, $espace);
}
$id_agent=(int)($chaine);
return $id_agent;
}
?>