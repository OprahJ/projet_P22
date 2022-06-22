<!-- Debut de viewInserted -->
<?php
require ($root . '/app/view/fragment/fragmentGeneHeader.html');
?>

<body>
    <div class='container'>
        <?php
        include $root . '/app/view/fragment/fragmentGeneMenu.html';
        include $root . '/app/view/fragment/fragmentGeneJumbotron.php';
        ?>  
        <!-- Affichage d'un message en fonction de si c'est un update ou un insert -->
        <h3>L'évènement a bien été <?php echo $statut ; ?></h3>
        <!-- Affichage de toutes les variables ayant été nécéssaire à l'insertion ou l'update-->
        <?php
        echo("<ul>"
        . "<li>Famille_id = " . $_SESSION['id'] . "</li>"
        . "<li>individu_id = " . $_GET['individu'] . "</li>"
        . "<li>event_id = ".$results."</li>"
        . "<li>event_type = " . $_GET['evenement'] . "</li>"
        . "<li>event_date = " . $_GET['date'] . "</li>"
        . "<li>event_lieu = " . $_GET['lieu'] . "</li>"
        . "</ul>");
        ?>
    </div>
    <?php include $root . '/app/view/fragment/fragmentGeneFooter.html'; ?>
   <!-- Fin de viewInserted -->