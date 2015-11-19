<?php

include_once '../../Controlador/PetChow.php';

$control = PetChow::getInstancia();

$accion = htmlspecialchars($_REQUEST['accion']);
if ($accion != null) {
    if ($accion == "LISTADO") {
        $reservahostals = $control->getAllReservahostals();
        $json = json_encode($reservahostals);
        echo $json;
    } else if ($accion == "AGREGAR") {
        $tipo = htmlspecialchars($_REQUEST['tipo']);
        $fechaInicio = htmlspecialchars($_REQUEST['fechaInicio']);
        $fechaFin = htmlspecialchars($_REQUEST['fechaFin']);
        $tarifa = htmlspecialchars($_REQUEST['tarifa']);
        $idEstadoReserva = htmlspecialchars($_REQUEST['idEstadoReserva']);
        $idMascota = htmlspecialchars($_REQUEST['idMascota']);
        $idCanil = htmlspecialchars($_REQUEST['idCanil']);

        $reservahostal = new ReservahostalDTO();
        $reservahostal->setTipo($tipo);
        $reservahostal->setFechaInicio($fechaInicio);
        $reservahostal->setFechaFin($fechaFin);
        $reservahostal->setTarifa($tarifa);
        $reservahostal->setIdEstadoReserva($idEstadoReserva);
        $reservahostal->setIdMascota($idMascota);
        $reservahostal->setIdCanil($idCanil);

        $result = $control->addReservahostal($reservahostal);

        if ($result) {
            echo json_encode(array(
                'success' => true,
                'mensaje' => "Reserva hostal ingresada correctamente"
            ));
        } else {
            echo json_encode(array('errorMsg' => 'Ha ocurrido un error.'));
        }
    } else if ($accion == "BORRAR") {
        $idReservaHostal = htmlspecialchars($_REQUEST['idReservaHostal']);

        $result = $control->removeReservahostal($idReservaHostal);
        if ($result) {
            echo json_encode(array('success' => true, 'mensaje' => "Reserva hostal borrado correctamente"));
        } else {
            echo json_encode(array('errorMsg' => 'Ha ocurrido un error.'));
        }
    } else if ($accion == "BUSCAR") {
        $cadena = htmlspecialchars($_REQUEST['cadena']);
        $reservahostals = $control->getReservahostalLikeAtrr($cadena);
        $json = json_encode($reservahostals);
        echo $json;
    } else if ($accion == "BUSCAR_BY_ID") {
        $idReservaHostal = htmlspecialchars($_REQUEST['idReservaHostal']);

        $reservahostal = $control->getReservahostalByID($idReservaHostal);
        $json = json_encode($reservahostal);
        echo $json;
    } else if ($accion == "ACTUALIZAR") {
        $idReservaHostal = htmlspecialchars($_REQUEST['idReservaHostal']);
        $tipo = htmlspecialchars($_REQUEST['tipo']);
        $fechaInicio = htmlspecialchars($_REQUEST['fechaInicio']);
        $fechaFin = htmlspecialchars($_REQUEST['fechaFin']);
        $tarifa = htmlspecialchars($_REQUEST['tarifa']);
        $idEstadoReserva = htmlspecialchars($_REQUEST['idEstadoReserva']);
        $idMascota = htmlspecialchars($_REQUEST['idMascota']);
        $idCanil = htmlspecialchars($_REQUEST['idCanil']);
        $estadoPago = htmlspecialchars($_REQUEST['pago']);

        $permitir = TRUE;
        if ($idEstadoReserva == 2) {
            if ($estadoPago != 2) {
                $permitir = FALSE;
            }
        }
        if ($permitir) {

            $reservahostal = new ReservahostalDTO();
            $reservahostal->setIdReservaHostal($idReservaHostal);
            $reservahostal->setTipo($tipo);
            $reservahostal->setFechaInicio($fechaInicio);
            $reservahostal->setFechaFin($fechaFin);
            $reservahostal->setTarifa($tarifa);
            $reservahostal->setIdEstadoReserva($idEstadoReserva);
            $reservahostal->setIdMascota($idMascota);
            $reservahostal->setIdCanil($idCanil);
            
            $pago = new PagoDTO();
            $pago->setIdReservaHostal($idReservaHostal);
            $pago->setMonto($tarifa);

            $result = $control->updateReservahostal($reservahostal);
            
            if($result){
                $result = $control->addPago($pago);
            }
            
            if ($result) {
                echo json_encode(array(
                    'success' => true,
                    'mensaje' => "Reservahostal actualizada correctamente"
                ));
            } else {
                echo json_encode(array('errorMsg' => 'Ha ocurrido un error.'));
            }
        }else{
            echo json_encode(array('errorMsg' => 'Debe realizar el pago.'));
        }
    }
}
