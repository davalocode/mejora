<?php include "database.php"?>
<?php 
  /*
  if (array_key_exists("administrador",$_COOKIE)) {
    $_SESSION['administrador'] = $_COOKIE['administrador'];
  }

  if (!array_key_exists("administrador",$_SESSION)) {
    echo "<script>window.location.href = 'https://iawdanielvaldes-com.stackstaging.com/proyectousuario.php';</script>";
  }
  */

  if (array_key_exists("direccion",$_COOKIE)) {
    $_SESSION['direccion'] = $_COOKIE['direccion'];
  }

  if (array_key_exists("administrador",$_COOKIE)) {
    $_SESSION['administrador'] = $_COOKIE['administrador'];
  }

  if (array_key_exists("administrador",$_SESSION)) {
    echo "<script>window.location.href = 'https://iawdanielvaldes-com.stackstaging.com/proyectoadmin.php';</script>";
  }

  if (!array_key_exists("direccion",$_SESSION) && !array_key_exists("administrador",$_SESSION)) {
    echo "<script>window.location.href = 'https://iawdanielvaldes-com.stackstaging.com/proyectousuario.php';</script>";
  }

?>
<html>
    <link rel="stylesheet" href="style.css">
<body>
<h1>Control de administracion</h1>

    <?php
    
    if (!$enlace) {
        echo "Conexión fallida: " . mysqli_connect_error();
    }
    else {
    echo "<a href='https://iawdanielvaldes-com.stackstaging.com/crear_datos.php' id='boton_anadir'>Añadir</a>";
    echo "<br>";
    echo "<table>";
    echo "<tr>";
    echo "<td class='cabecera'>ID</td>";
    echo "<td class='cabecera'>Planta</td>";
    echo "<td class='cabecera'>Aula</td>";
    echo "<td class='cabecera'>Descripcion</td>";
    echo "<td class='cabecera'>Fecha Alta</td>";
    echo "<td class='cabecera'>Fecha Revision</td>";
    echo "<td class='cabecera'>Fecha resolucion</td>";
    echo "<td class='cabecera'>Comentario</td>";
    echo "<td class='cabecera'>Visualizar</td>";
    echo "<td class='cabecera'>Editar</td>";
    echo "<td class='cabecera'>Borrar</td>";
    echo "</tr>";

        $query = "SELECT COUNT(fecha_alta) AS cantidad FROM incidencias;";
        $resultado = mysqli_query($enlace,$query);
        if ($resultado->num_rows > 0) {
          // Saca datos de cada linea
          while($row = $resultado->fetch_assoc()) {
            
            $info=($row["cantidad"]);
            echo "<p>Todas las incidencias: $info</p>";
    
          }
        }

        $query = "SELECT COUNT(fecha_resolucion) AS cantidad FROM incidencias WHERE incidencias.fecha_resolucion > 0";
        $resultado = mysqli_query($enlace,$query);
        if ($resultado->num_rows > 0) {
          // Saca datos de cada linea
          while($row = $resultado->fetch_assoc()) {
            
            $info2=($row["cantidad"]);
            echo "<p>Incidencias resueltas: $info2</p>";
    
          }
        }

        $diferencia = $info - $info2;
        echo "<p>Incidencias faltantes: $diferencia</p>";

        $query = "SELECT incidencias.id, planta.planta, aula.aula, incidencias.descripcion, incidencias.fecha_alta, incidencias.fecha_revision, incidencias.fecha_resolucion, incidencias.comentario 
        FROM incidencias, planta, aula
        WHERE incidencias.id_planta = planta.id AND incidencias.id_aula = aula.id"; 
        $resultado = mysqli_query($enlace,$query); 
        
        if ($resultado->num_rows > 0) {
      // Saca datos de cada linea
      while($row = $resultado->fetch_assoc()) {
        
        $id=($row["id"]);
        $planta=($row["planta"]);
        $aula=($row["aula"]);
        $descripcion=($row["descripcion"]);
        $fecha_alta=($row["fecha_alta"]);
        $fecha_revision=($row["fecha_revision"]);
        $fecha_resolucion=($row["fecha_resolucion"]);
        $comentario=($row["comentario"]);
        echo "<tr>";
        echo "<td>$id</td>";
        echo "<td>$planta</td>";
        echo "<td>$aula</td>";
        echo "<td>$descripcion</td>";
        echo "<td>$fecha_alta</td>";
        echo "<td>$fecha_revision</td>";
        echo "<td>$fecha_resolucion</td>";
        echo "<td>$comentario</td>";
        echo "<td><a href='visualizar.php?incidencia_id={$id}'>Ver</a></td>";
        echo "<td><a href='editar_datos.php?editar&incidencia_id={$id}'>Editar</a></td>";
        echo "<td><a href='borrar_datos.php?eliminar={$id}'>Borrar</a></td>";
        echo "</tr>";

      }
      echo "</table>";
      echo "<a href='loginproyecto.php?Logout=1'>Cerrar sesión</a>";
    } else {
      echo "0 results";
    }
        mysqli_close($enlace);
    }
?>
    
    
    
</body>
</html>