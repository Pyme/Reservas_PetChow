<?php include_once '../../Controlador/PetChow.php';

$control = PetChow::getInstancia();

$accion = htmlspecialchars($_REQUEST['accion']);
if ($accion != null) {
    if ($accion == "Listado") {
        $personas = $control->getAllPersonas();

        $json = json_encode($personas);
        echo $json;
    } else if ($accion == "AGREGAR") {
        $run = htmlspecialchars($_REQUEST['run']);
        ;
        $nombres = htmlspecialchars($_REQUEST['nombres']);
        $apellidos = htmlspecialchars($_REQUEST['apellidos']);
        $fechaNac = htmlspecialchars($_REQUEST['fechaNac']);
        $sexo = htmlspecialchars($_REQUEST['sexo']);
        $direccion = htmlspecialchars($_REQUEST['direccion']);
        $telefono = htmlspecialchars($_REQUEST['telefono']);
        $clave = htmlspecialchars($_REQUEST['clave']);
        $idPerfil = htmlspecialchars($_REQUEST['idPerfil']);

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
            $usuario->setIdPerfil($idPerfil);
            $usuario->setClave($clave);
            
            $result = $control->addPersona($persona);    
            
            if($result) 
                $result = $control->addUsuario($usuario);
            
            if ($result) {                
                echo json_encode(array(
                    'success' => true,
                    'mensaje' => "Persona ingresado correctamente"
                ));
            } else {
                echo json_encode(array('errorMsg' => 'Ha ocurrido un error.'));
            }
        } else {
            echo json_encode(array('errorMsg' => 'El rut ya existe, intento nuevamente.'));
        }
    }
}

