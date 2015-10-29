<?php
include_once '../../Controlador/PetChow.php';
$control = PetChow::getInstancia();

$run = $_POST['InputRun'];
$password = $_POST['InputPassword1'];

if($control->validarUsuario($run,$password)){
    $usuario = $control->getUsuarioByRun($run);
    session_start();
    $_SESSION["autentificado"] = "SI";
    $_SESSION["idPerfil"] = $usuario->getIdPerfil();
    $_SESSION["run"] = $usuario->getRun();
    $_SESSION["nombre"] = $usuario->getNombre();
    
    if($usuario->getIdPerfil() == 1)  header("Location: ../Layout/administrarPersonas.php");//administrador
    else if($usuario->getIdPerfil() == 2)  header("Location: ../Layout/administrarPersonas.php");
    else if($usuario->getIdPerfil() == 3)  header("Location: ../Layout/administrarPersonas.php");
} else {
    header('Location: ../../error.php');
}
?>