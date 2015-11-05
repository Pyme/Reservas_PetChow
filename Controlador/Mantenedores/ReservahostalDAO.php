<?php
include_once 'Nucleo/ConexionMySQL.php';
include_once '../../Modelo/ReservahostalDTO.php';

class ReservahostalDAO{
    private $conexion;

    public function ReservahostalDAO() {
        $this->conexion = new ConexionMySQL();
    }

    public function delete($idReservaHostal) {
        $this->conexion->conectar();
        $query = "DELETE FROM reservahostal WHERE  idReservaHostal =  ".$idReservaHostal." ";
        $result = $this->conexion->ejecutar($query);
        $this->conexion->desconectar();
        return $result;
    }

    public function findAll() {
        $this->conexion->conectar();
        $query = "SELECT * FROM reservahostal R JOIN estadoreserva E ON R.idEstadoReserva = E.idEstadoReserva";
        $result = $this->conexion->ejecutar($query);
        $i = 0;
        $reservahostals = array();
        while ($fila = mysql_fetch_assoc($result)) {
            $reservahostal = new ReservahostalDTO();
            $reservahostal->setIdReservaHostal($fila['idReservaHostal']);
            $reservahostal->setTipo($fila['tipo']);
            $reservahostal->setFechaInicio($fila['fechaInicio']);
            $reservahostal->setFechaFin($fila['fechaFin']);
            $reservahostal->setFechaReserva($fila['fechaReserva']);
            $reservahostal->setTarifa($fila['tarifa']);
            $reservahostal->setIdEstadoReserva($fila['idEstadoReserva']);
            $reservahostal->setDescripcionEstado($fila['estado']);
            $reservahostal->setIdMascota($fila['idMascota']);
            $reservahostal->setIdCanil($fila['idCanil']);
            $reservahostals[$i] = $reservahostal;
            $i++;
        }
        $this->conexion->desconectar();
        return $reservahostals;
    }

    public function findByID($idReservaHostal) {
        $this->conexion->conectar();
        $query = "SELECT * FROM reservahostal WHERE  idReservaHostal =  ".$idReservaHostal." ";
        $result = $this->conexion->ejecutar($query);
        $reservahostal = new ReservahostalDTO();
        while ($fila = mysql_fetch_assoc($result)) {
            $reservahostal->setIdReservaHostal($fila['idReservaHostal']);
            $reservahostal->setTipo($fila['tipo']);
            $reservahostal->setFechaInicio($fila['fechaInicio']);
            $reservahostal->setFechaFin($fila['fechaFin']);
            $reservahostal->setFechaReserva($fila['fechaReserva']);
            $reservahostal->setTarifa($fila['tarifa']);
            $reservahostal->setIdEstadoReserva($fila['idEstadoReserva']);
            $reservahostal->setIdMascota($fila['idMascota']);
            $reservahostal->setIdCanil($fila['idCanil']);
        }
        $this->conexion->desconectar();
        return $reservahostal;
    }

    public function findLikeAtrr($cadena) {
        $this->conexion->conectar();
        $query = "SELECT * FROM reservahostal WHERE  upper(idReservaHostal) LIKE upper(".$cadena.")  OR  upper(tipo) LIKE upper('".$cadena."')  OR  upper(fechaInicio) LIKE upper('".$cadena."')  OR  upper(fechaFin) LIKE upper('".$cadena."')  OR  upper(fechaReserva) LIKE upper('".$cadena."')  OR  upper(tarifa) LIKE upper(".$cadena.")  OR  upper(idEstadoReserva) LIKE upper(".$cadena.")  OR  upper(idMascota) LIKE upper(".$cadena.")  OR  upper(idCanil) LIKE upper(".$cadena.") ";
        $result = $this->conexion->ejecutar($query);
        $i = 0;
        $reservahostals = array();
        while ($fila = mysql_fetch_assoc($result)) {
            $reservahostal = new ReservahostalDTO();
            $reservahostal->setIdReservaHostal($fila['idReservaHostal']);
            $reservahostal->setTipo($fila['tipo']);
            $reservahostal->setFechaInicio($fila['fechaInicio']);
            $reservahostal->setFechaFin($fila['fechaFin']);
            $reservahostal->setFechaReserva($fila['fechaReserva']);
            $reservahostal->setTarifa($fila['tarifa']);
            $reservahostal->setIdEstadoReserva($fila['idEstadoReserva']);
            $reservahostal->setIdMascota($fila['idMascota']);
            $reservahostal->setIdCanil($fila['idCanil']);
            $reservahostals[$i] = $reservahostal;
            $i++;
        }
        $this->conexion->desconectar();
        return $reservahostals;
    }

    public function save($reservahostal) {
        $this->conexion->conectar();
        $query = "INSERT INTO reservahostal (tipo,fechaInicio,fechaFin,fechaReserva,tarifa,idEstadoReserva,idMascota,idCanil)"
                . " VALUES ('".$reservahostal->getTipo()."' , '".$reservahostal->getFechaInicio()."' , '".$reservahostal->getFechaFin()."' , now() ,  ".$reservahostal->getTarifa()." ,  ".$reservahostal->getIdEstadoReserva()." ,  ".$reservahostal->getIdMascota()." ,  ".$reservahostal->getIdCanil()." )";
        $result = $this->conexion->ejecutar($query);
        $this->conexion->desconectar();
        return $result;
    }

    public function update($reservahostal) {
        $this->conexion->conectar();
        $query = "UPDATE reservahostal SET "
                . "  tipo = '".$reservahostal->getTipo()."' ,"
                . "  fechaInicio = '".$reservahostal->getFechaInicio()."' ,"
                . "  fechaFin = '".$reservahostal->getFechaFin()."' ,"
                . "  fechaReserva = '".$reservahostal->getFechaReserva()."' ,"
                . "  tarifa =  ".$reservahostal->getTarifa()." ,"
                . "  idEstadoReserva =  ".$reservahostal->getIdEstadoReserva()." ,"
                . "  idMascota =  ".$reservahostal->getIdMascota()." ,"
                . "  idCanil =  ".$reservahostal->getIdCanil()." "
                . " WHERE  idReservaHostal =  ".$reservahostal->getIdReservaHostal()." ";
        $result = $this->conexion->ejecutar($query);
        $this->conexion->desconectar();
        return $result;
    }
}