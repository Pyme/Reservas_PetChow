<?php

include_once '../../Controlador/PetChow.php';

$control = PetChow::getInstancia();

$accion = htmlspecialchars($_REQUEST['accion']);
if ($accion != null) {
    if ($accion == "LISTADO") {
        $pagos = $control->getAllPagos();
        $json = json_encode($pagos);
        echo $json;
    } else if ($accion == "AGREGAR") {
        $idPago = htmlspecialchars($_REQUEST['idPago']);
        $fechaPago = htmlspecialchars($_REQUEST['fechaPago']);
        $monto = htmlspecialchars($_REQUEST['monto']);
        $idReservaHostal = htmlspecialchars($_REQUEST['idReservaHostal']);

        $object = $control->getPagoByID($idPago);
        if (($object->getIdPago() == null || $object->getIdPago() == "")) {
            $pago = new PagoDTO();
            $pago->setIdPago($idPago);
            $pago->setFechaPago($fechaPago);
            $pago->setMonto($monto);
            $pago->setIdReservaHostal($idReservaHostal);

            $result = $control->addPago($pago);

            if ($result) {
                echo json_encode(array(
                    'success' => true,
                    'mensaje' => "Pago ingresada correctamente"
                ));
            } else {
                echo json_encode(array('errorMsg' => 'Ha ocurrido un error.'));
            }
        } else {
            echo json_encode(array('errorMsg' => 'El o la pago ya existe, intento nuevamente.'));
        }
    } else if ($accion == "BORRAR") {
        $idPago = htmlspecialchars($_REQUEST['idPago']);

        $result = $control->removePago($idPago);
        if ($result) {
            echo json_encode(array('success' => true, 'mensaje' => "Pago borrado correctamente"));
        } else {
            echo json_encode(array('errorMsg' => 'Ha ocurrido un error.'));
        }
    } else if ($accion == "BUSCAR") {
        $cadena = htmlspecialchars($_REQUEST['cadena']);
        $pagos = $control->getPagoLikeAtrr($cadena);
        $json = json_encode($pagos);
        echo $json;
    } else if ($accion == "BUSCAR_BY_ID") {
        $idPago = htmlspecialchars($_REQUEST['idPago']);

        $pago = $control->getPagoByID($idPago);
        $json = json_encode($pago);
        echo $json;
    } else if ($accion == "BUSCAR_BY_ID_RESERVA") {
        $idReserva = htmlspecialchars($_REQUEST['idReserva']);

        $pago = $control->getPagoByIDReserva($idReserva);
        $json = json_encode($pago);
        echo $json;
    }else if ($accion == "ACTUALIZAR") {
        $idPago = htmlspecialchars($_REQUEST['idPago']);
        $fechaPago = htmlspecialchars($_REQUEST['fechaPago']);
        $monto = htmlspecialchars($_REQUEST['monto']);
        $idReservaHostal = htmlspecialchars($_REQUEST['idReservaHostal']);

            $pago = new PagoDTO();
            $pago->setIdPago($idPago);
            $pago->setFechaPago($fechaPago);
            $pago->setMonto($monto);
            $pago->setIdReservaHostal($idReservaHostal);

        $result = $control->updatePago($pago);
        if ($result) {
            echo json_encode(array(
                'success' => true,
                'mensaje' => "Pago actualizada correctamente"
            ));
        } else {
            echo json_encode(array('errorMsg' => 'Ha ocurrido un error.'));
        }
    }
}
