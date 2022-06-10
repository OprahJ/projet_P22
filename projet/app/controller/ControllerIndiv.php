<!-- Debut ControllerIndiv -->
<?php
require_once '../model/Model.php';
require_once '../model/ModelIndividu.php';

class ControllerIndiv {

    // Liste des individus
    public static function indivReadAll() {
        $results = ModelIndividu::individuGetAll();
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/indiv/viewAll.php';
        if (DEBUG)
            echo ("ControllerIndiv : indivReadAll : vue = $vue");
        require ($vue);
    }

    // Ajout d'un individu 
    public function indivInsert() {
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/indiv/viewInsert.php';
        require ($vue);
    }

    public function indivInserted() {
        $results = ModelIndividu::insert(htmlspecialchars($_GET['nom']), htmlspecialchars($_GET['prenom']), htmlspecialchars($_GET['sexe']));
        include 'config.php';
        $vue = $root . '/app/view/indiv/viewInserted.php';
        require ($vue);
    }

}
?>