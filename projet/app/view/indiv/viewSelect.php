<?php
require ($root . '/app/view/fragment/fragmentGeneHeader.html');
?>

<body>
    <div class="container">
        <?php
        include $root . '/app/view/fragment/fragmentGeneMenu.html';
        include $root . '/app/view/fragment/fragmentGeneJumbotron.php';
        ?>
        
        <form role="form" method='get' action='router1.php'>
            <div class="form-group">
                <input type="hidden" name='action' value='indivInfo'>

                <label for="nom">Selection d'un individu : </label>
                <select class='form-control' id='id' name='nom' style="width: 200px">
                    <?php
                    foreach ($results as $element) {
                        echo('<option value='.$element->getId().'> '.$element->getNom().' : '.$element->getPrenom().'</option>');
                    }
                    ?>
                </select>
            </div>
            <p/>
            <button class="btn btn-primary" type="submit">GO</button>
        </form>
        <p/>
    </div>

    <?php include $root . '/app/view/fragment/fragmentGeneFooter.html'; ?>