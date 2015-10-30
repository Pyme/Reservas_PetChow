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
        <link rel="stylesheet" href="files/css/estilos.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script>
            $('.carousel').carousel({
                interval: 3000
            });
        </script>
        
        <link rel="stylesheet" type="text/css" href="files/Complementos/jquery-easyui-1.4.2/themes/default/easyui.css">
        <link rel="stylesheet" type="text/css" href="files/Complementos/jquery-easyui-1.4.2/themes/icon.css">
        <link rel="stylesheet" type="text/css" href="files/Complementos/jquery-easyui-1.4.2/demo/demo.css">
        <script type="text/javascript" src="files/Complementos/jquery-easyui-1.4.2/jquery.min.js"></script>
        <script type="text/javascript" src="files/Complementos/jquery-easyui-1.4.2/jquery.easyui.min.js"></script>
        <script type="text/javascript" src="files/Complementos/jquery-easyui-1.4.2/plugins/jquery.datagrid.js"></script>
    </head>
    <body>
        <section id = "Contenedor">
            <header>
                <a href="index.html"><img src="files/img/logo.jpg" width="900px" height="102px"></a>
            </header>
            <section id="Menu">
                <ul class="nav">
                    <li><a href="">Inicio</a></li>
                    <li><a href="">Quienes Somos</a></li>
                    <li><a href="">Contacto</a></li>
                    <li><a href="login.php">Ingresar</a></li>
                </ul>
            </section>
            <section id="banner">
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <!-- Indicators --> 
                    <ol class="carousel-indicators">
                        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="3"></li>
                    </ol>
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item active">
                            <img src="files/img/b4.jpg" alt="...">
                            <div class="carousel-caption">
                                <h3></h3>
                            </div>
                        </div>
                        <div class="item">
                            <img src="files/img/b2.jpg" alt="...">
                            <div class="carousel-caption">
                                <h3></h3>
                            </div>
                        </div>
                        <div class="item">
                            <img src="files/img/b3.jpg" alt="...">
                            <div class="carousel-caption">
                                <h3></h3>
                            </div>
                        </div>
                        <div class="item">
                            <img src="files/img/b1.jpg" alt="...">
                            <div class="carousel-caption">
                                <h3></h3>
                            </div>
                        </div>
                    </div>       

                    <!-- Controls -->
                    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                </div> <!-- Carousel -->
            </section>
            <section id="Contenido">
                  <div class="login">
                        <div class="formulario-ingreso">
                            <form id="fm" method="post" novalidate>
                                <div class="form-group">
                                    <label for="InputRut">Run:</label>
                                    <input type="text" class="form-control" id="InputRun" name="InputRun" placeholder="112223339 ">
                                </div>
                                <div class="form-group">
                                    <label for="InputPassword1">Password</label>
                                    <input type="password" class="form-control" id="InputPassword1" name="InputPassword1" placeholder="Password">
                                </div>
                                <div class="boton-login">
                                    <a class="btn btn-default" onclick="validarLogin()">Entrar</a>
                                </div>   
                            </form>
                        </div>
                    </div>
            </section>
            <footer>
                <p> Hostal de Mascotas PetChow | Av. Andres Bello S/n | Chillan <br/> Fono/Fax: (56-42)2463000 </p>
            </footer>
        </section>   
        <script>
            function validarLogin(){
                $('#fm').form('submit', {
                    url: "Vista/Servlet/login.php",
                    onSubmit: function () {
                        return $(this).form('validate');
                    },
                    success: function (result) {
                        console.log("<<"+result);
                        var result = eval('(' + result + ')');
                        $.messager.show({
                                title: 'Aviso',
                                msg: result.mensaje
                            });
                        if (!result.success) {
                            $.messager.alert('Error', result.mensaje);
                        } else {
                            
                        }
                    }
                });
            }
        </script>
    </body>
</html>
