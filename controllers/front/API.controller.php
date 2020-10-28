<?php
require_once("models/front/API.manager.php");
require_once("models/Model.php");

class APIController
{
    private $apiManager;

    public function __construct()
    {
        $this->apiManager = new APIManager();
    }

    public function getAnimaux($idFamille, $idContinent)
    {
        $animaux = $this->apiManager->getDBAnimaux($idFamille, $idContinent);
        $tabResultat =  $this->formatDataAnimaux($animaux);
        // echo "<pre>";
        //   print_r($tabResultat);
        // echo "</pre>";
        Model::sendJSON($tabResultat);
    }

    public function getAnimal($idAnimal)
    {
        $lignesAnimal =  $this->apiManager->getDBAnimal($idAnimal);
        $tabResultat = $this->formatDataAnimaux($lignesAnimal);
        // echo "<pre>";
        //   print_r($tabResultat);
        // echo "</pre>";
        Model::sendJSON($tabResultat);
    }
    /*
        Manipulation de tableau . si l'animal existe alors
        on en genre plus un nouvelle ligne, on ajoutera juste 
        les continents
    */
    private function formatDataAnimaux($lignes)
    {
        $tab = [];
        foreach ($lignes as $ligne) {
            if (!array_key_exists($ligne['animal_id'], $tab)) {
                $tab[$ligne['animal_id']] = [
                    "id" => $ligne['animal_id'],
                    "nom" => $ligne['animal_nom'],
                    "description" => $ligne['animal_description'],
                    "image" => URL . "public/images/" . $ligne['animal_image'],
                    "famille" => [
                        "idFamille" => $ligne['famille_id'],
                        "libelleFamille" => $ligne['famille_libelle'],
                        "descriptionFamille" => $ligne['famille_description'],
                    ],
                ];
            }
            $tab[$ligne['animal_id']]['continent'][] = [
                "idContinent" => $ligne['continent_id'],
                "libelleContinent" => $ligne['continent_libelle']
            ];
        }

        return $tab;
    }

    public function getContinent()
    {

        $continents = $this->apiManager->getDBContinents();
        Model::sendJSON($continents);
    }


    public function getFamilles()
    {

        $familles = $this->apiManager->getDBFamilles();
        Model::sendJSON($familles);
        // echo "<pre>";
        //     print_r($familles);
        // echo "</pre>";
    }


    public function sendMessage()
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Accept , Content-type, Content-Length, Accept-Encoding, X-CSRF-Token, Authorization");
        //header("Content-Type: application/json;");

        $obj = json_decode(file_get_contents('php://input')); // partie decodage 
        
        //Traitement sur les informations recupérer
        // $to = "contact@godwin.com";
        // $subject = "Message du site mYzOO :" .$obj->nom;
        // $message = $obj->contenu;
        // $headers = "From : " .$message->email;

        //mail($to, $subject, $message, $headers);
        
        //Message retour sur le front
        $messageRetour = [
            'from' => $obj->email,
            'to' => "koffigodwin96@gmail.com"

        ];

        echo json_encode($messageRetour);
    }
}
