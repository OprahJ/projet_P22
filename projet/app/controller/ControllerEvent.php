<?php

require_once '../model/ModelEvent.php';
require_once '../model/ModelIndividu.php';

class ControllerEvent {

    //Afficher tout les évènements d'une famille
    public static function eventReadAll() {
        //Recupération de tout les evènements dans $results
        $results = ModelEvent::eventGetAll();
        //Construction du chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/event/viewAll.php';
        require($vue);
    }

    //Formulaire d'ajout d'un évènement
    public static function eventInsert() {
        //Recupération de tout les individus dans $results
        $results = ModelIndividu::individuGetAll();
        //Construction du chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/event/viewInsert.php';
        require($vue);
    }
    
    //Insertion ou maj d'un evenement
    public static function eventInserted() {
        //Tester si l'évènement a déjà été créé
        $test = ModelEvent::test(htmlspecialchars($_GET['individu']), htmlspecialchars($_GET['evenement']));
        if ($test==1) {
            // Si oui, mettre a jour la base de donnée et afficher "mis a jour" dans la vue
            $results = Modelevent::update(htmlspecialchars($_GET['individu']), htmlspecialchars($_GET['evenement']), htmlspecialchars($_GET['date']), htmlspecialchars($_GET['lieu']));
            $statut="mis à jour";
        } else {
            //Sinon créer un nouvel évènement et mettre "ajouté" dans la vue
            $results = ModelEvent::insert(htmlspecialchars($_GET['individu']), htmlspecialchars($_GET['evenement']), htmlspecialchars($_GET['date']), htmlspecialchars($_GET['lieu']));
            $statut="ajouté";
        }
        //Construction du chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/event/viewInserted.php';
        require($vue);
    }

}
