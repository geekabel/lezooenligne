<?php
require "./controllers/back/Securite.class.php";
require "./models/back/admin.manager.php";

class AdminController
{
    private $adminManager;

    public function __construct()
    {
        $this->adminManager = new AdminManager();
    }

    public function getPageLogin()
    {
        //echo "Page de login";
        require_once "views/login.view.php";
    }

    public function connexion()
    {
        if (!empty($_POST['username']) && !empty($_POST['password'])) {
            $login = Securite::secureHTML($_POST['username']);
            $password = Securite::secureHTML($_POST['password']);
            var_dump($password);
            if ($this->adminManager->isConnexionValid($login, $password)) {
               
                $_SESSION['access'] = "admin";
                header('Location: '.URL."back/admin");

            } else {
                header('Location: '.URL."back/login");
            }
        }
       
       
    }

    public function getAccueilAdmin()
    {
        // password_hash("admin09",PASSWORD_DEFAULT);
        if(Securite::verifAccessSession()){
            require "views/accueilAdmin.view.php";
        } else {
            header('Location: '.URL."back/login");
        }
    }
    public function deconnexion()
    {
        
        session_destroy();
        header('Location: '.URL."back/login");
    }
}
