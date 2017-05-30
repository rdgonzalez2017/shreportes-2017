<nav class="navbar navbar-inverse " style="background: #2A63A2;" >
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="img-responsive" href="#"><img src="navbar/logo_desktop.png"></a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
                <li><button class="btn btn-warning btn-sm navbar-btn" onclick = "location='reportes.php'">Ver Reportes</button></li>
                <li><a href='index.php'><span class="glyphicon glyphicon-log-in"></span> Cierre de Sesión</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Modificaciones <span class="caret"></span></a>
                    <ul class="dropdown-menu" style="text-align: center" >
                        <li><button class="btn btn-sm btn-warning navbar-btn bounceInUp animated animated" data-wow-duration="500ms" onclick = "location='modificacionreportes.php'">Modificar Reportes</button></li>
                        <li><button class="btn btn-sm btn-info navbar-btn bounceInUp animated animated" data-wow-duration="500ms" onclick = "location='modificarusuario.php'">Modificar mi Usuario</button></li>
                    </ul>
                </li>
                <!-- <li><a href="#">Page 2</a></li>-->
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Agregar <span class="caret"></span></a>
                    <ul class="dropdown-menu" style="text-align: center" >
                        <li><button class="btn btn-sm btn-warning navbar-btn bounceInUp animated animated" data-wow-duration="500ms" onclick = "location='agregarcategoria.php'">Agregar Categoria</button></li>

                    </ul>
                </li>
                <!-- <li><a href="#">Page 2</a></li>-->
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Eliminar <span class="caret"></span></a>
                    <ul class="dropdown-menu" style="text-align: center" >
                        <li><button class="btn btn-sm btn-warning navbar-btn bounceInUp animated animated" data-wow-duration="500ms" onclick = "location='eliminareportes.php'">Eliminar Reportes</button></li>

                    </ul>
                </li>
                <!-- <li><a href="#">Page 2</a></li>-->
            </ul>
        </div>
    </div>
</nav>