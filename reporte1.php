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
        <h3 class="center ">Registro de Asamblea de Casos Especiales</h3>
        <form action="php/envio1.php" method = "post" id = "form1">
        <br><br>
        <div class= "lila col-8 row">
            <label for="">Fecha de ingreso (dd/mm/aaaa):</label>
            <!-- <input type="date" name="" id="fecha_ingreso"> -->
            <label for=""><?= date('d/m/Y') ?></label>
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
                <input class="in center" name="direccion_distrital_1"  id= "direccion_distrital_1" value= "<?= $id_distrito?>" placeholder ="<?= $id_distrito?>" type="text">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>DEMARCACIÓN:</label>
            </div>
            <div class="col-4">
                <select class="in" name="demarcacion_1" id="demarcacion_1">
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
                <select class="in" name="unidad_territorial_1" id="unidad_territorial_1">
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
                <input class="in" name ="tipo_asamblea_1" id = "tipo_asamblea_1" type="text" value="CASOS ESPECIALES"  readonly>
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>LUGAR:</label>
            </div>
            <div class="col-4">
                <input class="in" name ="lugar_1" id = "lugar_1" type="text" onkeyup= "mayus(this)">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>FECHA(dd/mm/aaaa):</label>
            </div>
            <div class="col-4">
                <input class="in center" name ="fecha_1" id="fecha_1" type="date">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>HORA (hh:mm formato 24 hrs):</label>
            </div>
            <div class="col-4">
                <input class="in center" name ="hora_1" id ="hora_1" type="time">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>ASAMBLEA CANCELADA (SÍ/NO):</label>
            </div>
            <div class="col-4">
                <select class="in" name="asamblea_cancelada_1" id="asamblea_cancelada_1">
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
                <input class="in" name ="cancelacion_1" id = "cancelacion_1" type="text" onkeyup= "mayus(this)">
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
            <input class="in" name ="total_1_1" id ="total_1_1" type="text" maxlength="4" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                <!-- <input class="in" name ="total_1_1" id ="total_1_1" type="text" maxlength="4" onkeypress="return event.charCode >= 48 && event.charCode <= 57"> -->
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>MUJERES:</label>
            </div>
            <div class="col-4">
                <input class="in" name ="mujeres_1_1" id ="mujeres_1_1" type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>HOMBRES:</label>
            </div>
            <div class="col-4">
                <input class="in" name ="hombres_1_1" id ="hombres_1_1"  type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>OTROS:</label>
            </div>
            <div class="col-4">
                <input class="in" name ="otros_1_1" id ="otros_1_1"  type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
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
                <input class="in" name ="total_2_1" id ="total_2_1" type="text" maxlength="4" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>MUJERES:</label>
            </div>
            <div class="col-4">
                <input class="in" name ="mujeres_2_1" id ="mujeres_2_1"  type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>HOMBRES:</label>
            </div>
            <div class="col-4">
                <input class="in" name ="hombres_2_1" id ="hombres_2_1"  type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>OTROS:</label>
            </div>
            <div class="col-4">
                <input class="in" name ="otros_2_1" id ="otros_2_1"  type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
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
                <input class="in" name ="total_3_1" id ="total_3_1" type="text" maxlength="4" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>MUJERES:</label>
            </div>
            <div class="col-4">
                <input class="in" name ="mujeres_3_1" id ="mujeres_3_1"  type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>HOMBRES:</label>
            </div>
            <div class="col-4">
                <input class="in" name ="hombres_3_1" id ="hombres_3_1"  type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>OTROS:</label>
            </div>
            <div class="col-4">
                <input class="in" name ="otros_3_1" id ="otros_3_1"  type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
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
                <input class="in" name ="total_4_1" id ="total_4_1" type="text" maxlength="4" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>MUJERES:</label>
            </div>
            <div class="col-4">
                <input class="in" name ="mujeres_4_1" id ="mujeres_4_1"  type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>HOMBRES:</label>
            </div>
            <div class="col-4">
                <input class="in" name ="hombres_4_1" id ="hombres_4_1"  type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>OTROS:</label>
            </div>
            <div class="col-4">
                <input class="in" name ="otros_4_1" id ="otros_4_1"  type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
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
                <input class="in" name ="total_5_1" id ="total_5_1" type="text" maxlength="4" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>MUJERES:</label>
            </div>
            <div class="col-4">
                <input class="in" name ="mujeres_5_1" id ="mujeres_5_1"  type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>HOMBRES:</label>
            </div>
            <div class="col-4">
                <input class="in" name ="hombres_5_1" id ="hombres_5_1"  type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>OTROS:</label>
            </div>
            <div class="col-4">
                <input class="in" name ="otros_5_1" id ="otros_5_1"  type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
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
                <input class="in" name ="total_6_1" id ="total_6_1" type="text" maxlength="4" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>MUJERES:</label>
            </div>
            <div class="col-4">
                <input class="in" name ="mujeres_6_1" id ="mujeres_6_1"  type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>HOMBRES:</label>
            </div>
            <div class="col-4">
                <input class="in" name ="hombres_6_1" id ="hombres_6_1"  type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>OTROS:</label>
            </div>
            <div class="col-4">
                <input class="in" name ="otros_6_1" id ="otros_6_1"  type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
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
                <input class="in" name ="total_7_1" id ="total_7_1" type="text" maxlength="4" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>MUJERES:</label>
            </div>
            <div class="col-4">
                <input class="in" name ="mujeres_7_1" id ="mujeres_7_1"  type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>HOMBRES:</label>
            </div>
            <div class="col-4">
                <input class="in" name ="hombres_7_1" id ="hombres_7_1" type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>OTROS:</label>
            </div>
            <div class="col-4">
                <input class="in" name ="otros_7_1" id ="otros_7_1"  type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
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
                <input class="in" name ="total_8_1" id ="total_8_1" type="text" maxlength="4" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>MUJERES:</label>
            </div>
            <div class="col-4">
                <input class="in" name ="mujeres_8_1" id ="mujeres_8_1"  type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>HOMBRES:</label>
            </div>
            <div class="col-4">
                <input class="in" name ="hombres_8_1" id ="hombres_8_1"  type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>OTROS:</label>
            </div>
            <div class="col-4">
                <input class="in" name ="otros_8_1" id ="otros_8_1"  type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
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
                <input class="in" name= "rango_1_1" id ="rango_1_1"  type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>16 A 17:</label>
            </div>
            <div class="col-4">
                <input class="in" name= "rango_2_1" id ="rango_2_1"  type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>18 A 29:</label>
            </div>
            <div class="col-4">
                <input class="in" name= "rango_3_1" id ="rango_3_1"  type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>30 A 39:</label>
            </div>
            <div class="col-4">
                <input class="in" name= "rango_4_1" id ="rango_4_1"  type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>40 A 49:</label>
            </div>
            <div class="col-4">
                <input class="in" name= "rango_5_1" id ="rango_5_1"  type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>50 A 59:</label>
            </div>
            <div class="col-4">
                <input class="in" name= "rango_6_1" id ="rango_6_1"  type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>60 Ó MÁS:</label>
            </div>
            <div class="col-4">
                <input class="in" name= "rango_7_1" id ="rango_7_1"  type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>     
        </div>
        <div class="row azul">
            <p class="col-8 info-1">CASO ESPECIAL</p>
            <p class="col-8"><b>EMPATES</b></p>
            <p class="col-8">(En caso de que no aplique señalar NO APLICA)</p>
        </div>
        <div class="row" id="divempate_1">
            <div class="col-8">
                <label>PROYECTO GANADOR 2020 (DESEMPATE EN 1er LUGAR)</label>
            </div>
            <div class="col-4">
                <select class="in" name="select_empate_1" id="select_empate_1">
                    <option value="">---------------------------</option>
                </select>
                <!-- <input class="in" name ="empate_1" id = "empate_1" type="text" onkeyup= "mayus(this)"> -->
           </div>     
        </div>
        <div class="row" id="divempate_2">
            <div class="col-8">
                <label>PROYECTO SEGUNDO LUGAR 2020 (DESEMPATE EN 2o LUGAR)</label>
            </div>
            <div class="col-4">
                <select class="in" name="select_empate_2" id="select_empate_2">
                    <option value="">---------------------------</option>
                </select>
                <!-- <input class="in" name ="empate_2" id = "empate_2"  type="text" onkeyup= "mayus(this)"> -->
           </div>     
        </div>
        <div class="row" id="divempate_3">
            <div class="col-8">
                <label>PROYECTO GANADOR 2021 (DESEMPATE EN 1er LUGAR)</label>
            </div>
            <div class="col-4">
                <select class="in" name="select_empate_3" id="select_empate_3">
                    <option value="">---------------------------</option>
                </select>
                <!-- <input class="in" name ="empate_3" id = "empate_3" type="text" onkeyup= "mayus(this)"> -->
           </div>     
        </div>
        <div class="row" id="divempate_4">
            <div class="col-8">
                <label>PROYECTO SEGUNDO LUGAR 2021 (DESEMPATE EN 2o LUGAR)</label>
            </div>
            <div class="col-4">
                <select class="in" name="select_empate_4" id="select_empate_4">
                    <option value="">---------------------------</option>
                </select>
                <!-- <input class="in" name ="empate_4" id = "empate_4" type="text" onkeyup= "mayus(this)"> -->
           </div>          
        </div>
        <div class="row azul">
            <p class="col-8 info-1">CASO ESPECIAL</p>
            <p class="col-8"><b>NO SE CELEBRÓ LA JORNADA CONSULTIVA</b></p>
            <p class="col-8">(En caso de que no aplique señalar NO APLICA)</p>
        </div>
        <div class="row lila">
            <p class="col-8 info center">PROYECTOS PROPUESTOS PARA 2020 (En orden de prelación)</p>
        </div>
        <div class="proyecto_propuesto_2020">
        <div class="row">
            <div class="col-8 center">
                <label>1</label>
            </div>
            <div class="col-4">
                <input class="in" name ="proyecto_2020[]" id = "proyecto_2020_1" type="text" maxlength="300" onkeyup= "mayus(this)">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>2</label>
            </div>
            <div class="col-4">
                <input class="in" name ="proyecto_2020[]" id = "proyecto_2020_2" type="text" maxlength="300" onkeyup= "mayus(this)">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>3</label>
            </div>
            <div class="col-4">
                <input class="in" name ="proyecto_2020[]" id = "proyecto_2020_3" type="text" maxlength="300" onkeyup= "mayus(this)">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>4</label>
            </div>
            <div class="col-4">
                <input class="in" name ="proyecto_2020[]" id = "proyecto_2020_4" type="text" maxlength="300" onkeyup= "mayus(this)">
           </div>     
        </div>
        </div>
        
        <button id= "add_2020">agregar</button>
        <div class="row lila">
            <p class="col-8 info center">PROYECTOS PROPUESTOS PARA 2021 (En orden de prelación)</p>
        </div>
        <div class="proyecto_propuesto_2021">
        <div class="row">
            <div class="col-8 center">
                <label>1</label>
            </div>
            <div class="col-4">
                <input class="in" name ="proyecto_2021[]" id = "proyecto_2021_1" type="text" maxlength="300" onkeyup= "mayus(this)">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>2</label>
            </div>
            <div class="col-4">
                <input class="in" name ="proyecto_2021[]" id = "proyecto_2021_2" type="text" maxlength="300" onkeyup= "mayus(this)">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>3</label>
            </div>
            <div class="col-4">
                <input class="in" name ="proyecto_2021[]" id = "proyecto_2021_3" type="text" maxlength="300" onkeyup= "mayus(this)">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>4</label>
            </div>
            <div class="col-4">
                <input class="in" name ="proyecto_2021[]" id = "proyecto_2021_4" type="text" maxlength="300" onkeyup= "mayus(this)">
           </div>     
        </div>
        </div>
        <button id= "add_2021">agregar</button>
        <div class="row border">
            <p class="col-8 center info-1">Elaboró:</p>
            <div class="col-4">
                <input class="in" name ="elaboro_1" id= "elaboro_1" type="text" onkeyup= "mayus(this)">
           </div>  
        </div>
        <div class="row">
            <p class="col-8 center info-1">Observaciones:</p>
            <div class="col-4">
                <textarea class="in form-control" name ="observaciones_1" id= "observaciones_1" onkeyup= "mayus(this)"></textarea>
           </div>  
        </div>
        <div class="d-flex justify-content-end boton">
            <button class="btn btn-success btn-f1">Registrar</button>
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
<script src="js/funciones.js"></script>
</html> 