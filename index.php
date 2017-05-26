<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <script src="js/jquery.min.js"></script>

    <script src="js/bootstrap.min.js"></script>
    <title>	Inicio de sesion	</title>
</head>

<nav class="navbar navbar-inverse" style="background: darkblue;">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a class="img-responsive" href="https://www.servicioshosting.com/sitio/"><img src="images/logo_desktop.png"></a>

        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <!--  <ul class="nav navbar-nav">

                 <li class="dropdown">

                     <a class="dropdown-toggle" data-toggle="dropdown" href="#">Page 1 <span class="caret"></span></a>
                     <ul class="dropdown-menu">
                         <li><a href="#">Page 1-1</a></li>
                         <li><a href="#">Page 1-2</a></li>
                         <li><a href="#">Page 1-3</a></li>
                     </ul>
                 </li>
                 <li><a href="#">Page 2</a></li>
                 <li><a href="#">Page 3</a></li>
             </ul>
             <button class="btn btn-danger navbar-btn">Button</button>-->
            <ul class="nav navbar-nav navbar-right">

                <li><button class="btn btn-sm btn-info navbar-btn" onclick = "location='https://www.servicioshosting.com/sitio/contactanos-2/'">Contactos</button>-</li>
                <li><button class="btn btn-sm btn-warning navbar-btn" onclick = "location='http://blog.servicioshosting.com/'">Blog ServiciosHosting</button></li>
                <!--<li><a href="#"><span class="glyphicon glyphicon-user"></span> Registrarse</a></li>-->

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
                <input type="submit" class="btn btn-success btn-lg" value="Entrar"></input>
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