<?php include 'header.php'; ?>

<table id="dg" title="Reservas" class="easyui-datagrid" style="width:900px;height:550px"
       url="../Servlet/administrarReservaHostal.php?accion=LISTADO"
       toolbar="#toolbar"
       rownumbers="true" fitColumns="true" singleSelect="true">
    <thead>
        <tr>
            <th field="idReservaHostal" width="10">ID</th>
            <th field="tipo" width="40">Tipo</th>
            <th field="fechaInicio" width="40">Fecha Inicio</th>
            <th field="fechaFin" width="40">Fecha Fin</th>
            <th field="fechaReserva" width="40">Fecha Reserva</th>
            <th field="tarifa" width="30">Tarifa</th>
            <th field="descripcionEstado" width="40">Estado Reserva</th>
            <th field="idMascota" width="30">Mascota</th>
            <th field="idCanil" width="30">Canil</th>
            <th field="run" width="30">Run Cliente</th>
        </tr>
    </thead>
</table>

<div id="toolbar">
    <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="crearReserva()">Agregar</a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editarReserva()">Editar</a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="eliminarReserva()">Eliminar</a>
    <input type="search" name="inputBuscarReserva" id="inputBuscarReserva" placeholder="Buscar..." results="4" onKeyUp="buscarReserva()">
</div>

<div id="dlg" class="easyui-dialog" style="width:410px;height:300px;padding:10px 20px;"
     closed="true" buttons="#dlg-buttons" modal="true">
    <div class="ftitle"></div>
    <form id="fm" method="post" novalidate>
        <div class="fitem">
            <label>Run:</label>
            <input type="text" name="run" id="run" class="easyui-validatebox" style="width:200px;"  required onkeyup="eliminarCaracteres();" onchange="buscarMascotas();">
        </div>
        <div class="fitem">
            <label>Fecha Inicio:</label>
            <input type="date" name="fechaInicio" id="fechaInicio" class="easyui-validatebox" style="width:200px;" onchange="diasEntreFechas();" required>
        </div>
        <div class="fitem">
            <label>Fecha Fin:</label>
            <input type="date" class="easyui-validatebox" value="" id="fechaFin" style="width:200px;" name="fechaFin" onchange="diasEntreFechas();" required>
        </div>
        <div class="fitem">
            <label>Estado Reserva:</label>
            <select class="easyui-validatebox" value="" id="idEstadoReserva" style="width:200px;" name="idEstadoReserva" maxlength="45" onchange="habilitarPago()">
                <option value='1'>Reservada</option>
                <option value='2'>Concretada</option>
                <option value='3'>Finalizada</option>
            </select>            
        </div>
        <div class="fitem">
            <label>Tarifa:</label>
            <input type="text" class="easyui-validatebox" value="" id="tarifa" style="width:200px; height: 21px;" name="tarifa" required>
        </div>
        <div class="fitem">
            <label>Mascota: </label>            
            <select class="easyui-validatebox" value="" id="idMascota" style="width:200px;" name="idMascota" maxlength="45" onchange="buscarCanilParaMascota()">
            </select>
        </div>
        <div class="fitem">
            <label>Canil:</label>
            <select class="easyui-validatebox" value="" id="idCanil" style="width:200px;" name="idCanil" maxlength="45">
            </select>
        </div>        
        <div class="fitem" id="estado-pago" style="display: none;">
            <label>Pago:</label>
            <select class="easyui-validatebox" value="" id="pago" style="width:200px;" name="pago">
                <option value='1'>No</option>
                <option value='2'>Si</option>
            </select>            
        </div>
        <input name="accion" id="accion" type="hidden">
        <input name="idReservaHostal" id="idReservaHostal" type="hidden">
        <input name="tipo" id="tipo" value="Presencial" type="hidden">
    </form>
</div>  

<div id="dlg-buttons">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="guardarReserva()">Guardar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')">Cancelar</a>
</div>  

<!-- Administracion-->
<script src="../../files/js/validarut.js"></script>

