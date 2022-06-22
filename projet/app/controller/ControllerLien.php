<?php

require_once '../model/ModelLien.php';
require_once '../model/ModelIndividu.php';

class ControllerLien {
    
    //Affichage de tout les liens d'une famille
    public static function lienReadAll() {
        $results = ModelLien::lienGetAll();
        //Construction de la vue
        include 'config.php';
        $vue = $root . '/app/view/lien/viewAll.php';
        require ($vue);
    }
    //Formulaire pour Insertion d'un lien parent
    public static function lienInsertParent() {
        $individu = ModelIndividu::individuGetAll();
        //Construction de la vue
        include 'config.php';
        $vue = $root . '/app/view/lien/viewInsertParent.php';
        require($vue);
    }
    //Insertion ou maj d'un lien parent
    public static function lienInsertedParent() {
        //Recuperation de l'id de l'enfant et du parent
        $enfant_id = $_GET['enfant'];
        $parent_id = $_GET['parent'];
        //Test pour que le parent ne soit pas lui même son parent
        if ($enfant_id == $parent_id) {
            $message = "Un enfant ne peut pas être parent de lui même";
        } else {
            //Test du sexe du parent pour savoir si c'est un lien paternel ou maternel
            $sexe = ModelIndividu::sexe($parent_id);
            if ($sexe == "H") {
                $lien = "PATERNEL";
                //Test si l'enfant a deja un pere ou non
                $test = ModelIndividu::testPaternel(htmlspecialchars($enfant_id));
                if ($test == 0) {
                    //Sinon insertion d'un nouveau lien paternel
                    $results = ModelLien::insertParent(htmlspecialchars($enfant_id), htmlspecialchars($parent_id), htmlspecialchars($lien));
                    $statut = "créé";
                } else {
                    //maj du lien paternel
                    $results = ModelLien::updateParent(htmlspecialchars($enfant_id), htmlspecialchars($parent_id), htmlspecialchars($lien));
                    $statut = "mis à jour";
                }
                //Maj de la base de donnée de l'individu avec l'id du pere
                $update = ModelIndividu::updatePere(htmlspecialchars($enfant_id), htmlspecialchars($parent_id));
                $message = "Lien " . $lien . " " . $statut . " : <br> <ul><li>famille_id = $_SESSION[id]</li><li>lien_id = $results</li><li>id_enfant = $enfant_id</li><li>id_parent = $parent_id</li></ul>";
            } else {
                $lien = "MATERNEL";
                //test si l'enfant a deja une mere ou non
                $test = ModelIndividu::testMaternel(htmlspecialchars($enfant_id));
                if ($test == 0) {
                    // si non alors insertion d'un lien maternel
                    $results = ModelLien::insertParent(htmlspecialchars($enfant_id), htmlspecialchars($parent_id), htmlspecialchars($lien));
                    $statut = "créé";
                } else {
                    //insertion d'un lien maternel
                    $results = ModelLien::updateParent(htmlspecialchars($enfant_id), htmlspecialchars($parent_id), htmlspecialchars($lien));
                    $statut = "mis à jour";
                }
                //maj de la base de donnée de l'individu avec l'id de la mere
                $update = ModelIndividu::updateMere(htmlspecialchars($enfant_id), htmlspecialchars($parent_id));
                $message = "Lien " . $lien . " ".$statut." : <br> <ul><li>famille_id = $_SESSION[id]</li><li>lien_id = $results</li><li>id_enfant = $enfant_id</li><li>id_parent = $parent_id</li></ul>";
            }
        }
        //Construction de la vue
        include 'config.php';
        $vue = $root . '/app/view/lien/viewInsertedParent.php';
        require($vue);
    }
    //Affichage du formulaire pour le lien union
    public static function lienInsertUnion() {
        //Selection de tout les individus homme et tout individus femme
        $homme = ModelIndividu::individuGetAllHomme();
        $femme = ModelIndividu::individuGetAllFemme();
        //Construction de la vue
        include 'config.php';
        $vue = $root . '/app/view/lien/viewInsertUnion.php';
        require($vue);
    }
    
    //Insertion d'un lien Union
    public static function lienInsertedUnion() {
        //insertion d'un nouveau lien
        $results = ModelLien::insertUnion(htmlspecialchars($_GET['homme']), htmlspecialchars($_GET['femme']), htmlspecialchars($_GET['union']), htmlspecialchars($_GET['date']), htmlspecialchars($_GET['lieu']));
        //Construction de la vue
        include 'config.php';
        $vue = $root . '/app/view/lien/viewInsertedUnion.php';
        require($vue);
    }

}
