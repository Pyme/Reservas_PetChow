<?php

class Configuracion {
    public $user;
    public $password;
    public $host;
    public $bd;
    public function __construct() {
        $this->user = "root";
        $this->password = "";
        $this->host = "localhost";
        $this->db = "petchow";
    }
    
    public function getUser() {
        return $this->user;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getHost() {
        return $this->host;
    }

    public function getBd() {
        return $this->bd;
    }
}   

?>
