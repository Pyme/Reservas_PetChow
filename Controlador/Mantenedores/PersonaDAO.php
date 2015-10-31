<?php

include_once 'Nucleo/ConexionMySQL.php';
include_once '../../Modelo/PersonaDTO.php';
include_once 'InterfaceDAO.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of C
 *
 * @author Joseline
 */
class PersonaDAO implements InterfaceDAO {

    private $conexion;

    public function PersonaDAO() {
        $this->conexion = new ConexionMySQL();
    }

    public function delete($run) {
        $this->conexion->conectar();
        $query = "DELETE FROM persona WHERE run = '" . $run . "'";
        $result = $this->conexion->ejecutar($query);
        $this->conexion->desconectar();
        return $result;
    }

    public function findAll() {
        $this->conexion->conectar();
        $query = "SELECT * FROM persona";
        $result = $this->conexion->ejecutar($query);
        $i = 0; //Se inicializa en 0 para las posiciones del arreglo
        $personas = array(); //Se crea un arreglo no se le dice el tamaño
        while ($fila = mysql_fetch_assoc($result)) {
            $persona = new PersonaDTO();
            $persona->setRun($fila['run']);
            $persona->setNombres($fila['nombres']);
            $persona->setApellidos($fila['apellidos']);
            $persona->setfechaNac($fila['fechaNac']);
            $persona->setSexo($fila['sexo']);
            $persona->setDireccion($fila['direccion']);
            $persona->setTelefono($fila['telefono']);
            $personas[$i] = $persona;
            $i++;
        }

        $this->conexion->desconectar();
        return $personas;
    }

    public function findAllEmpleados() {
        $this->conexion->conectar();
        $query = "SELECT * FROM persona P JOIN empleado E on P.run = E.run";
        $result = $this->conexion->ejecutar($query);
        $i = 0; //Se inicializa en 0 para las posiciones del arreglo
        $personas = array(); //Se crea un arreglo no se le dice el tamaño
        while ($fila = mysql_fetch_assoc($result)) {
            $persona = new PersonaDTO();
            $persona->setRun($fila['run']);
            $persona->setNombres($fila['nombres']);
            $persona->setApellidos($fila['apellidos']);
            $persona->setfechaNac($fila['fechaNac']);
            $persona->setSexo($fila['sexo']);
            $persona->setDireccion($fila['direccion']);
            $persona->setTelefono($fila['telefono']);
            $persona->setCargo($fila['cargo']);
            $personas[$i] = $persona;
            $i++;
        }
        $this->conexion->desconectar();
        return $personas;
    }

    public function findByRun($run) {
        $this->conexion->conectar();
        $query = "SELECT * FROM persona WHERE run = '" . $run . "'";
        $result = $this->conexion->ejecutar($query);
        $persona = new PersonaDTO();
        while ($fila = mysql_fetch_assoc($result)) {
            $persona->setRun($fila['run']);
            $persona->setNombres($fila['nombres']);
            $persona->setApellidos($fila['apellidos']);
            $persona->setfechaNac($fila['fechaNac']);
            $persona->setSexo($fila['sexo']);
            $persona->setDireccion($fila['direccion']);
            $persona->setTelefono($fila['telefono']);
        }
        $this->conexion->desconectar();
        return $persona;
    }

    public function findLikeAtrr($name) {
        $this->conexion->conectar();
        $query = "SELECT * FROM persona WHERE upper(nombres) LIKE upper('$name%')";
        $result = $this->conexion->ejecutar($query);
        $i = 0;
        $personas = array();
        while ($fila = mysql_fetch_assoc($result)) {
            $persona = new PersonaDTO();
            $persona->setRun($fila['run']);
            $persona->setNombres($fila['nombres']);
            $persona->setApellidos($fila['apellidos']);
            $persona->setfechaNac($fila['fechaNac']);
            $persona->setSexo($fila['sexo']);
            $persona->setDireccion($fila['direccion']);
            $persona->setTelefono($fila['telefono']);
            $personas[$i] = $persona;
            $i++;
        }
        $this->conexion->desconectar();
        return $personas;
    }

    public function save($object) {
        $this->conexion->conectar();
        $query = "INSERT INTO persona (run,nombres,apellidos,fechaNac,sexo, direccion,telefono)"
                . " VALUES ('" . $object->getRun() . "','" . $object->getNombres() . "','" . $object->getApellidos() . "','" . $object->getFechaNac() . "','" . $object->getSexo() . "','" . $object->getDireccion() . "'," . $object->getTelefono() . ")";


        $result = $this->conexion->ejecutar($query);
        $this->conexion->desconectar();
        return $result;
    }

    public function update($object) {
        $this->conexion->conectar();

        $query = "UPDATE persona SET "
                . " nombres = '" . $object->getNombres() . "', "
                . " apellidos = '" . $object->getApellidos() . "', "
                . " fechaNac = '" . $object->getFechaNac() . "', "
                . " sexo = '" . $object->getSexo() . "', "
                . " direccion = '" . $object->getDireccion() . "', "
                . " telefono = " . $object->getTelefono() . " "
                . " WHERE run = '" . $object->getRun() . "'";

        $result = $this->conexion->ejecutar($query);
        $this->conexion->desconectar();
        return $result;
    }

}
