<?php
class EstadoreservaDTO {
    public $idEstadoReserva;
    public $estado;

    public function EstadoreservaDTO(){
    }

    function getIdEstadoReserva() {
        return $this->idEstadoReserva;
    }

    function setIdEstadoReserva($idEstadoReserva) {
        return $this->idEstadoReserva = $idEstadoReserva;
    }

    function getEstado() {
        return $this->estado;
    }

    function setEstado($estado) {
        return $this->estado = $estado;
    }

}