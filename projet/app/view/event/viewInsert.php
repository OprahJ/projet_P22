<?php
require ($root . '/app/view/fragment/fragmentGeneHeader.html');
?>

<body>
    <div class="container">
        <?php
        include $root . '/app/view/fragment/fragmentGeneMenu.html';
        include $root . '/app/view/fragment/fragmentGeneJumbotron.php';
        ?>
        <h3>Ajout d'un évènement</h3>
        <form method="get" action="router1.php">
            <div class="form-group">
                <input type="hidden" name="action" value="eventInserted">
                <label for="individu">Selectionnez un individu:</label>
                <select class="form-control" id='individu' name="individu">
                    <?php
                    foreach ($results as $element) {
                        printf("<option value='%d'> %s : %s </option>",$element->getId(), $element->getNom(), $element->getPrenom());
                    }
                    ?>
                </select>
                <label for='evenement'>Selectrionnez un type d'évènement:</label>
                <select class="form-control" id='evenement' name="evenement">
                    <option>NAISSANCE</option>
                    <option>DECES</option>
                </select>
            </div>
            <div class="form-group">
                <label for="date">Date (AAAA-MM-JJ) ?</label><br>
                <input type="text" name='date' id='date' style="width: 200px;" required><br>
                <label for='lieu'>Lieu ?</label><br>
                <input type="text" name="lieu" id="lieu" style="width: 200px;" required>
            </div>
            <button class="btn btn-primary" type='submit'>Go</button>
        </form>
    </div>
    <?php include $root . '/app/view/fragment/fragmentGeneFooter.html'; ?>

