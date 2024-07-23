<?php
session_start();
if($_SESSION['utilisateur']===null){
    header('Location:identifie.php');
}
require('utilitaires/fonctions.php');
    require('utilitaires/connexion.php');
    $au="/admin/activites.php";
    $utilisateur=($_SESSION['utilisateur']);
    $employers=Employer($pdo);
    require('utilitaires/entete/head.php');
?>


<?php
//var_dump($_SERVER)

?>







        
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

  <div class="album py-2 bg-light">
    <div class="container">
      
<h2>Tout les Vendeurs</h2>
<hr class="mb-3">
        <div class="container mb-3" >
            <form class="d-flex">
                <input class="form-control me-2 w-100 filter " type="search" id="filter" onkeyup="searchProduct()" placeholder="Filtrer par nom" aria-label="Search">
                
            </form>
        </div>
        <div class="card-lists" id="card-lists">
      <div  id="myTable"  class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        
        <?php foreach($employers as $a) :?>
        <div class="col" id="col" >
          <div id="card" class="card carde shadow-sm">
            <div class="border border-5">
          <img class="mb-4 bd-placeholder-img card-img-top" src="../css/images/Capture.PNG" alt="" width="100%" height="225">

            </div>
            <div class="card-body">
              <h5 class="card-title" id="titre" ><?= $a['nom'] ?>  <?= $a['postnom'] ?> <?= $a['prenom'] ?></h5>
              
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                  <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                </div>
                <small class="text-muted">9 mins</small>
              </div>
            </div>
          </div>
        </div>
        <?php endforeach ?>
        </div>
      </div>
    </div>
  </div>

</main>


<script>
    function searchProduct(){
      const input = document.getElementById('filter').value.toUpperCase();
      //console.log(input)
      const cardContainer = document.getElementById("card-lists")
      
      //console.log(cardContainer)
      const cards= cardContainer.getElementsByClassName('carde')
      //console.log(cards)
      for(let i=0; i<cards.length; i++){
        let title=cards[i].querySelector('.card-body h5.card-title');
        //console.log(title)
        if(title.innerText.toUpperCase().indexOf(input)> -1){
          cards[i].style.display='';
        }else{
          cards[i].style.display='none';
        }
      }
    }
</script>
<?php

require('utilitaires/entete/foot.php');
?>