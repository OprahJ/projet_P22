<?php

require_once 'Model.php';

class ModelLien {

    private $famille_id, $id, $iid1, $iid2, $lien_type, $lien_date, $lien_lieu;

    public function __construc($famille_id = NULL, $id = NULL, $iid1 = NULL, $iid2 = NULL, $lien_type = NULL, $lien_date = NULL, $lien_lieu = NULL) {
        if (!is_null($famille_id)) {
            $this->famille_id = $famille_id;
            $this->id = $id;
            $this->iid1 = $iid1;
            $this->iid2 = $iid2;
            $this->lien_type = $lien_type;
            $this->lien_date = $lien_date;
            $this->lien_lieu = $lien_lieu;
        }
    }

    function setFamille_id($famille_id) {
        $this->famille_id = $famille_id;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setIid1($iid1) {
        $this->iid1 = $iid1;
    }

    function setIid2($iid2) {
        $this->iid2 = $iid2;
    }

    function setLien_type($lien_type) {
        $this->lien_type = $lien_type;
    }

    function setLien_date($lien_date) {
        $this->lien_date = $lien_date;
    }

    function setLien_lieu($lien_lieu) {
        $this->lien_lieu = $lien_lieu;
    }

    function getFamille_id() {
        return $this->famille_id;
    }

    function getId() {
        return $this->id;
    }

    function getIid1() {
        return $this->iid1;
    }

    function getIid2() {
        return $this->iid2;
    }

    function getLien_type() {
        return $this->lien_type;
    }

    function getLien_date() {
        return $this->lien_date;
    }

    function getLien_lieu() {
        return $this->lien_lieu;
    }
    //Affichage de tout les liens spécifiques à une famille
    public static function lienGetAll() {
        try {
            $database = Model::getInstance();
            $query = "select * from lien where famille_id = :famille";
            $statement = $database->prepare($query);
            $statement->execute(['famille' => $_SESSION['id']]);
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelLien");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
    //Affichage d'un lien en fonction de son id spécifique a une famille
    public static function lienGetOne($id) {
        try {
            $database = Model::getInstance();
            $query = "select * from lien where famille_id = :famille and (iid1=:id or iid2=:id)";
            //$query = "select * from lien where famille_id = :famille and iid1=:id";
            $statement = $database->prepare($query);
            $statement->execute(['famille' => $_SESSION['id'],
                'id' => $id]);
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelLien");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    //Insertion d'un nouveau lien parent
    public static function insertParent($iid1, $iid2, $lien_type) {
        try {
            //Selection de l'id max de lien specifique a la famille
            $database = Model::getInstance();
            $query = "select max(id) from lien where famille_id=:famille";
            $statement = $database->prepare($query);
            $statement->execute(['famille'=>$_SESSION['id']]);
            $tuple = $statement->fetch();
            $id = $tuple['0'];
            $id++;
            
            //Insertion du nouveau lien parent
            $query = "insert into lien(famille_id, id, iid1, iid2, lien_type ) value (:famille, :id, :iid1, :iid2, :type)";
            $statement = $database->prepare($query);
            $statement->execute([
                'famille' => $_SESSION['id'],
                'id' => $id,
                'iid1' => $iid1,
                'iid2' => $iid2,
                'type' => $lien_type,
            ]);
            return $id;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function deleteLienParent($iid1, $lien_type) {
        try {
            $database = Model::getInstance();
            $query = "delete from lien where famille_id= :famille and iid1 = :iid1 and lien_type = :lien";
            $statement = $database->prepare($query);
            $statement->execute([
                'famille' => $_SESSION['id'],
                'iid1' => $iid1,
                'lien' => $lien_type,
            ]);
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
    //Insertion d'un nouvel union specifique à une famille
    public static function insertUnion($iid1, $iid2, $lien_type, $lien_date, $lien_lieu) {
        try {
            //Selection de l'id max de lien specifique a la famille
            $database = Model::getInstance();
            $query = "select max(id) from lien where famille_id=:famille";
            $statement = $database->prepare($query);
            $statement->execute(['famille'=>$_SESSION['id']]);
            $tuple = $statement->fetch();
            $id = $tuple['0'];
            $id++;
            
            //Insertion du nouveau lien union
            $query = "insert into lien(famille_id, id, iid1, iid2, lien_type, lien_date, lien_lieu ) value (:famille, :id, :iid1, :iid2, :type, :date, :lieu)";
            $statement = $database->prepare($query);
            $statement->execute([
                'famille' => $_SESSION['id'],
                'id' => $id,
                'iid1' => $iid1,
                'iid2' => $iid2,
                'type' => $lien_type,
                'date' => $lien_date,
                'lieu' => $lien_lieu
            ]);
            return $id;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
    
    //Maj d'un lien parent
    public static function updateParent($iid1, $iid2, $lien_type) {
        try {
            $database = Model::getInstance();
            //Maj de l'id de la mere ou du pere
            $query = "update lien set iid2=:iid2 where famille_id=:famille and iid1=:iid1 and lien_type=:lien";
            $statement = $database->prepare($query);
            $statement->execute(['famille'=>$_SESSION['id'], 'iid2'=>$iid2, 'iid1'=>$iid1, 'lien'=>$lien_type ]);
            //recupération de l'id de lupdate
            $query2 = "select id from lien where famille_id = :famille and iid1 = :iid1 and lien_type = :lien";
            $statement2 = $database->prepare($query2);
            $statement2->execute(['famille' => $_SESSION['id'], 'iid1' => $iid1, 'lien' => $lien_type]);
            $results = $statement2->fetchAll(PDO::FETCH_CLASS, "ModelLien");
            foreach($results as $element){
                $id=$element->getId();
            }
            return $id;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

}
