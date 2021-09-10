<?php 
include "php/sqlconnector.php";
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
	<title>Registro de Reportes</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="stylesheet" href="js/sweet2/sweetalert2.min.css">
</head>
<body>
<?php include ("header.php"); ?>
<div class="container">
<div class="d-flex justify-content-between">
    <label>
        Distrito: <?= $id_distrito?>
    </label>
    <button class=""> 
        <a class="links" href="php/logout.php">Cerrar Sesión</a>
    </button>
</div>
   <div>
   <br>
        <h3 class="center">Registro de Asamblea de Información y Selección</h3>
        <br><br>
        <form action="php/envio3.php" method = "post" id = "form3">
        <div class= "lila col-8 row">
            <label for="">Fecha de ingreso (dd/mm/aaaa):</label>
            <!-- <input type="date" name="" id="fecha_ingreso"> -->
            <label for=""><?php echo date('d/m/Y'); ?></label>
        </div><br>
        <div class="row">
            <p class="col-12 p-completo"> <b>IMPORTANTE:</b> LLENAR FORMULARIO CON MAYÚSCULAS</p>
        </div>
        <div class="row azul">
            <p class="col-8 info-1">INFORMACIÓN GENERAL</p>
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>DIRECCIÓN DISTRITAL:</label>
            </div>
            <div class="col-4">
                <input class="in center" name="direccion_distrital_3"  id= "direccion_distrital_3" value= "<?php echo $id_distrito?>" placeholder ="<?php echo $id_distrito?>" type="text">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>DEMARCACIÓN:</label>
            </div>
            <div class="col-4">
                <select class="in" name="demarcacion_3" id="demarcacion_3">
                    <option value="">---------------------------</option>
                        <?php  
                        $query = "SELECT del.id_delegacion, nombre_delegacion from cat_delegacion as del, cat_dist_dele as dit  where del.id_delegacion = dit.id_delegacion and  id_distrito = '".$id_distrito."'";
                        $res = sqlsrv_query($conn, $query);
                        while ($row = sqlsrv_fetch_array($res)) {
                        echo '<option value='. $row['id_delegacion'].'>'.utf8_encode(trim($row['nombre_delegacion'])).'</option>';}?>
                </select>
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>UNIDAD TERRITORIAL:</label>
            </div>
            <div class="col-4">
                <select class="in" name="unidad_territorial_3" id="unidad_territorial_3">
                    <option value="">---------------------------</option>
                </select>
            </div>     
            </div>
                <!-- <div class="row">
                    <div class="col-8 center">
                        <label>CLAVE UNIDAD TERRITORIAL:</label>
                    </div>
                <div class="col-4">
                    <select class="in" name="" id="clave_unidad_territorial_1">
                        <option value="">---------------------------</option>
                        <?php  
                        /*$query = "SELECT clave_colonia from cat_colonia where id_distrito = '".$id_distrito."'";
                        $res = sqlsrv_query($conn, $query);
                        while ($row = sqlsrv_fetch_array($res)) {
                        echo '<option value='. $row['clave_colonia'].'>'.utf8_encode(trim($row['clave_colonia'])).'</option>';}*/?>
                    </select>
                </div>     
            </div>  -->
        
        
        <div class="row">
            <div class="col-8 center">
                <label>TIPO DE ASAMBLEA:</label>
            </div>
            <div class="col-4">
                <input class="in" name ="tipo_asamblea_3" id = "tipo_asamblea_3" value="INFORMACIÓN Y SELECCIÓN" type="text"  readonly>
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>LUGAR:</label>
            </div>
            <div class="col-4">
                <input class="in" name ="lugar_3" id = "lugar_3" type="text"  onkeyup= "mayus(this)">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>FECHA(dd/mm/aaaa):</label>
            </div>
            <div class="col-4">
                <input class="in center" name ="fecha_3" id="fecha_3" type="date">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>HORA (hh:mm formato 24 hrs):</label>
            </div>
            <div class="col-4">
                <input class="in center" name ="hora_3" id ="hora_3" type="time">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>ASAMBLEA CANCELADA (SÍ/NO):</label>
            </div>
            <div class="col-4">
                <select class="in" name="asamblea_cancelada_3" id="asamblea_cancelada_3">
                    <option value="">---------------------------</option>
                    <option value="1">SI</option>
                    <option value="2">NO</option>
                </select>
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>MOTIVO DE CANCELACIÓN:</label>
            </div>
            <div class="col-4">
                <input class="in" name ="cancelacion_3" id = "cancelacion_3" type="text" onkeyup= "mayus(this)">
           </div>     
        </div>
        <div class="row azul">
            <p class="col-8 info">PERSONAS PARTICIPANTES</p>
        </div>
        <div class="row lila">
            <p class="col-8 info center">PERSONAS INTEGRANTES DE LA COMISIÓN DE PARTICIPACIÓN COMUNITARIA PRESENTES</p>
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>TOTAL:</label>
            </div>
            <div class="col-4">
                <input class="in" name ="total_1_3" id ="total_1_3" type="text" maxlength="4" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>MUJERES:</label>
            </div>
            <div class="col-4">
                <input class="in" name ="mujeres_1_3" id ="mujeres_1_3" type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>HOMBRES:</label>
            </div>
            <div class="col-4">
                <input class="in" name ="hombres_1_3" id ="hombres_1_3" type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>OTROS:</label>
            </div>
            <div class="col-4">
                <input class="in" name ="otros_1_3" id ="otros_1_3" type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>     
        </div>
        <div class="row lila">
            <p class="col-8 info center">PERSONAS HABITANTES CON CREDENCIAL DE ELECTOR PRESENTES</p>
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>TOTAL:</label>
            </div>
            <div class="col-4">
                <input class="in" name ="total_2_3" id ="total_2_3" type="text" maxlength="4" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>MUJERES:</label>
            </div>
            <div class="col-4">
                <input class="in" name ="mujeres_2_3" id ="mujeres_2_3" type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>HOMBRES:</label>
            </div>
            <div class="col-4">
                <input class="in" name ="hombres_2_3" id ="hombres_2_3" type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>OTROS:</label>
            </div>
            <div class="col-4">
                <input class="in" name ="otros_2_3" id ="otros_2_3" type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>     
        </div>
        <div class="row lila">
            <p class="col-8 info center">PERSONAS DE ENTRE 16 Y 17 AÑOS PRESENTES</p>
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>TOTAL:</label>
            </div>
            <div class="col-4">
                <input class="in" name ="total_3_3" id ="total_3_3" type="text" maxlength="4" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>MUJERES:</label>
            </div>
            <div class="col-4">
                <input class="in" name ="mujeres_3_3" id ="mujeres_3_3" type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>HOMBRES:</label>
            </div>
            <div class="col-4">
                <input class="in" name ="hombres_3_3" id ="hombres_3_3" type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>OTROS:</label>
            </div>
            <div class="col-4">
                <input class="in" name ="otros_3_3" id ="otros_3_3" type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>     
        </div>
        <div class="row lila">
            <p class="col-8 info center">PERSONAS HABITANTES MENORES DE EDAD PRESENTES</p>
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>TOTAL:</label>
            </div>
            <div class="col-4">
                <input class="in" name ="total_4_3" id ="total_4_3" type="text" maxlength="4" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>MUJERES:</label>
            </div>
            <div class="col-4">
                <input class="in" name ="mujeres_4_3" id ="mujeres_4_3" type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>HOMBRES:</label>
            </div>
            <div class="col-4">
                <input class="in" name ="hombres_4_3" id ="hombres_4_3" type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>OTROS:</label>
            </div>
            <div class="col-4">
                <input class="in" name ="otros_4_3" id ="otros_4_3" type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>     
        </div>
        <div class="row lila">
            <p class="col-8 info center">PERSONAS FUNCIONARIAS PUBLICAS PRESENTES</p>
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>TOTAL:</label>
            </div>
            <div class="col-4">
                <input class="in" name ="total_5_3" id ="total_5_3" type="text" maxlength="4" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>MUJERES:</label>
            </div>
            <div class="col-4">
                <input class="in" name ="mujeres_5_3" id ="mujeres_5_3" type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>HOMBRES:</label>
            </div>
            <div class="col-4">
                <input class="in" name ="hombres_5_3" id ="hombres_5_3" type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>OTROS:</label>
            </div>
            <div class="col-4">
                <input class="in" name ="otros_5_3" id ="otros_5_3" type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>     
        </div>
        <div class="row lila">
            <p class="col-8 info center">PERSONAS CON INTERES DE CARÁCTER CONSULTIVO PRESENTES</p>
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>TOTAL:</label>
            </div>
            <div class="col-4">
                <input class="in" name ="total_6_3" id ="total_6_3" type="text" maxlength="4" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>MUJERES:</label>
            </div>
            <div class="col-4">
                <input class="in" name ="mujeres_6_3" id ="mujeres_6_3" type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>HOMBRES:</label>
            </div>
            <div class="col-4">
                <input class="in" name ="hombres_6_3" id ="hombres_6_3" type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>OTROS:</label>
            </div>
            <div class="col-4">
                <input class="in" name ="otros_6_3" id ="otros_6_3" type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>     
        </div>
        <div class="row lila">
            <p class="col-8 info center">PERSONAS INTEGRANTES DE ORGANIZACIÓN CIUDADANA CON REGISTRO ANTE IECM:</p>
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>TOTAL:</label>
            </div>
            <div class="col-4">
                <input class="in" name ="total_7_3" id ="total_7_3" type="text" maxlength="4" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>MUJERES:</label>
            </div>
            <div class="col-4">
                <input class="in" name ="mujeres_7_3" id ="mujeres_7_3" type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>HOMBRES:</label>
            </div>
            <div class="col-4">
                <input class="in" name ="hombres_7_3" id ="hombres_7_3" type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>OTROS:</label>
            </div>
            <div class="col-4">
                <input class="in" name ="otros_7_3" id ="otros_7_3" type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>     
        </div>
        <div class="row lila">
            <p class="col-8 info center">PERSONAS OBSERVADORAS Y VISITANTES EXTRANJERAS:</p>
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>TOTAL:</label>
            </div>
            <div class="col-4">
                <input class="in" name ="total_8_3" id ="total_8_3" type="text" maxlength="4" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>MUJERES:</label>
            </div>
            <div class="col-4">
                <input class="in" name ="mujeres_8_3" id ="mujeres_8_3" type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>HOMBRES:</label>
            </div>
            <div class="col-4">
                <input class="in" name ="hombres_8_3" id ="hombres_8_3" type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>OTROS:</label>
            </div>
            <div class="col-4">
                <input class="in" name ="otros_8_3" id ="otros_8_3" type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>     
        </div>
        <div class="row lila">
            <p class="col-8 info center">SUMAR EL NÚMERO DE PERSONAS POR RANGO DE EDAD Y CAPTURARLO EN LOS SIGUIENTES CAMPOS:</p>
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>MENORES DE 16:</label>
            </div>
            <div class="col-4">
                <input class="in" name= "rango_1_3" id ="rango_1_3" type="text" maxlength="4" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>16 A 17:</label>
            </div>
            <div class="col-4">
                <input class="in" name= "rango_2_3" id ="rango_2_3" type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>18 A 29:</label>
            </div>
            <div class="col-4">
                <input class="in" name= "rango_3_3" id ="rango_3_3" type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>30 A 39:</label>
            </div>
            <div class="col-4">
                <input class="in" name= "rango_4_3" id ="rango_4_3" type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>40 A 49:</label>
            </div>
            <div class="col-4">
                <input class="in" name= "rango_5_3" id ="rango_5_3" type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>50 A 59:</label>
            </div>
            <div class="col-4">
                <input class="in" name= "rango_6_3" id ="rango_6_3" type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>60 Ó MÁS:</label>
            </div>
            <div class="col-4">
                <input class="in" name= "rango_7_3" id ="rango_7_3" type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>     
        </div>
        <div class="row azul">
            <p class="col-8 info-1">COMITÉ DE EJECUCIÓN 2020</p>
            <p class="col-8">Ingresar nombre completo de las personas que lo conforman</p>
            <p class="col-8">(Nombre_Apellido paterno_Apellido materno)</p>
        </div>
        <div class="ejecucion_2020">
        <div class="row">
            <div class="col-8 center">
                <label>1</label>
            </div>
            <div class="col-4">
                <input class="in" name ='ejecucion_2020[]' id ="ejecucion_1_2020" type="text" onkeyup= "mayus(this)">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>2</label>
            </div>
            <div class="col-4">
                <input class="in" name ='ejecucion_2020[]' id ="ejecucion_2_2020" type="text" onkeyup= "mayus(this)">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>3</label>
            </div>
            <div class="col-4">
                <input class="in" name ='ejecucion_2020[]' id ="ejecucion_3_2020" type="text" onkeyup= "mayus(this)">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>4</label>
            </div>
            <div class="col-4">
                <input class="in" name ='ejecucion_2020[]' id ="ejecucion_4_2020" type="text" onkeyup= "mayus(this)">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>5</label>
            </div>
            <div class="col-4">
                <input class="in" name ='ejecucion_2020[]' id ="ejecucion_5_2020" type="text" onkeyup= "mayus(this)">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>6</label>
            </div>
            <div class="col-4">
                <input class="in" name ='ejecucion_2020[]' id ="ejecucion_6_2020" type="text" onkeyup= "mayus(this)">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>7</label>
            </div>
            <div class="col-4">
                <input class="in" name ='ejecucion_2020[]' id ="ejecucion_7_2020" type="text" onkeyup= "mayus(this)">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>8</label>
            </div>
            <div class="col-4">
                <input class="in" name ='ejecucion_2020[]' id ="ejecucion_8_2020" type="text" onkeyup= "mayus(this)">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>9</label>
            </div>
            <div class="col-4">
                <input class="in" name ='ejecucion_2020[]' id ="ejecucion_9_2020" type="text" onkeyup= "mayus(this)">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>10</label>
            </div>
            <div class="col-4">
                <input class="in" name ='ejecucion_2020[]' id ="ejecucion_10_2020" type="text" onkeyup= "mayus(this)">
           </div>     
        </div>
        </div>
        <button id= "add_ejecucion_2020">agregar</button>
        <div class="row">
            <div class="col-8 azul">
                <p>Persona Responsable de Comité de Ejecución 2020 (Insaculada)</p>
            </div>
            <div class="col-4">
                <input class="in" name ="persona_responsable_1" id ="persona_responsable_1" type="text" onkeyup= "mayus(this)">
           </div>     
        </div>
        <div class="row gris">
            <p class="col-8 info-1">COMITÉ DE VIGILANCIA 2020</p>
            <p class="col-8">Ingresar nombre completo de las personas que lo conforman</p>
            <p class="col-8">(Nombre_Apellido paterno_Apellido materno)</p>
        </div>
        <div class="vigilancia_2020">
        <div class="row">
            <div class="col-8 center">
                <label>1</label>
            </div>
            <div class="col-4">
                <input class="in" name ='vigilancia_2020[]' id ="vigilancia_2020_1" type="text" onkeyup= "mayus(this)">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>2</label>
            </div>
            <div class="col-4">
                <input class="in" name ='vigilancia_2020[]' id ="vigilancia_2020_2" type="text" onkeyup= "mayus(this)"> 
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>3</label>
            </div>
            <div class="col-4">
                <input class="in" name ='vigilancia_2020[]' id ="vigilancia_2020_3" type="text" onkeyup= "mayus(this)">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>4</label>
            </div>
            <div class="col-4">
                <input class="in" name ='vigilancia_2020[]' id ="vigilancia_2020_4" type="text" onkeyup= "mayus(this)">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>5</label>
            </div>
            <div class="col-4">
                <input class="in" name ='vigilancia_2020[]' id ="vigilancia_2020_5" type="text" onkeyup= "mayus(this)">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>6</label>
            </div>
            <div class="col-4">
                <input class="in" name ='vigilancia_2020[]' id ="vigilancia_2020_6" type="text" onkeyup= "mayus(this)">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>7</label>
            </div>
            <div class="col-4">
                <input class="in" name ='vigilancia_2020[]' id ="vigilancia_2020_7" type="text" onkeyup= "mayus(this)">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>8</label>
            </div>
            <div class="col-4">
                <input class="in" name ='vigilancia_2020[]' id ="vigilancia_2020_8" type="text" onkeyup= "mayus(this)">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>9</label>
            </div>
            <div class="col-4">
                <input class="in" name ='vigilancia_2020[]' id ="vigilancia_2020_9" type="text" onkeyup= "mayus(this)">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>10</label>
            </div>
            <div class="col-4">
                <input class="in" name ='vigilancia_2020[]' id ="vigilancia_2020_10" type="text" onkeyup= "mayus(this)">
           </div>     
        </div>
        </div>
        <button id= "add_vigilancia_2020">agregar</button>

        <div class="row">
            <div class="col-8 gris">
                <p>Persona Responsable de Comité de Vigilancia 2020 (Insaculada)</p>
            </div>
            <div class="col-4">
                <input class="in" name ="persona_responsable_2" id ="persona_responsable_2" type="text" onkeyup= "mayus(this)">
           </div>     
        </div>
        <div class="row azul">
            <p class="col-8 info-1">COMITÉ DE EJECUCIÓN 2021</p>
            <p class="col-8">Ingresar nombre completo de las personas que lo conforman</p>
            <p class="col-8">(Nombre_Apellido paterno_Apellido materno)</p>
        </div>
        <div class="ejecucion_2021">
        <div class="row">
            <div class="col-8 center">
                <label>1</label>
            </div>
            <div class="col-4">
                <input class="in" name ='ejecucion_2021[]' id ="ejecucion_1_2021" type="text" onkeyup= "mayus(this)">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>2</label>
            </div>
            <div class="col-4">
                <input class="in" name ='ejecucion_2021[]' id ="ejecucion_2_2021" type="text" onkeyup= "mayus(this)">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>3</label>
            </div>
            <div class="col-4">
                <input class="in" name ='ejecucion_2021[]' id ="ejecucion_3_2021" type="text" onkeyup= "mayus(this)">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>4</label>
            </div>
            <div class="col-4">
                <input class="in" name ='ejecucion_2021[]' id ="ejecucion_4_2021" type="text" onkeyup= "mayus(this)">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>5</label>
            </div>
            <div class="col-4">
                <input class="in" name ='ejecucion_2021[]' id ="ejecucion_5_2021" type="text" onkeyup= "mayus(this)">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>6</label>
            </div>
            <div class="col-4">
                <input class="in" name ='ejecucion_2021[]' id ="ejecucion_6_2021" type="text" onkeyup= "mayus(this)">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>7</label>
            </div>
            <div class="col-4">
                <input class="in" name ='ejecucion_2021[]' id ="ejecucion_7_2021" type="text" onkeyup= "mayus(this)">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>8</label>
            </div>
            <div class="col-4">
                <input class="in" name ='ejecucion_2021[]' id ="ejecucion_8_2021" type="text" onkeyup= "mayus(this)">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>9</label>
            </div>
            <div class="col-4">
                <input class="in" name ='ejecucion_2021[]' id ="ejecucion_9_2021" type="text" onkeyup= "mayus(this)">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>10</label>
            </div>
            <div class="col-4">
                <input class="in" name ='ejecucion_2021[]'  id ="ejecucion_10_2021" type="text" onkeyup= "mayus(this)">
           </div>     
        </div>
        </div>
        <button id= "add_ejecucion_2021">agregar</button>

        <div class="row">
            <div class="col-8 azul">
                <p>Persona Responsable de Comité de Ejecución 2021 (Insaculada)</p>
            </div>
            <div class="col-4">
                <input class="in" name ="persona_responsable_3" id ="persona_responsable_3" type="text" onkeyup= "mayus(this)">
           </div>     
        </div>
        <div class="row gris">
            <p class="col-8 info-1">COMITÉ DE VIGILANCIA 2021</p>
            <p class="col-8">Ingresar nombre completo de las personas que lo conforman</p>
            <p class="col-8">(Nombre_Apellido paterno_Apellido materno)</p>
        </div>
        <div class="vigilancia_2021">
        <div class="row">
            <div class="col-8 center">
                <label>1</label>
            </div>
            <div class="col-4">
                <input class="in" name ="vigilancia_2021[]" id ="vigilancia_2021_1" type="text" onkeyup= "mayus(this)">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>2</label>
            </div>
            <div class="col-4">
                <input class="in" name ="vigilancia_2021[]" id ="vigilancia_2021_2" type="text" onkeyup= "mayus(this)">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>3</label>
            </div>
            <div class="col-4">
                <input class="in" name ="vigilancia_2021[]" id ="vigilancia_2021_3" type="text" onkeyup= "mayus(this)">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>4</label>
            </div>
            <div class="col-4">
                <input class="in" name ="vigilancia_2021[]" id ="vigilancia_2021_4" type="text" onkeyup= "mayus(this)">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>5</label>
            </div>
            <div class="col-4">
                <input class="in" name ="vigilancia_2021[]" id ="vigilancia_2021_5" type="text" onkeyup= "mayus(this)">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>6</label>
            </div>
            <div class="col-4">
                <input class="in" name ="vigilancia_2021[]" id ="vigilancia_2021_6" type="text" onkeyup= "mayus(this)">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>7</label>
            </div>
            <div class="col-4">
                <input class="in" name ="vigilancia_2021[]" id ="vigilancia_2021_7" type="text" onkeyup= "mayus(this)">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>8</label>
            </div>
            <div class="col-4">
                <input class="in" name ="vigilancia_2021[]" id ="vigilancia_2021_8" type="text" onkeyup= "mayus(this)">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>9</label>
            </div>
            <div class="col-4">
                <input class="in" name ="vigilancia_2021[]" id ="vigilancia_2021_9" type="text" onkeyup= "mayus(this)">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>10</label>
            </div>
            <div class="col-4">
                <input class="in" name ="vigilancia_2021[]"  id ="vigilancia_2021_10" type="text" onkeyup= "mayus(this)">
           </div>     
        </div>
        </div>
        <button id= "add_vigilancia_2021">agregar</button>

        <div class="row">
            <div class="col-8 gris">
                <p>Persona Responsable de Comité de Vigilancia 2020 (Insaculada)</p>
            </div>
            <div class="col-4">
                <input class="in" name ="persona_responsable_4" id ="persona_responsable_4" type="text" onkeyup= "mayus(this)">
           </div>     
        </div>
        
        
        <div class="row border">
            <p class="col-8 center info-1">Elaboró:</p>
            <div class="col-4">
                <input class="in" name ="elaboro_3" id ="elaboro_3" type="text" onkeyup= "mayus(this)">
           </div>  
        </div>
        <div class="row">
            <p class="col-8 center info-1">Observaciones:</p>
            <div class="col-4">
                <textarea class="in form-control" name ="observaciones_3" id= "observaciones_3" onkeyup= "mayus(this)"></textarea>
           </div>  
        </div>
        <div class="d-flex justify-content-end boton">
            <button class="btn btn-success btn-f3">Registrar</button>
        </div>
           
        </form>
        <div class="d-flex justify-content-start">
            <button class=" btn btn-warning"> 
                <a class="links" href="eleccion.php">Volver</a>
            </button>
        </div>
   </div>
</div>
<?php include ("footer.php"); ?>
</body>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="js/sweet2/sweetalert2.js"></script>
<script src="js/funciones3.js"></script>
</html> 