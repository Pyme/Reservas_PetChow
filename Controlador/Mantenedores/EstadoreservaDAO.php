<?php
include_once 'Nucleo/ConexionMySQL.php';
include_once '../../Modelo/EstadoreservaDTO.php';

class EstadoreservaDAO{
    private $conexion;

    public function EstadoreservaDAO() {
        $this->conexion = new ConexionMySQL();
    }

    public function delete($idEstadoReserva) {
        $this->conexion->conectar();
        $query = "DELETE FROM estadoreserva WHERE  idEstadoReserva =  ".$idEstadoReserva." ";
        $result = $this->conexion->ejecutar($query);
        $this->conexion->desconectar();
        return $result;
    }

    public function findAll() {
        $this->conexion->conectar();
        $query = "SELECT * FROM estadoreserva";
        $result = $this->conexion->ejecutar($query);
        $i = 0;
        $estadoreservas = array();
        while ($fila = mysql_fetch_assoc($result)) {
            $estadoreserva = new EstadoreservaDTO();
            $estadoreserva->setIdEstadoReserva($fila['idEstadoReserva']);
            $estadoreserva->setEstado($fila['estado']);
            $estadoreservas[$i] = $estadoreserva;
            $i++;
        }
        $this->conexion->desconectar();
        return $estadoreservas;
    }

    public function findByID($idEstadoReserva) {
        $this->conexion->conectar();
        $query = "SELECT * FROM estadoreserva WHERE  idEstadoReserva =  ".$idEstadoReserva." ";
        $result = $this->conexion->ejecutar($query);
        $estadoreserva = new EstadoreservaDTO();
        while ($fila = mysql_fetch_assoc($result)) {
            $estadoreserva->setIdEstadoReserva($fila['idEstadoReserva']);
            $estadoreserva->setEstado($fila['estado']);
        }
        $this->conexion->desconectar();
        return $estadoreserva;
    }

    public function findLikeAtrr($cadena) {
        $this->conexion->conectar();
        $query = "SELECT * FROM estadoreserva WHERE  upper(idEstadoReserva) LIKE upper(".$cadena.")  OR  upper(estado) LIKE upper('".$cadena."') ";
        $result = $this->conexion->ejecutar($query);
        $i = 0;
        $estadoreservas = array();
        while ($fila = mysql_fetch_assoc($result)) {
            $estadoreserva = new EstadoreservaDTO();
            $estadoreserva->setIdEstadoReserva($fila['idEstadoReserva']);
            $estadoreserva->setEstado($fila['estado']);
            $estadoreservas[$i] = $estadoreserva;
            $i++;
        }
        $this->conexion->desconectar();
        return $estadoreservas;
    }

    public function save($estadoreserva) {
        $this->conexion->conectar();
        $query = "INSERT INTO estadoreserva (idEstadoReserva,estado)"
                . " VALUES ( ".$estadoreserva->getIdEstadoReserva()." , '".$estadoreserva->getEstado()."' )";
        $result = $this->conexion->ejecutar($query);
        $this->conexion->desconectar();
        return $result;
    }

    public function update($estadoreserva) {
        $this->conexion->conectar();
        $query = "UPDATE estadoreserva SET "
                . "  estado = '".$estadoreserva->getEstado()."' "
                . " WHERE  idEstadoReserva =  ".$estadoreserva->getIdEstadoReserva()." ";
        $result = $this->conexion->ejecutar($query);
        $this->conexion->desconectar();
        return $result;
    }
}