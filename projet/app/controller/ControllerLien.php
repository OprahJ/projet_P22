<?php
require_once '../model/ModelLien.php';

class ControllerLien{
    
    public static function lienReadAll(){
        $results = ModelLien::lienGetAll();
        include 'config.php';
        $vue = $root . '/app/view/lien/viewAll.php';
        require ($vue);
    }
}