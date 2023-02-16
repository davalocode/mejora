<?php

    if (array_key_exists("direccion",$_COOKIE)) {
        $_SESSION['direccion'] = $_COOKIE['direccion'];
    }

    if (array_key_exists("direccion",$_SESSION)) {
        echo "<script>window.location.href = 'https://iawdanielvaldes-com.stackstaging.com/proyectodireccion.php';</script>";
    }

    if (array_key_exists("administrador",$_COOKIE)) {
        $_SESSION['administrador'] = $_COOKIE['administrador'];
    }

    if (!array_key_exists("administrador",$_SESSION)) {
        echo "<script>window.location.href = 'https://iawdanielvaldes-com.stackstaging.com/proyectousuario.php';</script>";
    }

?>