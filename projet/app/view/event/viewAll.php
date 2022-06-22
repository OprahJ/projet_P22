<?php
require ($root . '/app/view/fragment/fragmentGeneHeader.html');
?>
<body>
    <div class="container">
        <?php
        include $root . '/app/view/fragment/fragmentGeneMenu.html';
        include $root . '/app/view/fragment/fragmentGeneJumbotron.php';
        ?>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th scope="col">famille_id</th>
                    <th scope="col">id</th>
                    <th scope="col">iid</th>
                    <th scope="col">event_type</th>
                    <th scope="col">event_date</th>
                    <th scope="col">event_lieu</th>
                </tr>
            </thead>
            <tbody>
                <!--Affichage d'une ligne répondant aux colonnes pour chaque event de la famille -->
                <?php
                foreach ($results as $element)
                {
                    printf("<tr><td>%d</td><td>%d</td><td>%d</td><td>%s</td><td>%s</td><td>%s</td></tr>", $element->getFamille_id(), $element->getId(), $element->getIid(), $element->getEvent_type(), $element->getEvent_date(), $element->getEvent_lieu());
                }
                ?>
            </tbody>
        </table>
    </div>
    <?php include $root . '/app/view/fragment/fragmentGeneFooter.html'; ?>
