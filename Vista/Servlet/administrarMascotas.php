<?php

include_once '../../Controlador/PetChow.php';

$control = PetChow::getInstancia();

$accion = htmlspecialchars($_REQUEST['accion']);
if ($accion != null) {
    if ($accion == "Listado") {
        $mascotas = $control->getAllMascotas();

        $json = json_encode($mascotas);
        echo $json;
    } else if ($accion == "AGREGAR") {
        $raza = htmlspecialchars($_REQUEST['raza']);
        $nombre = htmlspecialchars($_REQUEST['nombre']);
        $run = htmlspecialchars($_REQUEST['run']);
        $tipoMascota = htmlspecialchars($_REQUEST['tipoMascota']);

        $mascota = new MascotaDTO();
        $mascota->setRaza($raza);
        $mascota->setNombre($nombre);
        $mascota->setRun($run);
        $mascota->setTipoMascota($tipoMascota);

        $result = $control->addMascota($mascota);

        if ($result) {
            echo json_encode(array(
                'success' => true,
                'mensaje' => "Mascota ingresada correctamente"
            ));
        } else {
            echo json_encode(array('errorMsg' => 'Ha ocurrido un error.'));
        }
    } else if ($accion == "AGREGAR_BY_USER_ACTIVO") {
        session_start();
        $run = $_SESSION["run"];

        $raza = htmlspecialchars($_REQUEST['raza']);
        $nombre = htmlspecialchars($_REQUEST['nombre']);        
        $tipoMascota = htmlspecialchars($_REQUEST['tipoMascota']);

        $mascota = new MascotaDTO();
        $mascota->setRaza($raza);
        $mascota->setNombre($nombre);
        $mascota->setRun($run);
        $mascota->setTipoMascota($tipoMascota);

        $result = $control->addMascota($mascota);

        if ($result) {
            echo json_encode(array(
                'success' => true,
                'mensaje' => "Mascota ingresada correctamente"
            ));
        } else {
            echo json_encode(array('errorMsg' => 'Ha ocurrido un error.'));
        }
    } else if ($accion == "BORRAR") {
        $idMascota = intval($_REQUEST['idMascota']);
        $result = $control->removeMascota($idMascota);
        if ($result) {
            echo json_encode(array('success' => true, 'mensaje' => "Mascota borrada correctamente"));
        } else {
            echo json_encode(array('errorMsg' => 'Ha ocurrido un error.'));
        }
    } else if ($accion == "BUSCAR") {
        $nombre = htmlspecialchars($_REQUEST['nombre']);
        $mascotas = $control->getMascotasByName($nombre);
        $json = json_encode($mascotas);
        echo $json;
    } else if ($accion == "BUSCAR_BY_RUN") {
        $run = htmlspecialchars($_REQUEST['run']);
        $mascotas = $control->getMascotaByRunDueño($run);
        $json = json_encode($mascotas);
        echo $json;
    } else if ($accion == "GET_MASCOTAS_USUARIO_ACTIVO") {
        session_start();
        $run = $_SESSION["run"];

        $mascotas = $control->getMascotaByRunDueño($run);
        $json = json_encode($mascotas);
        echo $json;
    } else if ($accion == "ACTUALIZAR") {
        $idMascota = htmlspecialchars($_REQUEST['idMascota']);
        $raza = htmlspecialchars($_REQUEST['raza']);
        $nombre = htmlspecialchars($_REQUEST['nombre']);
        $run = htmlspecialchars($_REQUEST['run']);
        $tipoMascota = htmlspecialchars($_REQUEST['tipoMascota']);

        $mascota = new MascotaDTO();
        $mascota->setIdMascota($idMascota);
        $mascota->setRaza($raza);
        $mascota->setNombre($nombre);
        $mascota->setRun($run);
        $mascota->setTipoMascota($tipoMascota);

        $result = $control->updateMascota($mascota);

        if ($result) {
            echo json_encode(array(
                'success' => true,
                'mensaje' => "Mascota actualizada correctamente"
            ));
        } else {
            echo json_encode(array('errorMsg' => 'Ha ocurrido un error.'));
        }
    }
}