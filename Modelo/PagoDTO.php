<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PagoDTO
 *
 * @author Joseline
 */
class PagoDTO {
    //put your code here
    public $idPago;
    public $fechaPago;
    public $monto;
    public $idReservaHostal;
    
    public function PagoDTO(){
        
    }
    
    function getIdPago() {
        return $this->idPago;
    }

    function getFechaPago() {
        return $this->fechaPago;
    }

    function getMonto() {
        return $this->monto;
    }

    function getIdReservaHostal() {
        return $this->idReservaHostal;
    }

    function setIdPago($idPago) {
        $this->idPago = $idPago;
    }

    function setFechaPago($fechaPago) {
        $this->fechaPago = $fechaPago;
    }

    function setMonto($monto) {
        $this->monto = $monto;
    }

    function setIdReservaHostal($idReservaHostal) {
        $this->idReservaHostal = $idReservaHostal;
    }
}
