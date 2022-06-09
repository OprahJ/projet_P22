
<!-- ----- début viewInserted -->
<?php
require ($root . '/app/view/fragment/fragmentGeneHeader.html');
?>

<body>
  <div class="container">
    <?php
    include $root . '/app/view/fragment/fragmentGeneMenu.html';
    include $root . '/app/view/fragment/fragmentGeneJumbotron.php';
    ?>
    <!-- ===================================================== -->
    <?php
    if ($results) {
     echo ("<h3>La nouvelle famille a été ajouté </h3>");
     echo("<ul>");
     echo ("<li>id = " . $results . "</li>");
     echo ("<li>cru = " . $_GET['nom'] . "</li>");
      echo("</ul>");
    } else {
     echo ("<h3>Problème d'insertion de la famille</h3>");
     echo ("id = " . $_GET['nom']);
    }

    echo("</div>");
    
    include $root . '/app/view/fragment/fragmentGeneFooter.html';
    ?>
    <!-- ----- fin viewInserted -->    

    
    