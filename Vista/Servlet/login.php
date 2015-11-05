<?php

include_once '../../Controlador/PetChow.php';
$control = PetChow::getInstancia();

$run = $_POST['InputRun'];
$clave = $_POST['InputPassword1'];

$success = true;
$mensajes;
$pagina = "";
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

            if ($usuario->getIdPerfil() == 1) {//administrador
                $pagina = "Vista/Layout/administrarReservaHostal.php";
            } else if ($usuario->getIdPerfil() == 2) {//Persona
                $pagina = "Vista/Layout/administrarPersonas.php";
            } else if ($usuario->getIdPerfil() == 3) {//Cuidador
                $pagina = "Vista/Layout/administrarPersonas.php";
            } else if ($usuario->getIdPerfil() == 4) {//Secretaria
                $pagina = "Vista/Layout/administrarPersonas.php";
            } else if ($usuario->getIdPerfil() == 5) {//Veterinario
                $pagina = "Vista/Layout/administrarPersonas.php";
            }

            $success = true;
            $mensajes = "Iniciando...";
        } else {
            $success = false;
            $mensajes = "La clave ingresada es incorrecta.";
        }
    } else {
        $success = false;
        $mensajes = "Usuario no existe.";
    }
} else {
    $success = false;
    $mensajes = "Ninguna casilla puede estar vacia.";
}
echo json_encode(array(
    'success' => $success,
    'mensaje' => $mensajes,
    'pagina' => $pagina
));
?>