<?php
require ($root . '/app/view/fragment/fragmentGeneHeader.html');
?>

<body>
    <div class="container">
        <?php
        include $root . '/app/view/fragment/fragmentGeneMenu.html';
        include $root . '/app/view/fragment/fragmentGeneJumbotron.php';
        ?>
        <br>
        <?php
        echo("<h3>Confirmation de la sélection d'une famille</h3>"
                . "<p> La famille $_SESSION[famille][$_SESSION[id]] a bien été sélectionnée</p>");
        ?>
    </div>
    <?php include $root . '/app/view/fragment/fragmentGeneFooter.html'; ?>