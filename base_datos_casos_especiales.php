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
header("Content-Disposition: attachment; filename=Base_datos_casos_especiales.xls");
header("Pragma: no-cache");
header("Expires: 0");
header("Content-Type: text/html;charset=utf-8");
date_default_timezone_set('America/Mexico_City'); 
$sql ="SELECT proyecto_propuesto_1_2020, proyecto_propuesto_1_2021 from sireac_casos_especiales";
$qry = sqlsrv_query($conn, $sql);
$cantidad1 = 0;
$cantidad2 = 0;
 while($row = sqlsrv_fetch_array($qry)){
     $cantidad_entrante = count(json_decode($row['proyecto_propuesto_1_2020']));
    //  echo $cantidad_entrante;
     if ($cantidad_entrante > $cantidad1) {
         $cantidad1 = $cantidad_entrante;
     }
     $cantidad_entrante2 = count(json_decode($row['proyecto_propuesto_1_2021']));
    //  echo $cantidad_entrante2;
     if ($cantidad_entrante2 > $cantidad2) {
         $cantidad2 = $cantidad_entrante2;
     }
 };
// echo $cantidad1;
// echo '<br>'; 
// echo $cantidad2;

 $cantidad_proyecto_2020 = count($row['proyecto_propuesto_1_2020']);
 $cantidad_proyecto_2021 = count($row['proyecto_propuesto_1_2021']);

echo "<table border = '1' height='100' align='center' style='font-family: Calibri Light;'>";

    echo '<tr aling="center">
    <th bgcolor="#FCE4D6">No.<br></th>
    <th bgcolor="#FCE4D6">CLAVE<br></th>
    <th bgcolor="#FCE4D6">UNIDAD TERRITORIAL<br></th>
    <th bgcolor="#FCE4D6">DEMARCACIÓN<br></th>
    <th bgcolor="#FCE4D6"><br>DIRECCIÓN<br>DISTRITAL</th>
    <th bgcolor="#FCE4D6"><br>ASAMBLEA CONVOCADA<br>(SI/NO)</th>
    <th bgcolor="#FCE4D6"><br>FECHA EN LA QUE SE<br>CELEBRARA LA<br> ASAMBLEA</th>
    <th bgcolor="#FCE4D6"><br>ASAMBLEA CELEBRADA<br>(SI/NO)</th>
    <th bgcolor="#FCE4D6"><br>EMPATE EN 1er LUGAR<br>2020</th>
    <th bgcolor="#FCE4D6"><br>EMPATE EN 1er LUGAR<br>2021</th>
    <th bgcolor="#FCE4D6"><br>EMPATE EN 2do LUGAR<br>2020</th>
    <th bgcolor="#FCE4D6"><br>EMPATE EN 2do LUGAR<br>2021</th>
    <th bgcolor="#FCE4D6"><br>UT SIN JORNADA<br>2020</th>
    <th bgcolor="#FCE4D6"><br>UT SIN JORNADA<br>2021</th>
    <th bgcolor="#FCE4D6"><br>SIN PROYECTO EN 2DO LUGAR<br>PARA SUSTITUIR GANADOR<br>2021</th>
    <th bgcolor="#FCE4D6"><br>PROYECTO GANADOR 2020<br>(DESEMPATE EN 1er LUGAR)</th>
    <th bgcolor="#FCE4D6"><br>PROYECTO GANADOR 2021<br>(DESEMPATE EN 1er LUGAR)</th>
    <th bgcolor="#FCE4D6"><br>PROYECTO GANADOR 2020<br>(DESEMPATE EN 2do LUGAR)</th>
    <th bgcolor="#FCE4D6"><br>PROYECTO GANADOR 2021<br>(DESEMPATE EN 2do LUGAR)</th>
    ';
    for ($i=1; $i <= $cantidad1; $i++) { 
       echo '<th bgcolor="#FCE4D6"><br>PROYECTO PROPUESTO<br>2020<br>No.'.$i.'</th>';
    } 
    for ($i=1; $i <= $cantidad2; $i++) { 
        echo '<th bgcolor="#FCE4D6"><br>PROYECTO PROPUESTO<br>2021<br>No.'.$i.'</th>';
     } 
     echo '<th bgcolor="#FCE4D6"><br>OBSERVACIONES<br></th>
     </tr>
    
    ';
    $sql = "SELECT id, clave_territorial, t.nombre_colonia as nombre_colonia, demarcacion, distrito, asamblea_convocada, fecha, asamblea_celebrada, empate_primer_lugar_2020, empate_segundo_lugar_2020,
    empate_primer_lugar_2021, empate_segundo_lugar_2021, ut_sin_jornada_2020, ut_sin_jornada_2021, segundo_lugar_2021, proyecto_ganador_2020, proyecto_ganador_2021,
    proyecto_segundo_2020, proyecto_segundo_2021, proyecto_propuesto_1_2020, proyecto_propuesto_1_2021,d.observaciones from sireac_casos_especiales as d, cat_colonia as t where d.clave_territorial = t.clave_colonia order by id";
    $qry = sqlsrv_query($conn, $sql);
    while($row = sqlsrv_fetch_array($qry)){
        echo '
        <tr align="center">
            <td>'.$row['id'].'</td>
            <td>'.utf8_encode($row['clave_territorial']).'</td>
            <td>'.utf8_encode($row['nombre_colonia']).'</td>
            <td>'.$row['demarcacion'].'</td>
            <td>'.$row['distrito'].'</td>
            <td>'.$row['asamblea_convocada'].'</td>
            <td>'.$row['fecha'].'</td>
            <td>'.$row['asamblea_celebrada'].'</td>
            <td>'.$row['empate_primer_lugar_2020'].'</td>
            <td>'.$row['empate_primer_lugar_2021'].'</td>
            <td>'.$row['empate_segundo_lugar_2020'].'</td>
            <td>'.$row['empate_segundo_lugar_2021'].'</td>
            <td>'.$row['ut_sin_jornada_2020'].'</td>
            <td>'.$row['ut_sin_jornada_2021'].'</td>
            <td>'.$row['segundo_lugar_2021'].'</td>
            <td>'.utf8_encode($row['proyecto_ganador_2020']).'</td>
            <td>'.utf8_encode($row['proyecto_ganador_2021']).'</td>
            <td>'.utf8_encode($row['proyecto_segundo_2020']).'</td>
            <td>'.utf8_encode($row['proyecto_segundo_2021']).'</td>
            ';
            $proyecto_propuesto_1 = json_decode(utf8_encode($row['proyecto_propuesto_1_2020']));
            $proyecto_propuesto_2 = json_decode(utf8_encode($row['proyecto_propuesto_1_2021']));

            // foreach((array)$proyecto_propuesto_1 as $key => $value) {
            //     for ($i=0; $i < $cantidad1; $i++) { 
            //        if()
            //     }
               
            // }
            
                for ($i=0; $i < $cantidad1; $i++) { 
                    
                    if (isset($proyecto_propuesto_1[$i])) {
                        echo '<td>'.$proyecto_propuesto_1[$i].'</td>';
                    }
                    else{
                        echo '<td></td>';
                    }
                
                
            }
            // foreach((array)$proyecto_propuesto_2 as  $value) {
                
            //    echo '<td>'.$value.'</td>';
            // }
           
                for ($i=0; $i < $cantidad2; $i++) { 
                   
                    if (isset($proyecto_propuesto_2[$i])) {
                        echo '<td>'.$proyecto_propuesto_2[$i].'</td>';
                    }
                    else{
                        echo '<td></td>';
                    }
                
                
            }
            echo '
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
