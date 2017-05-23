<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
    <title>	Inicio de sesion	</title>
    <body>
        <form class="form-horizontal" method = "post" action="validar.php">
            <div class="col-md-8 col-md-offset-2">
                <br>
            <div class="panel panel-primary">

            <div class="panel-heading" style="background: limegreen">
                <p class="text-center">Inicio de Sesion</p>
            </div>

            <div class="panel-body">
                <div class="form-group row">
                    <label for="correo" class="col-md-2 control-label">Correo:</label>
                    <div class="col-md-8">
                        <input class="form-control" type="mail" name="correo" id="correo"  required/>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="clave" class="col-md-2 control-label">Clave:</label>
                    <div class="col-md-8">
                        <input class="form-control" type="password" name="clave" id="clave" required/>
                    </div>
                </div>

            </div>

            <div class="panel-footer text-center">
                <input type="submit" class="btn btn-info btn-sm" value="Entrar"></input>

            </div>
                <?php
                if(isset($_SESSION['bienvenido'])){
                    echo $_SESSION['bienvenido'];
                    unset($_SESSION['bienvenido']);
                }
                ?>
            </div>

            </div>
            </div>
        </form>
    </body>
</html>