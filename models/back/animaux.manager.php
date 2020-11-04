<?php

require_once "./models/Model.php";

class AnimauxManager extends Model
{

    public function getAnimaux()
    {

        $req = "SELECT * FROM animal";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
        $animaux = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $animaux;
    }
    public function deleteDBAnimalContinent($idAnimal)
    {
        $req = "DELETE FROM animal_continent WHERE animal_id= :idAnimal";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue("idAnimal", $idAnimal, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
    }
    public function deleteDBAnimal($idAnimal)
    {
        $req = "DELETE FROM animal WHERE animal_id= :idAnimal";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue("idAnimal", $idAnimal, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
    }
    public function updateAnimaux($idAnimal, $name, $description, $image, $familles)
    {
        $req = "UPDATE animal set animal_nom= :nom, animal_description= :description,
         animal_image= :image,famille_id= :famille
        where animal_id= :idAnimal";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue("idAnimal", $idAnimal, PDO::PARAM_INT);
        $stmt->bindValue("famille", $familles, PDO::PARAM_INT);
        $stmt->bindValue("nom", $name, PDO::PARAM_STR);
        $stmt->bindValue("description", $description, PDO::PARAM_STR);
        $stmt->bindValue("image", $image, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->closeCursor();
    }


    public function createAnimal($name, $description, $image, $familles)
    {
        $req = "INSERT INTO animal(animal_nom,animal_description,animal_image,famille_id) VALUES (:nom,:description,:image,:familles) ";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue("nom", $name, PDO::PARAM_STR);
        $stmt->bindValue("description", $description, PDO::PARAM_STR);
        $stmt->bindValue("image", $image, PDO::PARAM_STR);
        $stmt->bindValue("familles", $familles, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
        return $this->getBdd()->lastInsertId();
    }
    //j'ai eu une erreur ici du au fait qu'il n'arrive pas a distinguer le bon animal_id;
    //Du coup , j'ai recuperé celle ci en selectectionnant de façon distinctes celle-ci
    public function getAnimal($idAnimal)
    {
        $req =
            "SELECT a.animal_id,animal_nom,animal_description,animal_image,a.famille_id,continent_id 
        from animal a 
        inner join famille f on a.famille_id=f.famille_id 
        left join animal_continent ac on ac.animal_id = a.animal_id 
        where a.animal_id = :idAnimal";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":idAnimal", $idAnimal, PDO::PARAM_INT);
        $stmt->execute();
        $lignesAnimal = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $lignesAnimal;
    }

    public function getImageAnimal($idAnimal)
    {
        $req = "SELECT animal_image FROM animal where animal_id=:idAnimal";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":idAnimal", $idAnimal, PDO::PARAM_INT);
        $stmt->execute();
        $images = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $images['animal_image'];
    }
   
}
