<?php

include_once 'Nucleo/ConexionMySQL.php';
include_once '../../Modelo/CanilDTO.php';
include_once 'InterfaceDAO.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CanilDAO
 *
 * @author Joseline
 */
class CanilDAO implements InterfaceDAO{
    private $conexion;
    
    public function CanilDAO() {
        $this->conexion = new ConexionMySQL();
    }
    
    public function delete($idCanil) {
        $this->conexion->conectar();
        $query = "DELETE FROM canil WHERE idCanil = " . $idCanil;
        $result = $this->conexion->ejecutar($query);
        $this->conexion->desconectar();
        return $result;
    }

    public function findAll() {
        $this->conexion->conectar();
        $query = "SELECT * FROM canil C JOIN estadocanil E ON C.idEstadoCanil = E.idEstadoCanil";
        $result = $this->conexion->ejecutar($query);
        $i = 0; //Se inicializa en 0 para las posiciones del arreglo
        $caniles = array(); //Se crea un arreglo no se le dice el tamaño
        while ($fila = mysql_fetch_assoc($result)) {
            $canil = new CanilDTO();
            $canil->setIdCanil($fila['idCanil']);
            $canil->setDimension($fila['dimension']);
            $canil->setTipoCanil($fila['tipoCanil']);
            $canil->setIdEstadoCanil($fila['idEstadoCanil']);
            $canil->setEstadoCanil($fila['estado']);
            $caniles[$i] = $canil;
            $i++;
        }
        $this->conexion->desconectar();
        return $caniles;
    }

    public function findByIdCanil($idCanil) {
        $this->conexion->conectar();
        $query = "SELECT * FROM canil C JOIN estadocanil E ON C.idEstadoCanil = E.idEstadoCanil WHERE C.idCanil = ".$idCanil;
        $result = $this->conexion->ejecutar($query);        
        $canil = new CanilDTO();
        while ($fila = mysql_fetch_assoc($result)) {            
            $canil->setIdCanil($fila['idCanil']);
            $canil->setDimension($fila['dimension']);
            $canil->setTipoCanil($fila['tipoCanil']);
            $canil->setIdEstadoCanil($fila['idEstadoCanil']);
            $canil->setEstadoCanil($fila['estado']);
        }
        $this->conexion->desconectar();
        return $canil;
    }

    public function findLikeAtrr($name) {
        
    }

    public function save($object) {
        $this->conexion->conectar();
        $query = "INSERT INTO canil (idCanil,dimension,tipoCanil,idEstadoCanil)"
                . " VALUES (" . $object->getIdCanil() . ",'" . $object->getDimension() . "','" . $object->getTipoCanil() . "'," . $object->getIdEstadoCanil() . ")";
        $result = $this->conexion->ejecutar($query);
        $this->conexion->desconectar();
        return $result;
    }

    public function update($object) {
        $this->conexion->conectar();

        $query = "UPDATE canil SET "
                . " idCanil = " . $object->getIdCanil() . ", "
                . " dimension = '" . $object->getDimension() . "', "
                . " tipoCanil = '" . $object->getTipoCanil() . "', "
                . " idEstadoCanl = " . $object->getIdEstadoCanil() . " "
                . " WHERE idCanil = " . $object->getIdCanil();

        $result = $this->conexion->ejecutar($query);
        $this->conexion->desconectar();
        return $result;
    }
    
    public function findByTipoAndLibre($tipo,$fechaInicio,$fechaFin){
        $this->conexion->conectar();
        $query = "SELECT * FROM canil C JOIN estadocanil E ON C.idEstadoCanil = E.idEstadoCanil WHERE C.tipoCanil = '"+$tipo+"' AND C.idCanil NOT IN (SELECT R.idCanil FROM reservahostal R WHERE (R.fechaInicio <= '"+$fechaInicio+"' AND r.fechaFin >= '"+$fechaInicio+"') OR (R.fechaInicio <= '"+$fechaFin+"' AND r.fechaFin >= '"+$fechaFin+"'))";        
        $result = $this->conexion->ejecutar($query);
        $i = 0; //Se inicializa en 0 para las posiciones del arreglo
        $caniles = array(); //Se crea un arreglo no se le dice el tamaño
        while ($fila = mysql_fetch_assoc($result)) {
            $canil = new CanilDTO();
            $canil->setIdCanil($fila['idCanil']);
            $canil->setDimension($fila['dimension']);
            $canil->setTipoCanil($fila['tipoCanil']);
            $canil->setIdEstadoCanil($fila['idEstadoCanil']);
            $canil->setEstadoCanil($fila['estado']);
            $caniles[$i] = $canil;
            $i++;
        }
        $this->conexion->desconectar();
        return $caniles;
    }

    public function findByRun($run) {
        
    }

//put your code here
}
