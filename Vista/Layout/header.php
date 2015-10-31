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
        <link rel="stylesheet" href="../../files/css/estilos.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
       
        <link rel="stylesheet" type="text/css" href="../../files/Complementos/jquery-easyui-1.4.2/themes/metro-blue/easyui.css">
        <link rel="stylesheet" type="text/css" href="../../files/Complementos/jquery-easyui-1.4.2/themes/icon.css">
        <link rel="stylesheet" type="text/css" href="../../files/Complementos/jquery-easyui-1.4.2/demo/demo.css">
        <script type="text/javascript" src="../../files/Complementos/jquery-easyui-1.4.2/jquery.min.js"></script>
        <script type="text/javascript" src="../../files/Complementos/jquery-easyui-1.4.2/jquery.easyui.min.js"></script>
        <script type="text/javascript" src="../../files/Complementos/jquery-easyui-1.4.2/plugins/jquery.datagrid.js"></script>
    </head>
    <body>
        <section id = "Contenedor">
            <header>
                <a href="index.html"><img src="../../files/img/logo.jpg" width="900px" height="102px"></a>
            </header>
            <section id="Menu">
                <?php
                session_start();
                if ($_SESSION['autentificado'] != "SI") {
                    header("Location: ../../../index.php");
                }
                $perfil = $_SESSION["idPerfil"];
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