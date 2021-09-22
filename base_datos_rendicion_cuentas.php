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
header("Content-Disposition: attachment; filename=base_datos_Rendicion_Cuentas.xls");
header("Pragma: no-cache");
header("Expires: 0");
header("Content-Type: text/html;charset=utf-8");
date_default_timezone_set('America/Mexico_City'); 

$sql1 = "SELECT col.nombre_colonia, f2.clave_colonia, f2.id_distrito, del.nombre_delegacion, f2.lugar, f2.asamblea_convocada, CONVERT(varchar,f2.fecha,103) as fecha , SUBSTRING(CONVERT(VARCHAR(10), f2.hora), 1, 5) as hora, f2.asamblea_celebrada, f2.motivo_cancelacion, f3.numero_ganador_2020, f3.nombre_ganador_2020, f3.numero_ganador_2021, f3.nombre_ganador_2021, f2.total_1, f2.mujeres_1, f2.hombres_1, f2.otros_1, f2.total_2, f2.mujeres_2, f2.hombres_2, f2.otros_2, f2.total_3, f2.mujeres_3, f2.hombres_3, f2.otros_3, f2.total_4, f2.mujeres_4, f2.hombres_4, f2.otros_4, f2.total_5, f2.mujeres_5, f2.hombres_5, f2.otros_5, f2.total_6, f2.mujeres_6, f2.hombres_6, f2.otros_6, f2.total_7, f2.mujeres_7, f2.hombres_7, f2.otros_7, f2.total_8, f2.mujeres_8, f2.hombres_8, f2.otros_8, f2.menor_16, f2.edad_16_17, f2.edad_18_29, f2.edad_30_39, f2.edad_40_49, f2.edad_50_59, f2.edad_60_mas, f2.elaboro, f2.observaciones FROM sireac_formato2 f2, cat_colonia col, cat_delegacion del, sireac_informacion_seleccion f3 WHERE f2.clave_colonia = col.clave_colonia AND f2.id_delegacion = del.id_delegacion AND f2.clave_colonia = f3.clave_territorial  AND  f3.clave_territorial = col.clave_colonia AND f3.demarcacion = del.id_delegacion ORDER BY f2.id_distrito, del.nombre_delegacion, col.nombre_colonia, f2.clave_colonia";

