<?php include 'header.php'; ?>

<table id="dg" title="Insumos" class="easyui-datagrid" style="width:900px;height:600px"
       url="../Servlet/administrarInsumos.php?accion=Listado"
       toolbar="#toolbar"
       rownumbers="true" fitColumns="true" singleSelect="true">
    <thead>
        <tr>
            <th field="idInsumos" width="30">ID</th>
            <th field="nombre" width="30">Nombre</th>
            <th field="stock" width="60">Stock</th>
            <th field="precio" width="60">Precio</th>        
        </tr>
    </thead>
</table>
<div id="toolbar">
    <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="utilizarInsumo()">Utilizar</a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="crearInsumo()">Agregar</a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editarInsumo()">Editar</a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="eliminarInsumo()">Eliminar</a>
    <input type="search" name="inputBuscarInsumo" id="inputBuscarInsumo" placeholder="Buscar..." results="4" onKeyUp="buscarInsumo()">    
</div>
<div id="dlg" class="easyui-dialog" style="width:340px;height:220px;padding:20px 30px;"
     closed="true" buttons="#dlg-buttons" modal="true">
    <div class="ftitle"></div>
    <form id="fm" method="post" novalidate>
        <div class="fitem">
            <label>Nombre:</label>
            <input type="text" class="easyui-validatebox" value="" id="nombre" style="width:200px;" name="nombre" maxlength="45" required>
        </div>
        <div class="fitem">
            <label>Cantidad:</label>
            <input type="text" class="easyui-validatebox" value="" id="stock" style="width:200px;" name="stock" maxlength="45" required>
        </div>
        <div class="fitem">
            <label>Precio:</label>
            <input type="text" class="easyui-validatebox" value="" id="precio" style="width:200px;" name="precio" maxlength="45" required>
        </div>       
        <input name="accion" id="accion" type="hidden">
        <input name="idInsumos" id="idInsumos" type="hidden">
    </form>
</div>  
<div id="dlg-buttons">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="guardarInsumo()">Guardar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')">Cancelar</a>
</div>  

<div id="dlg-utilizar" class="easyui-dialog" style="width:340px;height:150px;padding:20px 30px;"
     closed="true" buttons="#dlg-buttons-utilizar" modal="true">
    <div class="ftitle"></div>
    <form id="fm-utilizar" method="post" novalidate>
        <div class="fitem">
            <label>Cantidad:</label>
            <input type="number" class="easyui-validatebox" value="" id="stock" style="width:200px;" name="stock" min="0" required>
        </div>      
        <input name="idInsumosUtilizado" id="idInsumosUtilizado" type="hidden">
    </form>
</div>  
<div id="dlg-buttons-utilizar">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="descontarInsumo()">Utilizar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-utilizar').dialog('close')">Cancelar</a>
</div> 

<script>
    function crearInsumo() {
        document.getElementById("fm").reset();
        $('#dlg').dialog('open').dialog('setTitle', 'Crear Insumo');
        document.getElementById('accion').value = "AGREGAR";
    }

    function guardarInsumo() {
        $('#fm').form('submit', {
            url: "../Servlet/administrarInsumos.php",
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
    function eliminarInsumo() {
        var row = $('#dg').datagrid('getSelected');
        if (row) {
            $.messager.confirm('Confirmar', '¿Esta seguro de eliminar el insumo seleccionada?', function (r) {
                if (r) {//SI
                    $.post('../Servlet/administrarInsumos.php?accion=BORRAR', {idInsumos: row.idInsumos}, function (result) {
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
            $.messager.alert('Alerta', 'Debe seleccionar el insumo a eliminar.');
        }
    }
    function utilizarInsumo() {
        var row = $('#dg').datagrid('getSelected');
        if (row) {
            document.getElementById("fm-utilizar").reset();
            $('#dlg-utilizar').dialog('open').dialog('setTitle', 'Utilizar Insumo');
            document.getElementById('accion').value = "UTILIZAR";
        } else {
            $.messager.alert('Alerta', 'Debe seleccionar el insumo a utilizar.');
        }
    }
    /*function buscarInsumoByIdInsumo() {
     var nombre = document.getElementById("inputBuscarInsumo").value;
     var parm = "";
     parm = parm + "&nombre=" + nombre;
     var url_json = '../Servlet/administrarInsumos.php?accion=BUSCAR_BY_IDINSUMO' + parm;
     $.getJSON(
     url_json,
     function (datos) {
     $('#dg').datagrid('loadData', datos);
     }
     );
     }*/
    function buscarInsumo() {
        var nombre = document.getElementById("inputBuscarInsumo").value;
        var parm = "";
        parm = parm + "&nombre=" + nombre;
        var url_json = '../Servlet/administrarInsumos.php?accion=BUSCAR' + parm;
        $.getJSON(
                url_json,
                function (datos) {
                    $('#dg').datagrid('loadData', datos);
                }
        );
    }
    function editarInsumo() {
        document.getElementById("fm").reset();
        var row = $('#dg').datagrid('getSelected');
        if (row) {
            $('#dlg').dialog('open').dialog('setTitle', 'Editar Insumo');
            $('#nombre').val(row.nombre);
            $('#stock').val(row.stock);
            $('#precio').val(row.precio);
            $('#fm').form('load', row);
            document.getElementById('idInsumos').value = row.idInsumos;
            document.getElementById('accion').value = "ACTUALIZAR";//Listo
        } else {
            $.messager.alert('Alerta', 'Debe seleccionar el insumo a editar.');
        }
    }
</script>

<?php include 'footer.php'; ?>