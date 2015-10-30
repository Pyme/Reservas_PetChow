<?php

include_once '../../Controlador/PetChow.php';
$control = PetChow::getInstancia();

$run = $_POST['InputRun'];
$clave = $_POST['InputPassword1'];

$success = true;
$mensajes;
if (($run != null || $run != "") && ($clave != null || $clave != "")) {

    $usuario = $control->getUsuarioByRun($run);    
    if ($usuario->getRun() == $run) {        
        if ($usuario->getClave() == $clave) {
            $usuario = $control->getUsuarioByRun($run);
            session_start();
            $_SESSION["autentificado"] = "SI";
            $_SESSION["idPerfil"] = $usuario->getIdPerfil();
            $_SESSION["run"] = $usuario->getRun();
            $_SESSION["nombre"] = $usuario->getNombre();

            if ($usuario->getIdPerfil() == 1) {
                header("Location: ../Layout/administrarPersonas.php"); //administrador
            } else if ($usuario->getIdPerfil() == 2) {
                header("Location: ../Layout/administrarPersonas.php");
            } else if ($usuario->getIdPerfil() == 3) {
                header("Location: ../Layout/administrarPersonas.php");
            }
        } else {
            $success = false;
            $mensajes = "La clave ingresada es incorrecta.";
        }
    } else {
        $success = false;
        $mensajes = "No existe un usuario asociado al rut ingresado.";
    }
} else {
    $success = false;
    $mensajes = "Ninguna casilla puede estar vacia.";
}
echo json_encode(array(
    'success' => $success,
    'mensaje' => $mensajes,    
));
//header('Location: ../../error.php');
?>