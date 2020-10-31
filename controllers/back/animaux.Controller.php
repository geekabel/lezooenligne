<?php
require_once "./controllers/back/Securite.class.php";
require_once "./models/back/animaux.manager.php";
require_once "./models/back/familles.manager.php";
require_once "./models/back/continents.manager.php";
class AnimauxController
{

    private $animauxManager;

    public function __construct()
    {
        $this->animauxManager = new AnimauxManager();
    }

    public function visualisation()
    {
        if (Securite::verifAccessSession()) {

            $animaux = $this->animauxManager->getAnimaux();


            //print_r($animaux);
            //echo 'je suis beni';
            require "views/animauxVisualisation.view.php";
        } else {
            throw new Exception("tu n'as pas le droit detre la");
            //header("Location" :)
        }
    }
    public function suppression()
    {
        if (Securite::verifAccessSession()) {
            $idAnimal  = (int)Securite::secureHTML($_POST['animal_id']);
            $this->animauxManager->deleteDBAnimalContinent($idAnimal);
            $this->animauxManager->deleteDBAnimal($idAnimal);
            $_SESSION['alert'] = [
                "message" => "L'animal a été supprimée",
                "type"  => "alert-success"
            ];

            header('Location: ' . URL . 'back/animaux/visualisation');

            //echo $_POST['famille_id'];
        } else {
            throw new Exception("tu n'as pas le droit d'être la");
            //header("Location" :)
        }
    }

    public function creation()
    {
        if (Securite::verifAccessSession()) {
            $famillesManager = new FamilleManager();
            $familles = $famillesManager->getFamilles();
            $continentsManager = new ContinentsManager();
            $continents = $continentsManager->getContinents();
            require_once "views/animauxCreation.view.php";
        } else {
            throw new Exception("tu n'as pas le droit d'être la");
            //header("Location" :)
        }
    }
    //$image = Securite::secureHTML($_POST['image']);
    public function creationValidation()
    {
        if (Securite::verifAccessSession()) {
            $name = Securite::secureHTML($_POST['animal_nom']);
            $description = Securite::secureHTML($_POST['animal_description']);
            $image = "";
            $familles = (int) Securite::secureHTML($_POST['famille_id']);

            $idAnimal = $this->animauxManager->createAnimal($name, $description, $image, $familles);

            $continentsManager = new ContinentsManager();

            $_SESSION['alert'] = [
                "message" => "L'animal a été créé :" . $idAnimal,
                "type"  => "alert-success"
            ];
            if (!empty($_POST['continent-1']))
            $continentsManager->addContinentAnimal($idAnimal, 1);
            if (!empty($_POST['continent-2']))
            $continentsManager->addContinentAnimal($idAnimal, 2);
            if (!empty($_POST['continent-3']))
            $continentsManager->addContinentAnimal($idAnimal, 3);
            if (!empty($_POST['continent-4']))
            $continentsManager->addContinentAnimal($idAnimal, 4);
            if (!empty($_POST['continent-5']))
            $continentsManager->addContinentAnimal($idAnimal, 5);
            header('Location: ' . URL . 'back/animaux/visualisation');
        } else {
            throw new Exception("tu n'as pas le droit d'être la");
        }
    }
    public function modification($idAnimal)
    {
        if (Securite::verifAccessSession()) {
            $famillesManager = new FamilleManager();
            $familles = $famillesManager->getFamilles();
            $continentsManager = new ContinentsManager();
            $continents = $continentsManager->getContinents();

            $lignesAnimal = $this->animauxManager->getAnimal((int)Securite::secureHTML($idAnimal));
            // var_dump($lignesAnimal);
            $tabContinents = [];
            foreach ($lignesAnimal as $continent) {
                $tabContinents[] = $continent['continent_id'];
            }

            $animal = array_slice($lignesAnimal[0], 0, 5);

            require_once "views/animalModification.view.php";
        } else {
            throw new Exception("tu n'as pas le droit detre la");
            
        }
    }


    public function modificationValidation(){
        
    }
}
