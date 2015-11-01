<?php include 'header.php'; ?>

<table id="dg" title="Mascotas" class="easyui-datagrid" style="width:900px;height:600px"
       url="../Servlet/administrarMascotas.php?accion=Listado"
       toolbar="#toolbar"
       rownumbers="true" fitColumns="true" singleSelect="true">
    <thead>
        <tr>
            <th field="raza" width="60">Raza</th>
            <th field="nombre" width="60">Nombre</th>
            <th field="run" width="30">Run Dueño</th>
        </tr>
    </thead>
</table>
<div id="toolbar">
    <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="crearMascota()">Agregar</a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editarMascota()">Editar</a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="eliminarMascota()">Eliminar</a>
    <input type="search" name="inputBuscarMascota" id="inputBuscarMascota" placeholder="Buscar por nombre" results="4" onKeyUp="buscarMascota()">    
</div>
<div id="dlg" class="easyui-dialog" style="width:410px;height:210px;padding:20px 30px;"
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
            <input name="run" id="run" class="easyui-validatebox" style="width:200px;"  required placeholder="ej 11222333k" >
        </div>
        <input name="accion" id="accion" type="hidden">
        <input name="idMascota" id="idMascota" type="hidden">
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
                document.getElementById('accion').value = "ACTUALIZAR";
            } else {
                $.messager.alert('Alerta', 'Debe seleccionar la mascota a editar.');
            }
        }

        function validar() {
            if (Rut(document.getElementById('run').value)) {
                if (document.getElementById('nombre').value != "") {
                    if (document.getElementById('raza').value != "") {
                        return true;
                    } else {
                        $.messager.alert("Alerta", "Debe ingresar La raza de la mascota");
                    }
                } else {
                    $.messager.alert("Alerta", "Debe ingresar el nombre");
                }
            } else {
                $.messager.alert("Alerta", "El run ingresado no es valido");
            }
            return false;
        }

</script>

<?php include 'footer.php'; ?>