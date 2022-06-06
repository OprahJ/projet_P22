
<!-- ----- debut Router1 -->
<?php
require ('../controller/ControllerFamille.php');


// --- récupération de l'action passée dans l'URL
$query_string = $_SERVER['QUERY_STRING'];

// fonction parse_str permet de construire 
// une table de hachage (clé + valeur)
parse_str($query_string, $param);

// --- $action contient le nom de la méthode statique recherchée
$action = htmlspecialchars($param["action"]);

// --- Liste des méthodes autorisées
switch ($action) {
 case "famReadAll" :
 case "famReadOne" :
 case "famReadNom" :
 case "famCreate" :
 case "famCreated" :
  ControllerFamille::$action();
  break;


 case "eventReadAll" :
 case "producteurReadOne" :
 case "producteurReadId" :
 case "producteurCreate" :
 case "producteurCreated" :
 case "producteurOnlyRegion" :
 case "producteurNombre":
     
  ControllerEvenement::$action();
  break;


 // Tache par défaut
 default:
  $action = "geneAccueil";
  ControllerFamille::$action();
}
?>
<!-- ----- Fin Router1 -->

