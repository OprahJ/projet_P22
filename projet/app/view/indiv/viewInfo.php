
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
        <h3 class='rouge'><?php echo ($individu[0]->getNom() . ' ' . $individu[0]->getPrenom()); ?></h3>
        <?php
        // Si $taille=2 alors l'évenement déces et naissance ont été rentré : dans le getOne , on selectionne par ordre alphabetique du event_type donc le déces sera tjrs avant la naissance
        // d'ou le [1] et le [0]
        if ($taille == 2) {
            echo('<ul><li>Né le ' . $event[1]->getEvent_date() . ' à ' . $event[1]->getEvent_lieu() . '</li>');
            echo('<li>Décédé le ' . $event[0]->getEvent_date() . ' à ' . $event[0]->getEvent_lieu() . '</li></ul>');
        } else {
            // Si taille=1, cela veut dire que seulement la naissance a été rentré (on ne rentrera pas la mort de qqun si celui çi n'est pas né)
            if ($taille == 1) {
                echo('<ul><li>Né le ' . $event[0]->getEvent_date() . ' à ' . $event[0]->getEvent_lieu() . '</li>');
                echo('<li>Décédé le ? à ? </li></ul>');
                //aucune des infos n'a été rentrée donc taille=0
            } else {
                echo('<ul><li>Né le ? à ? </li>');
                echo('<li>Décédé le ? à ? </li></ul>');
            }
        }
        echo('Parents');
        echo('<ul>');
        echo('<li>Pere ');
        echo('<a href="' . $root . '/app/router/router1.php?action=indivInfo&nom=' . $individu[0]->getPere() . '">' . $pere[0]->getNom() . ' ' . $pere[0]->getPrenom() . '</a>');
        echo('</li>');
        echo('<li>Mere ');
        echo('<a href="' . $root . '/app/router/router1.php?action=indivInfo&nom=' . $individu[0]->getMere() . '">' . $mere[0]->getNom() . ' ' . $mere[0]->getPrenom() . '</a>');
        echo('</li>');
        echo('</ul>');

        echo('Unions et enfants');
        echo('<ul>');

        foreach ($union as $element) {
            echo('<li>');

            echo('Union avec ');
            echo('<a href="' . $root . '/app/router/router1.php?action=indivInfo&nom=' . $element[2] . '">' . $element[0] . '</a>');

            if (isset($element[3])) {
                echo('<ol>');
                foreach ($element[3] as $element2) {
                    echo('<li>');

                    echo('Enfant ');
                    echo('<a href="' . $root . '/app/router/router1.php?action=indivInfo&nom=' . $element2[1] . '">' . $element2[0] . '</a>');

                    echo('</li>');
                }
                echo('</ol>');
            }

            echo('</li>');
        }
        ?>
    </div>
    <?php include $root . '/app/view/fragment/fragmentGeneFooter.html'; ?>