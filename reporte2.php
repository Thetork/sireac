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
	<title>Registro de Asambleas</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="stylesheet" href="js/sweet2/sweetalert2.min.css">
</head>
<a href="eleccion.php" class="btn-flotante btn-warning"><i class="fas fa-home"></i> Inicio</a>
<body>

<?php include ("header.php"); ?>
<div class="container">
<br>
    <div class="d-flex justify-content-between">
        <label>
            <b>Distrito: <?= $id_distrito?></b>
        </label>
        <a class="btn btn-secondary" href="php/logout.php">Cerrar Sesión</a>
    </div>
       <br>
        <h3 class="center">Registro de Asambleas de Evaluación y Rendición de Cuentas</h3>
        <br><br>
        <form action="php/envio2.php" method = "post" id = "form2" name="form2">
        <!-- <div class= "lila col-8 row">
            <label for="">Fecha de ingreso (dd/mm/aaaa):</label>
            <label for=""><?php echo date('d/m/Y'); ?></label>
        </div><br>
        <div class="row">
            <p class="col-12 p-completo"> <b>IMPORTANTE:</b> LLENAR FORMULARIO CON MAYÚSCULAS</p>
        </div> -->
        <div class="row azul">
            <p class="col-8 info-1"><b>INFORMACIÓN GENERAL</b></p>
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>DIRECCIÓN DISTRITAL:</label>
            </div>
            <div class="col-4">
                <input class="in center" name="direccion_distrital_2"  id= "direccion_distrital_2" value= "<?php echo $id_distrito?>" placeholder ="<?php echo $id_distrito?>" type="text">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>DEMARCACIÓN:</label>
            </div>
            <div class="col-4">
                <select class="in" name="demarcacion_2" id="demarcacion_2">
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
                <select class="in" name="unidad_territorial_2" id="unidad_territorial_2">
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
                <input class="in" name ="tipo_asamblea_2" id = "tipo_asamblea_2" value="EVALUACIÓN Y RENDICIÓN DE CUENTAS" type="text"  readonly>
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>LUGAR:</label>
            </div>
            <div class="col-4">
                <input class="in" name ="lugar_2" id = "lugar_2" type="text" onkeyup= "mayus(this)">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>FECHA(dd/mm/aaaa):</label>
            </div>
            <div class="col-4">
                <input class="in center" name ="fecha_2" id="fecha_2" type="date">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>HORA:</label>
            </div>
            <div class="col-4">
                <input class="in center" name ="hora_2" id ="hora_2" type="time">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>ASAMBLEA CANCELADA (SÍ/NO):</label>
            </div>
            <div class="col-4">
                <select class="in" name="asamblea_cancelada_2" id="asamblea_cancelada_2">
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
                <input class="in" name ="cancelacion_2" id = "cancelacion_2" type="text" onkeyup= "mayus(this)">
           </div>     
        </div>
        <br>
        <div class="row azul">
            <p class="col-8 info-1"><b>PERSONAS PARTICIPANTES</b></p>
        </div>
        <div class="row lila">
            <p class="col-8 info center">PERSONAS INTEGRANTES DE LA COMISIÓN DE PARTICIPACIÓN COMUNITARIA PRESENTES</p>
        </div>
        
        <div class="row">
            <div class="col-8 center">
                <label>MUJERES:</label>
            </div>
            <div class="col-4">
                <input class="in total" name ="mujeres_1_2" id ="mujeres_1_2"  type="text" maxlength="3"  onkeypress="return event.charCode >= 48 && event.charCode <= 57" onchange="sumar(this.value, this.id);">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>HOMBRES:</label>
            </div>
            <div class="col-4">
                <input class="in total" name ="hombres_1_2" id ="hombres_1_2"  type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onchange="sumar(this.value, this.id);">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>OTROS:</label>
            </div>
            <div class="col-4">
                <input class="in total" name ="otros_1_2" id ="otros_1_2"  type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onchange="sumar(this.value, this.id);">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>TOTAL:</label>
            </div>
            <div class="col-4">
                <input class="in total" name ="total_1_2" id ="total_1_2" type="text" maxlength="4" readonly onkeypress="return event.charCode >= 48 && event.charCode <= 57" onchange="sumar(this.value, this.id);">
           </div>     
        </div>
        <div class="row lila">
            <p class="col-8 info center">PERSONAS HABITANTES CON CREDENCIAL DE ELECTOR PRESENTES</p>
        </div>
       
        <div class="row">
            <div class="col-8 center">
                <label>MUJERES:</label>
            </div>
            <div class="col-4">
                <input class="in total" name ="mujeres_2_2" id ="mujeres_2_2"  type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onchange="sumar(this.value, this.id);">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>HOMBRES:</label>
            </div>
            <div class="col-4">
                <input class="in total" name ="hombres_2_2" id ="hombres_2_2"  type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onchange="sumar(this.value, this.id);">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>OTROS:</label>
            </div>
            <div class="col-4">
                <input class="in total" name ="otros_2_2" id ="otros_2_2"  type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onchange="sumar(this.value, this.id);">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>TOTAL:</label>
            </div>
            <div class="col-4">
                <input class="in total" name ="total_2_2" id ="total_2_2" type="text" maxlength="4" readonly onkeypress="return event.charCode >= 48 && event.charCode <= 57" onchange="sumar(this.value, this.id);">
           </div>     
        </div>
        <div class="row lila">
            <p class="col-8 info center">PERSONAS DE ENTRE 16 Y 17 AÑOS PRESENTES</p>
        </div>
        
        <div class="row">
            <div class="col-8 center">
                <label>MUJERES:</label>
            </div>
            <div class="col-4">
                <input class="in total" name ="mujeres_3_2" id ="mujeres_3_2"  type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onchange="sumar(this.value, this.id);">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>HOMBRES:</label>
            </div>
            <div class="col-4">
                <input class="in total" name ="hombres_3_2" id ="hombres_3_2"  type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onchange="sumar(this.value, this.id);">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>TOTAL:</label>
            </div>
            <div class="col-4">
                <input class="in total" name ="total_3_2" id ="total_3_2" type="text" maxlength="4" readonly onkeypress="return event.charCode >= 48 && event.charCode <= 57" onchange="sumar(this.value, this.id);">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>OTROS:</label>
            </div>
            <div class="col-4">
                <input class="in total" name ="otros_3_2" id ="otros_3_2"  type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onchange="sumar(this.value, this.id);">
           </div>     
        </div>
        <div class="row lila">
            <p class="col-8 info center">PERSONAS HABITANTES MENORES DE EDAD PRESENTES</p>
        </div>
        
        <div class="row">
            <div class="col-8 center">
                <label>MUJERES:</label>
            </div>
            <div class="col-4">
                <input class="in total" name ="mujeres_4_2" id ="mujeres_4_2"  type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onchange="sumar(this.value, this.id);">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>HOMBRES:</label>
            </div>
            <div class="col-4">
                <input class="in total" name ="hombres_4_2" id ="hombres_4_2"  type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onchange="sumar(this.value, this.id);">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>OTROS:</label>
            </div>
            <div class="col-4">
                <input class="in total" name ="otros_4_2" id ="otros_4_2"  type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onchange="sumar(this.value, this.id);">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>TOTAL:</label>
            </div>
            <div class="col-4">
                <input class="in total" name ="total_4_2" id ="total_4_2" type="text" maxlength="4" readonly onkeypress="return event.charCode >= 48 && event.charCode <= 57" onchange="sumar(this.value, this.id);">
           </div>     
        </div>
        <div class="row lila">
            <p class="col-8 info center">PERSONAS FUNCIONARIAS PÚBLICAS PRESENTES</p>
        </div>
       
        <div class="row">
            <div class="col-8 center">
                <label>MUJERES:</label>
            </div>
            <div class="col-4">
                <input class="in total" name ="mujeres_5_2" id ="mujeres_5_2"  type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onchange="sumar(this.value, this.id);">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>HOMBRES:</label>
            </div>
            <div class="col-4">
                <input class="in total" name ="hombres_5_2" id ="hombres_5_2"  type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onchange="sumar(this.value, this.id);">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>OTROS:</label>
            </div>
            <div class="col-4">
                <input class="in total" name ="otros_5_2" id ="otros_5_2"  type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onchange="sumar(this.value, this.id);">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>TOTAL:</label>
            </div>
            <div class="col-4">
                <input class="in total" name ="total_5_2" id ="total_5_2" type="text" maxlength="4" readonly onkeypress="return event.charCode >= 48 && event.charCode <= 57" onchange="sumar(this.value, this.id);">
           </div>     
        </div>
        <div class="row lila">
            <p class="col-8 info center">PERSONAS CON INTERES DE CARÁCTER CONSULTIVO PRESENTES</p>
        </div>
        
        <div class="row">
            <div class="col-8 center">
                <label>MUJERES:</label>
            </div>
            <div class="col-4">
                <input class="in total" name ="mujeres_6_2" id ="mujeres_6_2"  type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onchange="sumar(this.value, this.id);">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>HOMBRES:</label>
            </div>
            <div class="col-4">
                <input class="in total" name ="hombres_6_2" id ="hombres_6_2"  type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onchange="sumar(this.value, this.id);">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>OTROS:</label>
            </div>
            <div class="col-4">
                <input class="in total" name ="otros_6_2" id ="otros_6_2"  type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onchange="sumar(this.value, this.id);">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>TOTAL:</label>
            </div>
            <div class="col-4">
                <input class="in total" name ="total_6_2" id ="total_6_2" type="text" maxlength="4" readonly onkeypress="return event.charCode >= 48 && event.charCode <= 57" onchange="sumar(this.value, this.id);">
           </div>     
        </div>
        <div class="row lila">
            <p class="col-8 info center">PERSONAS INTEGRANTES DE ORGANIZACIÓN CIUDADANA CON REGISTRO ANTE IECM:</p>
        </div>
        
        <div class="row">
            <div class="col-8 center">
                <label>MUJERES:</label>
            </div>
            <div class="col-4">
                <input class="in total" name ="mujeres_7_2" id ="mujeres_7_2"  type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onchange="sumar(this.value, this.id);">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>HOMBRES:</label>
            </div>
            <div class="col-4">
                <input class="in total" name ="hombres_7_2" id ="hombres_7_2"  type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onchange="sumar(this.value, this.id);">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>OTROS:</label>
            </div>
            <div class="col-4">
                <input class="in total" name ="otros_7_2" id ="otros_7_2"  type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onchange="sumar(this.value, this.id);">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>TOTAL:</label>
            </div>
            <div class="col-4">
                <input class="in total" name ="total_7_2" id ="total_7_2" type="text" maxlength="4" readonly onkeypress="return event.charCode >= 48 && event.charCode <= 57" onchange="sumar(this.value, this.id);">
           </div>     
        </div>
        <div class="row lila">
            <p class="col-8 info center">PERSONAS OBSERVADORAS Y VISITANTES EXTRANJERAS:</p>
        </div>
        
        <div class="row">
            <div class="col-8 center">
                <label>MUJERES:</label>
            </div>
            <div class="col-4">
                <input class="in total" name ="mujeres_8_2" id ="mujeres_8_2"  type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onchange="sumar(this.value, this.id);">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>HOMBRES:</label>
            </div>
            <div class="col-4">
                <input class="in total" name ="hombres_8_2" id ="hombres_8_2"  type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onchange="sumar(this.value, this.id);">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>OTROS:</label>
            </div>
            <div class="col-4">
                <input class="in total" name ="otros_8_2" id ="otros_8_2"  type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onchange="sumar(this.value, this.id);">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>TOTAL:</label>
            </div>
            <div class="col-4">
                <input class="in total" name ="total_8_2" id ="total_8_2" type="text" maxlength="4" readonly onkeypress="return event.charCode >= 48 && event.charCode <= 57" onchange="sumar(this.value, this.id);">
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
                <input class="in total" name= "rango_1_2" id ="rango_1_2"  type="text" maxlength="4" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>16 A 17:</label>
            </div>
            <div class="col-4">
                <input class="in total" name= "rango_2_2" id ="rango_2_2"  type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>18 A 29:</label>
            </div>
            <div class="col-4">
                <input class="in total" name= "rango_3_2" id ="rango_3_2"  type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>30 A 39:</label>
            </div>
            <div class="col-4">
                <input class="in total" name= "rango_4_2" id ="rango_4_2"  type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>40 A 49:</label>
            </div>
            <div class="col-4">
                <input class="in total" name= "rango_5_2" id ="rango_5_2"  type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>50 A 59:</label>
            </div>
            <div class="col-4">
                <input class="in total" name= "rango_6_2" id ="rango_6_2"  type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>     
        </div>
        <div class="row">
            <div class="col-8 center">
                <label>60 O MÁS:</label>
            </div>
            <div class="col-4">
                <input class="in total" name= "rango_7_2" id ="rango_7_2"  type="text" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>     
        </div>
        <div class="row border">
            <p class="col-8 center info-1">Elaboró:</p>
            <div class="col-4">
                <input class="in" name ="elaboro_2" id= "elaboro_2" type="text" onkeyup= "mayus(this)">
           </div>  
        </div>
        <br>
        <div class="row">
            <p class="col-8 center info-1">Observaciones:</p>
            <div class="col-4">
                <textarea class="in form-control" name ="observaciones_2" id= "observaciones_2" onkeyup= "mayus(this)"></textarea>
           </div>  
        </div>
        <div class="d-flex justify-content-end boton">
            <button class="btn btn-success btn-lg">Registrar</button>
        </div>
           
        </form>
        <!-- <div class="d-flex justify-content-start">
            <button class="btn btn-warning"> 
                <a class="links" href="eleccion.php">Volver</a>
            </button>
        </div> -->
</div>
<?php include ("footer.php"); ?>
</body>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="js/sweet2/sweetalert2.js"></script>
<script src="js/funciones2.js"></script>
</html> 