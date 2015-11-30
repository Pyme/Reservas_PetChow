<?php

class Configuracion {
    public $user;
    public $password;
    public $host;
    public $bd;
    public function __construct() {
        //Para el servidor UBB Colvin
        /*$this->user = "jcistern";
        $this->password = "glnEK7TH";
        $this->host = "192.168.122.70"; 
        $this->db = "jcistern";*/
        
        //Para LocalHost
       $this->user = "root";
        $this->password = "";
        $this->host = "localhost";
        $this->db = "petchow";
        
        /*WEB
        $this->user = "icibiobi_jciste";
        $this->password = "local8080";
        $this->host = "localhost";
        $this->db = "icibiobi_petchow";*/
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
