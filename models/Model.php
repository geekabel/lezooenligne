<?php
// on ne peuxt  jamais instancier cette classe 
abstract class Model{
    // instance $pdo unique 
    private static $pdo; 

    private static function setBdd(){
       self::$pdo = new PDO("mysql:host=localhost;dbname=animaux;charset=utf8","root","");
       self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }

    protected function getBdd(){
         if(self::$pdo === null){
             self::setBdd();
         }
         return self::$pdo;
    }

    public static function sendJSON($info){
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json;");
        echo json_encode($info);
    }
}

