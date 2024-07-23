
<script>
  var today = new Date();
var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
var dateTime = date+' '+time;
console.log(dateTime);

</script>




    <script language = "JavaScript">
            function showtime() {
              now = new Date();
              var hours = now.getHours();
              var minutes = now.getMinutes();
              var seconds = now.getSeconds();
              var timeValue = "" +(hours)
              timeValue += ((minutes < 10) ? ":0" : ":") + minutes
              timeValue += ((seconds < 10) ? ":0" : ":") + seconds
              timeValue + hours
              document.clock.clock.value = timeValue;
              setTimeout("showtime()", 1000);
                           
                           }
                      
    /*var today = new Date();
    var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
    var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
    var dateTime = date+' '+time;
    document.getElementById("monLabel").innerHTML = dateTime;
    setInterval(function(){
        var today = new Date();
        var time = today.getHours() +  ":" + today.getMinutes() + ":" + today.getSeconds();
        document.getElementById("monLabel").innerHTML = date+' '+time;
    }, 1000);*/

</script>


    



<script>
        // Sélectionnez tous les éléments du tableau
var elements = document.querySelectorAll("table #tr");

// Parcourez tous les éléments
for(var i = 0; i < elements.length; i++) {
    // Si l'élément est supérieur à 3, cachez-le
    if(i >= 5) {
        elements[i].style.display = "none";
    }
}

      // Sélectionnez tous les éléments du tableau
      var elements = document.querySelectorAll("table #trs");

// Parcourez tous les éléments
for(var i = 0; i < elements.length; i++) {
    // Si l'élément est supérieur à 3, cachez-le
    if(i >= 3) {
        elements[i].style.display = "none";
    }
}
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
function filterTableClient() {

// Declare variables
var input, filter, table, tr, td, i, txtValue;
input = document.getElementById("myInput2");
filter = input.value.toUpperCase();
table = document.getElementById("myTable2");
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
<footer class="blog-footer mt-3">
  <p>Blog template built for <a href="../../../../index.html">Bootstrap</a> by <a href="https://twitter.com/mdo">@mdo</a>.</p>
  <p>
    <a href="#">Back to top</a>
  </p>
</footer>

<script src="../css/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
 

</body>
</html>