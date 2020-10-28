<?php

require_once "./models/Model.php";

class AdminManager extends Model
{
    private function getPasswordByUser($login)
    {
        $req = 'SELECT * FROM administration WHERE login = :login';
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":login",$login, PDO::PARAM_INT);
        $stmt->execute();
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $admin['password'];
    }

    public function isConnexionValid($login, $password)
    {
        $passwordDB = $this->getPasswordByUser($login);
        //$PasswordVerify = password_verify($password,$passwordDB);
        return password_verify($password, $passwordDB);

        //var_dump($PasswordVerify);
        //var_dump($passwordDB);

    }

    // public function getUserByMail($email){

    // }
}
