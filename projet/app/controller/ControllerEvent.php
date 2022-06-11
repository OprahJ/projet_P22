<?php

require_once '../model/ModelEvent.php';
require_once '../model/ModelIndividu.php';

class ControllerEvent {

    public static function eventReadAll() {
        $results = ModelEvent::eventGetAll();
        include 'config.php';
        $vue = $root . '/app/view/event/viewAll.php';
        require($vue);
    }

    public static function eventInsert() {
        $results = ModelIndividu::individuGetAll();
        include 'config.php';
        $vue = $root . '/app/view/event/viewInsert.php';
        require($vue);
    }

    public static function eventInserted() {
        $test = ModelEvent::test(htmlspecialchars($_GET['individu']), htmlspecialchars($_GET['evenement']));
        if ($test==1) {
            $results = Modelevent::update(htmlspecialchars($_GET['individu']), htmlspecialchars($_GET['evenement']), htmlspecialchars($_GET['date']), htmlspecialchars($_GET['lieu']));
            $statut="mis à jour";
        } else {
            $results = ModelEvent::insert(htmlspecialchars($_GET['individu']), htmlspecialchars($_GET['evenement']), htmlspecialchars($_GET['date']), htmlspecialchars($_GET['lieu']));
            $statut="ajouté";
        }
        include 'config.php';
        $vue = $root . '/app/view/event/viewInserted.php';
        require($vue);
    }

}
