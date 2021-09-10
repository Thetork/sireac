<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Registro de Asambleas</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
<?php include ("header.php"); ?>
<div class="container">
	<div class="row justify-content-md-center">
		<div class="col-md-5" style="padding-bottom:2em;margin-top:2rem;">
			<div class="card">
				<div class="card-header">Ingresar</div>
				<div class="card-body">
					<form class="form-horizontal" method="post" id="form-login-censo">
						<div class="form-group">
							<div class="col-sm-12">
								<input type="text" class="form-control" id="usuario" placeholder="Usuario" required autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-12">
								<input type="password" class="form-control" id="contrasena" placeholder="Contraseña" required autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-12">
								<button type="submit" name="submit" class="btn btn-primary btn-block">Ingresar</button>
								<div id="errormsg"></div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="js/funciones.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<?php include ("footer.php"); ?>
</body>
</html>