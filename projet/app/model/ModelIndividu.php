<?php

require_once 'Model.php';

class ModelIndividu {

    private $famille_id, $id, $nom, $prenom, $sexe, $pere, $mere;

    public function __construct($famille_id = NULL, $id = null, $nom = NULL, $prenom = NULL, $sexe = NULL, $pere = NULL, $mere = NULL) {
        if (!is_null($famille_id)) {
            $this->famille_id = $famille_id;
            $this->id = $id;
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->sexe = $sexe;
            $this->pere = $pere;
            $this->mere = $mere;
        }
    }

    function setFamille_id($famille_id) {
        $this->famille_id = $famille_id;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNom($nom) {
        $this->nom = $nom;
    }

    function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    function setSexe($sexe) {
        $this->sexe = $sexe;
    }

    function setPere($pere) {
        $this->pere = $pere;
    }

    function setMere($mere) {
        $this->mere = $mere;
    }

    function getFamille_id() {
        return $this->famille_id;
    }

    function getId() {
        return $this->id;
    }

    function getNom() {
        return $this->nom;
    }

    function getPrenom() {
        return $this->prenom;
    }

    function getSexe() {
        return $this->sexe;
    }

    function getPere() {
        return $this->pere;
    }

    function getMere() {
        return $this->mere;
    }
    
    //Affichage de tout les individus d'une famille
    public static function individuGetAll() {
        try {
            $database = Model::getInstance();
            //selection des individus de la famille en excluant l'individu 0 qui n'existe pas IRL
            $query = "select * from individu where famille_id = :famille and id>0 order by id";
            $statement = $database->prepare($query);
            $statement->execute(['famille' => $_SESSION['id']]);
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelIndividu");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
    //Affichage d'un individu en fonction de son id et de sa famille
    public static function individuGetOne($id) {
        try {
            $database = Model::getInstance();
            $query = "select * from individu where famille_id = :famille and id=:id";
            $statement = $database->prepare($query);
            $statement->execute(['famille' => $_SESSION['id'], 'id' => $id]);
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelIndividu");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
    
    //Recupération de tout les individus hommes autre que l'individu 0 et ordonne par l'id
    public static function individuGetAllHomme() {
        try {
            $database = Model::getInstance();
            $query = "select * from individu where famille_id = :famille and id>0 and sexe='H' order by id";
            $statement = $database->prepare($query);
            $statement->execute(['famille' => $_SESSION['id']]);
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelIndividu");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    //Recupération de tout les individus femmes autre que l'individu 0 et ordonne par l'id
    public static function individuGetAllFemme() {
        try {
            $database = Model::getInstance();
            $query = "select * from individu where famille_id = :famille and id>0 and sexe='F' order by id";
            $statement = $database->prepare($query);
            $statement->execute(['famille' => $_SESSION['id']]);
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelIndividu");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    //Recupération du sexe d'un individu en fonction de son id
    public static function sexe($id) {
        try {
            $database = Model::getInstance();
            $query = "select sexe from individu where id = :id";
            $statement = $database->prepare($query);
            $statement->execute(['id' => $id]);
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelIndividu");
            foreach ($results as $element) {
                $sexe = $element->getSexe();
            }
            return $sexe;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
    
    //Mise a jour de l'id du pere d'un individu
    public static function updatePere($id, $pere_id) {
        try {
            $database = Model::getInstance();
            $query = "update individu set pere = :pere where id = :id and famille_id = :famille";
            $statement = $database->prepare($query);
            $nb = $statement->execute([
                'id' => $id,
                'pere' => $pere_id,
                'famille' => $_SESSION['id'],
            ]);
            return $nb;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    //Mise a jour de l'id de la mere d'un individu
    public static function updateMere($id, $mere_id) {
        try {
            $database = Model::getInstance();
            $query = "update individu set mere = :mere where id = :id and famille_id = :famille";
            $statement = $database->prepare($query);
            $nb = $statement->execute([
                'id' => $id,
                'mere' => $mere_id,
                'famille' => $_SESSION['id'],
            ]);
            return $nb;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
    //Insertion d'un nouvel individu dans la famille
    public static function insert($nom, $prenom, $sexe) {
        try {
            //Recuperation de l'id max dispo
            $database = Model::getInstance();
            $query = "select max(id) from individu where famille_id=:famille";
            $statement = $database->prepare($query);
            $statement->execute(['famille' => $_SESSION['id']]);
            $tuple = $statement->fetch();
            $id = $tuple['0'];
            $id++;
            //Insertion du nouvel individu
            $query = "insert into individu value (:famille, :id, :nom, :prenom, :sexe, 0, 0)";
            $statement = $database->prepare($query);
            $statement->execute([
                'famille' => $_SESSION['id'],
                'id' => $id,
                'nom' => $nom,
                'prenom' => $prenom,
                'sexe' => $sexe,
            ]);
            return $id;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    //Insertion de l'individu 0
    public static function individu0() {
        try {
            $database = Model::getInstance();
            $query = "insert into individu value (:famille, 0, '?', '?', '?', 0, 0)";
            $statement = $database->prepare($query);
            $statement->execute([
                'famille' => $_SESSION['id'],
            ]);
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
    // Test si un individu a deja un pere 
    public static function testPaternel($id) {
        try {
            $database = Model::getInstance();
            $query = "select pere from individu where famille_id = :famille and id=:id";
            $statement = $database->prepare($query);
            $statement->execute(['famille' => $_SESSION['id'], 'id' => $id]);
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelIndividu");
            // si test = 1 alors l'individu a deja un pere si test=0 il n'a pas de pere
            $test=1;
            foreach($results as $element){
                if($element->getPere()==0){
                    $test=0;
                }
            }
            return $test;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
    
    //meme fonctionnement que test paternel
    public static function testMaternel($id) {
        try {
            $database = Model::getInstance();
            $query = "select mere from individu where famille_id = :famille and id=:id";
            $statement = $database->prepare($query);
            $statement->execute(['famille' => $_SESSION['id'], 'id' => $id]);
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelIndividu");
            $test=1;
            foreach($results as $element){
                if($element->getMere()==0){
                    $test=0;
                }
            }
            return $test;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

}
