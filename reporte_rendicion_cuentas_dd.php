<?php 
$URL = "http://145.0.40.76/sedicop/registro_asambleas/img/";
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <!-- <meta charset="utf-8"> -->
  <title>Documento sin título</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <style>
    img.centrar-imagen {
        display: block;
        margin: 0 auto;
        background-color: black;
    }
    </style>
</head>
<body>
<?php
include 'php/sqlconnector.php';
session_start();


header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=Reporte_Rendicion_Cuentas_dd.xls");
header("Pragma: no-cache");
header("Expires: 0");
header("Content-Type: text/html;charset=utf-8");
date_default_timezone_set('America/Mexico_City'); 

echo "<table border=0 width='50' style='font-family: Calibri Light;'> ";
echo "<img src='". $URL ."header20_1.png' width='240' height='130' alt='Logo IECM' >";
echo "<tr></tr>
      <tr></tr>
      <tr>
        <th colspan='51'style ='color:#6847A3;'>
          <font style='font-size: 20px; align:center;'>
            REPORTE DE ASAMBLEAS CIUDADANAS DE EVALUACIÓN Y RENDICIÓN DE CUENTAS
          </font>
        </th>
      </tr>
      <tr></tr>
      <tr></tr>
      <tr></tr>
</table>";

$sql1 = "SELECT col.nombre_colonia, f2.clave_colonia, f2.id_distrito, del.nombre_delegacion, tipo_asamblea, lugar, CONVERT(varchar,fecha,103) as fecha , SUBSTRING(CONVERT(VARCHAR(10), hora), 1, 5) as hora, CASE asamblea_cancelada WHEN 1 THEN 'SI' ELSE 'NO' END AS asamblea_cancelada, motivo_cancelacion, total_1, mujeres_1, hombres_1, otros_1, total_2, mujeres_2, hombres_2, otros_2, total_3, mujeres_3, hombres_3, otros_3, total_4, mujeres_4, hombres_4, otros_4, total_5, mujeres_5, hombres_5, otros_5, total_6, mujeres_6, hombres_6, otros_6, total_7, mujeres_7, hombres_7, otros_7, total_8, mujeres_8, hombres_8, otros_8, menor_16, edad_16_17, edad_18_29, edad_30_39, edad_40_49, edad_50_59, edad_60_mas, elaboro, f2.observaciones from sireac_formato2 f2, cat_colonia col, cat_delegacion del where f2.clave_colonia = col.clave_colonia AND f2.id_delegacion = del.id_delegacion AND f2.id_distrito = " . $_SESSION['id_distrito'] ." ORDER BY f2.id_distrito, del.nombre_delegacion, col.nombre_colonia, f2.clave_colonia";

