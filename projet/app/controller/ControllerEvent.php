<?php
require_once '../model/ModelEvent.php';
require_once '../model/ModelIndividu.php';

class ControllerEvent{
    
    public static function eventReadAll(){
        $results = ModelEvent::eventGetAll();
        include 'config.php';
        $vue = $root . '/app/view/event/viewAll.php';
        require($vue);
    }
    
    public static function eventInsert(){
        $results = ModelIndividu::individuGetAll();
        include 'config.php';
        $vue = $root . '/app/view/event/viewInsert.php';
        require($vue);
    }
    
    public static function eventInserted(){
        $results = ModelEvent::insert(htmlspecialchars($_GET['individu']), htmlspecialchars($_GET['evenement']), htmlspecialchars($_GET['date']), htmlspecialchars($_GET['lieu']));
        include 'config.php';
        $vue = $root . '/app/view/event/viewInserted.php';
        require($vue);
    }
}