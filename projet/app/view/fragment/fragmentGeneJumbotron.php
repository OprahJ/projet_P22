
<!-- ----- debut fragmentCaveJumbotron -->

<div class="jumbotron">
    <?php
    if (!isset($_SESSION['famille'])){
        echo("<h1>Pas de famille sélectionnée</h1>");
    }
    else{
        echo("<h1>$_SESSION[famille]</h1>");
    }
    ?>
</div>
 
 

<!-- ----- fin fragmentCaveJumbotron -->