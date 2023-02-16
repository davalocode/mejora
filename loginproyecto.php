<?php
    if (array_key_exists('username',$_POST) OR
    array_key_exists('password',$_POST)) {

        $servidor = "sdb-51.hosting.stackcp.net";
        $bd = "bdpruebas-35303033a085";
        $usuario = "usuario-3ea9";
        $password = "usuario123";

        $enlace = mysqli_connect($servidor, $usuario, $password, $bd); 
        if (mysqli_connect_error()) {
            die("Error en la conexión");
        }
        if ($_POST['username']=='') {
            echo "<p> El campo usuario es obligatorio </p>";
        }
        else if ($_POST['password']=='') {
            echo "<p> El campo password es obligatorio </p>";
        }
        else {
            $contra = $_POST['password'];
            $cifrada = md5($contra);
            $query = "SELECT id, username, password FROM usuarios WHERE username='".mysqli_real_escape_string($enlace,$_POST['username'])."' AND password='".$cifrada."'";
            $result = mysqli_query($enlace,$query);

            if ($result) {
                $fila = mysqli_fetch_array($result); //Permite seleccionar una fila
                $id = $fila['id'];
            }

            if (mysqli_num_rows($result)>0) {
                setcookie("id",$id,time()+60*60*24*365);
                
                $query = "SELECT usuarios.username, usuarios.password, roles.rol FROM usuarios, roles WHERE usuarios.username='".mysqli_real_escape_string($enlace,$_POST['username'])."' AND password='".$cifrada."' AND usuarios.id_rol = '1' LIMIT 1";
                $result = mysqli_query($enlace,$query); 
                if (mysqli_num_rows($result)>0) {
                    setcookie("administrador",mysqli_insert_id($enlace),time()+60*60*24*365);
                    echo "<script>window.location.href = 'https://iawdanielvaldes-com.stackstaging.com/proyectoadmin.php';</script>";
                }

                $query = "SELECT usuarios.username, usuarios.password, roles.rol FROM usuarios, roles WHERE usuarios.username='".mysqli_real_escape_string($enlace,$_POST['username'])."' AND password='".$cifrada."' AND usuarios.id_rol = '3' LIMIT 1";
                $result = mysqli_query($enlace,$query);
                if (mysqli_num_rows($result)>0) {
                    setcookie("direccion",mysqli_insert_id($enlace),time()+60*60*24*365);
                    echo "<script>window.location.href = 'https://iawdanielvaldes-com.stackstaging.com/proyectodireccion.php';</script>";
                }
                echo "<script>window.location.href = 'https://iawdanielvaldes-com.stackstaging.com/proyectousuario.php';</script>";   
            }
            else {
                echo "<p> El usuario o contraseña que ha introducido no existe </p>";
            }
    }
}

if (!empty($_GET['Logout']==1)){
    setcookie("id",mysqli_insert_id($enlace),time()-60*60*24*365);
    setcookie("administrador",mysqli_insert_id($enlace),time()-60*60*24*365);
    setcookie("direccion",mysqli_insert_id($enlace),time()-60*60*24*365);
    session_destroy();
}

?>
<html>
<link rel="stylesheet" href="style.css">
    <body>
<form method="post">
    <input type="text" name="username" placeholder="Usuario">
    <input type="password" name="password" placeholder="Contraseña">
    <br>
    <input type="submit" value="Registro">
</form>
    <body>
</html>