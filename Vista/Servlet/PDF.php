<?php

require('../../files/Complementos/fpdf17/fpdf.php');

/**
 * Description of ReportesPDF
 *
 * @author Javier Jara Yañez
 */
class PDF extends FPDF {

    function logoAndTitulo($titulo) {
        // Logo                               x  y  escala tamaño
        $this->Image('../../files/img/logo-reporte.jpg', 10, 8, 20);
        // Título
        $this->SetXY(35, 13);
        $this->SetFont('Arial', 'B', 13);
        //Borde,
        $this->Cell(20, 10, utf8_decode($titulo), 0, 0, 'L', false);
        // Salto de línea
        $this->Ln(5);
    }
    
    function subTitulo($titulo,$x,$y) {
        // Título
        $this->SetTextColor(3, 3, 3);
        $this->SetXY($x, $y);
        $this->SetFont('Arial', 'B', 12);
        //Borde,
        $this->Cell(20, 10, utf8_decode($titulo), 0, 0, 'L', false);
        // Salto de línea
        $this->Ln(5);
    }
    //REPORTE RESERVAS    
    function cabeceraHorizontalReservas($cabecera,$x,$y) {
        $this->SetXY($x, $y);
        $this->SetFont('Arial', 'B', 10);
        $this->SetFillColor(77, 201, 235); //Fondo cion
        //$this->SetFillColor(242, 171, 29); //Fondo naranjo
        $this->SetTextColor(240, 255, 240); //Letra color blanco
        $this->CellFitSpace(9, 7, utf8_decode($cabecera[0]), 1, 0, 'L', true);
        $this->CellFitSpace(23, 7, utf8_decode($cabecera[1]), 1, 0, 'L', true);
        $this->CellFitSpace(23, 7, utf8_decode($cabecera[2]), 1, 0, 'L', true);
        $this->CellFitSpace(20, 7, utf8_decode($cabecera[3]), 1, 0, 'L', true);
        $this->CellFitSpace(20, 7, utf8_decode($cabecera[4]), 1, 0, 'L', true);
        $this->CellFitSpace(20, 7, utf8_decode($cabecera[5]), 1, 0, 'L', true);
        $this->CellFitSpace(20, 7, utf8_decode($cabecera[6]), 1, 0, 'L', true);
        $this->CellFitSpace(20, 7, utf8_decode($cabecera[7]), 1, 0, 'L', true);
        $this->CellFitSpace(15, 7, utf8_decode($cabecera[8]), 1, 0, 'L', true);
        $this->CellFitSpace(20, 7, utf8_decode($cabecera[9]), 1, 0, 'L', true);
    }   
    
    function datosHorizontalReservas($reservas,$x,$y) {
        $this->SetXY($x, $y);
        $this->SetFont('Arial', '', 10);
        $this->SetFillColor(229, 229, 229); //Gris tenue de cada fila
        $this->SetTextColor(3, 3, 3); //Color del texto: Negro
        $bandera = false; //Para alternar el relleno
        foreach ($reservas as $reserva) {
            $this->CellFitSpace(9, 7, utf8_decode($reserva->getIdReservaHostal()), 1, 0, 'L', $bandera);
            $this->CellFitSpace(23, 7, utf8_decode($reserva->getFechaReserva()), 1, 0, 'L', $bandera);
            $this->CellFitSpace(23, 7, utf8_decode($reserva->getTipo()), 1, 0, 'L', $bandera);
            $this->CellFitSpace(20, 7, utf8_decode($reserva->getFechaInicio()), 1, 0, 'L', $bandera);
            $this->CellFitSpace(20, 7, utf8_decode($reserva->getFechaFin()), 1, 0, 'L', $bandera);
            $this->CellFitSpace(20, 7, utf8_decode($reserva->getTarifa()), 1, 0, 'L', $bandera);
            $this->CellFitSpace(20, 7, utf8_decode($reserva->getRun()), 1, 0, 'L', $bandera);
            $this->CellFitSpace(20, 7, utf8_decode($reserva->getIdMascota()), 1, 0, 'L', $bandera);
            $this->CellFitSpace(15, 7, utf8_decode($reserva->getIdCanil()), 1, 0, 'L', $bandera);
            $this->CellFitSpace(20, 7, utf8_decode($reserva->getDescripcionEstado()), 1, 0, 'L', $bandera);
            
            $this->Ln(); //Salto de línea para generar otra fila
            $bandera = !$bandera; //Alterna el valor de la bandera
        }
    }

    function tablaHorizontalReservas($tituloPagina, $subTituloCantidades,$cabeceraCantidad,$cantidades,$subTituloReservas, $cabeceraReservas, $reservas) {
        $this->logoAndTitulo($tituloPagina);
        
        $this->subTitulo($subTituloCantidades, 20, 35);
        $this->cabeceraHorizontalReservasPorLibro($cabeceraCantidad);
        $this->datosHorizontalCantidades($cantidades);
        
        $this->subTitulo($subTituloReservas, 20, 85);
        $this->cabeceraHorizontalReservas($cabeceraReservas);
        $this->datosHorizontalReservas($reservas);
        
        $this->Footer();
    }   
    //PRIMER REPORTE FINALIZADO
   
    // Pie de página
    function Footer() {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo(), 0, 0, 'C');
    }

    //***** Aquí comienza código para ajustar texto *************
    //***********************************************************
    function CellFit($w, $h = 0, $txt = '', $border = 0, $ln = 0, $align = '', $fill = false, $link = '', $scale = false, $force = true) {
        //Get string width
        $str_width = $this->GetStringWidth($txt);
        //Calculate ratio to fit cell
        if ($w == 0)
            $w = $this->w - $this->rMargin - $this->x;
        $ratio = ($w - $this->cMargin * 2) / $str_width;
        $fit = ($ratio < 1 || ($ratio > 1 && $force));
        if ($fit) {
            if ($scale) {
                //Calculate horizontal scaling
                $horiz_scale = $ratio * 100.0;
                //Set horizontal scaling
                $this->_out(sprintf('BT %.2F Tz ET', $horiz_scale));
            } else {
                //Calculate character spacing in points
                $char_space = ($w - $this->cMargin * 2 - $str_width) / max($this->MBGetStringLength($txt) - 1, 1) * $this->k;
                //Set character spacing
                $this->_out(sprintf('BT %.2F Tc ET', $char_space));
            }
            //Override user alignment (since text will fill up cell)
            $align = '';
        }
        //Pass on to Cell method
        $this->Cell($w, $h, $txt, $border, $ln, $align, $fill, $link);
        //Reset character spacing/horizontal scaling
        if ($fit)
            $this->_out('BT ' . ($scale ? '100 Tz' : '0 Tc') . ' ET');
    }

    function CellFitSpace($w, $h = 0, $txt = '', $border = 0, $ln = 0, $align = '', $fill = false, $link = '') {
        $this->CellFit($w, $h, $txt, $border, $ln, $align, $fill, $link, false, false);
    }

    function MBGetStringLength($s) {
        if ($this->CurrentFont['type'] == 'Type0') {
            $len = 0;
            $nbbytes = strlen($s);
            for ($i = 0; $i < $nbbytes; $i++) {
                if (ord($s[$i]) < 128)
                    $len++;
                else {
                    $len++;
                    $i++;
                }
            }
            return $len;
        } else
            return strlen($s);
    }

//************** Fin del código para ajustar texto *****************
//******************************************************************
}

?>