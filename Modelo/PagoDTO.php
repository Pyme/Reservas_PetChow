<?php
class PagoDTO {
    public $idPago;
    public $fechaPago;
    public $monto;
    public $idReservaHostal;

    public function PagoDTO(){
    }

    function getIdPago() {
        return $this->idPago;
    }

    function setIdPago($idPago) {
        return $this->idPago = $idPago;
    }

    function getFechaPago() {
        return $this->fechaPago;
    }

    function setFechaPago($fechaPago) {
        return $this->fechaPago = $fechaPago;
    }

    function getMonto() {
        return $this->monto;
    }

    function setMonto($monto) {
        return $this->monto = $monto;
    }

    function getIdReservaHostal() {
        return $this->idReservaHostal;
    }

    function setIdReservaHostal($idReservaHostal) {
        return $this->idReservaHostal = $idReservaHostal;
    }

}