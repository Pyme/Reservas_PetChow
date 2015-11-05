<?php

include_once '../../Controlador/PetChow.php';

$control = PetChow::getInstancia();

$accion = htmlspecialchars($_REQUEST['accion']);
if ($accion != null) {
    if ($accion == "LISTADO") {
        $canils = $control->getAllCanils();
        $json = json_encode($canils);
        echo $json;
    } else if ($accion == "AGREGAR") {
        $idCanil = htmlspecialchars($_REQUEST['idCanil']);
        $dimension = htmlspecialchars($_REQUEST['dimension']);
        $tipoCanil = htmlspecialchars($_REQUEST['tipoCanil']);
        $idEstadoCanil = htmlspecialchars($_REQUEST['idEstadoCanil']);

        $object = $control->getCanilByID($idCanil);
        if (($object->getIdCanil() == null || $object->getIdCanil() == "")) {
            $canil = new CanilDTO();
            $canil->setIdCanil($idCanil);
            $canil->setDimension($dimension);
            $canil->setTipoCanil($tipoCanil);
            $canil->setIdEstadoCanil($idEstadoCanil);

            $result = $control->addCanil($canil);

            if ($result) {
                echo json_encode(array(
                    'success' => true,
                    'mensaje' => "Canil ingresada correctamente"
                ));
            } else {
                echo json_encode(array('errorMsg' => 'Ha ocurrido un error.'));
            }
        } else {
            echo json_encode(array('errorMsg' => 'El o la canil ya existe, intento nuevamente.'));
        }
    } else if ($accion == "BORRAR") {
        $idCanil = htmlspecialchars($_REQUEST['idCanil']);

        $result = $control->removeCanil($idCanil);
        if ($result) {
            echo json_encode(array('success' => true, 'mensaje' => "Canil borrado correctamente"));
        } else {
            echo json_encode(array('errorMsg' => 'Ha ocurrido un error.'));
        }
    } else if ($accion == "BUSCAR") {
        $cadena = htmlspecialchars($_REQUEST['cadena']);
        $canils = $control->getCanilLikeAtrr($cadena);
        $json = json_encode($canils);
        echo $json;
    } else if ($accion == "BUSCAR_BY_ID") {
        $idCanil = htmlspecialchars($_REQUEST['idCanil']);

        $canil = $control->getCanilByID($idCanil);
        $json = json_encode($canil);
        echo $json;
    } else if ($accion == "BUSCAR_CANIL_LIBRE_BY_MASCOTA") {
        $idMascota = htmlspecialchars($_REQUEST['idMascota']);
        $fechaInicio = htmlspecialchars($_REQUEST['fechaInicio']);
        $fechaFin = htmlspecialchars($_REQUEST['fechaFin']);
        
        $mascota = $control->getMascotaByIdMascota($idMascota);
        $tipo = $mascota->getTipoMascota();               
        $caniles = $control->getAllCanilLibre($tipo,$fechaInicio,$fechaFin);
        
        $json = json_encode($caniles);
        echo $json;
    } else if ($accion == "ACTUALIZAR") {
        $idCanil = htmlspecialchars($_REQUEST['idCanil']);
        $dimension = htmlspecialchars($_REQUEST['dimension']);
        $tipoCanil = htmlspecialchars($_REQUEST['tipoCanil']);
        $idEstadoCanil = htmlspecialchars($_REQUEST['idEstadoCanil']);

        $canil = new CanilDTO();
        $canil->setIdCanil($idCanil);
        $canil->setDimension($dimension);
        $canil->setTipoCanil($tipoCanil);
        $canil->setIdEstadoCanil($idEstadoCanil);

        $result = $control->updateCanil($canil);
        if ($result) {
            echo json_encode(array(
                'success' => true,
                'mensaje' => "Canil actualizada correctamente"
            ));
        } else {
            echo json_encode(array('errorMsg' => 'Ha ocurrido un error.'));
        }
    }
}
