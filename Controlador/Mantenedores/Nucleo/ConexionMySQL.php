<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

include_once ("configuracion.php");

class ConexionMySQL {

    private $host;
    private $db;
    private $user;
    private $password;
    private $conexion;
    private $configuracion;

    function __construct() {
        $this->configuracion = new Configuracion();
        $this->user = $this->configuracion->user;
        $this->password = $this->configuracion->password;
        $this->host = $this->configuracion->host;
        $this->db = $this->configuracion->db;
    }

    public function conectar() {
        $this->conexion = mysql_connect($this->host, $this->user, $this->password)
                or die('No se pudo conectar: ' . mysql_error());
        mysql_select_db($this->db) or die('No se pudo seleccionar la base de datos');
       
    }

    public function desconectar() {
        mysql_close($this->conexion)or die('Consulta fallida : '.  mysql_error());
    }   

    public function ejecutar($strComando) {
        try {
             $result = mysql_query($strComando);

            return $result;
        } catch (PDOException $ex) {
            throw $ex;
        }
    }
}

?>