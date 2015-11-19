<?php

include_once '../../Controlador/PetChow.php';

$control = PetChow::getInstancia();

$accion = htmlspecialchars($_REQUEST['accion']);
if ($accion != null) {
    if ($accion == "Listado") {
        $insumos = $control->getAllInsumos();
        $json = json_encode($insumos);
        echo $json;
    } else if ($accion == "AGREGAR") {
        $nombre = htmlspecialchars($_REQUEST['nombre']);
        $stock = htmlspecialchars($_REQUEST['stock']);
        $precio = htmlspecialchars($_REQUEST['precio']);

        $insumo = new InsumosDTO();
        $insumo->setNombre($nombre);
        $insumo->setStock($stock);
        $insumo->setPrecio($precio);

        $result = $control->addInsumo($insumo);

        if ($result) {
            echo json_encode(array(
                'success' => true,
                'mensaje' => "Insumo ingresado correctamente"
            ));
        } else {
            echo json_encode(array('errorMsg' => 'Ha ocurrido un error.'));
        }
    } else if ($accion == "BORRAR") {
        $idInsumos = intval($_REQUEST['idInsumos']);
        $result = $control->removeInsumo($idInsumos);
        if ($result) {
            echo json_encode(array('success' => true, 'mensaje' => "Insumo Eliminado correctamente"));
        } else {
            echo json_encode(array('errorMsg' => 'Ha ocurrido un error.'));
        }
    } else if ($accion == "BUSCAR") {
        $nombre = htmlspecialchars($_REQUEST['nombre']);
        $insumos = $control->getInsumosLikeAtrr($nombre);
        $json = json_encode($insumos);
        echo $json;
    } else if ($accion == "ACTUALIZAR") {
        $idInsumos = htmlspecialchars($_REQUEST['idInsumos']); //No esta llegando este ID
        $nombre = htmlspecialchars($_REQUEST['nombre']);
        $stock = htmlspecialchars($_REQUEST['stock']);
        $precio = htmlspecialchars($_REQUEST['precio']);

        $insumo = new InsumosDTO();
        $insumo->setIdInsumos($idInsumos);
        $insumo->setNombre($nombre);
        $insumo->setStock($stock);
        $insumo->setPrecio($precio);

        $result = $control->updateInsumo($insumo);

        if ($result) {
            echo json_encode(array(
                'success' => true,
                'mensaje' => "Insumo actualizado correctamente"
            ));
        } else {
            echo json_encode(array(
                'errorMsg' => 'Ha ocurrido un error.',
                'insumo' => $insumo
            ));
        }
    } else if ($accion == "UTILIZAR") {
        $stockUtilizar = htmlspecialchars($_REQUEST['stockUtilizar']);
        $idInsumosUtilizado = htmlspecialchars($_REQUEST['idInsumosUtilizado']);
        $stockMaximo = htmlspecialchars($_REQUEST['stockMaximo']);


        if ($stockMaximo >= $stockUtilizar) {
            $insumo = $control->getInsumosByIdInsumos($idInsumosUtilizado);
            
            $stock = $stockMaximo-$stockUtilizar;
            $insumo->setStock($stock);
            
            $result = $control->updateInsumo($insumo);

            if ($result) {
                echo json_encode(array(
                    'success' => true,
                    'mensaje' => "Insumo utilizado correctamente"
                ));
            } else {
                echo json_encode(array(
                    'errorMsg' => 'Ha ocurrido un error.'
                ));
            }
        }else{
            echo json_encode(array('errorMsg' => 'No hay stock disponible.'));
        }
    }
}