<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InterfaceDAO
 *
 * @author Joseline
 */
interface InterfaceDAO {

    /**
     * Metodo encargado de buscar todos los objetos de la tabla
     */
    public function findAll();
    /**
     * Busqueda realizada mediante un ID
     * @param type $run
     */
    public function findByRun($run);
    /**
     * Busqueda mediante un parámetro (cohicidencias)
     * @param type $name
     */
    public function findLikeAtrr($name);
    /**
     * Metodo el cual guarda un objeto en la base de datos
     * @param type $object
     */
    public function save($object);
    /**
     * Método encargado de actualizar un objeto
     * @param type $object
     */
    public function update($object);
    /**
     * Metodo que eliminar un objeto en la base de datos segun un ID
     * @param type $run
     */
    public function delete($run);
}
?>