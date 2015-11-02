<?php include 'header.php'; ?>

<table id="dg" title="Clientes" class="easyui-datagrid" style="width:900px;height:600px"
       url="../Servlet/administrarPersonas.php?accion=Listado"
       toolbar="#toolbar"
       rownumbers="true" fitColumns="true" singleSelect="true">
    <thead>
        <tr>
            <th field="run" width="30">Run</th>
            <th field="nombres" width="60">Nombres</th>
            <th field="apellidos" width="60">Apellidos</th>
            <th field="fechaNac" width="30">Fecha Nac.</th>
            <th field="sexo" width="30">Sexo</th>
            <th field="direccion" width="50">Direccion</th>
            <th field="telefono" width="30">Telefono</th>
        </tr>
    </thead>
</table>

<div id="toolbar">
    <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="crearPersona()">Agregar</a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editarPersona()">Editar</a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="eliminarPersona()">Eliminar</a>
    <input type="search" name="inputBuscarPersona" id="inputBuscarPersona" placeholder="Buscar por nombres" results="4" onKeyUp="buscarPersona()">    
</div>

<div id="dlg" class="easyui-dialog" style="width:410px;height:485px;padding:10px 20px;"
     closed="true" buttons="#dlg-buttons" modal="true">
    <div class="ftitle"></div>
    <form id="fm" method="post" novalidate>
        <div class="fitem">
            <label>Run:</label>
            <input name="run" id="run" class="easyui-validatebox" style="width:200px;"  required placeholder="ej 11222333k" onkeyup="eliminarCaracteres()">
        </div>
        <div class="fitem">
            <label>Nombres:</label>
            <input type="text" class="easyui-validatebox" value="" id="nombres" style="width:200px;" name="nombres" maxlength="45" required>
        </div>
        <div class="fitem">
            <label>Apellidos:</label>
            <input type="text" class="easyui-validatebox" value="" id="apellidos" style="width:200px;" name="apellidos" maxlength="45" required>
        </div>
        <div class="fitem">
            <label>Fecha Nacimiento:</label>
            <input type="date" class="easyui-validatebox" value="" id="fechaNac" style="width:200px; height: 21px;" name="fechaNac" required>
        </div>
        <div class="fitem2">
            <label>Sexo: </label>
            <input type="radio" name="sexo" value="F" style="margin-left:120px;"checked> Femenino
            <input type="radio" name="sexo" value="M" style="margin-left:20px;" > Masculino<br>
        </div>
        <div class="fitem">
            <label>Direccion:</label>
            <input type="text" class="easyui-validatebox" value="" id="direccion" style="width:200px;" name="direccion" maxlength="45" required>
        </div>
        <div class="fitem">
            <label>Telefono/Celular:</label>
            <input type="text" class="easyui-validatebox" value="" id="telefono" style="width:200px;" name="telefono" maxlength="45" pattern="^[9|8|7|6|5]\d{6}$" Required>
        </div>

        <div class="fitem">
            <label>Clave:</label>
            <input type="password" class="easyui-validatebox" value="" id="clave" style="width:200px;" name="clave" maxlength="45" pattern=".{6,}" title="minimo 4 caracteres" Required>
        </div>
        <div class="fitem">
            <label>Confirmar Clave:</label>
            <input type="password" class="easyui-validatebox" value="" id="claveRepetida" style="width:200px;" name="claveRepetida" maxlength="45" pattern=".{6,}" title="minimo 4 caracteres" Required>
        </div>
        <input name="accion" id="accion" type="hidden">
        <input name="runRespaldo" id="runRespaldo" type="hidden">
    </form>
</div>  

<div id="dlg-buttons">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="guardarPersona()">Guardar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')">Cancelar</a>
</div>  

<!-- Administracion-->
<script src="../../files/js/validarut.js"></script>

