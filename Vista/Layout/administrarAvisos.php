<?php include 'header.php'; ?>

<table id="dg" title="Avisos" class="easyui-datagrid" style="width:890px;height:450px"
       url="../Servlet/administrarAviso.php?accion=LISTADO"
       toolbar="#toolbar"
       rownumbers="true" fitColumns="true" singleSelect="true">
    <thead>
        <tr>
            <th field="idAviso" width="20">ID</th>
            <th field="fecha" width="30">Fecha</th>
            <th field="rutaImagen" width="50">Imagen</th>
            <th field="descripcion" width="80">Descripcion</th>                        
        </tr>
    </thead>
</table>

<div id="toolbar">
    <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="crearAviso()">Agregar</a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editarAviso()">Editar</a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="eliminarAviso()">Eliminar</a>
    <!-- <input type="search" name="inputBuscarPersona" id="inputBuscarPersona" placeholder="Buscar..." results="4" onKeyUp="buscarPersona()">    -->
</div>

<div id="dlg" class="easyui-dialog" style="width:410px;height:325px;padding:10px 20px;"
     closed="true" buttons="#dlg-buttons" modal="true">
    <div class="ftitle"></div>
    <form id="fm" method="post" enctype="multipart/form-data">        
        <div class="fitem">
            <label>Imagen:</label>
            <input type="file" class="easyui-validatebox" value="" id="rutaImagen" style="width:250px;" name="rutaImagen">
        </div>
        <div class="fitem">
            <label>Descripción:</label><br>
            <textarea type="text" class="easyui-validatebox" value="" id="descripcion" name="descripcion" maxlength="200" cols="50" rows="13"></textarea>
        </div>
        <input name="accion" id="accion" type="hidden">
        <input name="idAviso" id="idAviso" type="hidden">
    </form>
</div>  

<div id="dlg-buttons">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="guardarAviso()">Guardar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')">Cancelar</a>
</div>  

<script type="text/javascript">
    function crearAviso() {
        document.getElementById("fm").reset();
        $('#dlg').dialog('open').dialog('setTitle', 'Crear Aviso');
        document.getElementById('accion').value = "AGREGAR";
    }

    function guardarAviso() {
        if (validar()) {
            $('#fm').form('submit', {
                url: "../Servlet/administrarAviso.php",
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
                        $.messager.show({
                            title: 'Aviso',
                            msg: result.mensaje
                        });
                    }
                }
            });
        }

    }

    function eliminarAviso() {
        var row = $('#dg').datagrid('getSelected');
        if (row) {
            $.messager.confirm('Confirmar', '¿Esta seguro de eliminar el aviso seleccionado?', function (r) {
                if (r) {//SI
                    $.post('../Servlet/administrarAviso.php?accion=BORRAR', {idAviso: row.idAviso}, function (result) {
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
            $.messager.alert('Alerta', 'Debe seleccionar el aviso a eliminar.');
        }
    }

    function editarAviso() {
        document.getElementById("fm").reset();
        var row = $('#dg').datagrid('getSelected');
        if (row) {
            $('#dlg').dialog('open').dialog('setTitle', 'Editar Aviso');        
            document.getElementById('descripcion').value = row.descripcion;
            document.getElementById('idAviso').value = row.idAviso;
            document.getElementById('accion').value = "ACTUALIZAR";
        } else {
            $.messager.alert('Alerta', 'Debe seleccionar el aviso a editar.');
        }
    }

    function validar() {
        return true;
    }

</script>
<?php include 'footer.php'; ?>