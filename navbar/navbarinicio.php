<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <img  style="width: 70%" src="images/logo_shincidencias.png">
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
                <li><button class="btn btn-warning btn-sm navbar-btn alert-warning" onclick = "location='reportes.php'"><b>Ver Incidencias</b></button></li>
                <li><a href='controles/logout.php'><span class="glyphicon glyphicon-log-in"></span>Cierre de Sesión</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Modificaciones<span class="caret"></span></a>
                    <ul class="dropdown-menu" style="text-align: center" >
                        <li><button class="btn btn-sm btn-info navbar-btn rotateIn animated" data-wow-duration="10ms" onclick = "location='complementos/modificarusuario.php'"><b>Modificar mi Usuario</b></button></li>
                    </ul>
                </li>
                <!-- <li><a href="#">Page 2</a></li>-->
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <?php if ($_SESSION['tipo']==1):?>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Agregar<span class="caret"></span></a>
                    <ul class="dropdown-menu" style="text-align: center" >
                        <li><button class="btn btn-sm btn-warning navbar-btn rotateIn animated" data-wow-duration="10ms" onclick = "location='complementos/agregarcategoria.php'"><b>Agregar Categoria</b></button></li>
                        <li><button class="btn btn-sm btn-info navbar-btn bounceInUp rotateIn animated" data-wow-duration="10ms" onclick = "location='complementos/agregarusuario.php'"><b>Agregar Usuario</b></button></li>
                        <li><button class="btn btn-sm btn-warning navbar-btn bounceInUp rotateIn animated" data-wow-duration="10ms" onclick = "location='complementos/agregarestado.php'"><b>Agregar Estatus</b></button></li>
                        <li><button class="btn btn-sm btn-info navbar-btn bounceInUp rotateIn animated" data-wow-duration="10ms" onclick = "location='complementos/agregarservidor.php'"><b>Agregar Servidor</b></button></li>
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