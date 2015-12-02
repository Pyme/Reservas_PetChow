<?php

include_once 'Nucleo/ConexionMySQL.php';
include_once '../../Modelo/ReservahostalDTO.php';
include_once 'InterfaceDAO.php';

class ReservahostalDAO implements InterfaceDAO{

    private $conexion;

    public function ReservahostalDAO() {
        $this->conexion = new ConexionMySQL();
    }

    public function getID() {//Obtiene un id disponible de la BD
        $this->conexion->conectar();
        $query = "SELECT (max(idReservaHostal)+1) as id FROM reservahostal";
        $result = $this->conexion->ejecutar($query);
        $id = 0;
        while ($fila = mysql_fetch_assoc($result)) {
            $id = $fila['id'];
        }
        return $id;
    }

    public function delete($idReservaHostal) {
        $this->conexion->conectar();
        $query = "DELETE FROM reservahostal WHERE  idReservaHostal =  " . $idReservaHostal . " ";
        $result = $this->conexion->ejecutar($query);
        $this->conexion->desconectar();
        return $result;
    }

    public function findAll() {//mostrar todas las reservas
        $this->conexion->conectar();
        $query = "SELECT * FROM reservahostal R JOIN estadoreserva E ON R.idEstadoReserva = E.idEstadoReserva JOIN mascota M ON R.idMascota = M.idMascota ";
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
            $reservahostal->setRun($fila['run']);
            $reservahostals[$i] = $reservahostal;
            $i++;
        }
        $this->conexion->desconectar();
        return $reservahostals;
    }

    public function findByID($idReservaHostal) {
        $this->conexion->conectar();
        $query = "SELECT * FROM reservahostal R JOIN mascota M ON R.idMascota = M.idMascota WHERE  R.idReservaHostal =  " . $idReservaHostal . " ";
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
            $reservahostal->setRun($fila['run']);
        }
        $this->conexion->desconectar();
        return $reservahostal;
    }

    public function findByRun($run) {
        $this->conexion->conectar();
        $query = "SELECT * FROM reservahostal R JOIN estadoreserva E ON R.idEstadoReserva = E.idEstadoReserva JOIN mascota M ON R.idMascota = M.idMascota  WHERE  M.run = '".$run."'";
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
            $reservahostal->setRun($fila['run']);
            $reservahostals[$i] = $reservahostal;
            $i++;
        }
        $this->conexion->desconectar();
        return $reservahostals;
    }

    public function findLikeAtrr($cadena) {
        $this->conexion->conectar();
        $query = "SELECT * FROM reservahostal R JOIN mascota M ON R.idMascota = M.idMascota JOIN estadoreserva E ON R.idEstadoReserva = E.idEstadoReserva WHERE upper(M.run) LIKE upper('%" . $cadena . "%') ";
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
            $reservahostal->setDescripcionEstado($fila['estado']);
            $reservahostal->setRun($fila['run']);
            $reservahostals[$i] = $reservahostal;
            $i++;
        }
        $this->conexion->desconectar();
        return $reservahostals;
    }

    public function getEntreFechas($desde, $hasta) {//metodo para reporte
        $this->conexion->conectar();
        $query = "SELECT * FROM reservahostal R JOIN mascota M ON R.idMascota = M.idMascota JOIN estadoreserva E ON R.idEstadoReserva = E.idEstadoReserva WHERE (R.fechaReserva >= '$desde' AND R.fechaReserva <= '$hasta')";
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
            $reservahostal->setDescripcionEstado($fila['estado']);
            $reservahostal->setRun($fila['run']);
            $reservahostals[$i] = $reservahostal;
            $i++;
        }
        $this->conexion->desconectar();
        return $reservahostals;
    }

    public function save($reservahostal) {
        $this->conexion->conectar();
        $query = "INSERT INTO reservahostal (idReservaHostal,tipo,fechaInicio,fechaFin,fechaReserva,tarifa,idEstadoReserva,idMascota,idCanil)"
                . " VALUES (" . $reservahostal->getIdReservaHostal() . ",'" . $reservahostal->getTipo() . "' , '" . $reservahostal->getFechaInicio() . "' , '" . $reservahostal->getFechaFin() . "' , now() ,  " . $reservahostal->getTarifa() . " ,  " . $reservahostal->getIdEstadoReserva() . " ,  " . $reservahostal->getIdMascota() . " ,  " . $reservahostal->getIdCanil() . " )";
        $result = $this->conexion->ejecutar($query);
        $this->conexion->desconectar();
        return $result;
    }

    public function update($reservahostal) {
        $this->conexion->conectar();
        $query = "UPDATE reservahostal SET "
                . "  tipo = '" . $reservahostal->getTipo() . "' ,"
                . "  fechaInicio = '" . $reservahostal->getFechaInicio() . "' ,"
                . "  fechaFin = '" . $reservahostal->getFechaFin() . "' ,"
                . "  tarifa =  " . $reservahostal->getTarifa() . " ,"
                . "  idEstadoReserva =  " . $reservahostal->getIdEstadoReserva() . " ,"
                . "  idMascota =  " . $reservahostal->getIdMascota() . " ,"
                . "  idCanil =  " . $reservahostal->getIdCanil() . " "
                . " WHERE  idReservaHostal =  " . $reservahostal->getIdReservaHostal() . " ";
        $result = $this->conexion->ejecutar($query);
        $this->conexion->desconectar();
        return $result;
    }

}
