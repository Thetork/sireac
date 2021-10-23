<?php 
include "php/securityPanel.php";
session_start();
$id_distrito = $_SESSION['id_distrito'];
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
    <link rel="stylesheet" type="text/css" href="js/sweet2/sweetalert2.css">
</head>
<body>

    <?php include ("header.php"); ?>
    <div class="container">
    <br>
        <div class="d-flex justify-content-between">
            <label>
                <b>Distrito: <?= $id_distrito?></b>
            </label>
            <a class="btn btn-secondary " href="php/logout.php">Cerrar Sesión</a>
        </div>
<br>
    	<div class="d-flex justify-content-center h-100">
            <div class="card" style="width: 70%; heigth: auto;">
                <table width="100%"  class ="table table-striped table_margin">
                    <tbody>
                        <tr>
                            <td colspan="2"><h3 class= "titulo-eleccion">Asambleas de Evaluación y Rendición de Cuentas</h3></td>
                        </tr>
                        <tr>
                            <td class="txt_right"><a href="reporte2.php"><img src="img/estudiante.png"></a></td>
                            <td class="txt_right"><a class="btn btn-secondary btn-lg btn-block" href="reporte2.php">Registrar Asambleas</a></td>
                        </tr>
                        <tr>
                            <td class="txt_right">
                                <a href=""><img src="img/sobresalir.png"></a></td>
                            <td class="txt_right"><button class="btn btn-secondary btn-lg btn-block" onclick="reportesamablea()">Reporte de Asambleas</button>

                                <!-- <a class="btn btn-secondary btn-lg btn-block" href="reporte_rendicion_cuentas_dd.php">Reporte de Asambleas</a> --></td>
                        </tr>
                    </tbody>
                </table>
            </div>
    	</div>
    </div>
    <?php include ("footer.php"); ?>
    <script>
        function reportesamablea(){
    var accion = 7;
    var formData = {accion:accion};
    $.ajax({
        type: "POST",
        url: "php/load.php",
        data: formData,
        success: function(response) {
            if (response >= 1) {
                window.location.href = './reporte_rendicion_cuentas_dd.php';
            } else {
                Swal.fire({
                    type: 'warning',
                    title: 'Alerta!!!',
                    text: 'No existe información!'
                })
            }
        }
    });
}
    </script>
</body>
<script src="js/funciones.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="js/sweet2/sweetalert2.js"></script>
</html>

