<?php
session_start();

define("URL", str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http") .
    "://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));

require_once "controllers/front/API.controller.php";
require_once "controllers/back/admin.Controller.php";
require_once "controllers/back/familles.Controller.php";

$apiController = new APIController();
$adminController = new AdminController();
$famillesController = new FamillesController();


try {
    if (empty($_GET['page'])) {
        throw new Exception("La page n'existe pas");
    } else {
        $url = explode("/", filter_var($_GET['page'], FILTER_SANITIZE_URL));
        if (empty($url[0]) || empty($url[1])) throw new Exception("La page n'existe pas");
        switch ($url[0]) {
            case "front":
                switch ($url[1]) {
                    case "animaux":
                        if (!isset($url[2]) || !isset($url[3])) {
                            $apiController->getAnimaux(-1, -1);
                        } else {
                            $apiController->getAnimaux((int)$url[2], (int)$url[3]);
                        }
                        break;
                    case "animal":
                        if (empty($url[2])) throw new Exception("L'identifiant de l'animal est manquant");
                        echo $apiController->getAnimal($url[2]);
                        break;
                    case "continents":
                        echo $apiController->getContinent();
                        break;
                    case "familles":
                        echo $apiController->getFamilles();
                        break;
                    case "sendMessage":
                        $apiController->sendMessage();
                        break;
                    default:
                        throw new Exception("La page n'existe pas");
                }
                break;
            case "back":
                switch ($url[1]) {
                    case "login":
                        $adminController->getPageLogin();
                        //echo "page back end demandée";
                        break;
                        case "connexion":
                           $adminController->connexion(); 
                        break;
                        case "admin":
                            $adminController->getAccueilAdmin(); 
                         break;
                         case "deconnexion":
                            $adminController->deconnexion(); 
                         break;
                         case "familles":
                            switch ($url[2]){
                                case "visualisation" :
                                  $famillesController->visualisation();
                                 break; 
                                 case "validationSuppression":
                                    $famillesController->suppression();
                                 break;
                                 case "validationModification":
                                    $famillesController->modification();
                                 break;
                                 case "creation" :
                                    $famillesController->createTemplate();
                                 break;
                                  case "creationValidation":
                                    $famillesController->creationFamilles();
                                    break;
                            default:
                                 throw new Exception("La page n'existe pas here ");
                            }
                        break;
                    default:
                        throw new Exception("La page n'existe pas");
                }
                break;
            default:
                throw new Exception("La page n'existe pas bullshit");
        }
    }
} catch (Exception $e) {
    $msg = $e->getMessage();
    echo $msg;

    echo "<a href='".URL."back/login'>login</a>";
}
//routage pour eviter les appel **?page=1**
//creer le chemin absolu permettant d'acceder au differents pages