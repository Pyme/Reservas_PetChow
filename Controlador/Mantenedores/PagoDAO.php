<?php
include_once 'Nucleo/ConexionMySQL.php';
include_once '../../Modelo/PagoDTO.php';

class PagoDAO{
    private $conexion;

    public function PagoDAO() {
        $this->conexion = new ConexionMySQL();
    }

    public function delete($idPago) {
        $this->conexion->conectar();
        $query = "DELETE FROM pago WHERE  idPago =  ".$idPago." ";
        $result = $this->conexion->ejecutar($query);
        $this->conexion->desconectar();
        return $result;
    }

    public function findAll() {
        $this->conexion->conectar();
        $query = "SELECT * FROM pago";
        $result = $this->conexion->ejecutar($query);
        $i = 0;
        $pagos = array();
        while ($fila = mysql_fetch_assoc($result)) {
            $pago = new PagoDTO();
            $pago->setIdPago($fila['idPago']);
            $pago->setFechaPago($fila['fechaPago']);
            $pago->setMonto($fila['monto']);
            $pago->setIdReservaHostal($fila['idReservaHostal']);
            $pagos[$i] = $pago;
            $i++;
        }
        $this->conexion->desconectar();
        return $pagos;
    }

    public function findByID($idPago) {
        $this->conexion->conectar();
        $query = "SELECT * FROM pago WHERE  idPago =  ".$idPago." ";
        $result = $this->conexion->ejecutar($query);
        $pago = new PagoDTO();
        while ($fila = mysql_fetch_assoc($result)) {
            $pago->setIdPago($fila['idPago']);
            $pago->setFechaPago($fila['fechaPago']);
            $pago->setMonto($fila['monto']);
            $pago->setIdReservaHostal($fila['idReservaHostal']);
        }
        $this->conexion->desconectar();
        return $pago;
    }
    
    public function findByIDReserva($idReserva) {
        $this->conexion->conectar();
        $query = "SELECT * FROM pago WHERE idReservaHostal =  ".$idReserva." ";
        $result = $this->conexion->ejecutar($query);
        $pago = new PagoDTO();
        while ($fila = mysql_fetch_assoc($result)) {
            $pago->setIdPago($fila['idPago']);
            $pago->setFechaPago($fila['fechaPago']);
            $pago->setMonto($fila['monto']);
            $pago->setIdReservaHostal($fila['idReservaHostal']);
        }
        $this->conexion->desconectar();
        return $pago;
    }

    public function findLikeAtrr($cadena) {
        $this->conexion->conectar();
        $query = "SELECT * FROM pago WHERE  upper(idPago) LIKE upper(".$cadena.")  OR  upper(fechaPago) LIKE upper('".$cadena."')  OR  upper(monto) LIKE upper(".$cadena.")  OR  upper(idReservaHostal) LIKE upper(".$cadena.") ";
        $result = $this->conexion->ejecutar($query);
        $i = 0;
        $pagos = array();
        while ($fila = mysql_fetch_assoc($result)) {
            $pago = new PagoDTO();
            $pago->setIdPago($fila['idPago']);
            $pago->setFechaPago($fila['fechaPago']);
            $pago->setMonto($fila['monto']);
            $pago->setIdReservaHostal($fila['idReservaHostal']);
            $pagos[$i] = $pago;
            $i++;
        }
        $this->conexion->desconectar();
        return $pagos;
    }

    public function save($pago) {
        $this->conexion->conectar();
        $query = "INSERT INTO pago (fechaPago,monto,idReservaHostal)"
                . " VALUES ( now() ,  ".$pago->getMonto()." ,  ".$pago->getIdReservaHostal()." )";
        $result = $this->conexion->ejecutar($query);
        $this->conexion->desconectar();
        return $result;
    }

    public function update($pago) {
        $this->conexion->conectar();
        $query = "UPDATE pago SET "
                . "  fechaPago = '".$pago->getFechaPago()."' ,"
                . "  monto =  ".$pago->getMonto()." ,"
                . "  idReservaHostal =  ".$pago->getIdReservaHostal()." "
                . " WHERE  idPago =  ".$pago->getIdPago()." ";
        $result = $this->conexion->ejecutar($query);
        $this->conexion->desconectar();
        return $result;
    }
     public function getPagoEntreFechas($desde, $hasta) {
        $this->conexion->conectar();
        $query = "SELECT * FROM pago P JOIN reservahostal R ON P.idReservaHostal = R.idReservaHostal WHERE (P.fechaPago >= '$desde' AND P.fechaPago <= '$hasta')";
        $result = $this->conexion->ejecutar($query);
        $i = 0;
        $pagos = array();
        while ($fila = mysql_fetch_assoc($result)) {
            $pago = new PagoDTO();
            $pago->setIdPago($fila['idPago']);
            $pago->setFechaPago($fila['fechaPago']);
            $pago->setFechaMonto($fila['monto']);
            $pago->setIdReservaHostal($fila['idReservaHostal']);
            
            $pagos[$i] = $pago;
            $i++;
        }
        $this->conexion->desconectar();
        return $pagos;
    }
}