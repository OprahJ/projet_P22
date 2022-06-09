
<!-- ----- début viewAll -->
<?php

require ($root . '/app/view/fragment/fragmentGeneHeader.html');
?>

<body>
  <div class="container">
      <?php
      include $root . '/app/view/fragment/fragmentGeneMenu.html';
      include $root . '/app/view/fragment/fragmentGeneJumbotron.php';
      ?>

    <table class = "table table-striped table-bordered">
      <thead>
        <tr>
          <th scope = "col">id</th>
          <th scope = "col">nom</th>
          
        </tr>
      </thead>
      <tbody>
          <?php
          // La liste des famille est dans une variable $results             
          foreach ($results as $element) {
           printf("<tr><td>%d</td><td>%s</td>", $element->getId(), 
             $element->getNom());
          }
          ?>
      </tbody>
    </table>
  </div>
  <?php include $root . '/app/view/fragment/fragmentGeneFooter.html'; ?>

  <!-- ----- fin viewAll -->
  
  