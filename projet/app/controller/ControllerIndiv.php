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
    
    public function indivSelect() {
         $results = ModelIndividu::individuGetAll();


  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/indiv/viewSelect.php';
  require ($vue);
 } 
    
 public function indivInfo($args) {
     $id=$args['nom'];
     $individu = ModelIndividu::individuGetOne($id);
     $pere = ModelIndividu::individuGetOne($individu[0]->getPere());
     $mere = ModelIndividu::individuGetOne($individu[0]->getMere());
     
     // Le eventGetOne récupère la naissance et le déces du perso selectionné
     $event = ModelEvent::eventGetOne(htmlspecialchars($_GET['nom']));
     //permet de compter la taille du tableau afin de déterminer les évenements rentrés
     $taille=count($event);
     $lien= ModelLien::lienGetOne($id);
     $union = array();
     $i = 0;
     foreach ($lien as $element){
         //si iid1 = id on prend le iid2
        if ($id === $element->getIid1()){
            $id2 = $element->getIid2();
        //si iid2 = id alors on prend iid1
        }else if ($id === $element->getIid2()){
            $id2 = $element->getIid1();
        }
        if(strcasecmp($element->getLien_type(), 'mariage') === 0 || strcasecmp($element->getLien_type(), 'couple') === 0){
            $personne2 = ModelIndividu::individuGetOne($id2);
            $table = array();
            $table[0] = $personne2[0]->getNom().' '.$personne2[0]->getPrenom();
            $table[1] = $element->getLien_type();
            $table[2] = $personne2[0]->getId();
            $parents = ModelIndividu::individuGetAll();
            $j = 0;
            //Ajout enfants
            $table2 = array();
            foreach ($parents as $element2){
                if(($element2->getPere() === $id && $element2->getMere() === $id2) || ($element2->getPere() === $id2 && $element2->getMere() === $id)){
                    $table3 = array();
                    $table3[0] = $element2->getNom().' '.$element2->getPrenom();
                    $table3[1] = $element2->getId();
                    $table2[$j] = $table3;
                    $j++;   
                }
            }
            $table[3] = $table2;
            $union[$i] = $table;
            $i++;
        }
     }
    
     
     // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/indiv/viewInfo.php';
  require ($vue);
 }
}
?>
