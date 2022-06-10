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

    public static function individuGetAll() {
        try {
            $database = Model::getInstance();
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
    
    public static function individuGetAllHomme(){
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
    
    public static function individuGetAllFemme(){
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

    public static function updatePere($id, $pere_id) {
        try {
            $database = Model::getInstance();
            $query ="update individu set pere = :pere where id = :id and famille_id = :famille";
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
    
    public static function updateMere($id, $mere_id) {
        try {
            $database = Model::getInstance();
            $query ="update individu set mere = :mere where id = :id and famille_id = :famille";
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

}
