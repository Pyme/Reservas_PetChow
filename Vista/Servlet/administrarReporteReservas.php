<?php

include_once '../../Controlador/PetChow.php';
include_once 'PDF.php';

$control = PetChow::getInstancia();

$accion = htmlspecialchars($_REQUEST['accion']);

if ($accion != null) {
    if ($accion == "GENERAR") {
        $fInicio = date_create(htmlspecialchars($_REQUEST['InputFechaInicio']));
        $fTermino = date_create(htmlspecialchars($_REQUEST['InputFechaTermino']));

        $fechaActual = date("d-m-20y");
        $fechaInicio = date_format($fInicio, "Y-m-d");
        $fechaTermino = date_format($fTermino, "Y-m-d");
       
        $reservas = $control->getReservaHostalEntreFechas($fechaInicio, $fechaTermino);
        
        /*
        $json = json_encode($reservas);
        echo $json;
        */
        
        $pdf = new PDF('P', 'mm', 'A4');
        $pdf->AddPage();

        $tituloPagina = "Reporte reservas desde el  " . $fechaInicio . " hasta el " . $fechaTermino;

        $subTituloReservas = "Reservas realizadas en el periodo:";
        $cabeceraReservas = array('ID', 'Fecha', 'Tipo', 'Inicio', 'Fin', 'Tarifa', 'Run', 'ID Mascota', 'ID Canil', 'Estado');

        $pdf->SetAutoPageBreak(TRUE);
        $pdf->logoAndTitulo($tituloPagina);
        $pdf->subTitulo($subTituloReservas, 20, 30);
        $pdf->cabeceraHorizontalReservas($cabeceraReservas,10,40);
        $pdf->datosHorizontalReservas($reservas,10,47);
        
        $pdf->Footer();        
        $pdf->Output();        
        
        
    }
}

