<?php

include_once '../../Controlador/PetChow.php';

$control = PetChow::getInstancia();

$accion = htmlspecialchars($_REQUEST['accion']);
if ($accion != null) {
    if ($accion == "LISTADO") {
        $estadoreservas = $control->getAllEstadoreservas();
        $json = json_encode($estadoreservas);
        echo $json;
    } else if ($accion == "AGREGAR") {
        $idEstadoReserva = htmlspecialchars($_REQUEST['idEstadoReserva']);
        $estado = htmlspecialchars($_REQUEST['estado']);

        $object = $control->getEstadoreservaByID($idEstadoReserva);
        if (($object->getIdEstadoReserva() == null || $object->getIdEstadoReserva() == "")) {
            $estadoreserva = new EstadoreservaDTO();
            $estadoreserva->setIdEstadoReserva($idEstadoReserva);
            $estadoreserva->setEstado($estado);

            $result = $control->addEstadoreserva($estadoreserva);

            if ($result) {
                echo json_encode(array(
                    'success' => true,
                    'mensaje' => "Estadoreserva ingresada correctamente"
                ));
            } else {
                echo json_encode(array('errorMsg' => 'Ha ocurrido un error.'));
            }
        } else {
            echo json_encode(array('errorMsg' => 'El o la estadoreserva ya existe, intento nuevamente.'));
        }
    } else if ($accion == "BORRAR") {
        $idEstadoReserva = htmlspecialchars($_REQUEST['idEstadoReserva']);

        $result = $control->removeEstadoreserva($idEstadoReserva);
        if ($result) {
            echo json_encode(array('success' => true, 'mensaje' => "Estadoreserva borrado correctamente"));
        } else {
            echo json_encode(array('errorMsg' => 'Ha ocurrido un error.'));
        }
    } else if ($accion == "BUSCAR") {
        $cadena = htmlspecialchars($_REQUEST['cadena']);
        $estadoreservas = $control->getEstadoreservaLikeAtrr($cadena);
        $json = json_encode($estadoreservas);
        echo $json;
    } else if ($accion == "BUSCAR_BY_ID") {
        $idEstadoReserva = htmlspecialchars($_REQUEST['idEstadoReserva']);

        $estadoreserva = $control->getEstadoreservaByID($idEstadoReserva);
        $json = json_encode($estadoreserva);
        echo $json;
    } else if ($accion == "ACTUALIZAR") {
        $idEstadoReserva = htmlspecialchars($_REQUEST['idEstadoReserva']);
        $estado = htmlspecialchars($_REQUEST['estado']);

            $estadoreserva = new EstadoreservaDTO();
            $estadoreserva->setIdEstadoReserva($idEstadoReserva);
            $estadoreserva->setEstado($estado);

        $result = $control->updateEstadoreserva($estadoreserva);
        if ($result) {
            echo json_encode(array(
                'success' => true,
                'mensaje' => "Estadoreserva actualizada correctamente"
            ));
        } else {
            echo json_encode(array('errorMsg' => 'Ha ocurrido un error.'));
        }
    }
}
