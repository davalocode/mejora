<?php 

    include "database.php";


    if (mysqli_connect_error()) {
        die("Error en la conexión que has hecho");
    }
    else {

        if(isset($_GET['eliminar'])) {
        
            if (array_key_exists("administrador",$_COOKIE)) {
                $_SESSION['administrador'] = $_COOKIE['administrador'];
            }
    
            if (!array_key_exists("administrador",$_SESSION)) {
                echo "<script>window.location.href = 'https://iawdanielvaldes-com.stackstaging.com/proyectousuario.php';</script>";
            }
            else {
                $id= htmlspecialchars($_GET['eliminar']);
                $query = "DELETE FROM incidencias WHERE id_usuario = {$id}";
                $resultado= mysqli_query($enlace, $query);
                $query = "DELETE FROM usuarios WHERE id = {$id}"; 
                $resultado= mysqli_query($enlace, $query);
                echo "<script>window.location.href = 'https://iawdanielvaldes-com.stackstaging.com/usuarios.php';</script>";
            }
        }
    }
?>