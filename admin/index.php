<?php
session_start();
$titre="Accueil  ";
if($_SESSION['utilisateur']===null){
    header('Location:identifie.php');
}
if(isset($_COOKIE['succes'])){
    $succes=$_COOKIE['succes'];
} 
require('utilitaires/fonctions.php');
    require('utilitaires/connexion.php');
    $n="null";
   
    $produits=Produits($pdo);
    require('utilitaires/entete/head.php');
    $i=1;
    $count=0;
?>



<?php
//var_dump($_SERVER['SCRIPT_NAME']);

?>
<div class="container">
    <h1 class="text-bold"> Tous les Médicaments</h1>

    <div class="container">
    <?php if(isset($succes)) :?>
      <div class="alert alert-success">
        <h5 class="text-center" ><?= $succes ?></h5>
      </div>
    <?php endif ?>
        <div class="d-flex d-grid gap-2 d-md-flex justify-content-md-end">
               <a href="gerer.php" class="btn btn-primary">Créer un Médicament</a>
        </div>
        <div class="container" style="margin-top:12px">
            <form class="d-flex">
                <input class="form-control me-2 w-100 " type="search" id="myInput" onkeyup="filterTable()" placeholder="Filtrer par nom" aria-label="Search">
                
            </form>
        </div>
        <form action="" method="post">
        <table id="myTable" class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Numero</th>
                    <th scope="col">Idéntinfiant</th>
                    <th scope="col">Libellé</th>
                    <th scope="col">Prix</th>
                    <th scope="col">Qté</th>
                    <th scope="col">Action 1</th>
                    <th scope="col">Action 2</th>
                </tr>
            </thead>
            <tbody>
                <?php   foreach($produits as $p){
                  $count++
                  ?>
                <tr>
                  
                    <th scope="col"><?= $i++?></th>
                    <th scope="row"><?=$p['id_med']?></th>
                    <td><?=$p['nom']?></td>
                    <td><?= number_format($p['prix'], 0, '','  ');?> Fc</td>
                    <td><?=$p['quantite']?></td>
                    <td> <a href="gerer.php?pr=<?=$p['id']?>" class="btn btn-primary" >Modifier</a></td>
                    <td >
                      <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo($count)?>">
  Supprimer
</button>

                    </td>

                </tr>
<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="exampleModal<?php echo($count)?>" tabindex="-1" aria-labelledby="exampleModalLabel<?php echo($count)?>" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel<?php echo($count)?>">Modal title <?= $p['nom']?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Supprimer un fichier
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <a href="suppression.php?suppri=<?=$p['id']?>" class="btn btn-primary">Save changes</a>
      </div>
    </div>
  </div>
</div>
                <?php } ?>
                
            </tbody>
        </table>
        </form>
    </div>

</div>






<!--
    Modal
-->


<?php if(isset($_POST['idd'])){
  var_dump($_POST['idd']);} 
  ?>
<script>
    function filterTable() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

</script>

<?php

require('utilitaires/entete/foot.php');
?>