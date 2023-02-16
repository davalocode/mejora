<?php
    session_start();
    if (array_key_exists("id",$_COOKIE)) {
        $_SESSION['id'] = $_COOKIE['id'];
    }

    if (array_key_exists("id",$_SESSION)) {
    $servidor = "sdb-51.hosting.stackcp.net";
    $database = "bdpruebas-35303033a085";
    $usuario = "usuario-3ea9";
    $password = "usuario123";
    
    $enlace = mysqli_connect($servidor, $usuario, $password, $database);
    
    if (!$enlace) {
        echo "Conexión fallida: " . mysqli_connect_error();
    }
} else {
    echo "<script>window.location.href = 'https://iawdanielvaldes-com.stackstaging.com/loginproyecto.php';</script>";
}
    ?>