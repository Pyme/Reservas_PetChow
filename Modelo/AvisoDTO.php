<?php
class AvisoDTO {
    public $idAviso;
    public $rutaImagen;
    public $descripcion;
    public $fecha;

    public function AvisoDTO(){
    }

    function getIdAviso() {
        return $this->idAviso;
    }

    function setIdAviso($idAviso) {
        return $this->idAviso = $idAviso;
    }

    function getRutaImagen() {
        return $this->rutaImagen;
    }

    function setRutaImagen($rutaImagen) {
        return $this->rutaImagen = $rutaImagen;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function setDescripcion($descripcion) {
        return $this->descripcion = $descripcion;
    }

    function getFecha() {
        return $this->fecha;
    }

    function setFecha($fecha) {
        return $this->fecha = $fecha;
    }

}