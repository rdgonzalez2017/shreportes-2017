<?php session_start(); ?>
<!DOCTYPE html>
<html>
<?php include("head.php")?>
<?php include("navbar/navbarindex.php")?>
<body>
    <form class="form-horizontal row bounceInDown animated animated" data-wow-duration="1500ms"" method = "post" action="controles/validarlogin.php">
        <div class="col-md-8 col-md-offset-2 container">
            <div class="panel panel-primary" >
                <div class="panel-heading">
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
                <input type="submit" class="btn btn-success" value="Entrar"></input>
            </div>
                <?php
                if(isset($_SESSION['bienvenido'])){
                    echo $_SESSION['bienvenido'];
                    unset($_SESSION['bienvenido']);
                }
                ?>

            </div>

        </div>
    </form>
</body>


</html>