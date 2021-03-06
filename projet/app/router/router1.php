
<!-- ----- debut Router1 -->
<?php
require ('../controller/ControllerFamille.php');
require ('../controller/ControllerEvent.php');
require ('../controller/ControllerIndiv.php');
require ('../controller/ControllerLien.php');

// --- récupération de l'action passée dans l'URL
$query_string = $_SERVER['QUERY_STRING'];

// fonction parse_str permet de construire 
// une table de hachage (clé + valeur)
parse_str($query_string, $param);

// --- $action contient le nom de la méthode statique recherchée
$action = htmlspecialchars($param["action"]);
unset($param['action']);
$args = $param;
// --- Liste des méthodes autorisées
switch ($action) {
    case "famReadAll" :
    case "famReadOne" :
    case "famReadNom" :
    case "famCreate" :
    case "famCreated" :
    case"amelioration" :

        ControllerFamille::$action();
        break;

    case "eventReadAll" :
    case "eventInsert" :
    case "eventInserted" :
        ControllerEvent::$action($args);
        break;

    case "indivReadAll":
    case "indivInsert":
    case "indivInserted":
    case "indivSelect":
    case "indivInfo":
        ControllerIndiv::$action($args);
        break;

    case "lienReadAll":
    case "lienInsertParent" :
    case "lienInsertedParent":
    case "lienInsertUnion":
    case "lienInsertedUnion":
        ControllerLien::$action();
        break;
    // Tache par défaut
    default:
        $action = "geneAccueil";
        ControllerFamille::$action();
}
?>
<!-- ----- Fin Router1 -->