<script>
        function crearPersona() {
            document.getElementById("fm").reset();
            run.disabled = false;//Activamos
            $('#dlg').dialog('open').dialog('setTitle', 'Crear Persona');
            document.getElementById('accion').value = "AGREGAR";
        }

        function guardarPersona() {
            if (validar()) {
                $('#fm').form('submit', {
                    url: "../Servlet/administrarPersonas.php",
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
        function eliminarPersona() {
            var row = $('#dg').datagrid('getSelected');
            if (row) {
                $.messager.confirm('Confirmar', '¿Esta seguro de eliminar la persona seleccionado?', function (r) {
                    if (r) {//SI
                        $.post('../Servlet/administrarPersonas.php?accion=BORRAR', {run: row.run}, function (result) {
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
                $.messager.alert('Alerta', 'Debe seleccionar la persona a eliminar.');
            }
        }

        function buscarPersona() {
            var nombres = document.getElementById("inputBuscarPersona").value;
            var parm = "";
            parm = parm + "&nombres=" + nombres;

            var url_json = '../Servlet/administrarPersonas.php?accion=BUSCAR' + parm;
            $.getJSON(
                    url_json,
                    function (datos) {
                        $('#dg').datagrid('loadData', datos);
                    }
            );
        }

        function editarPersona() {
            document.getElementById("fm").reset();
            var row = $('#dg').datagrid('getSelected');
            if (row) {
                $('#dlg').dialog('open').dialog('setTitle', 'Editar Persona');
                $('#run').val(row.run);
                $('#runRespaldo').val(row.run);
                $('#fm').form('load', row);
                obtieneUsuario();
                document.getElementById('accion').value = "ACTUALIZAR";
            } else {
                $.messager.alert('Alerta', 'Debe seleccionar la persona a editar.');
            }
        }

        function obtieneUsuario() {
            var run = document.getElementById("run").value;
            var parm = "";
            if (run != "") {
                parm = parm + "&run=" + run;
            }
            var url_json = '../Servlet/administrarUsuarios.php?accion=BUSCAR' + parm;
            $.getJSON(
                    url_json,
                    function (dato) {
                        document.getElementById("clave").value = dato.clave;
                        $('#claveRepetida').val(dato.clave);
                    }
            );
        }

        function validar() {
            if (Rut(document.getElementById('run').value)) {
                if (document.getElementById('nombres').value != "") {
                    if (document.getElementById('apellidos').value != "") {
                        if (document.getElementById('fechaNac').value != "") {
                            if (document.getElementById('direccion').value != "") {
                                var telefono = document.getElementById('telefono').value;
                                if (telefono != "" && telefono.length > 5) {
                                    if (!isNaN(telefono)) {
                                        var cadenaPass = document.getElementById('clave').value;
                                        if (cadenaPass.length >= 4) {
                                            if (cadenaPass == document.getElementById('claveRepetida').value) {
                                                return true;
                                            } else {
                                                $.messager.alert("Alerta", "Las contraseñas no coinciden");
                                            }
                                        } else {
                                            $.messager.alert("Alerta", "La contraseña debe tener minimo 4 caracteres");
                                        }
                                    } else {
                                        $.messager.alert("Alerta", "El telefono contiene caracteres no validos");
                                    }
                                } else {
                                    $.messager.alert("Alerta", "Debe ingresar una telefono de contacto con al menos 6 digitos");
                                }
                            } else {
                                $.messager.alert("Alerta", "Debe ingresar una direccion");
                            }
                        } else {
                            $.messager.alert("Alerta", "Debe ingresar una fecha de nacimiento");
                        }
                    } else {
                        $.messager.alert("Alerta", "Debe ingresar sus apellidos");
                    }
                } else {
                    $.messager.alert("Alerta", "Debe ingresar sus nombres");
                }
            } else {
                $.messager.alert("Alerta", "El run ingresado no es valido");
            }
            return false;
        }

        function eliminarCaracteres() {
            var aux = String(document.getElementById("run").value);
            aux = aux.replace('.', '');
            aux = aux.replace('.', '');
            aux = aux.replace('-', '');
            document.getElementById("run").value = aux;
        }

</script>
<?php include 'footer.php'; ?>