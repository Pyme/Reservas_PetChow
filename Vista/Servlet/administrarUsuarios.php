<?php

include_once '../../Controlador/PetChow.php';

$control = PetChow::getInstancia();

$accion = htmlspecialchars($_REQUEST['accion']);
if ($accion != null) {
    if ($accion == "Listado") {
        $usuarios = $control->getAllUsuarios();
        
        $json = json_encode($usuarios);
        echo $json;
    }
}

