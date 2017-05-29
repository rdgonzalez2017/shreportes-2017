<?php session_start(); ?>
<!DOCTYPE html>
<html>
<?php include("head.php")?>
<nav class="navbar navbar-inverse" style="background: #2A63A2;">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="img-responsive wow bounceInUp animated animated" href="https://www.servicioshosting.com/sitio/"><img src="images/logo_desktop.png"></a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle wow bounceInDown animated animated" data-toggle="dropdown" href="#">Nosotros <span class="caret"></span></a>
                    <ul class="dropdown-menu" style="text-align: center" >
                        <li><button class="btn btn-sm btn-info navbar-btn bounceInUp animated animated" data-wow-duration="3000ms" onclick = "location='https://www.servicioshosting.com/sitio/contactanos-2/'">Contactos</button></li>
                        <li><button class="btn btn-sm btn-warning navbar-btn bounceInUp animated animated" data-wow-duration="3000ms"" onclick = "location='http://blog.servicioshosting.com/'">Blog ServiciosHosting</button></li>
                    </ul>
                </li>
                <!-- <li><a href="#">Page 2</a></li>-->
            </ul>
        </div>
    </div>
</nav>
<body>
    <form class="form-horizontal row" method = "post" action="validar.php">
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