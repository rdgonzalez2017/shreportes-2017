<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header col-md-4">
            <a href="https://www.servicioshosting.com/sitio/"><img class="img-responsive" id="img-logosh" src="images/logo_desktop.png"></a>
        </div>
        <div class="col-md-4 col-md-offset-1">
            <img  style="width: 50%" src="images/logo_shincidencias.png">
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
                <?php if (isset($_SESSION['nombre'])):?>
                    <li><a href='logout.php'><span class="glyphicon glyphicon-log-in"></span> Cierre de Sesión</a></li>
                <?php else:?>
                    <li><a href='index.php'><span class="glyphicon glyphicon-log-in"></span> Inicio de Sesión</a></li>
               <?php endif;?>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Nosotros <span class="caret"></span></a>
                    <ul class="dropdown-menu" style="text-align: center" >
                        <li><button class="btn btn-sm btn-info navbar-btn bounceInUp animated animated" data-wow-duration="500ms" onclick = "location='https://www.servicioshosting.com/sitio/contactanos-2/'">Contactos</button></li>
                        <li><button class="btn btn-sm btn-warning navbar-btn bounceInUp animated animated" data-wow-duration="500ms"" onclick = "location='http://blog.servicioshosting.com/'">Blog ServiciosHosting</button></li>
                    </ul>
                </li>
                <!-- <li><a href="#">Page 2</a></li>-->
            </ul>
        </div>
    </div>
</nav>