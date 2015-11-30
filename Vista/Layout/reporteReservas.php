<?php include 'header.php'; ?>

<div class='vista'>            
    <div id="formulario-reporte">
        <label><h2>Rango de Fechas Reservas</h2></label><br>
        <form id="form-reserva" action="../Servlet/administrarReporteReservas.php">
            <label style="margin: 0 0 10px 0;">Fecha Inicio:</label>
            <input type="date" class="form-control" id="InputFechaInicio" name="InputFechaInicio" style="width: 200px; margin-left: 48px;">
            <label style="margin: 10px 0px 0px 40px;">Fecha Termino:</label>
            <input type="date" class="form-control" id="InputFechaTermino" name="InputFechaTermino"  style="width: 200px; margin-left: 48px;">
            <input type="hidden" id="accion" name="accion" value="">  
        </form>
    </div>
    <div class="botonReporte">
        <button onclick="generarReporteReservas()" class="btn btn-default" style="width: 140px; height: 25px; border-radius: 5px;"> Generar Reporte</button>
    </div>

</div>

<script type="text/javascript">
    function generarReporteReservas() {
        var fechaInicio = document.getElementById("InputFechaInicio").value;
        var fechaTermino = document.getElementById("InputFechaTermino").value;
        var f_actual = fechaActual();
        document.getElementById("accion").value = "GENERAR";
        if (fechaInicio != "") {
            if (fechaTermino != "") {
                if ((Date.parse(fechaInicio)) <= (Date.parse(fechaTermino))) {
                    console.log("ENVIANDO");
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
    function fechaActual() {
        var hoy = new Date();
        var dd = hoy.getDate();
        var mm = hoy.getMonth() + 1; //hoy es 0!
        var yyyy = hoy.getFullYear();

        if (dd < 10) {
            dd = '0' + dd
        }
        if (mm < 10) {
            mm = '0' + mm
        }
        hoy = yyyy + "-" + mm + "-" + dd;
        return hoy;
    }
</script>
<?php include 'footer.php'; ?>