<?php

include_once '../../Controlador/PetChow.php';

$control = PetChow::getInstancia();

$accion = htmlspecialchars($_REQUEST['accion']);
if ($accion != null) {
    if ($accion == "Listado") {
        $personas = $control->getAllPersonas();

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

        $pers = $control->getPersonaByRun($run);
        if ($pers->getRun() == null || $pers->getRun() == "") {

            $persona = new PersonaDTO();
            $persona->setRun($run);
            $persona->setNombres($nombres);
            $persona->setApellidos($apellidos);
            $persona->setFechaNac($fechaNac);
            $persona->setSexo($sexo);
            $persona->setDireccion($direccion);
            $persona->setTelefono($telefono);

            $usuario = new UsuarioDTO();
            $usuario->setRun($run);
            $usuario->setIdPerfil(2);
            $usuario->setClave($clave);

            $result = $control->addPersona($persona);

            if ($result)
                $result = $control->addUsuario($usuario);

            if ($result) {
                echo json_encode(array(
                    'success' => true,
                    'mensaje' => "Persona ingresada correctamente"
                ));
            } else {
                echo json_encode(array('errorMsg' => 'Ha ocurrido un error.'));
            }
        } else {
            echo json_encode(array('errorMsg' => 'El run ya existe, intento nuevamente.'));
        }
    } else if ($accion == "BORRAR") {
        $run = htmlspecialchars($_REQUEST['run']);

        $empleado = $control->getEmpleadoByRun($run); //Buscamos el empleado por el run si existe
        if ($empleado->getRun() == null || $empleado->getRun() == "") {//Validamos que el cliente no sea empleado
            $result = $control->removePersona($run);
            if ($result) {
                echo json_encode(array('success' => true, 'mensaje' => "Persona borrada correctamente"));
            } else {
                echo json_encode(array('errorMsg' => 'Ha ocurrido un error.'));
            }
        } else {
            echo json_encode(array('errorMsg' => 'No se puede eliminar al cliente porque es empleado de la empresa.'));
        }
    } else if ($accion == "BUSCAR") {
        $nombres = htmlspecialchars($_REQUEST['nombres']);

        $personas = $control->getPersonasByName($nombres);

        $json = json_encode($personas);
        echo $json;
    } else if ($accion == "BUSCAR_BY_RUN") {
        $run = htmlspecialchars($_REQUEST['run']);

        $persona = $control->getPersonaByRun($run);

        $json = json_encode($persona);
        echo $json;
    } else if ($accion == "GET_USUARIO_ACTIVO") {
        session_start();
        $run = $_SESSION["run"];

        $persona = $control->getPersonaByRun($run);

        $json = json_encode($persona);
        echo $json;
    } else if ($accion == "ACTUALIZAR") {
        $run = htmlspecialchars($_REQUEST['runRespaldo']);
        $nombres = htmlspecialchars($_REQUEST['nombres']);
        $apellidos = htmlspecialchars($_REQUEST['apellidos']);
        $fechaNac = htmlspecialchars($_REQUEST['fechaNac']);
        $sexo = htmlspecialchars($_REQUEST['sexo']);
        $direccion = htmlspecialchars($_REQUEST['direccion']);
        $telefono = htmlspecialchars($_REQUEST['telefono']);
        $clave = htmlspecialchars($_REQUEST['clave']);

        $persona = new PersonaDTO();
        $persona->setRun($run);
        $persona->setNombres($nombres);
        $persona->setApellidos($apellidos);
        $persona->setFechaNac($fechaNac);
        $persona->setSexo($sexo);
        $persona->setDireccion($direccion);
        $persona->setTelefono($telefono);

        $usuario = $control->getUsuarioByRun($run);
        $usuario->setClave($clave);

        $result = $control->updatePersona($persona);
        if ($result)
            $result = $control->updateUsuario($usuario);

        if ($result) {
            echo json_encode(array(
                'success' => true,
                'mensaje' => "Persona actualizada correctamente"
            ));
        } else {
            echo json_encode(array('errorMsg' => 'Ha ocurrido un error.'));
        }
    }
}

    