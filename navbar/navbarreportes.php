<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="img-responsive" href="https://www.servicioshosting.com/sitio/"><img src="navbar/logo_desktop.png"></a>
        </div>
        <?php if (isset($_SESSION['nombre'])):?>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
                <li><button class="btn btn-sm btn-info navbar-btn" onclick="location='sistema.php'">Regresar al inicio</button> </li>
                <li><button class="btn btn-sm btn-warning navbar-btn" onclick="location='modificacionreportes.php'">Modificar Reportes</button> </li>
                <li><a href='logout.php'><span class="glyphicon glyphicon-log-in"></span> Cierre de Sesión</a></li>
            </ul>
            <ul class="dropdown-menu" style="text-align: center" >
                <li><button class="btn btn-sm btn-warning navbar-btn bounceInUp animated animated" data-wow-duration="500ms" onclick = "location='modificacionreportes.php'">Modificar Reportes</button></li>
            </ul>
            <?php else:?>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Nosotros <span class="caret"></span></a>
                    <ul class="dropdown-menu" style="text-align: center" >
                        <li><button class="btn btn-sm btn-info navbar-btn bounceInUp animated animated" data-wow-duration="500ms" onclick = "location='https://www.servicioshosting.com/sitio/contactanos-2/'">Contactos</button></li>
                        <li><button class="btn btn-sm btn-warning navbar-btn bounceInUp animated animated" data-wow-duration="500ms"" onclick = "location='http://blog.servicioshosting.com/'">Blog ServiciosHosting</button></li>
                    </ul>
                </li>
                <li><a href='index.php'><span class="glyphicon glyphicon-log-in"></span> Inicio de Sesión</a></li>
                <!-- <li><a href="#">Page 2</a></li>-->
            </ul>
            <?php endif;?>
        </div>
    </div>
</nav>