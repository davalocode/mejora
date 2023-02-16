<?php

if (array_key_exists("administrador",$_COOKIE)) {
    $_SESSION['administrador'] = $_COOKIE['administrador'];
  }

  if (!array_key_exists("administrador",$_SESSION)) {
    echo "<script>window.location.href = 'https://iawdanielvaldes-com.stackstaging.com/proyectousuario.php';</script>";
  }

    header("Content-type:text/html;charset=utf-8");
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
            $query = "SELECT username FROM usuarios WHERE username='".mysqli_real_escape_string($enlace,$_POST['username'])."'";
            $result = mysqli_query($enlace,$query);
            if (mysqli_num_rows($result)>0) {
                echo "<p> El nombre de usuario que ha elegido ya existe, eliga otro </p>";
            }
            else {
                //Añadimos al usuario
                //Ciframos la contrasena
                $contra = $_POST['password'];
                $cifrada = md5($contra);
                $query="INSERT INTO usuarios (username, password, id_rol) VALUES('".mysqli_real_escape_string($enlace,$_POST['username'])."','".$cifrada."', (SELECT id FROM roles WHERE roles.rol='".mysqli_real_escape_string($enlace,$_POST['rol'])."'))";
                if (mysqli_query($enlace,$query)){
                    echo "<p> El usuario ha sido añadido con éxito</p>";
                }

                else {
                    echo "<p> El usuario no se ha creado correctamente </p>";
                }
        }   
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
            <form method="post">
                
                <input type="text" name="username" id="inputPassword"  placeholder="Usuario" required autofocus>
                <input type="password" name="password" id="inputPassword" placeholder="Contraseña" required autofocus>
                <select name="rol" required>
                    <option value="administrador">Administrador</option>
                    <option value="direccion">Dirección</option>
                    <option value="profesor">Profesor</option>
                </select>
                <button  onclick="crearCuenta()" type="submit">Añadir usuario</button>
                <a href="https://iawdanielvaldes-com.stackstaging.com/proyectoadmin.php"> Volver </a>
            </form>
</body>
</html>