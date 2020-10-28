<?php
require_once "./controllers/back/Securite.class.php";
require_once "./models/back/familles.manager.php";
class FamillesController
{

    private $famillesManager;

    public function __construct()
    {
        $this->famillesManager = new FamilleManager();
    }

    public function visualisation()
    {
        if (Securite::verifAccessSession()) {

            $familles = $this->famillesManager->getFamilles();
            //print_r($familles);

            require "views/familleVisualisation.view.php";
        } else {
            throw new Exception("tu n'as pas le droit detre la");
            //header("Location" :)
        }
    }

    public function suppression()
    {
        if (Securite::verifAccessSession()) {
            $idFamille  = (int)Securite::secureHTML($_POST['famille_id']);
            if ($this->famillesManager->compterAnimaux($idFamille) > 0) {
                $_SESSION['alert'] = [
                    "message" => "La famille n'a pas éte supprimée",
                    "type"  => "alert-danger"
                ];
            } else {
                $this->famillesManager->deleteDBFamilles($idFamille);
                $_SESSION['alert'] = [
                    "message" => "La famille a été supprimée",
                    "type"  => "alert-success"
                ];
            }
            header('Location: ' . URL . 'back/familles/visualisation');

            //echo $_POST['famille_id'];
        } else {
            throw new Exception("tu n'as pas le droit detre la");
            //header("Location" :)
        }
    }

    public function modification()
    {
        if (Securite::verifAccessSession()) {
            $idFamille = (int)Securite::secureHTML($_POST['famille_id']);
            $libelle = Securite::secureHTML($_POST['famille_libelle']);
            $description = Securite::secureHTML($_POST['famille_description']);
            $this->famillesManager->updateFamille($idFamille, $libelle, $description);

            $_SESSION['alert'] = [
                "message" => "La famille a été bien modifié",
                "type"  => "alert-success"
            ];
            header('Location: ' . URL . 'back/familles/visualisation');
        } else {
            throw new Exception("tu n'as pas le droit detre la");
            //header("Location" :)
        }
    }

    public function createTemplate()
    {
        if (Securite::verifAccessSession()) {
            require "views/familleCreation.view.php";
        } else {
            throw new Exception("tu n'as pas le droit detre la");
        }
    }
    public function creationFamilles()
    {
        if (Securite::verifAccessSession()) {
            $familles = $this->famillesManager->getFamilles();
            //print_r($familles);
            $libelle = Securite::secureHTML($_POST['famille_libelle']);
            $description = Securite::secureHTML($_POST['famille_description']);
            $idFamille = $this->famillesManager->createDBfamille($libelle, $description);

            $_SESSION['alert'] = [
                "message" => "La famille a été créé avec l'identifiant: " . $idFamille,
                "type"  => "alert-success"
            ];
            header('Location: ' . URL . 'back/familles/visualisation');
        } else {
            throw new Exception("tu n'as pas le droit detre la");
            //header("Location" :)
        }
    }
}
