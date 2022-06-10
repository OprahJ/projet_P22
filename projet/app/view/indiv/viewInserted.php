<?php
require ($root . '/app/view/fragment/fragmentGeneHeader.html');
?>

<body>
    <div class='container'>
        <?php
        include $root . '/app/view/fragment/fragmentGeneMenu.html';
        include $root . '/app/view/fragment/fragmentGeneJumbotron.php';
        ?>  
        <h3>Confirmation de la création d'un individu : </h3>
        <?php
        echo("<ul>"
        . "<li>famille_id = " . $_SESSION['id'] . "</li>"
        . "<li>id = " . $results . "</li>"
        . "<li>nom = " . $_GET['nom'] . "</li>"
        . "<li>prenom = ".$_GET['prenom']."</li>"
        . "<li>sexe = " . $_GET['sexe'] . "</li>"
        . "<li>pere = 0 </li>"
        . "<li>mere = 0</li>"
        . "</ul>");
        ?>
    </div>
    <?php include $root . '/app/view/fragment/fragmentGeneFooter.html'; ?>

