<?php

namespace Ti\Helpdesk\App\System;

use Exception;
use PDO;

class DatabaseConnection{

    public function __construct(){
        return $this->run();
    }

    public function run(){
        $host = 'localhost';
        $user = 'root';
        $pass = '';
        $db = 'cuzhelpdesk';
        try {
            $conn = new PDO("mysql:host=$host;dbname=$db",$user,$pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return  $conn;
        } catch (Exception $e) {
            die(json_encode(array("message"=>"Cannot connect to Database", "response"=>false)));
        }
    }
}