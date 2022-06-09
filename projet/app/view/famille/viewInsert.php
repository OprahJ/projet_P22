
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
        <input type="hidden" name='action' value='famCreated'>        
        <label for="id">nom : </label><input type="text" name='nom' size='75' value=''>                           
        
      <p/>
      <button class="btn btn-primary" type="submit">Go</button>
    </form>
    <p/>
  </div>
  <?php include $root . '/app/view/fragment/fragmentGeneFooter.html'; ?>

<!-- ----- fin viewInsert -->



