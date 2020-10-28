<?php
require_once "models/Model.php";

class APIManager extends Model
{
    //Traiment de ma requete pour des filtres 
    //Petite remarque au niveau de mes filtres qui ne sont pas optimale
    public function getDBAnimaux($idFamille,$idContinent)
    {
        $whereClause = "";
        if($idFamille !== -1 || $idContinent!== -1) $whereClause .="WHERE ";
        if($idFamille !== -1) $whereClause .= "f.famille_id = :idFamille";
        if($idFamille !== -1 && $idContinent!== -1) $whereClause .=" AND ";
        //if($idContinent !== -1) $whereClause .= "c.continent_id = :idContinent";// Amelioration de cette requete 29/09/2020
        if($idContinent !== -1) $whereClause .= "a.animal_id IN (
            select animal_id from animal_continent where continent_id = :idContinent
        )";
        $req = "SELECT * 
      from animal a inner join famille f on f.famille_id = a.famille_id
      inner join animal_continent ac on ac.animal_id = a.animal_id
      inner join continent c on c.continent_id = ac.continent_id " .$whereClause;

        $stmt = $this->getBdd()->prepare($req);
        if($idFamille !== -1) $stmt->bindValue(":idFamille",$idFamille,PDO::PARAM_INT);
        if($idContinent !== -1) $stmt->bindValue(":idContinent",$idContinent,PDO::PARAM_INT);
        $stmt->execute();
        $animaux = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $animaux;
        
    }

    public function getDBAnimal($idAnimal)
    {
        $req = "SELECT * 
      from animal a inner join famille f on f.famille_id = a.famille_id
      inner join animal_continent ac on ac.animal_id = a.animal_id
      inner join continent c on c.continent_id = ac.continent_id
      where a.animal_id = :idAnimal
      ";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":idAnimal", $idAnimal, PDO::PARAM_INT);
        $stmt->execute();
        $lignesAnimal = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $lignesAnimal;
    }

    public function getDBFamilles()
    {
        $req = "SELECT * 
        FROM  famille";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
        $familles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $familles;
    }

    public function getDBContinents()
    {
        $req = "SELECT * 
        FROM continent";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
        $continents = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $continents;
    }
}
