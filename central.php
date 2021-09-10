<?php 
include "php/sqlconnector.php";
include "php/securityPanel.php";
session_start();
$id_distrito = $_SESSION['nombre'];
date_default_timezone_set('America/Mexico_City'); 
?>
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
<br>
<div class="d-flex justify-content-between">
    <label>
        <b>Perfil: <?= $id_distrito?></b>
    </label>
    <a class="btn btn-secondary" href="php/logout.php">Cerrar Sesión</a>
</div>
    <br>
        <div class="d-flex justify-content-center h-100">
            <div class="card" style="width: 70%; heigth: auto;">
                <table width="100%"  class ="table table-striped table_margin">
                    <tbody>
                        <tr>
                            <td colspan="2"><h3 class="titulo-eleccion">¿Qué reporte desea generar?</h3></td>
                        </tr>
                        <tr>
                            <td class="txt_right"><a href="reporte_rendicion_cuentas.php"><img src="img/sobresalir.png"></a></td>
                            <td class="txt_right"><a class="btn btn-secondary btn-lg btn-block" href="reporte_rendicion_cuentas.php">Reporte de Evaluación y Rendición de Cuentas</a></td>
                        </tr>
                        <tr>
                            <td class="txt_right">
                                <a href=""><img src="img/sobresalir.png"></a></td>
                            <td class="txt_right"><a class="btn btn-secondary btn-lg btn-block" href="base_datos_rendicion_cuentas.php">Base de datos de Evaluación y Rendición de Cuentas</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<?php include ("footer.php"); ?>
</body>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
<!-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script> -->
<script src="js/funciones.js"></script>

</html>

