<?php
require ($root . '/app/view/fragment/fragmentGeneHeader.html');
?>

<body>
    <div class='container'>
        <?php
        include $root . '/app/view/fragment/fragmentGeneMenu.html';
        include $root . '/app/view/fragment/fragmentGeneJumbotron.php';
        ?>  
        <h3>Confirmation de la création d'un lien union : </h3>
        <?php
        echo("<ul>"
        . "<li>Famille_id = " . $_SESSION['id'] . "</li>"
        . "<li>homme_id = " . $_GET['homme'] . "</li>"
        . "<li>femme_id = " . $_GET['femme'] . "</li>"
        . "<li>lien_id = ".$results."</li>"
        . "<li>lien_type = " . $_GET['union'] . "</li>"
        . "<li>lien_date = " . $_GET['date'] . "</li>"
        . "<li>lien_lieu = " . $_GET['lieu'] . "</li>"
        . "</ul>");
        ?>
    </div>
    <?php include $root . '/app/view/fragment/fragmentGeneFooter.html'; ?>