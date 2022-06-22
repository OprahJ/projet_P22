<?php 
require ($root . '/app/view/fragment/fragmentGeneHeader.html');
?>
<body>
    <div class="container">
        <?php
        include $root . '/app/view/fragment/fragmentGeneMenu.html';
        include $root . '/app/view/fragment/fragmentGeneJumbotron.php';
        ?>
        <h2>Ajout d'un lien parental</h2>
        <form method='get' action='router1.php'>
            <div class="form-group">
                <input type="hidden" name='action' value="lienInsertedParent">
                <label for='enfant'>Sélectionnez un enfant:</label>
                <!-- 2 formulaires de choix composés de tout les individus d'une famille -->
                <select class="form-control" name="enfant" id='enfant'>
                    <?php
                    foreach ($individu as $element) {
                        printf("<option value='%d'> %s : %s </option>",$element->getId(), $element->getNom(), $element->getPrenom());
                    }
                    ?>
                </select>
                <label for='parent'>Sélectionnez un parent:</label>
                <select class="form-control" name="parent" id='parent'>
                    <?php
                    foreach ($individu as $element) {
                        printf("<option value='%d'> %s : %s </option>",$element->getId(), $element->getNom(), $element->getPrenom());
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Go</button>
        </form>
    </div>
    <?php include $root . '/app/view/fragment/fragmentGeneFooter.html'; ?>
