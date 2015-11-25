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
        <script>
            $('.carousel').carousel({
                interval: 3000
            });
        </script>

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
                <div class="login">
                    <div class="cubo" id="formulario-ingreso" style="width: 310px;">
                        <div class="titini">
                            <label>Iniciar sesión</label>
                        </div>
                        <form id="fm" method="post" novalidate>
                            <div class="form-group">
                                <label for="InputRut">Run</label>
                                <input type="text" class="form-control" id="InputRun" name="InputRun" placeholder="112223339" style="width:270px;">
                            </div>
                            <div class="form-group">
                                <label for="InputPassword1">Contraseña</label>
                                <input type="password" class="form-control" id="InputPassword1" name="InputPassword1" placeholder="Password" style="width:270px;">
                            </div>
                            <div class="boton-login">
                                <a class="btn btn-default" onclick="validarLogin()" >Entrar</a> 
                            </div>   
                        </form>
                        <p><a href="registrate.php">¿No dispone de una Cuenta? ¡Registrese ahora!</a></p>
                    </div> 
                    <div class="cubo" id="info" style="width: 520px;">
                        <label>Visitanos</label>
                        <p>
                            Tenemos el mejor ambiente agradable, ameno y acogedor. 
                        </p>
                        <a href=""><img src="files/img/pie.jpg" width="480px" height="220px"></a>
                    </div>
                </div>
            </section>
            <footer>
                <p> Hostal de Mascotas PetChow | Av. Andres Bello S/n | Chillan <br/> Fono/Fax: (56-42)2463000 </p>
            </footer>
        </section>   
        <script>
            function validarLogin() {
                $('#fm').form('submit', {
                    url: "Vista/Servlet/login.php",
                    onSubmit: function () {
                        return $(this).form('validate');
                    },
                    success: function (result) {
                        var result = eval('(' + result + ')');
                        if (!result.success) {
                            $.messager.alert('Error', result.mensaje);
                        } else {
                            location.href = result.pagina;
                        }
                    }
                });
            }
        </script>
    </body>
</html>
