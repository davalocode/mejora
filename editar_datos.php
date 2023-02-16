<?php 
include("database.php");

include("direccion.php");
?>
<?php
   if(isset($_GET['incidencia_id']))
    {
      $incidenciaid = htmlspecialchars($_GET['incidencia_id']); 
    }

      $query="SELECT incidencias.id, planta.planta, aula.aula, incidencias.descripcion, incidencias.fecha_alta, 
      incidencias.fecha_revision, incidencias.fecha_resolucion, incidencias.comentario, usuarios.email
      FROM incidencias, planta, aula, usuarios
      WHERE incidencias.id={$incidenciaid}
      AND incidencias.id_planta=planta.id
      AND incidencias.id_aula=aula.id
      AND usuarios.id = incidencias.id_usuario";
      $result= mysqli_query($enlace,$query);
      while($row = mysqli_fetch_assoc($result))
        {
          $id = $row['id'];                
          $planta = $row['planta'];        
          $aula = $row['aula'];         
          $descripcion = $row['descripcion'];        
          $fecha_alta = $row['fecha_alta'];        
          $fecha_rev = $row['fecha_revision'];        
          $fecha_sol = $row['fecha_resolucion'];        
          $comentario = $row['comentario'];
          $email = $row['email'];
        }

        if ($fecha_sol > 0) {
          $boleano = true;
        }
        else {
          $boleano = false;
        }
 
    if(isset($_POST['editar'])) 
    {
      $planta = htmlspecialchars($_POST['usuario_planta']);
      $aula = htmlspecialchars($_POST['usuario_aula']);
      $descripcion = htmlspecialchars($_POST['usuario_descripcion']);
      $fecha_alta = htmlspecialchars($_POST['usuario_fecha_alta']);
      $fecha_revision = htmlspecialchars($_POST['usuario_fecha_revision']);
      $fecha_resolucion = htmlspecialchars($_POST['usuario_fecha_resolucion']);
      $comentario = htmlspecialchars($_POST['usuario_comentario']);

      $plantamayus = strtoupper($planta);
      $aulamayus = strtoupper($aula);

      $query = "UPDATE `incidencias`, `aula`, `planta` 
      SET `incidencias`.`id_planta` = `planta`.`id`, 
      `incidencias`.`id_aula` = `aula`.`id`, 
      `incidencias`.`descripcion` = '{$descripcion}', 
      `incidencias`.`fecha_alta` = '{$fecha_alta}', 
      `incidencias`.`fecha_revision` = '{$fecha_revision}', 
      `incidencias`.`fecha_resolucion` = '{$fecha_resolucion}', 
      `incidencias`.`comentario` = '{$comentario}' 
      WHERE `incidencias`.`id` = '{$id}' 
      AND UPPER(`aula`.`aula`) = '{$aulamayus}' 
      AND UPPER(`planta`.`planta`) = '{$plantamayus}';";

      $sentencia = mysqli_query($enlace, $query);
      
      if (!$sentencia)
        echo "Se ha producido un error al actualizar la incidencia.";
      else
      if ($boleano==false) {
        $destino = "{$email}";
        $asunto= "Incidencia";

        $mensaje = "
          <html>
          <head>
          <title>Incidencias Resueltas</title>
          </head>
          <body>
          <h1>La incidencia {$id} ha sido resuelta</h1>
          </body>
          </html>
        ";

        // Hay que señalar el tipo de contenido cuando se envía un correo de HTML
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

//Headers de quien lo envía
        $headers .= 'From: <daniel@clasesegundo.com>' . "\r\n";
        $headers .= '' . "\r\n";

        mail($destino,$asunto,$mensaje,$headers);
      }
        echo "<script type='text/javascript'>alert('¡Datos de la incidencia actualizados!'); window.location.href='https://iawdanielvaldes-com.stackstaging.com/proyectoadmin.php';</script>";
    }             
?>

<html>
<link rel="stylesheet" href="style.css">
    <body>

<form method="post">
    <input type="text" placeholder="Planta" name="usuario_planta" value="<?php echo $planta  ?>" required>
    <input type="text" placeholder="Aula" name="usuario_aula" required value="<?php echo $aula  ?>">
    <input type="text" placeholder="Descripcion" name="usuario_descripcion" required value="<?php echo $descripcion  ?>">
    <input type="date" placeholder="Fecha Alta" name="usuario_fecha_alta" required value="<?php echo $fecha_alta  ?>">
    <input type="date" placeholder="Fecha Revision" name="usuario_fecha_revision" required value="<?php echo $fecha_rev  ?>">
    <input type="date" placeholder="Fecha Resolucion" name="usuario_fecha_resolucion" required value="<?php echo $fecha_sol  ?>">
    <input type="text" placeholder="Comentario" name="usuario_comentario" value="<?php echo $comentario  ?>">

    <input type="submit" name="editar">
    </form>
    <a href='https://iawdanielvaldes-com.stackstaging.com/proyectoadmin.php'>Volver</a>
</html>
  </body>