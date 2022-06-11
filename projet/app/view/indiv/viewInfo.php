
<!-- ----- début viewInfo -->
<?php
require ($root . '/app/view/fragment/fragmentGeneHeader.html');
?>

<body>
    <div class="container">
        <?php
        include $root . '/app/view/fragment/fragmentGeneMenu.html';
        include $root . '/app/view/fragment/fragmentGeneJumbotron.php';
        ?>
        <h3 class='rouge'><?php echo ($individu[0]->getNom().' '.$individu[0]->getPrenom());  ?></h3>
       <?php
       echo('<ul>'.'<li>Né le '. $event[0]->getEvent_date().' à '. $event[0]->getEvent_lieu().'</li>');
       echo ('</ul>');
       
       echo('Parents');
       echo('<ul>');
       echo('<li>Pere ');
       echo('<a href="'.$root.'/app/router/router1.php?action=indivInfo&nom='.$individu[0]->getPere().'">'.$pere[0]->getNom().' '.$pere[0]->getPrenom().'</a>');
       echo('</li>');
       echo('<li>Mere ');
       echo('<a href="'.$root.'/app/router/router1.php?action=indivInfo&nom='.$individu[0]->getMere().'">'.$mere[0]->getNom().' '.$mere[0]->getPrenom().'</a>');
       echo('</li>');
       echo('</ul>');
       
       echo('Unions et enfants');
       echo('<ul>');
       
       foreach ($union as $element){
           echo('<li>');
           
           echo('Union avec ');
           echo('<a href="'.$root.'/app/router/router1.php?action=indivInfo&nom='.$element[2].'">'.$element[0].'</a>');
           
           if(isset($element[3])){
               echo('<ol>');
               foreach($element[3] as $element2){
                   echo('<li>');
                   
                   echo('Enfant ');
                   echo('<a href="'.$root.'/app/router/router1.php?action=indivInfo&nom='.$element2[1].'">'.$element2[0].'</a>');
                   
                   echo('</li>');
               }
               echo('</ol>');
           }
           
           echo('</li>');
       }
      
               ?>