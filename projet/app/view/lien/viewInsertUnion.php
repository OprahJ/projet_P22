<?php 
require ($root . '/app/view/fragment/fragmentGeneHeader.html');
?>
<body>
    <div class="container">
        <?php
        include $root . '/app/view/fragment/fragmentGeneMenu.html';
        include $root . '/app/view/fragment/fragmentGeneJumbotron.php';
        ?>
        <h2>Ajout d'une Union</h2>
        <form method='get' action='router1.php'>
            <div class="form-group">
                <input type="hidden" name='action' value="lienInsertedUnion">
                <label for='homme'>Sélectionnez un Homme:</label>
                <select class="form-control" name="homme" id='homme'>
                    <?php
                    foreach ($homme as $element) {
                        printf("<option value='%d'> %s : %s </option>",$element->getId(), $element->getNom(), $element->getPrenom());
                    }
                    ?>
                </select>
                <label for='femme'>Sélectionnez une femme:</label>
                <select class="form-control" name="femme" id='femme'>
                    <?php
                    foreach ($femme as $element) {
                        printf("<option value='%d'> %s : %s </option>",$element->getId(), $element->getNom(), $element->getPrenom());
                    }
                    ?>
                </select>
                <label for='union'>Selectionnez un type d'union :</label>
                <select class='form-control' name="union" id="union">
                    <option>COUPLE</option>
                    <option>SEPARATION</option>
                    <option>PACS</option>
                    <option>MARIAGE</option>
                    <option>DIVORCE</option>
                </select>
            </div>
            <div class="form-group">
                <label for="date">Date (AAAA-MM-JJ) ?</label><br>
                <input type="text" name='date' id='date' style="width: 200px;" required><br>
                <label for='lieu'>Lieu ?</label><br>
                <input type="text" name="lieu" id="lieu" style="width: 200px;" required>
            </div>
            <button type="submit" class="btn btn-primary">Go</button>
        </form>
    </div>
    <?php include $root . '/app/view/fragment/fragmentGeneFooter.html'; ?>