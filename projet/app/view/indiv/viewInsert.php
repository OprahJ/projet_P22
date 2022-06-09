
<!-- ----- début viewInsert -->

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
                <input type="hidden" name='action' value='indivInserted'>        
                <h3>Création d'un invidu</h3>
                <label for="id">Nom : </label><input type="text" name='nom' size='75' value=''>                           
                </br>    
                <label for="id">Prenom : </label><input type="text" name='prenom' size='75' value=''>   
                </br>
                <label for="sexe">Sexe ? </label><br>
                <label class="radio-inline"><input type="radio" name="sexe" value="M" checked>Masculin</label>
                <label class="radio-inline"><input type="radio" name="sexe" value="F">Feminin</label>
                <br><br>
                <p/>
                <button class="btn btn-primary" type="submit">Go</button>
        </form>
        <p/>
    </div>
    <?php include $root . '/app/view/fragment/fragmentGeneFooter.html'; ?>

    <!-- ----- fin viewInsert -->

