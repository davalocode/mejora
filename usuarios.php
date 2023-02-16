<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <title>Pagina principal de las incidencias</title>
  <link rel="stylesheet" href="style.css">
  <body>
    
<?php

  include "database.php";

  include "admin.php";

  // Crea la conexión
  $enlace = mysqli_connect($servidor, $usuario, $password, $database);

  // Compruebo si la conexión funciona y si hay enlace.
  if (!$enlace) {
      echo "Conexión fallida: " . mysqli_connect_error();
  }
  else {

    $query = "SELECT usuarios.id, usuarios.username, roles.rol FROM roles, usuarios WHERE usuarios.id_rol = roles.id;"; // Realizamos la consulta
    $resultado = mysqli_query($enlace,$query); // Guardamos la respuesta de la consulta en resultado
    echo '
    <table>
    <thead>
      <tr>
      <th class="cabecera">ID</th>
      <th class="cabecera">Nombre de usuario</th>
      <th class="cabecera">Rol</th>
      <th class="cabecera" colspan="1">Acciones</th>
      </tr>
    </thead>
  ';
    if ($resultado->num_rows > 0) {
        
        while($fila = $resultado->fetch_assoc())
            echo "<tbody><tr>
  
            <th scope='row'>".$fila["id"]."</th>
        
            <td>".$fila["username"]."</td>
        
            <td>".$fila["rol"]."</td>

            <td class='text-center'>  <a href='borrarusuarios.php?eliminar={$fila["id"]}'> <i class='bi bi-trash'></i> Eliminar</a> </td>
        

          </tr>";
    }



    echo '</tbody></table> <br> <div> <a href="https://iawdanielvaldes-com.stackstaging.com/proyectoadmin.php"> Volver </a> <div>';

  }
    mysqli_close($enlace);
  

?>




</body>
</body>
</html>
</html>