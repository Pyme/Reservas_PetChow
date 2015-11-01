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
            })
        </script>
    </head>
    <body>
        <section id = "Contenedor">
            <header>
                <a href="index.php"><img src="files/img/logo.jpg" width="900px" height="102px"></a>
            </header>
            <section id="Menu">
                <ul class="nav">
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="quienesSomos.php">Quienes Somos</a></li>
                    <li><a href="contacto.php">Contacto</a></li>
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
                <div class="cubo" id="quienesSomos">
                    <h4><b>Quienes Somos</b></h4>
                    <p>
                        Somos una empresa que se dedica desde hace más de 5 años a ofrecer un servicio personalizado, amable y de alta calidad, a través de un equipo de trabajo que se esmera día a día para que su mascota se sienta como en casa. Lo que nos hace una buena opción por nuestro ambiente agradable, ameno y acogedor. 
                    </p>
                    <h4><b>Vision</b></h4>
                    <p>
                        Somos un equipo comprometido con el servicio personalizado, para satisfacer a sus mascotas y lograr su fidelidad.
                    </p>
                    <h4><b>Mision</b></h4>
                    <p>
                        Ser el líder en el mercado en nuestro ramo, brindando un servicio confiable y seguro, posicionando a nuestra hostal en la preferencia del cliente.  
                    </p>
                    <h4><b>Valores</b></h4>
                    <p>
                    <ul>
                        <li>Trabajo.</li>
                        <li>Honestidad.</li>
                        <li>Compromiso.</li>
                    </ul>                        
                    </p>
                    <h4><b>Nuestra Filosofia</b></h4>
                    <p>
                        Orientación a la satisfacción de la mascota.<br>
                        Decisiones con responsabilidad de los colaboradores.<br>
                        Dirección abierta.<br>
                        Trabajo en equipo.<br>
                        Productividad.<br>
                    </p>
                </div>
                <div class="cubo" id="imagen">
                    <a href=""><img src="files/img/perro.png" width="250px" height="380px"></a>
                </div>
            </section>
            <footer>
                <p> Hostal de Mascotas PetChow | Av. Andres Bello S/n | Chillan <br/> Fono/Fax: (56-42)2463000 </p>
            </footer>
        </section>   
    </body>
</html>