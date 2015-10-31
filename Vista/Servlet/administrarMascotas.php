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

        $masc = $control->getMascotaByIdMascota($idMascota);
        if ($masc->getIdMascota() == null || $masc->getIdMascota() == "") {
            $mascota = new MascotaDTO();
            $mascota->setRaza($raza);
            $mascota->setNombre($nombre);
           
            $mascota->setRun($run);

            $result = $control->addMascota($mascota);

            if ($result) {
                echo json_encode(array(
                    'success' => true,
                    'mensaje' => "Mascota ingresada correctamente"
                ));
            } else {
                echo json_encode(array('errorMsg' => 'Ha ocurrido un error.'));
            }
        } else {
            echo json_encode(array('errorMsg' => 'La mascota ya existe, intento nuevamente con otro id.'));
        }
    }
}