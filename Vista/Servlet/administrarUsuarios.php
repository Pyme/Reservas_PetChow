<?php

include_once '../../Controlador/PetChow.php';

$control = PetChow::getInstancia();

$accion = htmlspecialchars($_REQUEST['accion']);
if ($accion != null) {
    if ($accion == "Listado") {
        $usuarios = $control->getAllUsuarios();
        
        $json = json_encode($usuarios);
        echo $json;
    }else if($accion == "BUSCAR"){
        $run = htmlspecialchars($_REQUEST['run']);
        $usuario = $control->getUsuarioByRun($run);
        
        $json = json_encode($usuario);
        echo $json;
    }
}

