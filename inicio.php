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
            <div class="container rotateIn animated" data-wow-duration="500ms">
                <div class="col-md-10 col-md-offset-1">
                    <br>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="text-center"><h3>Reportar Incidencia</h3></div>
                            <!--<div class="text-center"><h4>(Validar correo del cliente ó dominio afiliado)</h4></div>-->
                        </div>
                        <div class="panel-body">
                            <div class="well text-center"> 
                                <form method="Post" action="sistema.php">
                                    <h4>Ingrese el correo del cliente:</h4><br>
                                    <div class="form-horizontal text-center">                                           
                                        <div class="col-md-8 col-md-offset-2 text-center">
                                            <input type="email" name="correo" class="form-control text-center" placeholder="Correo" required="required">
                                        </div>
                                        <br><br><br><button type="submit" class="btn btn-info"><b>Aceptar</b></button>
                                    </div>
                                </form>
                            </div>                                
                            <!--<div class="well text-center"> 
                                <form method="Post" action="sistema.php">
                                    <h4>Ingrese el dominio del cliente:</h4><br>
                                    <div class="form-horizontal text-center">                                           
                                        <div class="col-md-8 col-md-offset-2 text-center">
                                            <input type="text" name="dominio" class="form-control text-center" placeholder="Dominio" required="required">
                                        </div>
                                        <br><br><br><button type="submit" class="btn btn-info"><b>Aceptar</b></button>
                                    </div>
                                </form>
                            </div>--> 
                        </div>
                    </div>
                </div>
            </div>
        </body>
    </html>
    <?php
 endif;