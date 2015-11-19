<?php

include_once 'Nucleo/ConexionMySQL.php';
include_once '../../Modelo/InsumosDTO.php';
include_once 'InterfaceDAO.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InsumosDAO
 *
 * @author Joseline
 */
class InsumosDAO implements InterfaceDAO {

    private $conexion;

    public function InsumosDAO() {
        $this->conexion = new ConexionMySQL();
    }

    public function delete($idInsumos) {
        $this->conexion->conectar();
        $query = "DELETE FROM insumos WHERE idInsumos = " . $idInsumos;
        $result = $this->conexion->ejecutar($query);
        $this->conexion->desconectar();
        return $result;
    }

    public function findAll() {
        $this->conexion->conectar();
        $query = "SELECT * FROM insumos";
        $result = $this->conexion->ejecutar($query);
        $i = 0; //Se inicializa en 0 para las posiciones del arreglo
        $insumos = array(); //Se crea un arreglo no se le dice el tamaño
        while ($fila = mysql_fetch_assoc($result)) {
            $insumo = new InsumosDTO();
            $insumo->setIdInsumos($fila['idInsumos']);
            $insumo->setNombre($fila['nombre']);
            $insumo->setStock($fila['stock']);
            $insumo->setPrecio($fila['precio']);
            $insumos[$i] = $insumo;
            $i++;
        }
        $this->conexion->desconectar();
        return $insumos;
    }

    public function findByIdInsumos($idInsumos) {
        $this->conexion->conectar();
        $query = "SELECT * FROM insumos WHERE idInsumos = " . $idInsumos;
        $result = $this->conexion->ejecutar($query);
        $insumo = new InsumosDTO();
        while ($fila = mysql_fetch_assoc($result)) {
            $insumo->setIdInsumos($fila['idInsumos']);
            $insumo->setNombre($fila['nombre']);
            $insumo->setStock($fila['stock']);
            $insumo->setPrecio($fila['precio']);
        }
        $this->conexion->desconectar();
        return $insumo;
    }

    public function findLikeAtrr($name) {
        $this->conexion->conectar();
        $query = "SELECT * FROM insumos WHERE upper(nombre) LIKE upper('%$name%')";
        $result = $this->conexion->ejecutar($query);
        $i = 0;
        $insumos = array();
        while ($fila = mysql_fetch_assoc($result)) {
            $insumo = new InsumosDTO();
            $insumo->setIdInsumos($fila['idInsumos']);
            $insumo->setNombre($fila['nombre']);
            $insumo->setStock($fila['stock']);
            $insumo->setPrecio($fila['precio']);
            $insumos[$i] = $insumo;
            $i++;
        }
        $this->conexion->desconectar();
        return $insumos;
    }

    public function save($object) {
        $this->conexion->conectar();
        $query = "INSERT INTO insumos (nombre,stock,precio)"
                . " VALUES ('" . $object->getNombre() . "'," . $object->getStock() . "," . $object->getPrecio() . ")";
        $result = $this->conexion->ejecutar($query);
        $this->conexion->desconectar();
        return $result;
    }

    public function update($object) {
        $this->conexion->conectar();

        $query = "UPDATE insumos SET "
                . " nombre = '" . $object->getNombre() . "', "
                . " stock = " . $object->getStock() . ", "
                . " precio = " . $object->getPrecio()." "
                . "WHERE idInsumos = ".$object->getIdInsumos();

        $result = $this->conexion->ejecutar($query);
        $this->conexion->desconectar();
        return $result;
    }

    public function findByDisponibles() {
        $this->conexion->conectar();
        $query = "SELECT * FROM insumos WHERE stock >0";
        $result = $this->conexion->ejecutar($query);
        $i = 0; //Se inicializa en 0 para las posiciones del arreglo
        $insumos = array(); //Se crea un arreglo no se le dice el tamaño        
        while ($fila = mysql_fetch_assoc($result)) {
            $insumo = new InsumosDTO();
            $insumo->setIdInsumos($fila['idInsumos']);
            $insumo->setNombre($fila['nombre']);
            $insumo->setStock($fila['stock']);
            $insumo->setPrecio($fila['precio']);
            $insumos[$i] = $insumo;
            $i++;
        }
        $this->conexion->desconectar();
        return $insumos;
    }

    public function findByNoDisponibles() {
        $this->conexion->conectar();
        $query = "SELECT * FROM insumos WHERE stock = 0";
        $result = $this->conexion->ejecutar($query);
        $i = 0; //Se inicializa en 0 para las posiciones del arreglo
        $insumos = array(); //Se crea un arreglo no se le dice el tamaño        
        while ($fila = mysql_fetch_assoc($result)) {
            $insumo = new InsumosDTO();
            $insumo->setIdInsumos($fila['idInsumos']);
            $insumo->setNombre($fila['nombre']);
            $insumo->setStock($fila['stock']);
            $insumo->setPrecio($fila['precio']);
            $insumos[$i] = $insumo;
            $i++;
        }
        $this->conexion->desconectar();
        return $insumos;
    }

    public function findByRun($run) {
        
    }

//put your code here
}
