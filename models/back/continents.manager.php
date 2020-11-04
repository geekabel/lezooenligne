<?php

require_once "./models/Model.php";

class ContinentsManager extends Model
{

    public function getContinents()
    {
        $req = "SELECT * FROM continent";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
        $animaux = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $animaux;
    }

    public function addContinentAnimal($idAnimal, $idContinent)
    {
        $req = "INSERT INTO animal_continent(animal_id,continent_id) VALUES (:idAnimal,:idContinent) ";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue("idAnimal", $idAnimal, PDO::PARAM_INT);
        $stmt->bindValue("idContinent", $idContinent, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
        return $this->getBdd()->lastInsertId();
    }
    public function deleteDBContinentAnimal($idAnimal, $idContinent)
    {
        $req = "DELETE from animal_continent where animal_id= :idAnimal and continent_id= :idContinent";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue("idAnimal", $idAnimal, PDO::PARAM_INT);
        $stmt->bindValue("idContinent", $idContinent, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
    }

    public function verificationExisteAnimalContinent($idAnimal, $idContinent)
    {
        $req = "SELECT count(*) as 'nb' from animal_continent ac where 
        ac.animal_id=:idAnimal and ac.continent_id= :idContinent";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue("idAnimal", $idAnimal, PDO::PARAM_INT);
        $stmt->bindValue("idContinent", $idContinent, PDO::PARAM_INT);
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        if ($resultat['nb'] >= 1) return true;
        return false;
    }
}
