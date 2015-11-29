<?php include 'header.php'; ?>

<div class='container'>            
    <div class="formulario">
        <label><h2>Editar Pefil</h2></label><br>
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
    <div class="botonReporte">
        <button onclick="guardarPersona()" class="btn btn-default" style="width: 300px; height: 25px; border-radius: 5px;"> Actualizar mis datos personales</button>
    </div>

</div>

<!-- Administracion-->
<script src="../../files/js/validarut.js"></script>

<script language="javascript">
    $(document).ready(function () {
        editarPersona();
    });

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

    function editarPersona() {
        document.getElementById("fm").reset();        
        var url_json = '../Servlet/administrarPersonas.php?accion=GET_USUARIO_ACTIVO';
        $.getJSON(
                url_json,
                function (dato) {
                    $('#run').val(dato.run);
                    $('#runRespaldo').val(dato.run);
                    $('#fm').form('load', dato);
                    obtieneUsuario();
                    document.getElementById('accion').value = "ACTUALIZAR";
                }
        );

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