$query1 = sqlsrv_query($conn,$sql1);
echo '<table border = "1" height="100" align="center" style="font-family: Calibri Light;">
  <thead>
    <tr>
      <th colspan="10"></th>
      <th colspan="4" bgcolor="#FCE4D6">PERSONAS INTEGRANTES DE LA COMISIÓN DE PARTICIPACIÓN COMUNITARIA PRESENTES</th>

      <th colspan="4" bgcolor="#FCE4D6">PERSONAS HABITANTES CON CREDENCIAL DE ELECTOR PRESENTES</th>

      <th colspan="4" bgcolor="#FCE4D6">PERSONAS DE ENTRE 16 Y 17 AÑOS PRESENTES</th>

      <th colspan="4" bgcolor="#FCE4D6">PERSONAS HABITANTES MENORES DE EDAD PRESENTES</th> 

      <th colspan="4" bgcolor="#FCE4D6">PERSONAS FUNCIONARIAS PÚBLICAS PRESENTES</th>   
      
      <th colspan="4" bgcolor="#FCE4D6">PERSONAS CON INTERÉS DE CARÁCTER CONSULTIVO PRESENTES</th>   

      <th colspan="4" bgcolor="#FCE4D6">PERSONAS INTEGRANTES DE ORGANIZACIÓN CIUDADANA CON REGISTRO ANTE IECM</th>   

      <th colspan="4" bgcolor="#FCE4D6">PERSONAS OBSERVADORAS Y VISITANTES EXTRANJERAS</th>

      <th colspan="7" bgcolor="#FCE4D6">SUMAR EL NÚMERO DE PERSONAS POR RANGO DE EDAD Y CAPTURARLO EN LOS SIGUIENTES CAMPOS</th>     
    </tr>
    <tr bgcolor="#FCE4D6">
      <th>DISTRITO</th>
      <th>DEMARCACIÓN</th>
      <th>UNIDAD TERRITORIAL</th>
      <th>CLAVE</th>      
      <th>TIPO DE ASAMBLEA</th>
      <th>LUGAR</th>
      <th>FECHA</th>
      <th>HORA (formato 24 horas)</th>
      <th>ASAMBLEA CANCELADA</th>
      <th>MOTIVO DE CANCELACIÓN</th>

      <th>TOTAL</th>
      <th>MUJERES</th>
      <th>HOMBRES</th>
      <th>OTROS</th>

      <th>TOTAL</th>
      <th>MUJERES</th>
      <th>HOMBRES</th>
      <th>OTROS</th>

      <th>TOTAL</th>
      <th>MUJERES</th>
      <th>HOMBRES</th>
      <th>OTROS</th>

      <th>TOTAL</th>
      <th>MUJERES</th>
      <th>HOMBRES</th>
      <th>OTROS</th>

      <th>TOTAL</th>
      <th>MUJERES</th>
      <th>HOMBRES</th>
      <th>OTROS</th>

      <th>TOTAL</th>
      <th>MUJERES</th>
      <th>HOMBRES</th>
      <th>OTROS</th>

      <th>TOTAL</th>
      <th>MUJERES</th>
      <th>HOMBRES</th>
      <th>OTROS</th>

      <th>TOTAL</th>
      <th>MUJERES</th>
      <th>HOMBRES</th>
      <th>OTROS</th>

      <th>MENORES DE 16 </th>
      <th>16 A 17</th>
      <th>18 A 29</th>
      <th>30 A 39</th>
      <th>40 A 49</th>
      <th>50 A 59</th>
      <th>60 O MÁS</th>

      <th>OBSERVACIONES</th>
      <th>ELABORÓ</th>
    </tr>
  </thead>
  <tbody>';
  while ($row = sqlsrv_fetch_array($query1)) {
    echo '<tr>
      <td>'. $row['id_distrito'].'</td>
      <td>'. utf8_encode($row['nombre_delegacion']).'</td>
      <td>'. utf8_encode($row['nombre_colonia']).'</td>
      <td>'. $row['clave_colonia'].'</td>      
      <td>'. utf8_encode($row['tipo_asamblea']).'</td>
      <td>'. utf8_encode($row['lugar']).'</td>
      <td>'. $row['fecha'].'</td>
      <td>'. $row['hora'].'</td>
      <td>'. $row['asamblea_cancelada'].'</td>
      <td>'. utf8_encode($row['motivo_cancelacion']).'</td>

      <td>'. $row['total_1'].'</td>
      <td>'. $row['mujeres_1'].'</td>
      <td>'. $row['hombres_1'].'</td>
      <td>'. $row['otros_1'].'</td>

      <td>'. $row['total_2'].'</td>
      <td>'. $row['mujeres_2'].'</td>
      <td>'. $row['hombres_2'].'</td>
      <td>'. $row['otros_2'].'</td>

      <td>'. $row['total_3'].'</td>
      <td>'. $row['mujeres_3'].'</td>
      <td>'. $row['hombres_3'].'</td>
      <td>'. $row['otros_3'].'</td>

      <td>'. $row['total_4'].'</td>
      <td>'. $row['mujeres_4'].'</td>
      <td>'. $row['hombres_4'].'</td>
      <td>'. $row['otros_4'].'</td>

      <td>'. $row['total_5'].'</td>
      <td>'. $row['mujeres_5'].'</td>
      <td>'. $row['hombres_5'].'</td>
      <td>'. $row['otros_5'].'</td>

      <td>'. $row['total_6'].'</td>
      <td>'. $row['mujeres_6'].'</td>
      <td>'. $row['hombres_6'].'</td>
      <td>'. $row['otros_6'].'</td>

      <td>'. $row['total_7'].'</td>
      <td>'. $row['mujeres_7'].'</td>
      <td>'. $row['hombres_7'].'</td>
      <td>'. $row['otros_7'].'</td>

      <td>'. $row['total_8'].'</td>
      <td>'. $row['mujeres_8'].'</td>
      <td>'. $row['hombres_8'].'</td>
      <td>'. $row['otros_8'].'</td>

      <td>'. $row['menor_16'].'</td>
      <td>'. $row['edad_16_17'].'</td>
      <td>'. $row['edad_18_29'].'</td>
      <td>'. $row['edad_30_39'].'</td>
      <td>'. $row['edad_40_49'].'</td>
      <td>'. $row['edad_50_59'].'</td>
      <td>'. $row['edad_60_mas'].'</td>

      <td>'. utf8_encode($row['observaciones']).'</td>
      <td>'. utf8_encode($row['elaboro']).'</td>
    </tr>';
  }
echo '</tbody>
</table>';
?>
</body>
</html>
