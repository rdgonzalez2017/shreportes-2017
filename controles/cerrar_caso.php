<?php
include("../config/conexion.php");
$result = mysqli_query($conexion, "SELECT *,A.id as id_reporte, C.id as id_estatus FROM $DB.reportes as A LEFT JOIN $DB.estatus as C ON A.idestatus = C.id") or die("Problemas con la conexion " . mysqli_error($conexion));
while ($columna = mysqli_fetch_array($result)):
    $id_reporte = $columna['id_reporte'];
    $fecha_creacion = $columna['fecha'];
    $id_estatus = $columna['id_estatus'];
    if (!empty($columna['fecha_modificacion'])) {
        $fecha_accion = $columna['fecha_modificacion'];
    } else {
        $fecha_accion = $fecha_creacion;
    }
    $hoy = date('Y-m-d');
    $fecha_actividad = $datetime1 = date_create($fecha_accion);
    $datetime2 = date_create($hoy);
    $inactividad = date_diff($datetime1, $datetime2);
    if ($inactividad->format('%a') >= 30 and $id_estatus <> 1) {
        $update_estado = mysqli_query($conexion, "UPDATE reportes SET idestatus = 5 where id = $id_reporte")
                or die("Problemas en el Update" . mysqli_error($conexion));
    }
endwhile;
