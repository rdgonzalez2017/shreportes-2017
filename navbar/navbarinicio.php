<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <img  style="width: 30%" src="images/logo_SHreportes.png"></a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
                <li><button class="btn btn-info btn-sm navbar-btn" onclick = "location='reportes.php'">Ver Reportes</button></li>
                <li><a href='logout.php'><span class="glyphicon glyphicon-log-in"></span> Cierre de Sesión</a></li>
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
                    <?php if ($_SESSION['tipo']==1):?>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Agregar <span class="caret"></span></a>
                    <ul class="dropdown-menu" style="text-align: center" >
                        <li><button class="btn btn-sm btn-warning navbar-btn bounceInUp animated animated" data-wow-duration="500ms" onclick = "location='../agregarcategoria.php'">Agregar Categoria</button></li>
                        <li><button class="btn btn-sm btn-info navbar-btn bounceInUp animated animated" data-wow-duration="500ms" onclick = "location='agregarusuario.php'">Agregar Usuario</button></li>
                        <li><button class="btn btn-sm btn-warning navbar-btn bounceInUp animated animated" data-wow-duration="500ms" onclick = "location='agregarestado.php'">Agregar Estatus</button></li>
                        <?php endif;?>

                    </ul>
                </li>
                <!-- <li><a href="#">Page 2</a></li>-->
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <?php if ($_SESSION['tipo']==1):?>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Eliminar <span class="caret"></span></a>
                    <ul class="dropdown-menu" style="text-align: center" >
                        <li><button class="btn btn-sm btn-warning navbar-btn bounceInUp animated animated" data-wow-duration="500ms" onclick = "location='eliminareportes.php'">Eliminar Reportes</button></li>
                        <?php endif;?>
                    </ul>
                </li>
                <!-- <li><a href="#">Page 2</a></li>-->
            </ul>
        </div>
    </div>
</nav>