$query1 = sqlsrv_query($conn,$sql1);
echo '<table border = "1" height="100" align="center" style="font-family: Calibri Light;">
  <thead>
    <tr bgcolor="#FFD9C3">
      <th rowspan="2">No</th>
      <th rowspan="2">DISTRITO</th>
      <th rowspan="2">DEMARCACIÓN</th>
      <th rowspan="2">UNIDAD TERRITORIAL</th>
      <th rowspan="2">CLAVE</th>
      <th rowspan="2">LUGAR</th>
      <th rowspan="2">ASAMBLEA CONVOCADA</th>
      <th rowspan="2">FECHA EN LA QUE SE CELEBRARÁ LA ASAMBLEA</th>
      <th rowspan="2">HORA (formato 24 horas)</th>
      <th rowspan="2">ASAMBLEA CELEBRADA</th>
      <th rowspan="2">EN SU CASO, MOTIVO DE LA CANCELACIÓN</th>
      
      <th rowspan="2">No. PROYECTO GANADOR 2020</th>
      <th rowspan="2">NOMBRE PROYECTO GANADOR 2020</th>
      <th rowspan="2">No. PROYECTO GANADOR 2021</th>
      <th rowspan="2">NOMBRE PROYECTO GANADOR 2021</th>

      <th colspan="4">PERSONAS INTEGRANTES DE LA COMISIÓN DE PARTICIPACIÓN COMUNITARIA PRESENTES</th>

      <th colspan="4">PERSONAS HABITANTES CON CREDENCIAL DE ELECTOR PRESENTES</th>

      <th colspan="4">PERSONAS DE ENTRE 16 Y 17 AÑOS PRESENTES</th>

      <th colspan="4">PERSONAS HABITANTES MENORES DE EDAD PRESENTES</th> 

      <th colspan="4">PERSONAS FUNCIONARIAS PÚBLICAS PRESENTES</th>   
      
      <th colspan="4">PERSONAS CON INTERÉS DE CARÁCTER CONSULTIVO PRESENTES</th>   

      <th colspan="4">PERSONAS INTEGRANTES DE ORGANIZACIÓN CIUDADANA CON REGISTRO ANTE IECM</th>   

      <th colspan="4">PERSONAS OBSERVADORAS Y VISITANTES EXTRANJERAS</th>

      <th colspan="7">SUMAR EL NÚMERO DE PERSONAS POR RANGO DE EDAD Y CAPTURARLO EN LOS SIGUIENTES CAMPOS</th>
    </tr>
    <tr bgcolor="#FFD9C3">
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
      <th>TOTAL</th>

      <th>MENORES DE 16 </th>
      <th>16 A 17</th>
      <th>18 A 29</th>
      <th>30 A 39</th>
      <th>40 A 49</th>
      <th>50 A 59</th>
      <th>60 O MÁS</th>
    </tr>
  </thead>
  <tbody>';
  $cout = 1;
  while ($row = sqlsrv_fetch_array($query1)) {
    echo '<tr>
      <td>'. $cout .'</td>
      <td>'. $row['id_distrito'].'</td>
      <td>'. utf8_encode($row['nombre_delegacion']).'</td>
      <td>'. utf8_encode($row['nombre_colonia']).'</td>
      <td>'. $row['clave_colonia'].'</td>
      <td>'. utf8_encode($row['lugar']).'</td>
      <td>'. $row['asamblea_convocada'].'</td>
      <td>'. $row['fecha'].'</td>
      <td>'. $row['hora'].'</td>
      <td>'. $row['asamblea_celebrada'].'</td>
      <td>'. utf8_encode($row['motivo_cancelacion']).'</td>

      <td>'. $row['numero_ganador_2020'].'</td>
      <td>'. utf8_encode($row['nombre_ganador_2020']).'</td>
      <td>'. $row['numero_ganador_2021'].'</td>
      <td>'. utf8_encode($row['nombre_ganador_2021']).'</td>

      <td>'. $row['mujeres_1'].'</td>
      <td>'. $row['hombres_1'].'</td>
      <td>'. $row['otros_1'].'</td>
      <td>'. $row['total_1'].'</td>

      <td>'. $row['mujeres_2'].'</td>
      <td>'. $row['hombres_2'].'</td>
      <td>'. $row['otros_2'].'</td>
      <td>'. $row['total_2'].'</td>

      <td>'. $row['mujeres_3'].'</td>
      <td>'. $row['hombres_3'].'</td>
      <td>'. $row['otros_3'].'</td>
      <td>'. $row['total_3'].'</td>

      <td>'. $row['mujeres_4'].'</td>
      <td>'. $row['hombres_4'].'</td>
      <td>'. $row['otros_4'].'</td>
      <td>'. $row['total_4'].'</td>

      <td>'. $row['mujeres_5'].'</td>
      <td>'. $row['hombres_5'].'</td>
      <td>'. $row['otros_5'].'</td>
      <td>'. $row['total_5'].'</td>

      <td>'. $row['mujeres_6'].'</td>
      <td>'. $row['hombres_6'].'</td>
      <td>'. $row['otros_6'].'</td>
      <td>'. $row['total_6'].'</td>

      <td>'. $row['mujeres_7'].'</td>
      <td>'. $row['hombres_7'].'</td>
      <td>'. $row['otros_7'].'</td>
      <td>'. $row['total_7'].'</td>

      <td>'. $row['mujeres_8'].'</td>
      <td>'. $row['hombres_8'].'</td>
      <td>'. $row['otros_8'].'</td>
      <td>'. $row['total_8'].'</td>

      <td>'. $row['menor_16'].'</td>
      <td>'. $row['edad_16_17'].'</td>
      <td>'. $row['edad_18_29'].'</td>
      <td>'. $row['edad_30_39'].'</td>
      <td>'. $row['edad_40_49'].'</td>
      <td>'. $row['edad_50_59'].'</td>
      <td>'. $row['edad_60_mas'].'</td>
    </tr>';
    $cout++;
  }
echo '</tbody>
</table>';
?>
</body>
</html>
