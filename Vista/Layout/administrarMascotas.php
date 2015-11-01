<?php include 'header.php'; ?>

<table id="dg" title="Mascotas" class="easyui-datagrid" style="width:900px;height:600px"
       url="../Servlet/administrarMascotas.php?accion=Listado"
       toolbar="#toolbar"
       rownumbers="true" fitColumns="true" singleSelect="true">
    <thead>
        <tr>
            <th field="idMascota" width="30">ID</th>
            <th field="raza" width="60">Raza</th>
            <th field="nombre" width="60">Nombre</th>
            <th field="run" width="30">Run Dueño</th>
            <th field="tipoMascota" width="30">Tipo Mascota</th>
        </tr>
    </thead>
</table>
<div id="toolbar">
    <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="crearMascota()">Agregar</a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editarMascota()">Editar</a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="eliminarMascota()">Eliminar</a>
    <input type="search" name="inputBuscarMascota" id="inputBuscarMascota" placeholder="Buscar por nombre" results="4" onKeyUp="buscarMascota()">    
</div>
<div id="dlg" class="easyui-dialog" style="width:410px;height:220px;padding:20px 30px;"
     closed="true" buttons="#dlg-buttons" modal="true">
    <div class="ftitle"></div>
    <form id="fm" method="post" novalidate>
        <div class="fitem">
            <label>Raza:</label>
            <input type="text" class="easyui-validatebox" value="" id="raza" style="width:200px;" name="raza" maxlength="45" required>
        </div>
        <div class="fitem">
            <label>Nombre:</label>
            <input type="text" class="easyui-validatebox" value="" id="nombre" style="width:200px;" name="nombre" maxlength="45" required>
        </div>
        <div class="fitem">
            <label>Run Dueño:</label>
            <input name="run" id="run" class="easyui-validatebox" style="width:200px;"  required placeholder="ej 11222333k" onkeyup="obtienePersona()" >
        </div>
        <div class="fitem">
            <label>Tipo Mascota:</label>
            <select class="easyui-validatebox" value="" id="tipoMascota" style="width:200px;" name="tipoMascota" maxlength="45">
                <option value='Perro'>Perro</option>
                <option value='Gato'>Gato</option>
            </select>
        </div>
        <input name="accion" id="accion" type="hidden">
        <input name="idMascota" id="idMascota" type="hidden">
        <input name="existe" id="existe" type="hidden">
    </form>
</div>  
<div id="dlg-buttons">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="guardarMascota()">Guardar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')">Cancelar</a>
</div>  
<!-- Administracion-->
<script src="../../files/js/validarut.js"></script>
<script>
        function crearMascota() {
            document.getElementById("fm").reset();
            $('#dlg').dialog('open').dialog('setTitle', 'Crear Mascota');
            document.getElementById('accion').value = "AGREGAR";
        }

        function guardarMascota() {
            if (validar()) {
                $('#fm').form('submit', {
                    url: "../Servlet/administrarMascotas.php",
                    onSubmit: function () {
                        return $(this).form('validate');
                    },
                    success: function (result) {
                        console.log(result);
                        var result = eval('(' + result + ')');
                        if (result.errorMsg) {
                            $.messager.alert('Error', result.errorMsg);
                        } else {
                            $('#dlg').dialog('close');        // close the dialog
                            $('#dg').datagrid('reload');    // reload the user data
                            $.messager.show({
                                title: 'Aviso',
                                msg: result.mensaje
                            });
                        }
                    }
                });
            }
        }
        function eliminarMascota() {
            var row = $('#dg').datagrid('getSelected');
            if (row) {
                $.messager.confirm('Confirmar', '¿Esta seguro de eliminar la mascota seleccionada?', function (r) {
                    if (r) {//SI
                        $.post('../Servlet/administrarMascotas.php?accion=BORRAR', {idMascota: row.idMascota}, function (result) {
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
                $.messager.alert('Alerta', 'Debe seleccionar la mascota a eliminar.');
            }
        }
        function buscarMascota() {
            var nombre = document.getElementById("inputBuscarMascota").value;
            var parm = "";
            parm = parm + "&nombre=" + nombre;
            var url_json = '../Servlet/administrarMascotas.php?accion=BUSCAR' + parm;
            $.getJSON(
                    url_json,
                    function (datos) {
                        $('#dg').datagrid('loadData', datos);
                    }
            );
        }
        function editarMascota() {
            document.getElementById("fm").reset();
            var row = $('#dg').datagrid('getSelected');
            if (row) {
                $('#dlg').dialog('open').dialog('setTitle', 'Editar Mascota');
                $('#raza').val(row.raza);
                $('#nombre').val(row.nombre);
                $('#run').val(row.run);
                $('#fm').form('load', row);
                document.getElementById("existe").value = true;
                document.getElementById('accion').value = "ACTUALIZAR";
            } else {
                $.messager.alert('Alerta', 'Debe seleccionar la mascota a editar.');
            }
        }

        function obtienePersona() {
            var run = document.getElementById("run").value;
            var parm = "";
            if (run != "") {
                parm = parm + "&run=" + run;
            }
            var url_json = '../Servlet/administrarPersonas.php?accion=BUSCAR_BY_RUN' + parm;
            $.getJSON(
                    url_json,
                    function (dato) {
                        if (dato.run != null) {
                            document.getElementById("existe").value = true;
                        } else {
                            document.getElementById("existe").value = false;
                        }
                    }
            );
        }

        function validar() {
            if (Rut(document.getElementById('run').value)) {
                if (document.getElementById("existe").value == "true") {
                    if (document.getElementById('nombre').value != "") {
                        if (document.getElementById('raza').value != "") {
                            if (document.getElementById('tipoMascota').value != "") {
                                return true;
                            } else {
                                $.messager.alert("Alerta", "Debe seleccionar un tipo de mascota");
                            }
                        } else {
                            $.messager.alert("Alerta", "Debe ingresar La raza de la mascota");
                        }
                    } else {
                        $.messager.alert("Alerta", "Debe ingresar el nombre");
                    }
                } else {
                    $.messager.alert("Alerta", "Debe registrar al cliente.");
                }
            } else {
                $.messager.alert("Alerta", "El run ingresado no es valido");
            }
            return false;
        }

</script>

<?php include 'footer.php'; ?>