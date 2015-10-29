<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MascotaDTO
 *
 * @author Joseline
 */
class MascotaDTO {

    //put your code here
    public $idMascota;
    public $raza;
    public $nombre;
    public $run;

    function getIdMascota() {
        return $this->idMascota;
    }

    function getRaza() {
        return $this->raza;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getRun() {
        return $this->run;
    }

    function setIdMascota($idMascota) {
        $this->idMascota = $idMascota;
    }

    function setRaza($raza) {
        $this->raza = $raza;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setRun($run) {
        $this->run = $run;
    }

}
