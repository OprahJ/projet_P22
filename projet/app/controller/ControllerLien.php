<?php
require_once '../model/ModelLien.php';
require_once '../model/ModelIndividu.php';

class ControllerLien{
    
    public static function lienReadAll(){
        $results = ModelLien::lienGetAll();
        include 'config.php';
        $vue = $root . '/app/view/lien/viewAll.php';
        require ($vue);
    }
    
    public static function lienInsertParent(){
        $individu = ModelIndividu::individuGetAll();
        include 'config.php';
        $vue = $root . '/app/view/lien/viewInsertParent.php';
        require($vue);
    }
    
    public static function lienInsertedParent(){
        $enfant_id = $_GET['enfant'];
        $parent_id = $_GET['parent'];
        if($enfant_id == $parent_id){
            $message = "Un enfant ne peut pas être parent de lui même";
        }
        else{
            $sexe = ModelIndividu::sexe($parent_id);
            if ($sexe=="H"){
                $lien = "PATERNEL";
                $suppression = ModelLien::deleteLienParent(htmlspecialchars($enfant_id), htmlspecialchars($lien));
                $results = ModelLien::insertParent(htmlspecialchars($enfant_id), htmlspecialchars($parent_id), htmlspecialchars($lien));
                $update = ModelIndividu::updatePere(htmlspecialchars($enfant_id), htmlspecialchars($parent_id));
                $message = "Lien ".$lien." créé : <br> <ul><li>famille_id = $_SESSION[id]</li><li>lien_id = $results</li><li>id_enfant = $enfant_id</li><li>id_parent = $parent_id</li></ul>";
            }
            else{
                $lien = "MATERNEL";
                $suppression = ModelLien::deleteLienParent(htmlspecialchars($enfant_id), htmlspecialchars($lien));
                $results = ModelLien::insertParent(htmlspecialchars($enfant_id), htmlspecialchars($parent_id), htmlspecialchars($lien));
                $update = ModelIndividu::updateMere(htmlspecialchars($enfant_id), htmlspecialchars($parent_id));
                $message = "Lien ".$lien." créé : <br> <ul><li>famille_id = $_SESSION[id]</li><li>lien_id = $results</li><li>id_enfant = $enfant_id</li><li>id_parent = $parent_id</li></ul>";
            }
        }
        include 'config.php';
        $vue = $root . '/app/view/lien/viewInsertedParent.php';
        require($vue);
    }
    
    public static function lienInsertUnion(){
        $homme = ModelIndividu::individuGetAllHomme();
        $femme = ModelIndividu::individuGetAllFemme();
        include 'config.php';
        $vue = $root . '/app/view/lien/viewInsertUnion.php';
        require($vue);
    }
    
    public static function lienInsertedUnion(){
        $results = ModelLien::insertUnion(htmlspecialchars($_GET['homme']), htmlspecialchars($_GET['femme']), htmlspecialchars($_GET['union']), htmlspecialchars($_GET['date']), htmlspecialchars($_GET['lieu']));
        include 'config.php';
        $vue = $root . '/app/view/lien/viewInsertedUnion.php';
        require($vue);
    }
}