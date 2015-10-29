<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UsuarioDTO
 *
 * @author Joseline
 */
class UsuarioDTO {

    //put your code here
    public $run;
    public $clave;
    public $idPerfil;
    public $nombre;

    function getRun() {
        return $this->run;
    }

    function getClave() {
        return $this->clave;
    }

    function getIdPerfil() {
        return $this->idPerfil;
    }

    function getNombre() {
        return $this->nombre;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setRun($run) {
        $this->run = $run;
    }

    function setClave($clave) {
        $this->clave = $clave;
    }

    function setIdPerfil($idPerfil) {
        $this->idPerfil = $idPerfil;
    }

}
