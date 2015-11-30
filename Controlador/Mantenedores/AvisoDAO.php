<?php

include_once 'Nucleo/ConexionMySQL.php';
include_once '../../Modelo/AvisoDTO.php';

class AvisoDAO {

    private $conexion;

    public function AvisoDAO() {
        $this->conexion = new ConexionMySQL();
    }

    public function getID() {
        $this->conexion->conectar();
        $query = "SELECT (max(idAviso)+1) as id FROM aviso";
        $result = $this->conexion->ejecutar($query);
        $id = 0;
        while ($fila = mysql_fetch_assoc($result)) {
             $id = $fila['id'];
        }
        $this->conexion->desconectar();
        if($id == 0){
            $id = 1;
        }
        return $id;
    }

    public function delete($idAviso) {
        $this->conexion->conectar();
        $query = "DELETE FROM aviso WHERE  idAviso =  " . $idAviso . " ";
        $result = $this->conexion->ejecutar($query);
        $this->conexion->desconectar();
        return $result;
    }

    public function findAll() {
        $this->conexion->conectar();
        $query = "SELECT * FROM aviso";
        $result = $this->conexion->ejecutar($query);
        $i = 0;
        $avisos = array();
        while ($fila = mysql_fetch_assoc($result)) {
            $aviso = new AvisoDTO();
            $aviso->setIdAviso($fila['idAviso']);
            $aviso->setRutaImagen($fila['rutaImagen']);
            $aviso->setDescripcion($fila['descripcion']);
            $aviso->setFecha($fila['fecha']);
            $avisos[$i] = $aviso;
            $i++;
        }
        $this->conexion->desconectar();
        return $avisos;
    }

    public function findByID($idAviso) {
        $this->conexion->conectar();
        $query = "SELECT * FROM aviso WHERE  idAviso =  " . $idAviso . " ";
        $result = $this->conexion->ejecutar($query);
        $aviso = new AvisoDTO();
        while ($fila = mysql_fetch_assoc($result)) {
            $aviso->setIdAviso($fila['idAviso']);
            $aviso->setRutaImagen($fila['rutaImagen']);
            $aviso->setDescripcion($fila['descripcion']);
            $aviso->setFecha($fila['fecha']);
        }
        $this->conexion->desconectar();
        return $aviso;
    }

    public function findLikeAtrr($cadena) {
        $this->conexion->conectar();
        $query = "SELECT * FROM aviso WHERE  upper(idAviso) LIKE upper(" . $cadena . ")  OR  upper(rutaImagen) LIKE upper('" . $cadena . "')  OR  upper(descripcion) LIKE upper('" . $cadena . "')  OR  upper(fecha) LIKE upper('" . $cadena . "') ";
        $result = $this->conexion->ejecutar($query);
        $i = 0;
        $avisos = array();
        while ($fila = mysql_fetch_assoc($result)) {
            $aviso = new AvisoDTO();
            $aviso->setIdAviso($fila['idAviso']);
            $aviso->setRutaImagen($fila['rutaImagen']);
            $aviso->setDescripcion($fila['descripcion']);
            $aviso->setFecha($fila['fecha']);
            $avisos[$i] = $aviso;
            $i++;
        }
        $this->conexion->desconectar();
        return $avisos;
    }

    public function save($aviso) {
        $this->conexion->conectar();
        $query = "INSERT INTO aviso (idAviso,rutaImagen,descripcion,fecha)"
                . " VALUES ( " . $aviso->getIdAviso() . " , '" . $aviso->getRutaImagen() . "' , '" . $aviso->getDescripcion() . "' , now() )";
        $result = $this->conexion->ejecutar($query);
        $this->conexion->desconectar();
        return $result;
    }

    public function update($aviso) {
        $this->conexion->conectar();
        $query = "UPDATE aviso SET "
                . "  descripcion = '" . $aviso->getDescripcion() . "' ,"
                . "  fecha = now() "
                . " WHERE idAviso =  " . $aviso->getIdAviso() . " ";
        $result = $this->conexion->ejecutar($query);
        $this->conexion->desconectar();
        return $result;
    }

}
