<?php session_start(); ?>
<!DOCTYPE html>
<html>
<?php include("head.php")?>
<header
<?php include("navbar/navbarindex.php")?>
</header>
<?php if (isset($_SESSION['nombre'])) {echo "Sesión Abierta: ".$_SESSION['nombre'];} ?>
<body>
<div class="container">
<section>
    <form class="form-horizontal row bounceInDown animated animated" data-wow-duration="1500ms" method = "post" action="controles/login.php">
        <div class="col-md-6 col-md-offset-3 container">
            <div class="panel panel-primary" >
                <div class="panel-heading">
                    <p class="text-center">Inicio de Sesion</p>
                </div>
                <!-- Inicio de sesión por correo
                <div class="panel-body">
                    <div class="form-group row">
                        <label for="correo" class="col-md-2 control-label">Correo:</label>
                        <div class="col-md-8">
                            <input class="form-control" type="mail" name="correo" id="correo"  required/>
                        </div>
                    </div>-->
                <!-- Inicio de sesión por nombre de usuario -->
                <div class="panel-body">
                    <div class="form-group row">
                        <label for="nombre" class="col-md-2 control-label">Usuario:</label>
                        <div class="col-md-8">
                            <select class="form-control" name="nombre">
                                <?php
                                include ("config/conexion.php");
                                $registros=mysqli_query($conexion,"select nombre from usuarios") or
                                die("Problemas en el select:".mysqli_error($conexion));
                                while ($reg=mysqli_fetch_array($registros))
                                {
                                    echo "<option value=\"$reg[nombre]\">$reg[nombre]</option>";
                                }
                                ?>
                            </select>
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
                <input type="submit" class="btn btn-info" value="Entrar"></input>
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
</section>
</div>
</body>
<?php include("footer.php");?>
</html>
