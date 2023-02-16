<?php include "database.php" ?>
<html>
<link rel="stylesheet" href="style.css">
    <body>
<h1>Detalles de incidencia</h1>
  <div>
    <table>
      <thead>
        <tr>
              <th scope="col" class='cabecera'>ID</th>
              <th  scope="col" class='cabecera'>Planta</th>
              <th  scope="col" class='cabecera'>Aula</th>
              <th  scope="col" class='cabecera'>Descripción</th>
              <th  scope="col" class='cabecera'>Fecha alta</th>
              <th  scope="col" class='cabecera'>Fecha revisión</th>
              <th  scope="col" class='cabecera'>Fecha solución</th>
              <th  scope="col" class='cabecera'>Comentario</th>
        </tr>  
      </thead>
        <tbody>
          <tr>
               
            <?php
              if (isset($_GET['incidencia_id'])) {
                  $incidenciaid = htmlspecialchars($_GET['incidencia_id']); 
                  $query="SELECT incidencias.id, planta.planta, aula.aula, incidencias.descripcion, incidencias.fecha_alta, incidencias.fecha_revision, incidencias.fecha_resolucion, incidencias.comentario 
                  FROM incidencias, planta, aula
                  WHERE incidencias.id_planta = planta.id AND incidencias.id_aula = aula.id AND incidencias.id = {$incidenciaid} LIMIT 1";  
                  $vista_incidencias= mysqli_query($enlace,$query);            

                  while($row = mysqli_fetch_assoc($vista_incidencias))
                  {
                    $id = $row['id'];                
                    $planta = $row['planta'];        
                    $aula = $row['aula'];         
                    $descripcion = $row['descripcion'];        
                    $fecha_alta = $row['fecha_alta'];        
                    $fecha_revision = $row['fecha_revision'];        
                    $fecha_resolucion = $row['fecha_resolucion'];        
                    $comentario = $row['comentario'];

                        echo "<tr >";
                        echo " <td >{$id}</td>";
                        echo " <td > {$planta}</td>";
                        echo " <td > {$aula}</td>";
                        echo " <td >{$descripcion} </td>"; 
                        echo " <td >{$fecha_alta} </td>";
                        echo " <td >{$fecha_revision} </td>";
                        echo " <td >{$fecha_resolucion} </td>";
                        echo " <td >{$comentario} </td>";
                        echo " </tr> ";
                  }
                }
            ?>
          </tr>  
        </tbody>
    </table>
  </div>

  <div class="container text-center mt-5">
    <a href="proyecto.php" class="btn btn-warning mt-5"> Volver </a>
  <div>
    </html>
              </body>