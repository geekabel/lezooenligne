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
        $req = "DELETE FROM animal_continent WHERE animal_id = :idAnimal";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue("idAnimal", $idAnimal, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
    }
    public function deleteDBAnimal($idAnimal)
    {
        $req = "DELETE FROM animal WHERE animal_id = :idAnimal";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue("idAnimal", $idAnimal, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
    }


    // public function updateFamille($idFamille, $libelle, $description)
    // {
    //     $req = "UPDATE famille set famille_libelle = :libelle, famille_description = :description 
    //     where famille_id= :idFamille";
    //     $stmt = $this->getBdd()->prepare($req);
    //     $stmt->bindValue("idFamille", $idFamille, PDO::PARAM_INT);
    //     $stmt->bindValue("libelle", $libelle, PDO::PARAM_STR);
    //     $stmt->bindValue("description", $description, PDO::PARAM_STR);
    //     $stmt->execute();
    //     $stmt->closeCursor();
    // }

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
    public function getAnimal($idAnimal)
    {
        $req = "SELECT * from animal a 
        inner join famille f on a.famille_id=f.famille_id 
        inner join animal_continent ac on ac.animal_id = a.animal_id 
        where a.animal_id= :idAnimal";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":idAnimal", $idAnimal, PDO::PARAM_INT);
        $stmt->execute();
        $lignesAnimal = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $lignesAnimal;
    }

    public function updateAnimaux()
    {
        //     $req = "UPDATE animal set animal_nom = :nom, animal_description = :description, animal_image = :image,
        //     where animal_id= :idAnimal";
        //     $stmt = $this->getBdd()->prepare($req);
        //     $stmt->bindValue("idAnimal", $idAnimal, PDO::PARAM_INT);
        //     $stmt->bindValue("nom", $nom, PDO::PARAM_STR);
        //     $stmt->bindValue("description", $description, PDO::PARAM_STR);
        //     $stmt->bindValue("image", $image, PDO::PARAM_STR);
        //     $stmt->bindValue("idFamille", $idFamille, PDO::PARAM_STR);
        //     $stmt->execute();
        //     $stmt->closeCursor();
    }
   
}
