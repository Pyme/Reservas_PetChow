<?php

include_once '../../Controlador/PetChow.php';

$control = PetChow::getInstancia();

$accion = htmlspecialchars($_REQUEST['accion']);
if ($accion != null) {
    if ($accion == "Listado") {
        $personas = $control->getAllEmpleados();

        $json = json_encode($personas);
        echo $json;
    } else if ($accion == "AGREGAR") {
        $run = htmlspecialchars($_REQUEST['run']);
        $nombres = htmlspecialchars($_REQUEST['nombres']);
        $apellidos = htmlspecialchars($_REQUEST['apellidos']);
        $fechaNac = htmlspecialchars($_REQUEST['fechaNac']);
        $sexo = htmlspecialchars($_REQUEST['sexo']);
        $direccion = htmlspecialchars($_REQUEST['direccion']);
        $telefono = htmlspecialchars($_REQUEST['telefono']);
        $clave = htmlspecialchars($_REQUEST['clave']);
        $idPerfil = htmlspecialchars($_REQUEST['idPerfil']);
        $cargo = htmlspecialchars($_REQUEST['cargo']);
        $existe = htmlspecialchars($_REQUEST['existe']);

        $pers = $control->getEmpleadoByRun($run);
        if ($pers->getRun() == null || $pers->getRun() == "") {

            $persona = new PersonaDTO();
            $persona->setRun($run);
            $persona->setNombres($nombres);
            $persona->setApellidos($apellidos);
            $persona->setFechaNac($fechaNac);
            $persona->setSexo($sexo);
            $persona->setDireccion($direccion);
            $persona->setTelefono($telefono);
            $persona->setCargo($cargo);

            $usuario = new UsuarioDTO();
            $usuario->setRun($run);
            $usuario->setIdPerfil($idPerfil);
            $usuario->setClave($clave);
           
            if($existe){
                $control->updatePersona($persona);
            }else{
                $control->addPersona($persona);
            }
            $result = $control->saveEmpleado($persona);

            if ($existe){
                $result = $control->updateUsuario($usuario);
            } else{
                $result = $control->addUsuario($usuario);
            }

            if ($result) {
                echo json_encode(array(
                    'success' => true,
                    'mensaje' => "Empleado ingresada correctamente"
                ));
            } else {
                echo json_encode(array('errorMsg' => 'Ha ocurrido un error.'));
            }
        } else {
            echo json_encode(array('errorMsg' => 'El run ya existe, intente nuevamente.'));
        }
    } else if ($accion == "BUSCAR_BY_RUN") {
        $run = htmlspecialchars($_REQUEST['run']);

        $persona = $control->getEmpleadoByRun($run);

        $json = json_encode($persona);
        echo $json;
    } 
}