<?php 
$URL = "https://aplicaciones.iecm.mx/sedicop/registro_asambleas/img/";

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <!-- <meta charset="utf-8"> -->
  <title>Documento sin título</title>

</head>
<body>
<?php
include 'php/sqlconnector.php';
session_start();
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=Base_datos_informacion_seleccion.xls");
header("Pragma: no-cache");
header("Expires: 0");
header("Content-Type: text/html;charset=utf-8");
date_default_timezone_set('America/Mexico_City'); 

$sql = "SELECT id, clave_territorial, t.nombre_colonia as nombre_colonia, demarcacion, distrito, numero_ganador_2020, nombre_ganador_2020, numero_ganador_2021, nombre_ganador_2021,
asamblea_convocada, fecha, asamblea_celebrada, comite_ejecucion_2020, comite_vigilancia_2020, comite_ejecucion_2021, comite_vigilancia_2021, d.observaciones as observaciones
from sireac_informacion_seleccion as d, cat_colonia as t where d.clave_territorial = t.clave_colonia order by distrito";
 $qry = sqlsrv_query($conn, $sql);
echo "<table border = '1' height='100' align='center' style='font-family: Calibri Light;'>";

    echo '<tr aling="center">
    <th bgcolor="#FCE4D6">No.<br></th>
    <th bgcolor="#FCE4D6">CLAVE<br></th>
    <th bgcolor="#FCE4D6">UNIDAD TERRITORIAL<br></th>
    <th bgcolor="#FCE4D6">DEMARCACIÓN<br></th>
    <th bgcolor="#FCE4D6"><br>DIRECCIÓN<br>DISTRITAL</th>
    <th bgcolor="#FCE4D6"><br>NO. PROYECTO<br>GANADOR 2020</th>
    <th bgcolor="#FCE4D6">NOMBRE PROYECTO GANADOR 2020</th>
    <th bgcolor="#FCE4D6"><br>NO. PROYECTO<br>GANADOR 2021</th>
    <th bgcolor="#FCE4D6">NOMBRE PROYECTO GANADOR 2021</th>
    <th bgcolor="#FCE4D6"><br>ASAMBLEA CONVOCADA<br>(SI/NO)</th>
    <th bgcolor="#FCE4D6"><br>FECHA EN LA QUE SE<br>CELEBRARA LA ASAMBLEA</th>
    <th bgcolor="#FCE4D6"><br>ASAMBLEA CELEBRADA<br>(SI/NO)</th>
    <th bgcolor="#FCE4D6">COMITÉ EJECUCIÓN 2020<br>CONFORMADO<br>(SI/NO)</th>
    <th bgcolor="#FCE4D6">COMITÉ VIGILANCIA 2020<br>CONFORMADO<br>(SI/NO)</th>
    <th bgcolor="#FCE4D6">COMITÉ EJECUCIÓN 2021<br>CONFORMADO<br>(SI/NO)</th>
    <th bgcolor="#FCE4D6">COMITÉ VIGILANCIA 2021<br>CONFORMADO<br>(SI/NO)</th>
    <th bgcolor="#FCE4D6"><br>OBSERVACIONES<br></th>
    </tr>
    
    ';
    while($row = sqlsrv_fetch_array($qry)){
        echo '

        <tr align="center">
            <td>'.$row['id'].'</td>
            <td>'.utf8_encode($row['clave_territorial']).'</td>
            <td>'.utf8_encode($row['nombre_colonia']).'</td>
            <td>'.$row['demarcacion'].'</td>
            <td>'.$row['distrito'].'</td>
            <td>'.$row['numero_ganador_2020'].'</td>
            <td>'.utf8_encode($row['nombre_ganador_2020']).'</td>
            <td>'.$row['numero_ganador_2021'].'</td>
            <td>'.utf8_encode($row['nombre_ganador_2021']).'</td>
            <td>'.$row['asamblea_convocada'].'</td>
            <td>'.$row['fecha'].'</td>
            <td>'.$row['asamblea_celebrada'].'</td>
            <td>'.$row['comite_ejecucion_2020'].'</td>
            <td>'.$row['comite_vigilancia_2020'].'</td>
            <td>'.$row['comite_ejecucion_2021'].'</td>
            <td>'.$row['comite_vigilancia_2020'].'</td>
            <td>'.utf8_encode($row['observaciones']).'</td>
        </tr>
        
        ';
    }
echo "</table>";
echo '<br><br><br>';

echo "<td colspan='1' align='center'>Fecha de corte:".date('d/m/Y')."</td>";

?>
</body>
</html>
