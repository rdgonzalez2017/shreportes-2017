<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/estilos.css">
<title>	SH Reportes	</title>
</head>
<!-- Conexión con base de datos-->
<?php include('conexi.php');?>
<body>
	  <form class="form-horizontal" method = "post" action="c7288fb603ca69bcd28.php">
		<div class="col-md-8 col-md-offset-2">
					<div class="panel panel-primary">
					
						<div class="panel-heading">
							<p class="text-center">Ingresar Datos</p>
						</div>
						
						<div class="panel-body">
							<div class="form-group row">
								<label for="titulo" class="col-md-2 control-label">Titulo</label>
								<div class="col-md-8">
									<input class="form-control" type="text" name="titulo" id="titulo"  required/>
								</div>
							</div>
						
						<div class="form-group row">
								<label for="autor" class="col-md-2 control-label">Autor</label>
								<div class="col-md-8">
									<input class="form-control" type="text" name="autor" id="autor" required/>
								</div>
							</div>
							
							
							  <div class="form-group row">
									<label for="observacion" class="col-md-2 control-label">Observacion</label>
									<div class="col-md-10 col-md-offset-1" >
									  <textarea name="observacion" style="resize:none" required class="form-control" id="observacion" rows="10"></textarea>
									</div>
								</div>
						
						</div>

						<div class="panel-footer text-center">
							<input type="submit" class="btn btn-info btn-sm" value="Publicar"></input>

						</div>
						
					</div>
				
			 </div>
		</div>	
	</form>		
 </body>
</html>