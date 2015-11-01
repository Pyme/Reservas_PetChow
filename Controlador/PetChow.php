<?php

include_once 'Mantenedores/PersonaDAO.php';
include_once 'Mantenedores/UsuarioDAO.php';
include_once 'Mantenedores/MascotaDAO.php';
include_once 'Mantenedores/CanilDAO.php';
include_once 'Mantenedores/PagoDAO.php';
include_once 'Mantenedores/EmpleadoDAO.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class PetChow {

    private static $instancia = NULL;
    private $personaDAO;
    private $usuarioDAO;
    private $mascotaDAO;
    private $canilDAO;
    private $pagoDAO;
    private $empleadoDAO;

    public function PetChow() {
        $this->personaDAO = new PersonaDAO();
        $this->usuarioDAO = new UsuarioDAO();
        $this->mascotaDAO = new MascotaDAO();
        $this->canilDAO = new CanilDAO();
        $this->pagoDAO = new PagoDAO();
        $this->empleadoDAO = new EmpleadoDAO();
    }

    public static function getInstancia() {
        if (self::$instancia == NULL) {
            self::$instancia = new PetChow();
        }
        return self::$instancia;
    }  

    public function getAllUsuarios() {
        return $this->usuarioDAO->findAll();
    }

    public function addUsuario($usuario) {
        return $this->usuarioDAO->save($usuario);
    }

    public function removeUsuario($run) {
        return $this->usuarioDAO->delete($run);
    }

    public function updateUsuario($usuario) {
        return $this->usuarioDAO->update($usuario);
    }

    public function getUsuarioByRun($run) {
        return $this->usuarioDAO->findByRun($run);
    }

    public function getAllPersonas() {
        return $this->personaDAO->findAll();
    }    

    public function addPersona($persona) {
        return $this->personaDAO->save($persona);
    }

    public function removePersona($run) {
        return $this->personaDAO->delete($run);
    }

    public function updatePersona($persona) {
        return $this->personaDAO->update($persona);
    }

    public function getPersonasByName($name) {
        return $this->personaDAO->findLikeAtrr($name);
    }

    public function getPersonaByRun($run) {
        return $this->personaDAO->findByRun($run);
    }

    public function getAllMascotas() {
        return $this->mascotaDAO->findAll();
    }

    public function addMascota($mascota) {
        return $this->mascotaDAO->save($mascota);
    }

    public function removeMascota($idMascota) {
        return $this->mascotaDAO->delete($idMascota);
    }

    public function updateMascota($mascota) {
        return $this->mascotaDAO->update($mascota);
    }

    public function getMascotasByName($name) {
        return $this->mascotaDAO->findLikeAtrr($name);
    }

    public function getMascotaByIdMascota($idMascota) {
        return $this->mascotaDAO->findByIdMascota($idMascota);
    }
    public function getMascotaByRunDueño($run) {
        return $this->mascotaDAO->findByRun($run);
    }
    public function deleteCanil($idCanil){
        return $this->canilDAO->delete($idCanil);
    }
    
    public function getAllCanil(){
        return $this->canilDAO->findAll();
    }
    
    public function getCanilById($idCanil){
        return $this->canilDAO->findByIdCanil($idCanil);
    }
    
    public function saveCanil($canil){
        return $this->canilDAO->save($canil);;
    }
    
    public function updateCanil($canil){
        return $this->canilDAO->update($canil);
    }
    
    public function deletePago($idPago){
        return $this->pagoDAO->delete($idPago);
    }
    
    public function getAllPagos(){
        return $this->pagoDAO->findAll();
    }
    
    public function savePago($pago){
        return $this->pagoDAO->save($pago);
    }
    
    public function updatePago($pago){
        return $this->pagoDAO->update($pago);
    }
    
    public function getAllEmpleados() {
        return $this->empleadoDAO->findAll();
    }
    
    public function deleteEmpleado($run){
        return $this->empleadoDAO->delete($run);
    }
    
    public function getEmpleadoByRun($run) {
        return $this->empleadoDAO->findByRun($run);
    }
    
    public function getEmpleadoByName($name) {
        return $this->empleadoDAO->findLikeAtrr($name);
    }
    
    public function saveEmpleado($empleado) {
        return $this->empleadoDAO->save($empleado);
    }
    
    public function updateEmpleado($empleado) {
        return $this->empleadoDAO->update($empleado);
    }
}
