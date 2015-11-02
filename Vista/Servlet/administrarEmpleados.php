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
        $existe = (htmlspecialchars($_REQUEST['existe'] == "true") ? true : false);
        $runRespaldo = htmlspecialchars($_REQUEST['runRespaldo']);

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

            $resulPersona;
            $resulEmpleado;
            $resulUsuario;
            if ($existe) {
                $persona->setRun($runRespaldo);
                $resulPersona = $control->updatePersona($persona);
            } else {
                $resulPersona = $control->addPersona($persona);
            }
            $resulEmpleado = $control->saveEmpleado($persona);

            if ($existe) {
                $usuario->setRun($runRespaldo);
                $resulUsuario = $control->updateUsuario($usuario);
            } else {
                $resulUsuario = $control->addUsuario($usuario);
            }

            if ($resulPersona && $resulEmpleado && $resulUsuario) {
                echo json_encode(array(
                    'success' => true,
                    'mensaje' => "Empleado ingresada correctamente"
                ));
            } else {                
                echo json_encode(array(
                    'errorMsg' => 'Ha ocurrido un error.',
                    'resultPersona' => $resulPersona,
                    'resulEmpleado' => $resulEmpleado,
                    'resultUsuario' => $resulUsuario,
                    ));
            }
        } else {
            echo json_encode(array('errorMsg' => 'El run ya existe, intente nuevamente.'));
        }
    } else if ($accion == "BUSCAR_BY_RUN") {
        $run = htmlspecialchars($_REQUEST['run']);

        $persona = $control->getEmpleadoByRun($run);

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
        $idPerfil = htmlspecialchars($_REQUEST['idPerfil']);
        $cargo = htmlspecialchars($_REQUEST['cargo']);

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

        $result = $control->updatePersona($persona);
        $result = $control->updateEmpleado($persona);
        if ($result)
            $result = $control->updateUsuario($usuario);

        if ($result) {
            echo json_encode(array(
                'success' => true,
                'mensaje' => "Empleado actualizado correctamente"
            ));
        } else {
            echo json_encode(array('errorMsg' => 'Ha ocurrido un error.'));
        }
    } else if ($accion == "BORRAR") {
        $run = htmlspecialchars($_REQUEST['run']);

        $usuario = $control->getUsuarioByRun($run);
        $usuario->setIdPerfil(2);
        
        $result = $control->updateUsuario($usuario);
        $result = $control->deleteEmpleado($run);        
        if ($result) {
            echo json_encode(array('success' => true, 'mensaje' => "Empleado borrado correctamente"));
        } else {
            echo json_encode(array('errorMsg' => 'Ha ocurrido un error.'));
        }
    } else if ($accion == "BUSCAR") {
        $nombres = htmlspecialchars($_REQUEST['nombres']);

        $personas = $control->getEmpleadoByName($nombres);

        $json = json_encode($personas);
        echo $json;
    }
}