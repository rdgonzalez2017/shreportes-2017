<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
    <?php include "head.php" ?>
    <header>
        <?php
        if (isset($_SESSION['nombre'])):
            include ("navbar/navbarsistema.php");
        else:
            include ("navbar/navbarindex.php");
        endif;
        ?>
    </header>
    <?php if (isset($_SESSION['nombre'])): ?>
        <body>
            <div class="row">
                <div class="col-md-3"><?php
                    if (isset($_SESSION['nombre'])) {
                        echo "Bienvenido: " . $_SESSION['nombrecompleto'];
                    }
                    ?>       
                </div>
            </div>
            <div class="container rollIn animated" data-wow-duration="1ms">
                <div class="col-md-8 col-md-offset-2">                    
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="text-center"><h3>Reportar Incidencia</h3></div>
                            <!--<div class="text-center"><h4>(Validar correo del cliente ó dominio afiliado)</h4></div>-->
                        </div>
                        <div class="panel-body">
                            <div class=" well text-center"> 
                                <form method="Post" action="sistema.php">
                                    <h3>Ingrese el correo del cliente:</h3>
                                    <div class="form-group row text-center">                                           
                                        <div class="col-md-8 col-md-offset-2 text-center">
                                            <input style="font-size: 18px;" type="email" name="correo" class="form-control text-center" placeholder="Ej: prueba@correo.com" required="required">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <h3>Seleccione una categoría:</h3>
                                        <div class="col-md-8 col-md-offset-2">
                                            <select style="font-size: 18px;" class="form-control text-center" name="categoria" id="categoria"  required>
                                                <?php
                                                include ("config/conexion.php");
                                                $registros = mysqli_query($conexion, "SELECT * FROM categorias") or
                                                        die("Problemas en el select:" . mysqli_error($conexion));
                                                while ($reg = mysqli_fetch_array($registros)) {
                                                    echo "<option value=\"$reg[id]\">$reg[nombre]</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                            </div>   
                        </div>
                        <div class="panel panel-footer">
                            <div class="text-center">
                                <button type="submit" class="btn btn-warning btn-lg"><b>Aceptar</b></button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </body>
    </html>
    <?php


 endif;