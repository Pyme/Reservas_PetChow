<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CanilDTO
 *
 * @author Joseline
 */
class CanilDTO {
    //put your code here
    public $idCanil;
    public $dimension;
    public $tipoCanil;
    
    public function CanilDTO(){
        
    }
    
    function getIdCanil() {
        return $this->idCanil;
    }

    function getDimension() {
        return $this->dimension;
    }

    function getTipoCanil() {
        return $this->tipoCanil;
    }

    function setIdCanil($idCanil) {
        $this->idCanil = $idCanil;
    }

    function setDimension($dimension) {
        $this->dimension = $dimension;
    }

    function setTipoCanil($tipoCanil) {
        $this->tipoCanil = $tipoCanil;
    }
}
