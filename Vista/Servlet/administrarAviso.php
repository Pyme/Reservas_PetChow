<?php

include_once '../../Controlador/PetChow.php';

$control = PetChow::getInstancia();

$accion = htmlspecialchars($_REQUEST['accion']);
if ($accion != null) {
    if ($accion == "LISTADO") {
        $avisos = $control->getAllAvisos();
        $json = json_encode($avisos);
        echo $json;
    } else if ($accion == "AGREGAR") {
        include_once("../../util/SubirImagen.php");
        $imagen = $_FILES['rutaImagen'];
        if ($imagen['name']) {
            $descripcion = htmlspecialchars($_REQUEST['descripcion']);

            $idAviso = $control->getIDAviso();

            $ruta = "files/img/avisos/";

            $subirImagen = new SubirImagen("../../" . $ruta);
            $nombreImagen = $subirImagen->asignaNombre($imagen['type'], "aviso_" . $idAviso);

            $aviso = new AvisoDTO();
            $aviso->setIdAviso($idAviso);
            $aviso->setRutaImagen($ruta . $nombreImagen);
            $aviso->setDescripcion($descripcion);

            if ($imagen["size"] <= 2000000) {//2 Mb
                if (validaTipo($imagen["type"])) {
                    $result = $control->addAviso($aviso);

                    if ($result) {
                        $subirImagen = new SubirImagen("../../" . $ruta);
                        $subirImagen->setMaximoSize(2000000); //2mb  

                        $subirImagen->setName("aviso_" . $idAviso);
                        $respuesta = $subirImagen->subirImagen($imagen);
                        if ($respuesta != true) {
                            $control->removeAviso($idAviso);
                            $result = false;
                        }
                    }

                    if ($result) {
                        echo json_encode(array(
                            'success' => true,
                            'mensaje' => "Aviso ingresada correctamente"
                        ));
                    } else {
                        echo json_encode(array('errorMsg' => 'Ha ocurrido un error.'));
                    }
                }
            } else {
                echo json_encode(array('errorMsg' => 'La imagen no puede superar los 2 mb.'));
            }
        } else {
            echo json_encode(array('errorMsg' => 'Debe seleccionar una imagen.'));
        }
    } else if ($accion == "BORRAR") {
        $idAviso = htmlspecialchars($_REQUEST['idAviso']);

        $aviso = $control->getAvisoByID($idAviso);

        $result = $control->removeAviso($idAviso);
        if ($result) {
            unlink("../../" . $aviso->getRutaImagen());
            echo json_encode(array('success' => true, 'mensaje' => "Aviso borrado correctamente"));
        } else {
            echo json_encode(array('errorMsg' => 'Ha ocurrido un error.'));
        }
    } else if ($accion == "BUSCAR") {
        $cadena = htmlspecialchars($_REQUEST['cadena']);
        $avisos = $control->getAvisoLikeAtrr($cadena);
        $json = json_encode($avisos);
        echo $json;
    } else if ($accion == "BUSCAR_BY_ID") {
        $idAviso = htmlspecialchars($_REQUEST['idAviso']);

        $aviso = $control->getAvisoByID($idAviso);
        $json = json_encode($aviso);
        echo $json;
    } else if ($accion == "ACTUALIZAR") {
        include_once("../../util/SubirImagen.php");
        $imagen = $_FILES['rutaImagen'];

        $idAviso = htmlspecialchars($_REQUEST['idAviso']);
        $descripcion = htmlspecialchars($_REQUEST['descripcion']);

        $ruta = "files/img/avisos/";

        $aviso = new AvisoDTO();
        $aviso->setIdAviso($idAviso);
        $aviso->setDescripcion($descripcion);

        $result = $control->updateAviso($aviso);

        if ($result) {
            if ($imagen['name']) {
                if ($imagen["size"] <= 2000000) {
                    if (validaTipo($imagen["type"])) {

                        $subirImagen = new SubirImagen("../../" . $ruta);
                        $subirImagen->setMaximoSize(2000000); //2mb  

                        $subirImagen->setName("aviso_" . $idAviso);
                        $respuesta = $subirImagen->subirImagen($imagen);
                        if ($respuesta) {
                            echo json_encode(array(
                                'success' => true,
                                'mensaje' => "Aviso actualizada correctamente"
                            ));
                        } else {
                            echo json_encode(array(
                                'success' => true,
                                'mensaje' => "Aviso actualizada correctamente, pero: " + $respuesta
                            ));
                        }
                    } else {
                        echo json_encode(array(
                            'success' => true,
                            'mensaje' => "La imagen no se a actualizado debido a que no es un archivo permitido."
                        ));
                    }
                } else {
                    echo json_encode(array(
                        'success' => true,
                        'mensaje' => "La imagen no se a actualizado debido a que supera los 2 Mb."
                    ));
                }
            } else {
                echo json_encode(array(
                    'success' => true,
                    'mensaje' => "Aviso actualizada correctamente"
                ));
            }
        } else {
            echo json_encode(array('errorMsg' => 'Ha ocurrido un error.'));
        }       
    }
}

function validaTipo($tipo) {
    $extenciones = array("image/jpg", "image/jpeg", "image/png", "image/gif");
    // Verifica que la extensión sea permitida, según el arreglo $extenciones
    if (in_array(strtolower($tipo), $extenciones))
        return true;
    return false;
}
