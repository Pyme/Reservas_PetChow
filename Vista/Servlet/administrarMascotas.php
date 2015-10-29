<?php

include_once '../../Controlador/PetChow.php';

$control = PetChow::getInstancia();

$accion = htmlspecialchars($_REQUEST['accion']);
if ($accion != null) {
    if ($accion == "Listado") {
        $mascotas = $control->getAllMascotas();
        $json = json_encode($mascotas);
        echo $json;
    }
}

