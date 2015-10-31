<?php

include_once 'Nucleo/ConexionMySQL.php';
include_once '../../Modelo/PagoDTO.php';
include_once 'InterfaceDAO.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PagoDAO
 *
 * @author Joseline
 */
class PagoDAO implements InterfaceDAO {

    private $conexion;

    public function PagoDAO() {
        $this->conexion = new ConexionMySQL();
    }

    public function delete($idPago) {
        $this->conexion->conectar();
        $query = "DELETE FROM pago WHERE idPago = " . $idPago;
        $result = $this->conexion->ejecutar($query);
        $this->conexion->desconectar();
        return $result;
    }

    public function findAll() {
        $this->conexion->conectar();
        $query = "SELECT * FROM pago ";
        $result = $this->conexion->ejecutar($query);
        $i = 0; //Se inicializa en 0 para las posiciones del arreglo
        $pagos = array(); //Se crea un arreglo no se le dice el tamaño
        while ($fila = mysql_fetch_assoc($result)) {
            $pago = new PagoDTO();
            $pago->setIdPago($fila['idPago']);
            $pago->setFechaPago($fila['fechaPago']);
            $pago->setMonto($fila['monto']);
            $pago->setIdReservaHostal($fila['idReservaHostal']);            
            $pagos[$i] = $pago;
            $i++;
        }
        $this->conexion->desconectar();
        return $pagos;
    }

    public function findByRun($run) {
        
    }

    public function findLikeAtrr($name) {
        
    }

    public function save($object) {
        $this->conexion->conectar();
        $query = "INSERT INTO pago (idPago,fechaPago,monto,idReservaHostal)"
                . " VALUES (" . $object->getIdPago() . ",". $object->getFechaPago() . ",". $object->getMonto() . ",". $object->getIdReservaHostal() . ")";
        $result = $this->conexion->ejecutar($query);
        $this->conexion->desconectar();
        return $result;
    }

    public function update($object) {
        $this->conexion->conectar();

        $query = "UPDATE pago SET "
                . " fechaPago = " . $object->getFechaPago() . ", "
                . " monto = " . $object->getMonto() . ", "
                . " idReservaHostal = " . $object->getIdReservaHostal() . " "
                . " WHERE idPago = " . $object->getIdPago();

        $result = $this->conexion->ejecutar($query);
        $this->conexion->desconectar();
        return $result;
    }
}