<script>
        function crearReserva() {
            document.getElementById("fm").reset();
            document.getElementById('estado-pago').style.display = 'none';
            $("#idMascota").empty();
            $("#idCanil").empty();
            $('#dlg').dialog('open').dialog('setTitle', 'Crear Reserva');
            document.getElementById('accion').value = "AGREGAR";
        }

        function guardarReserva() {
            var permitir = true;
            var idEstadoReserva = document.getElementById('idEstadoReserva').value;
            if (document.getElementById('accion').value == "AGREGAR") {
                if (idEstadoReserva == 3) {
                    permitir = false;
                }
            }

            if (permitir) {
                if (validar()) {
                    $('#fm').form('submit', {
                        url: "../Servlet/administrarReservaHostal.php",
                        onSubmit: function () {
                            return $(this).form('validate');
                        },
                        success: function (result) {
                            var result = eval('(' + result + ')');
                            if (result.errorMsg) {
                                $.messager.alert('Error', result.errorMsg);
                            } else {
                                $('#dlg').dialog('close');        // close the dialog
                                $('#dg').datagrid('reload');    // reload the user data
                                $("#idMascota").empty();
                                $("#idCanil").empty();
                                $.messager.show({
                                    title: 'Aviso',
                                    msg: result.mensaje
                                });
                            }
                        }
                    });
                }
            } else {
                $.messager.alert('Error', "No puede agregar una reserva con el estado: 'Finalizada'");
            }
        }

        function eliminarReserva() {
            var row = $('#dg').datagrid('getSelected');
            if (row) {
                $.messager.confirm('Confirmar', '¿Esta seguro de eliminar la reserva seleccionado?', function (r) {
                    if (r) {//SI
                        $.post('../Servlet/administrarReservaHostal.php?accion=BORRAR', {idReservaHostal: row.idReservaHostal}, function (result) {
                            if (result.success) {
                                $('#dg').datagrid('reload');    // reload the user data
                                $.messager.show({
                                    title: 'Aviso',
                                    msg: result.mensaje
                                });
                            } else {
                                $.messager.show({// show error message
                                    title: 'Error',
                                    msg: result.errorMsg
                                });
                            }
                        }, 'json');
                    }
                });
            } else {
                $.messager.alert('Alerta', 'Debe seleccionar una reserva a eliminar.');
            }
        }

        function buscarReserva() {
            var cadena = document.getElementById("inputBuscarReserva").value;  
            var url_json = '../Servlet/administrarReservaHostal.php?accion=BUSCAR&cadena=' + cadena;
            $.getJSON(
                    url_json,
                    function (datos) {
                        $('#dg').datagrid('loadData', datos);
                    }
            );
        }

        function editarReserva() {
            document.getElementById("fm").reset();
            var row = $('#dg').datagrid('getSelected');
            if (row) {
                document.getElementById('run').value = row.run;
                $('#dlg').dialog('open').dialog('setTitle', 'Editar Reserva');
                buscarMascotasEditar(row.idMascota);
                $('#fm').form('load', row);
                document.getElementById('accion').value = "ACTUALIZAR";
                if (row.idEstadoReserva == 2) {
                    buscarEstadoPago();
                    habilitarPago();
                } else {
                    document.getElementById('estado-pago').style.display = 'none';
                }
            } else {
                $.messager.alert('Alerta', 'Debe seleccionar la reserva a editar.');
            }
        }

        function buscarEstadoPago() {
            var idReservaHostal = document.getElementById('idReservaHostal').value;
            var url_json = '../Servlet/administrarPago.php?accion=BUSCAR_BY_ID_RESERVA&idReserva=' + idReservaHostal;
            $.getJSON(
                    url_json,
                    function (data) {
                        if (data.idPago != null) {
                            document.getElementById('pago').value = 2;
                        } else {
                            document.getElementById('pago').value = 1;
                        }
                    }
            );
        }

        function habilitarPago() {
            var idEstadoReserva = document.getElementById('idEstadoReserva').value;
            if (idEstadoReserva == 2) {
                document.getElementById('estado-pago').style.display = 'inline';
                buscarEstadoPago();
            } else {
                document.getElementById('estado-pago').style.display = 'none';
            }
        }

        function validar() {
            if (Rut(document.getElementById('run').value)) {
                if (document.getElementById('fechaInicio').value != "") {
                    if (document.getElementById('fechaFin').value != "") {
                        if (document.getElementById('tarifa').value != "") {
                            if (document.getElementById('idMascota').value != "") {
                                if (document.getElementById('idCanil').value != "") {
                                    return true;
                                } else {
                                    $.messager.alert("Alerta", "No hay caniles disponibles para las fechas indicadas.");
                                }
                            } else {
                                $.messager.alert("Alerta", "EL cliente no tiene mascotas registrada.");
                            }
                        } else {
                            $.messager.alert("Alerta", "Debe ingresar la tarifa.");
                        }
                    } else {
                        $.messager.alert("Alerta", "Debe ingresar la fecha de termino");
                    }
                } else {
                    $.messager.alert("Alerta", "Debe ingresar la fecha de inicio");
                }
            } else {
                $.messager.alert("Alerta", "El run ingresado no es valido");
            }
            return false;
        }

        function buscarMascotas() {
            var run = document.getElementById("run").value;
            var url_json = '../Servlet/administrarMascotas.php?accion=BUSCAR_BY_RUN&run=' + run;
            $("#idMascota").empty();
            $.getJSON(
                    url_json,
                    function (data) {
                        $.each(data, function (k, v) {
                            $("#idMascota").append("<option value=\'" + v.idMascota + "\'>" + v.nombre + "</option>");
                        });
                    }
            );
        }


        
        function buscarMascotasEditar(idMascota) {
            var run = document.getElementById("run").value;
            var url_json = '../Servlet/administrarMascotas.php?accion=BUSCAR_BY_RUN&run=' + run;
            $("#idMascota").empty();
            $.getJSON(
                    url_json,
                    function (data) {
                        $.each(data, function (k, v) {
                            $("#idMascota").append("<option value=\'" + v.idMascota + "\'>" + v.nombre + "</option>");
                        });
                        document.getElementById('idMascota').value = idMascota;
                        buscarCanilParaMascota();
                    }
            );
        }

        function buscarCanilParaMascota() {
            var idMascota = document.getElementById("idMascota").value;
            var fechaInicio = document.getElementById("fechaInicio").value;
            var fechaFin = document.getElementById("fechaFin").value;
            var url_json = '../Servlet/administrarCanil.php?accion=BUSCAR_CANIL_LIBRE_BY_MASCOTA&idMascota=' + idMascota + '&fechaInicio=' + fechaInicio + '&fechaFin=' + fechaFin;
            $("#idCanil").empty();
            $.getJSON(
                    url_json,
                    function (data) {
                        $.each(data, function (k, v) {
                            $("#idCanil").append("<option value=\'" + v.idCanil + "\'>" + v.dimension + "</option>");
                        });
                    }
            );
        }

        function eliminarCaracteres() {
            var aux = String(document.getElementById("run").value);
            aux = aux.replace('.', '');
            aux = aux.replace('.', '');
            aux = aux.replace('-', '');
            document.getElementById("run").value = aux;
        }

        function diasEntreFechas() {
            var f1 = document.getElementById("fechaInicio").value;
            var f2 = document.getElementById("fechaFin").value;
            var f_actual = fechaActual();

            if (f1 != "" && f2 != "") {
                if (f1 >= f_actual) {
                    if (f1 <= f2) {
                        var dia1 = f1.substr(8);
                        var mes1 = f1.substr(5, 2);
                        var anyo1 = f1.substr(0, 4);

                        var dia2 = f2.substr(8);
                        var mes2 = f2.substr(5, 2);
                        var anyo2 = f2.substr(0, 4);

                        var nuevafecha1 = new Date(anyo1 + "," + mes1 + "," + dia1);
                        var nuevafecha2 = new Date(anyo2 + "," + mes2 + "," + dia2);

                        var Dif = nuevafecha2.getTime() - nuevafecha1.getTime();
                        var dias = Math.floor(Dif / (1000 * 24 * 60 * 60));
                        document.getElementById("tarifa").value = (dias + 1) * 5000;
                        buscarCanilParaMascota();
                    } else {
                        $.messager.alert('Error', "La fecha final no puede ser menor a la inicial");
                        document.getElementById("fechaFin").value = "";
                    }
                } else {
                    $.messager.alert('Error', "La fecha inicial no puede ser menor a la actual");
                    document.getElementById("fechaInicio").value = "";
                }
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