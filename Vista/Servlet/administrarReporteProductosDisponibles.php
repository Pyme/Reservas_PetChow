<?php

include_once '../../Controlador/PetChow.php';
include_once 'PDF.php';

$control = PetChow::getInstancia();

$accion = htmlspecialchars($_REQUEST['accion']);

if ($accion != null) {
    if ($accion == "generar") {       
        $insumos = $control->getInsumosByDisponibles();
        
        /*
        $json = json_encode($reservas);
        echo $json;
        */
        
        $pdf = new PDF('P', 'mm', 'A4');
        $pdf->AddPage();

        $tituloPagina = "Reporte insumos disponibles ";

        $subTituloInsumosNoDis= "Detalle Insumos disponibles:";
        $cabeceraInsumosNoDis = array('idInsumos', 'nombre', 'stock', 'precio');
        
        $pdf->SetAutoPageBreak(TRUE);
        $pdf->logoAndTitulo($tituloPagina);
        $pdf->subTitulo($subTituloInsumosNoDis, 20, 30);
        $pdf->cabeceraHorizontalInsumosNoDis($cabeceraInsumosNoDis,10,40);
        $pdf->datosHorizontalInsumosNoDis($insumos,10,47);
        
        $pdf->Footer();        
        $pdf->Output();        
        
        
    }
}

