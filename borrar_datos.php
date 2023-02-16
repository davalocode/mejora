<?php include "database.php" ?>
<?php 
     if(isset($_GET['eliminar']))
     {
         $id= htmlspecialchars($_GET['eliminar']);
         $query = "DELETE FROM incidencias WHERE id = {$id}"; 
         $delete_query= mysqli_query($enlace, $query);
         echo "<script>window.location.href='https://iawdanielvaldes-com.stackstaging.com/proyectoadmin.php';</script>";
     }
?>