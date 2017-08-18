<?php
session_start();
if (isset($_SESSION['nombre'])):
    require("../config/conexion.php"); // Incluimos nuestro archivo de conexión con la base de datos.   
    $id_reporte = ($_POST['id_reporte']);
    $id_estatus = ($_POST['id_estatus']);
    $id_protegido = ($_POST['id_protegido']);
    $update_estado = mysqli_query($conexion, "UPDATE reportes SET idestatus = $id_estatus WHERE id = $id_reporte")
            or die("Problemas en el Update al modificar el reporte" . mysqli_error($conexion)); // Ejecutamos la consulta para actualizar el registro en la base de datos
    if ($update_estado) {
        echo 'El estado se modificó corectamente'; // Si la consulta se ejecutó bien, muestra este mensaje   
        ?>    
        <script>location.href = '../reportes.php?reporte=<?php echo $id_protegido; ?>'</script>
        <?php
    } else {
        echo 'El estado no se modificó'; // Si la consulta no se ejecutó bien, muestra este mensaje
    }
    endif;
