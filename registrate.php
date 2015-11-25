<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Reservas PetChow </title>
        <link rel="shortcut icon"  href="files/img/icono.png" sizes="16x16">        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

        <link rel="stylesheet" type="text/css" href="files/Complementos/jquery-easyui-1.4.2/themes/metro-blue/easyui.css">
        <link rel="stylesheet" type="text/css" href="files/Complementos/jquery-easyui-1.4.2/themes/icon.css">

        <link rel="stylesheet" href="files/css/estilos.css">
        <script type="text/javascript" src="files/Complementos/jquery-easyui-1.4.2/jquery.min.js"></script>
        <script type="text/javascript" src="files/Complementos/jquery-easyui-1.4.2/jquery.easyui.min.js"></script>
        <script type="text/javascript" src="files/Complementos/jquery-easyui-1.4.2/plugins/jquery.datagrid.js"></script>
    </head>
    <body>
        <section id = "Contenedor">
            <header>
                <a href="index.php"><img src="files/img/logo.jpg" width="900px" height="102px"></a>
            </header>
            <section id="Menu">
                <ul class="nav">
                    <li><a style="height: 40px;" href="index.php">Inicio</a></li>
                    <li><a style="height: 40px;" href="quienesSomos.php">Quienes Somos</a></li>
                    <li><a style="height: 40px;" href="contacto.php">Contacto</a></li>
                    <li><a style="height: 40px;" href="login.php">Ingresar</a></li>
                </ul>
            </section>
            <section id="Contenido">
                <div class="login2">
                    <div class="formulario-ingreso2" style="width: 450px;">
                       <div class="titRegist" >
                            <label>Registrarse</label>
                       </div>
                        <form id="fm" method="post" novalidate>
                            <div class="fitem">
                                <label>Run:</label>
                                <input name="run" id="run" class="easyui-validatebox" style="width:240px;"  required placeholder="ej 11222333k" onkeyup="eliminarCaracteres()">
                            </div>
                            <div class="fitem">
                                <label>Nombres:</label>
                                <input type="text" class="easyui-validatebox" value="" id="nombres" style="width:240px;" name="nombres" maxlength="45" required>
                            </div>
                            <div class="fitem">
                                <label>Apellidos:</label>
                                <input type="text" class="easyui-validatebox" value="" id="apellidos" style="width:240px;" name="apellidos" maxlength="45" required>
                            </div>
                            <div class="fitem">
                                <label>Fecha Nacimiento:</label>
                                <input type="date" class="easyui-validatebox" value="" id="fechaNac" style="width:240px; height: 21px;" name="fechaNac" required>
                            </div>
                            <div class="fitem2">
                                <label>Sexo: </label>
                                <input type="radio" name="sexo" value="F" style="margin-left:120px;"checked> Femenino
                                <input type="radio" name="sexo" value="M" style="margin-left:45px;" > Masculino<br>
                            </div>
                            <div class="fitem">
                                <label>Direccion:</label>
                                <input type="text" class="easyui-validatebox" value="" id="direccion" style="width:240px;" name="direccion" maxlength="45" required>
                            </div>
                            <div class="fitem">
                                <label>Telefono/Celular:</label>
                                <input type="text" class="easyui-validatebox" value="" id="telefono" style="width:240px;" name="telefono" maxlength="45" pattern="^[9|8|7|6|5]\d{6}$" Required>
                            </div>

                            <div class="fitem">
                                <label>Clave:</label>
                                <input type="password" class="easyui-validatebox" value="" id="clave" style="width:240px;" name="clave" maxlength="45" pattern=".{6,}" title="minimo 4 caracteres" Required>
                            </div>
                            <div class="fitem">
                                <label>Confirmar Clave:</label>
                                <input type="password" class="easyui-validatebox" value="" id="claveRepetida" style="width:240px;" name="claveRepetida" maxlength="45" pattern=".{6,}" title="minimo 4 caracteres" Required>
                            </div>
                            <input name="accion" id="accion" type="hidden" value="AGREGAR">
                            <div class="boton-login2">
                                <a class="btn btn-default" onclick="guardarPersona()">Registrarse</a>
                            </div>   
                        </form>
                        <div class = "declaracion">
                            <p>
                                Al registrarme, declaro que soy mayor de edad y acepto las Políticas de privacidad y los Términos y condiciones de Petchow
                            </p>
                        </div>
                    </div>
                </div>
            </section>
            <footer>
                <p> Hostal de Mascotas PetChow | Av. Andres Bello S/n | Chillan <br/> Fono/Fax: (56-42)2463000 </p>
            </footer>
        </section>   
        <!-- Administracion-->
        <script src="files/js/validarut.js"></script>
        <script type="text/javascript">
                                    function guardarPersona() {
                                        if (validar()) {
                                            $('#fm').form('submit', {
                                                url: "Vista/Servlet/administrarPersonas.php",
                                                onSubmit: function () {
                                                    return $(this).form('validate');
                                                },
                                                success: function (result) {
                                                    var result = eval('(' + result + ')');
                                                    if (result.errorMsg) {
                                                        $.messager.alert('Error', result.errorMsg);
                                                    } else {
                                                        document.getElementById("fm").reset();
                                                        $.messager.show({
                                                            title: 'Aviso',
                                                            msg: result.mensaje
                                                        });
                                                    }
                                                }
                                            });
                                        }
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
    </body>
</html>
