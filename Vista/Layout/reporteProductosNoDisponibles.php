<?php include 'header.php'; ?>

<div class='vista'>            
    <div id="formulario-reporte">
        <label><h2>Reporte insumos no disponibles</h2></label><br>
        <form id="form-reserva" action="../Servlet/administrarReporteProductosNoDisponibles.php">
            <input type="hidden" id="accion" name="accion" value="generar">  
        </form>
    </div>
    <div class="botonReporte">
        <button onclick="generarReporteProductosNoDisponibles()" class="btn btn-default" style="width: 140px; height: 25px; border-radius: 5px;"> Generar Reporte</button>
    </div>

</div>

<script type="text/javascript">
    function generarReporteProductosNoDisponibles() {
        $("#form-reserva").submit();
    }

</script>
<?php include 'footer.php'; ?>