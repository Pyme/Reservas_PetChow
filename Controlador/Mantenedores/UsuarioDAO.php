<?php

include_once 'Nucleo/ConexionMySQL.php';
include_once '../../Modelo/UsuarioDTO.php';
include_once 'InterfaceDAO.php';

/**
 * Description of UsuarioDAO
 *
 * @author Joseline
 */
class UsuarioDAO implements InterfaceDAO {

    private $conexion;

    public function UsuarioDAO() {
        $this->conexion = new ConexionMySQL();
    }

    public function delete($run) {
        $this->conexion->conectar();
        $query = "DELETE FROM usuario WHERE run = '" . $run."'";
        $result = $this->conexion->ejecutar($query);
        $this->conexion->desconectar();
        return $result;
    }

    public function findAll() {
        $this->conexion->conectar();
        $query = "SELECT * FROM usuario JOIN perfil ON usuario.run = perfil.run";
        $result = $this->conexion->ejecutar($query);
        $i = 0; //Se inicializa en 0 para las posiciones del arreglo
        $usuarios = array(); //Se crea un arreglo no se le dice el tamaño
        while ($fila = mysql_fetch_assoc($result)) {
            $usuario = new UsuarioDTO();
            $usuario->setRun($fila['run']);
            $usuario->setClave($fila['clave']);
            $usuario->setIdPerfil($fila['idPerfil']);
            $usuario->setNombre($fila['nombre']);
            $usuarios[$i] = $usuario;
            $i++;
        }

        $this->conexion->desconectar();
        return $usuarios;
    }

    public function findByRun($run) {
        $this->conexion->conectar();
        $query = "SELECT u.run, u.clave, p.idPerfil, p.nombre FROM usuario u JOIN perfil p on u.idPerfil = p.idPerfil WHERE u.run = '" . $run."'";
        $result = $this->conexion->ejecutar($query);
        $usuario = new UsuarioDTO();
        while ($fila = mysql_fetch_assoc($result)) {
            $usuario->setRun($fila['run']);
            $usuario->setClave($fila['clave']);
            $usuario->setIdPerfil($fila['idPerfil']);
            $usuario->setNombre($fila['nombre']);
        }
        $this->conexion->desconectar();
        return $usuario;
    }

    public function findLikeAtrr($run) {
        $this->conexion->conectar();
        $query = "SELECT u.run, u.clave, p.idPerfil, p.nombre FROM usuario u JOIN perfil p ON u.idPerfil = p.idPerfil WHERE u.run LIKE ('$run%')";
        $result = $this->conexion->ejecutar($query);
        $i = 0;
        $usuarios = array();
        while ($fila = mysql_fetch_assoc($result)) {
            $usuario = new UsuarioDTO();
            $usuario->setRun($fila['run']);
            $usuario->setClave($fila['clave']);
            $usuario->setIdPerfil($fila['idPerfil']);
            $usuario->setNombre($fila['nombre']);
            $usuarios[$i] = $usuario;
            $i++;
        }
        $this->conexion->desconectar();
        return $usuarios;
    }

    public function save($object) {
        $this->conexion->conectar();
        $query = "INSERT INTO usuario (run, clave, idPerfil) VALUES ('" . $object->getRun() . "','" . $object->getClave() . "', " . $object->getIdPerfil() . ")";
        $result = $this->conexion->ejecutar($query);
        $this->conexion->desconectar();
        return $result;
    }

    public function update($object) {
        $this->conexion->conectar();
        $query = "UPDATE usuario SET "
                . " idPerfil = " . $object->getIdPerfil() . ", "
                . " clave = '" . $object->getClave() . "' "
                . " WHERE run = '" . $object->getRun()."'";

        $result = $this->conexion->ejecutar($query);
        $this->conexion->desconectar();
        return $result;
    }

//put your code here
}
