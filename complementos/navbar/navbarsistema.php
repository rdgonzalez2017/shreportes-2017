<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        
        <div class="navbar-header col-xs-6 col-md-3">
            <button type="button" class="navbar-toggle"  data-toggle="collapse"  data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <img  style="width: 70%" src="../images/logo_shincidencias.png"></a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
                <li><button class="btn btn-info btn-sm navbar-btn alert-info" onclick = "location='../inicio.php'"><b>Reportar incidencia</b></button></li>
                <li><button class="btn btn-warning btn-sm navbar-btn alert-warning" onclick = "location='../reportes.php'"><b>Ver incidencias</b></button></li>
                <li><a href='../controles/logout.php'><span class="glyphicon glyphicon-log-in"></span> Cerrar Sesión</a></li>
            </ul>
            
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" href="#">Modificaciones <span class="caret"></span></a>
                    <ul class="dropdown-menu" style="text-align: center" >
                        <li><button class="btn btn-sm btn-info navbar-btn " onclick = "location='modificarusuario.php'">Modificar mi Usuario</button></li>
                    </ul>
                </li>
                <!-- <li><a href="#">Page 2</a></li>-->
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <?php if ($_SESSION['tipo']==1):?>
                    <a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" href="#">Agregar <span class="caret"></span></a>
                    <ul class="dropdown-menu" style="text-align: center" >
                        <li><button class="btn btn-sm btn-warning navbar-btn" onclick = "location='agregarcategoria.php'">Agregar Categoria</button></li>
                        <li><button class="btn btn-sm btn-info navbar-btn" onclick = "location='agregarusuario.php'">Agregar Usuario</button></li>
                        <li><button class="btn btn-sm btn-warning navbar-btn" onclick = "location='agregarestado.php'">Agregar Estatus</button></li>
                        <li><button class="btn btn-sm btn-info navbar-btn " onclick = "location='agregarservidor.php'">Agregar Servidor</button></li>
                        <li><button class="btn btn-sm btn-warning navbar-btn" onclick = "location='../complementos/agregar_campo.php'">Campos personalizables</button></li>

                        <?php endif;?>
                    </ul>
                </li>
                <!-- <li><a href="#">Page 2</a></li>-->
            </ul>
            <!--<ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <?php if ($_SESSION['tipo']==1):?>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Eliminar <span class="caret"></span></a>
                    <ul class="dropdown-menu" style="text-align: center" >
                        <li><button class="btn btn-sm btn-warning navbar-btn bounceInUp animated animated" data-wow-duration="500ms" onclick = "location='eliminareportes.php'">Eliminar Incidencias</button></li>
                        <?php endif;?>
                    </ul>
                </li>
                <!-- <li><a href="#">Page 2</a></li>
            </ul>-->
        </div>
    </div>
</nav>
 