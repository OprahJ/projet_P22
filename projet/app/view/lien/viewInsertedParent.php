<?php require ($root . '/app/view/fragment/fragmentGeneHeader.html');
?>
<body>
    <div class="container">
        <?php
        include $root . '/app/view/fragment/fragmentGeneMenu.html';
        include $root . '/app/view/fragment/fragmentGeneJumbotron.php';
        ?>
        <!-- Affichage d'un message variant en fonction d'une update ou d'un insert -->
        <?php echo $message; ?>
    </div>    
    <?php include $root . '/app/view/fragment/fragmentGeneFooter.html'; ?>
