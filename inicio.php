<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
    <?php include "head.php" ?>
    <header>
        <?php include "navbar/navbarinicio.php"; ?>
    </header>
    <body>
        <div class="container">
            <div class="col-md-10 col-md-offset-1">
                <br>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="text-center" style="font-family: giorgia"><h3><b>Reportar Incidencia</b></h3></div>   
                    </div>
                    <div class="panel-body">
                        <!-- Incio de Página-->

                        <div class=" rotateIn animated" data-wow-duration="500ms">  
                            <div class="well text-center"> 
                                <form method="Post" action="sistema.php">
                                    <h4>Si el cliente es registrado, ingrese su correo:</h4><br>
                                    <div class="form-horizontal text-center">                                           
                                        <div class="col-md-8 col-md-offset-2 text-center">
                                            <input type="email" name="correo" class="form-control text-center" placeholder="Email" required="required">
                                        </div>
                                        <br><br><br><button type="submit" class="btn btn-info"><b>Validar</b></button>
                                    </div>
                                </form>
                            </div>                                
                            <div class="well text-center"> 
                                <form method="Post" action="sistema.php">
                                    <h4>Si el cliente no está registrado, presione aquí:</h4><br> <button type="submit" class="btn btn-warning">                                             
                                        <b>No registrado</b>
                                    </button>
                                    <input type="hidden" name="no_registrado" value="no_registrado">
                                </form>
                            </div>
                        </div>                      
                        <!--Fin de Incio de Página-->
                    </div>
                </div>
            </div>
        </div>
    </body>


</html>