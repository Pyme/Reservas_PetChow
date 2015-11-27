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
       
        $pagos = $control->getPagosEntreFechas($fechaInicio, $fechaTermino);
        
        /*
        $json = json_encode($reservas);
        echo $json;
        */
        
        $pdf = new PDF('P', 'mm', 'A4');
        $pdf->AddPage();

        $tituloPagina = "Reporte Pagos desde el  " . $fechaInicio . " hasta el " . $fechaTermino;

        $subTituloPagos = "Pagos realizados en el periodo:";
        $cabeceraPagos = array('Id Pago', 'Fecha Pago', 'Monto', 'Id Reserva Hostal');

        $pdf->SetAutoPageBreak(TRUE);
        $pdf->logoAndTitulo($tituloPagina);
        $pdf->subTitulo($subTituloPagos, 20, 30);
        $pdf->cabeceraHorizontalPagos($cabeceraPagos,10,40);
        $pdf->datosHorizontalPagos($pagos,10,47);
        
        $pdf->Footer();        
        $pdf->Output();        
        
        
    }
}

