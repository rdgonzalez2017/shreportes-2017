<?php

include("../config/conexion.php");
$result = mysqli_query($conexion, "SELECT *,A.id as id_reporte, C.id as id_estatus FROM $DB.reportes as A LEFT JOIN $DB.estatus as C ON A.idestatus = C.id") or die("Problemas con la conexion " . mysqli_error($conexion));
while ($columna = mysqli_fetch_array($result)):
    $vencimiento = $columna['vencimiento'];
    if (!empty($vencimiento))://Si el reporte se vence, se ejecuta el resto del código:
        $id_reporte = $columna['id_reporte'];
        $fecha_creacion = $columna['fecha'];
        $id_estatus = $columna['id_estatus'];
        if (!empty($columna['fecha_modificacion'])) {
            $fecha_accion = $columna['fecha_modificacion'];
        } else {
            $fecha_accion = $fecha_creacion;
        }
        //echo $id_reporte."-";
        //echo $vencimiento." Días -";
        $hoy = date('Y-m-d');
        $tiempo1 = date_create($fecha_accion);
        $tiempo2 = date_create($hoy);
        $intervalo = date_diff($tiempo1, $tiempo2);
        $inactividad = $intervalo->format('%a');
        //echo $inactividad."<br>";
        if ($inactividad >= $vencimiento) {
            $update_estado = mysqli_query($conexion, "UPDATE reportes SET idestatus = 5 where id = $id_reporte")
                    or die("Problemas en el Update" . mysqli_error($conexion));
        }
    endif;
endwhile;
