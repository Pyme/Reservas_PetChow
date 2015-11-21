<?php include 'header.php'; ?>

<div class='vista'>            
    <div id="formulario-reporte" style="padding: 30px; width: 350px; margin: 0 auto; ">
        <label><h2>Rango de Fechas Reservas</h2></label><br>
        <form id="form-reserva" action="../Servlet/administrarReporteReservas.php">
            <label style="margin: 0 0 10px 0;">Fecha Inicio:</label>
            <input type="date" class="form-control" id="InputFechaInicio" name="InputFechaInicio" style="width: 200px; margin-left: 48px;">
            <label style="margin: 10px 0 10px 0;">Fecha Termino:</label>
            <input type="date" class="form-control" id="InputFechaTermino" name="InputFechaTermino"  style="width: 200px; margin-left: 48px;">
            <input type="hidden" id="accion" name="accion" value="">            
        </form>
        <button onclick="generarReporteReservas()" class="btn btn-default"  style="margin: 27px 0 0 0;">Generar Reporte</button>
    </div>
</div>

<script type="text/javascript">
    function generarReporteReservas() {
        var fechaInicio = document.getElementById("InputFechaInicio").value;
        var fechaTermino = document.getElementById("InputFechaTermino").value;
        document.getElementById("accion").value = "GENERAR";
        if (fechaInicio != "") {
            if (fechaTermino != "") {
                if ((Date.parse(fechaInicio)) < (Date.parse(fechaTermino))) {
                    $("#form-reserva").submit();
                } else {
                    $.messager.alert('Alerta', "La fecha inicial no puede ser mayor que la fecha de termino");
                    document.getElementById("InputFechaInicio").focus();
                }
            } else {
                $.messager.alert('Alerta', "Debe ingresar la fecha de termino");
                document.getElementById("InputFechaTermino").focus();
            }
        } else {
            $.messager.alert('Alerta', "Debe ingresar la fecha de inicio");
            document.getElementById("InputFechaInicio").focus();
        }
    }
</script>
<?php include 'footer.php'; ?>