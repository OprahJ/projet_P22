<!-- ----- debut ControllerFamille-->
<?php
session_start();
require_once '../model/ModelFamille.php';

class ControllerFamille {
 // --- page d'acceuil
 public static function geneAccueil() {
  include 'config.php';
  $vue = $root . '/app/view/viewAccueil.php';
  if (DEBUG)
   echo ("ControllerFamille : geneAccueil : vue = $vue");
  require ($vue);
 }

 // --- Liste des familles
 public static function famReadAll() {
  $results = ModelFamille::getAll();
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/famille/viewAll.php';
  if (DEBUG)
   echo ("ControllerFamille : famReadAll : vue = $vue");
  require ($vue);
 }

 // Affiche un formulaire pour sélectionner un nom qui existe
 public static function famReadNom() {
     
  $results = ModelFamille::getAll();


  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/famille/viewNom.php';
  require ($vue);
 }
 
 // Affiche une famille particulière (nom)
 public static function famReadOne() {
  $fam_nom = $_GET['nom'];
  $_SESSION['id'] = $fam_nom;
  $_SESSION['famille'] = ModelFamille::Id($_SESSION['id']);
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/famille/viewSelect.php';
  require ($vue);
 }

 // Affiche le formulaire de creation d'une famille
 public static function famCreate() {
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/famille/viewInsert.php';
  require ($vue);
 }

 // Affiche un formulaire pour récupérer les informations d'un nouveau vin.
 // La clé est gérée par le systeme et pas par l'internaute
 public static function famCreated() {
  // ajouter une validation des informations du formulaire
  $results = ModelFamille::insert(
      htmlspecialchars($_GET['nom'])
  );
  $_SESSION['famille'] = $_GET['nom'];
  $_SESSION['id'] = $results;
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/famille/viewInserted.php';
  require ($vue);
 }
 
}
?>
<!-- ----- fin ControllerFamille -->


