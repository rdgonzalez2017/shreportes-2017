<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
    <?php include "head.php" ?>
    <header>
        <?php include "navbar/navbarsistema.php"; ?>
    </header>
    <body>
        <!-- Incio de Página-->
        <div class="col-md-8 col-md-offset-2 rotateIn animated" data-wow-duration="500ms">                


            <div class="well text-center"> 
                <form method="Post" action="sistema.php">
                    <h4>Si es cliente registrado, ingrese su correo:</h4><br>
                    <div class="form-horizontal text-center">                                           
                        <div class="col-md-6 col-md-offset-3 text-center">
                            <input type="email" name="correo" class="form-control text-center" placeholder="Email" required="required">
                        </div>
                        <br><br><br><button type="submit" class="btn btn-info">Validar</button>
                    </div>
                </form>
            </div>                                
            <div class="well text-center"> 

                <form method="Post" action="sistema.php">
                    <h4>Si el cliente no está registrado, presione aquí:</h4><br> <button type="submit" class="btn btn-warning">                                             
                        No registrado
                    </button>
                    <input type="hidden" name="no_registrado" value="no_registrado">
                </form>
            </div>
        </div>                      
        <!--Fin de Incio de Página-->    
    </body>
    <script src="js/bootstrap.min.js"></script>
    <footer>
    </footer>
</html>