<?php include "database.php" ?>

<?php 
  if(isset($_POST['crear'])) 
    {
        $planta = htmlspecialchars($_POST['usuario_planta']);
        $aula = htmlspecialchars($_POST['usuario_aula']);
        $descripcion = htmlspecialchars($_POST['usuario_descripcion']);
        $comentario = htmlspecialchars($_POST['usuario_comentario']);
        $fecha_alta = htmlspecialchars($_POST['usuario_fecha_alta']);
        $fecha_rev = htmlspecialchars($_POST['usuario_fecha_revision']);
        $fecha_sol = htmlspecialchars($_POST['usuario_fecha_resolucion']);
        $plantamayus = strtoupper($planta);
        $aulamayus = strtoupper($aula);

        $id = $_COOKIE['id'];
      
        $query="INSERT INTO incidencias(id_planta, id_aula, id_usuario, descripcion, fecha_alta, fecha_revision, fecha_resolucion, comentario) 
                VALUES(
                (SELECT id FROM planta WHERE UPPER(planta)='{$plantamayus}'),
                (SELECT id FROM aula WHERE UPPER(aula)='{$aulamayus}'),
                '{$id}',
                '{$descripcion}',
                '{$fecha_alta}',
                '{$fecha_rev}',
                '{$fecha_sol}',
                '{$comentario}');";
        $resultado = mysqli_query($enlace,$query);
    
          if (!$resultado) {
              echo "Algo ha ido mal añadiendo la incidencia: ". mysqli_error($enlace);
          }
          else
          {
            echo "<script type='text/javascript'>alert('¡Incidencia añadida con éxito!'); window.location.href='https://iawdanielvaldes-com.stackstaging.com/proyectoadmin.php';</script>";
          }         
    }
?>

<html>
<link rel="stylesheet" href="style.css">
    <body>

<form method="post">
    <select name="usuario_planta" required>
                    <option value="primera">Primera</option>
                    <option value="segunda">Segunda</option>
                    <option value="tercera">Tercera</option>
    </select>
    <select name="usuario_aula" required>
                    <option value="primeroa">Primero A</option>
                    <option value="primerob">Primero B</option>
                    <option value="primeroc">Primero C</option>
    </select>
    <input type="text" placeholder="Descripcion" name="usuario_descripcion" required>
    <input type="date" placeholder="Fecha Alta" name="usuario_fecha_alta" required>
    <input type="date" placeholder="Fecha Revision" name="usuario_fecha_revision" >
    <input type="date" placeholder="Fecha Resolucion" name="usuario_fecha_resolucion">
    <input type="text" placeholder="Comentario" name="usuario_comentario">

    <input type="submit" name="crear">
    </form>
    <a href='https://iawdanielvaldes-com.stackstaging.com/proyectoadmin.php'>Volver</a>

</html>
  </body>