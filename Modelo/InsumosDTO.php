<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InsumosDTO
 *
 * @author Joseline
 */
class InsumosDTO {
    //put your code here
    public $idInsumos;
    public $nombre;
    public $stock;
    public $precio;
    
    public function InsumosDTO(){
        
    }
    function getIdInsumos() {
        return $this->idInsumos;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getStock() {
        return $this->stock;
    }

    function getPrecio() {
        return $this->precio;
    }

    function setIdInsumos($idInsumos) {
        $this->idInsumos = $idInsumos;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setStock($stock) {
        $this->stock = $stock;
    }

    function setPrecio($precio) {
        $this->precio = $precio;
    }    
}