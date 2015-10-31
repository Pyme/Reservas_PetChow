<?php

include_once 'Nucleo/ConexionMySQL.php';
include_once '../../Modelo/MascotaDTO.php';
include_once 'InterfaceDAO.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MascotaDAO
 *
 * @author Joseline
 */
class MascotaDAO implements InterfaceDAO {

    private $conexion;

    public function MascotaDAO() {
        $this->conexion = new ConexionMySQL();
    }

    public function delete($idMascota) {
        $this->conexion->conectar();
        $query = "DELETE FROM MASCOTA WHERE idMascota = " . $idMascota;
        $result = $this->conexion->ejecutar($query);
        $this->conexion->desconectar();
        return $result;
    }

    public function findAll() {
        $this->conexion->conectar();
        $query = "SELECT * FROM mascota";
        $result = $this->conexion->ejecutar($query);
        $i = 0; //Se inicializa en 0 para las posiciones del arreglo
        $mascotas = array(); //Se crea un arreglo no se le dice el tamaño
        while ($fila = mysql_fetch_assoc($result)) {
            $mascota = new MascotaDTO();
            $mascota->setIdMascota($fila['idMascota']);
            $mascota->setRaza($fila['raza']);
            $mascota->setNombre($fila['nombre']);
            $mascota->setRun($fila['run']);
            $mascotas[$i] = $mascota;
            $i++;
        }
        $this->conexion->desconectar();
        return $mascotas;
    }

    public function findByIdMascota($idMascota) {
        $this->conexion->conectar();
        $query = "SELECT * FROM mascota WHERE idMascota = " . $idMascota;
        $result = $this->conexion->ejecutar($query);
        $mascota = new MascotaDTO();
        while ($fila = mysql_fetch_assoc($result)) {
            $mascota->setIdMascota($fila['idMascota']);
            $mascota->setRaza($fila['raza']);
            $mascota->setNombre($fila['nombre']);
            $mascota->setRun($fila['run']);
        }
        $this->conexion->desconectar();
        return $mascota;
    }

    public function findLikeAtrr($name) {
        $this->conexion->conectar();
        $query = "SELECT * FROM mascota WHERE upper(nombre) LIKE upper('$name%')";
        $result = $this->conexion->ejecutar($query);
        $i = 0;
        $mascotas = array();
        while ($fila = mysql_fetch_assoc($result)) {
            $mascota = new MascotaDTO();
            $mascota->setIdMascota($fila['idMascota']);
            $mascota->setRaza($fila['raza']);
            $mascota->setNombre($fila['nombre']);
            $mascota->setRun($fila['run']);
            $mascotas[$i] = $mascota;
            $i++;
        }
        $this->conexion->desconectar();
        return $mascotas;
    }

    public function save($object) {
        $this->conexion->conectar();
        $query = "INSERT INTO mascota (raza,nombre,run)"
                . " VALUES ('" . $object->getRaza() . "','" . $object->getNombre() . "','" . $object->getRun() . "')";
        $result = $this->conexion->ejecutar($query);
        $this->conexion->desconectar();
        return $result;
    }

    public function update($object) {
        $this->conexion->conectar();

        $query = "UPDATE mascota SET "
                . " idMascota = " . $object->getIdMascota() . ", "
                . " raza = '" . $object->getRaza() . "', "
                . " nombre = '" . $object->getNombre() . "', "
                . " run = '" . $object->getRun() . "' "
                . " WHERE idMascota = " . $object->getIdMascota();

        $result = $this->conexion->ejecutar($query);
        $this->conexion->desconectar();
        return $result;
    }

    public function findByRun($run) {
        $this->conexion->conectar();
        $query = "SELECT * FROM mascota WHERE run = " . $run;
        $result = $this->conexion->ejecutar($query);
        $mascota = new MascotaDTO();
        while ($fila = mysql_fetch_assoc($result)) {
            $mascota->setIdMascota($fila['idMascota']);
            $mascota->setRaza($fila['raza']);
            $mascota->setNombre($fila['nombre']);
            $mascota->setRun($fila['run']);
        }
        $this->conexion->desconectar();
        return $mascota;
    }

}
