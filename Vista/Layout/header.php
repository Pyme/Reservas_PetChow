<?php
session_start();
if ($_SESSION['autentificado'] != "SI") {
    header("Location: ../../../index.php");
}
$perfil = $_SESSION["idPerfil"];
?>
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
        <link rel="shortcut icon"  href="../../files/img/icono.png" sizes="16x16">        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

        <link rel="stylesheet" type="text/css" href="../../files/Complementos/jquery-easyui-1.4.2/themes/metro-blue/easyui.css">
        <link rel="stylesheet" type="text/css" href="../../files/Complementos/jquery-easyui-1.4.2/themes/icon.css">
        <link rel="stylesheet" type="text/css" href="../../files/Complementos/jquery-easyui-1.4.2/demo/demo.css">
        <script type="text/javascript" src="../../files/Complementos/jquery-easyui-1.4.2/jquery.min.js"></script>
        <script type="text/javascript" src="../../files/Complementos/jquery-easyui-1.4.2/jquery.easyui.min.js"></script>
        <script type="text/javascript" src="../../files/Complementos/jquery-easyui-1.4.2/plugins/jquery.datagrid.js"></script>

        <link rel="stylesheet" href="../../files/css/estilos.css">
    </head>
    <body>
        <section id = "Contenedor">
            <header>
                <a href=""><img src="../../files/img/logo.jpg" width="900px" height="102px"></a>
            </header>
            <section id="Menu">
                <?php
                if ($perfil == 1) {
                    include '../Menus/Administrador.php';
                } else if ($perfil == 2) {
                    include '../Menus/Persona.php';
                } else if ($perfil == 3) {
                    include '../Menus/Cuidador.php';
                } else if ($perfil == 4) {
                    include '../Menus/Secretaria.php';
                } else if ($perfil == 5) {
                    include '../Menus/Veterinario.php';
                }
                ?>

            </section>
            <section id="Contenido">
                <div class="sessionUsuario">
                    <label><?php echo $_SESSION["nombres"] . " " .$_SESSION["apellidos"]; ?></label>
                    <a href="../Servlet/loginOFF.php"><img src="../../Files/img/salir.png" width="20px" height="20px"></a><br>
                    <label><?php echo $_SESSION["nombre"]; ?></label>
                </div>