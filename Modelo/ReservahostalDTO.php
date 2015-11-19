<?php
class ReservahostalDTO {
    public $idReservaHostal;
    public $tipo;
    public $fechaInicio;
    public $fechaFin;
    public $fechaReserva;
    public $tarifa;
    public $idEstadoReserva;
    public $descripcionEstado;
    public $idMascota;
    public $idCanil;
    public $run;

    public function ReservahostalDTO(){
    }
    function getRun() {
        return $this->run;
    }

    function setRun($run) {
        $this->run = $run;
    }

    function getIdReservaHostal() {
        return $this->idReservaHostal;
    }

    function setIdReservaHostal($idReservaHostal) {
        return $this->idReservaHostal = $idReservaHostal;
    }

    function getTipo() {
        return $this->tipo;
    }

    function setTipo($tipo) {
        return $this->tipo = $tipo;
    }

    function getFechaInicio() {
        return $this->fechaInicio;
    }

    function setFechaInicio($fechaInicio) {
        return $this->fechaInicio = $fechaInicio;
    }

    function getFechaFin() {
        return $this->fechaFin;
    }

    function setFechaFin($fechaFin) {
        return $this->fechaFin = $fechaFin;
    }

    function getFechaReserva() {
        return $this->fechaReserva;
    }

    function setFechaReserva($fechaReserva) {
        return $this->fechaReserva = $fechaReserva;
    }

    function getTarifa() {
        return $this->tarifa;
    }

    function setTarifa($tarifa) {
        return $this->tarifa = $tarifa;
    }

    function getIdEstadoReserva() {
        return $this->idEstadoReserva;
    }

    function setIdEstadoReserva($idEstadoReserva) {
        return $this->idEstadoReserva = $idEstadoReserva;
    }

    function getIdMascota() {
        return $this->idMascota;
    }

    function setIdMascota($idMascota) {
        return $this->idMascota = $idMascota;
    }

    function getIdCanil() {
        return $this->idCanil;
    }

    function setIdCanil($idCanil) {
        return $this->idCanil = $idCanil;
    }
    
    function getDescripcionEstado() {
        return $this->descripcionEstado;
    }

    function setDescripcionEstado($descripcionEstado) {
        $this->descripcionEstado = $descripcionEstado;
    }
}