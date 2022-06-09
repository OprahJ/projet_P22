
<!-- ----- début viewNom -->
<?php
require ($root . '/app/view/fragment/fragmentCaveHeader.html');
?>

<body>
    <div class="container">
        <?php
        include $root . '/app/view/fragment/fragmentCaveMenu.html';
        include $root . '/app/view/fragment/fragmentGeneJumbotron.php';

        // $results contient un tableau avec la liste des clés.
        ?>

        <form role="form" method='get' action='router1.php'>
            <div class="form-group">
                <input type="hidden" name='action' value='famReadOne'>

                <label for="nom">Nom : </label> <select class="form-control" id='id' name='nom' style="width: 200px">
                    <?php
                    foreach ($results as $element) {
                        printf("<option value='%d'> %s </option>", $element->getId(), $element->getNom());
                    }
                    ?>
                </select>
            </div>
            <p/>
            <button class="btn btn-primary" type="submit">Submit form</button>
        </form>
        <p/>
    </div>

    <?php include $root . '/app/view/fragment/fragmentCaveFooter.html'; ?>

