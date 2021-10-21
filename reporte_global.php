<?php 
$URL = "https://aplicaciones.iecm.mx/sedicop/registro_asambleas/img/";
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
header("Content-Disposition: attachment; filename=Reporte_global_CDMX.xls");
header("Pragma: no-cache");
header("Expires: 0");
header("Content-Type: text/html;charset=utf-8");
date_default_timezone_set('America/Mexico_City'); 
echo "<table border=0 width='50' style='font-family: Calibri Light;'> ";
echo "";
echo "<tr height='20px'><th><img src='".$URL."header20_1.png' width='150' height='100' alt='Logo IECM 20 AÑOS' ></th></tr>"; 
echo '<br><br>';
echo "<tr><th colspan='12'style ='color:#6847A3;'><font style='font-size: 20px; align:center;'>REPORTE AVANCE EN CELEBRACION DE ASAMBLEAS <br> CIUDAD DE MÉXICO</font></th></tr>";
echo "<tr height='20px'><th></th></tr>"; 
echo "<tr></tr>";
echo "<tr></tr>";
echo"<tr><th colspan='10' align='right'>Fecha de corte: ".date('d/m/Y')."</th></tr>";
echo "</table>";
echo '<br>';

echo '<br></br>';

$sql = "SELECT nombre_delegacion,count(t.clave_territorial) as cantidad,
 sum(case when t.asamblea_celebrada = 'SI' then 1 else 0 end) as celebrada,
  sum( case when t.asamblea_convocada = 'SI' then 1 else 0 end) as convocada 
  from cat_delegacion as d, sireac_casos_especiales as t where d.id_delegacion = t.demarcacion
   group by nombre_delegacion order by nombre_delegacion";
 $qry = sqlsrv_query($conn, $sql);

echo "<table width='100%' align='center' style='font-family: Calibri Light;'>";
  
    echo '<th colspan= "8" bgcolor="#B695D7" align="center">ASAMBLEAS CIUDADANAS DE CASOS ESPECIALES</th>';
    echo '<tr bgcolor="#B695D7"><th colspan="3" align="center">Demarcación</th><th>Asamblea de Casos<br>Especiales a celebrar</th><th colspan="2">Asambleas Convocadas</th><th colspan="2">Asambleas Celebradas</th></tr>';
    echo '<tr>';
    $total = 0;
    $totalconvocada = 0;
    $totalcelebrada = 0;
            while($row = sqlsrv_fetch_array($qry)){
                $porcentaje1 = round($row['celebrada']/$row['cantidad']*100);
                $porcentaje2 = round($row['convocada']/$row['cantidad']*100);
                echo '
                <td bgcolor="#D9C8EA" colspan= "3" align="center">'.utf8_encode($row['nombre_delegacion']).'</td>
                <td bgcolor="#D9C8EA" align="center">'.$row['cantidad'].'</td> 
                <td bgcolor="#D9C8EA" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$row['convocada'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td bgcolor="#D9C8EA" align="center">'.$porcentaje1.'%</td>
                <td bgcolor="#D9C8EA" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$row['celebrada'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td bgcolor="#D9C8EA" align="center">'.$porcentaje2.'%</td>';
                $total += $row['cantidad']; 
                $totalconvocada += $row['convocada'];
                $totalcelebrada += $row['celebrada'];
                echo '</tr>';
            }

    $porcentajeconvocada = round($totalconvocada / $total *100);
    $porcentajecelebrada = round($totalcelebrada / $total * 100);
    echo '<td bgcolor="#B695D7" colspan = "3" align="center">Total</td>';
    echo '<td bgcolor="#B695D7"  align="center">'.$total.'</td>';
    echo '<td bgcolor="#B695D7"  align="center">'.$totalconvocada.'</td>';
    echo '<td bgcolor="#B695D7"  align="center">'.$porcentajeconvocada.'%</td>';
    echo '<td bgcolor="#B695D7"  align="center">'.$totalcelebrada.'</td>';
    echo '<td bgcolor="#B695D7"  align="center">'.$porcentajecelebrada.'%</td>';
    

echo "</table>";

echo '<br>';

$sql = "SELECT id_distrito,count(t.clave_territorial) as cantidad,
 sum(case when t.asamblea_celebrada = 'SI' then 1 else 0 end) as celebrada,
  sum( case when t.asamblea_convocada = 'SI' then 1 else 0 end) as convocada
   from cat_distrito as d, sireac_casos_especiales as t where d.id_delegacion = t.demarcacion
    group by id_distrito order by id_distrito";
 $qry = sqlsrv_query($conn, $sql);

echo "<table width='100%' align='center' style='font-family: Calibri Light;'>";
  
  
    echo '<tr bgcolor="#B695D7"><th colspan="1" align="center">Dirección<br>Distrital</th><th>Asamblea de Casos<br>Especiales a celebrar</th><th colspan="2">Asambleas Convocadas</th><th colspan="2">Asambleas Celebradas</th></tr>';
    echo '<tr>';
    $total = 0;
    $totalconvocada = 0;
    $totalcelebrada = 0;
            while($row = sqlsrv_fetch_array($qry)){
                $porcentaje1 = round($row['celebrada']/$row['cantidad']*100);
                $porcentaje2 = round($row['convocada']/$row['cantidad']*100);
                echo '
                <td bgcolor="#D9C8EA" colspan= "1" align="center">'.utf8_encode($row['id_distrito']).'</td>
                <td bgcolor="#D9C8EA" align="center">'.$row['cantidad'].'</td> 
                <td bgcolor="#D9C8EA" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$row['convocada'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td bgcolor="#D9C8EA" align="center">'.$porcentaje1.'%</td>
                <td bgcolor="#D9C8EA" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$row['celebrada'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td bgcolor="#D9C8EA" align="center">'.$porcentaje2.'%</td>';
                $total += $row['cantidad']; 
                $totalconvocada += $row['convocada'];
                $totalcelebrada += $row['celebrada'];
                echo '</tr>';
            }

    $porcentajeconvocada = round($totalconvocada / $total *100);
    $porcentajecelebrada = round($totalcelebrada / $total * 100);
    echo '<td bgcolor="#B695D7" colspan = "1" align="center">Total</td>';
    echo '<td bgcolor="#B695D7"  align="center">'.$total.'</td>';
    echo '<td bgcolor="#B695D7"  align="center">'.$totalconvocada.'</td>';
    echo '<td bgcolor="#B695D7"  align="center">'.$porcentajeconvocada.'%</td>';
    echo '<td bgcolor="#B695D7"  align="center">'.$totalcelebrada.'</td>';
    echo '<td bgcolor="#B695D7"  align="center">'.$porcentajecelebrada.'%</td>';
    

echo "</table>";
echo "<br>";

$sql = "SELECT nombre_delegacion,count(t.clave_territorial) as cantidad,
 sum(case when t.asamblea_celebrada = 'SI' then 1 else 0 end) as celebrada,
  sum( case when t.asamblea_convocada = 'SI' then 1 else 0 end) as convocada
   from cat_delegacion as d, sireac_informacion_seleccion as t where d.id_delegacion = t.demarcacion
    group by nombre_delegacion order by nombre_delegacion";
 $qry = sqlsrv_query($conn, $sql);

echo "<table width='100%' align='center' style='font-family: Calibri Light;'>";
  
    echo '<th colspan= "8" bgcolor="#FCE4D6" align="center">ASAMBLEAS CIUDADANAS DE INFORMACIÓN Y SELECCIÓN</th>';
    echo '<tr bgcolor="#FCE4D6"><th colspan="3" align="center">Demarcación</th><th>Unidades Territoriales</th><th colspan="2">Asambleas Convocadas</th><th colspan="2">Asambleas Celebradas</th></tr>';
    echo '<tr>';
    $total = 0;
    $totalconvocada = 0;
    $totalcelebrada = 0;
            while($row = sqlsrv_fetch_array($qry)){
                $porcentaje1 = round($row['celebrada']/$row['cantidad']*100);
                $porcentaje2 = round($row['convocada']/$row['cantidad']*100);
                echo '
                <td bgcolor="#FDF0E9" colspan= "3" align="center">'.utf8_encode($row['nombre_delegacion']).'</td>
                <td bgcolor="#FDF0E9" align="center">'.$row['cantidad'].'</td> 
                <td bgcolor="#FDF0E9" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$row['convocada'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td bgcolor="#FDF0E9" align="center">'.$porcentaje1.'%</td>
                <td bgcolor="#FDF0E9" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$row['celebrada'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td bgcolor="#FDF0E9" align="center">'.$porcentaje2.'%</td>';
                $total += $row['cantidad']; 
                $totalconvocada += $row['convocada'];
                $totalcelebrada += $row['celebrada'];
                echo '</tr>';
            }

    $porcentajeconvocada = round($totalconvocada / $total *100);
    $porcentajecelebrada = round($totalcelebrada / $total * 100);
    echo '<td bgcolor="#FCE4D6" colspan = "3" align="center">Total</td>';
    echo '<td bgcolor="#FCE4D6"  align="center">'.$total.'</td>';
    echo '<td bgcolor="#FCE4D6"  align="center">'.$totalconvocada.'</td>';
    echo '<td bgcolor="#FCE4D6"  align="center">'.$porcentajeconvocada.'%</td>';
    echo '<td bgcolor="#FCE4D6"  align="center">'.$totalcelebrada.'</td>';
    echo '<td bgcolor="#FCE4D6"  align="center">'.$porcentajecelebrada.'%</td>';
    

echo "</table>";
echo '<br>';

$sql = "SELECT id_distrito, count(t.clave_territorial) as cantidad,
sum(case when t.asamblea_celebrada = 'SI' then 1 else 0 end) as celebrada,
 sum( case when t.asamblea_convocada = 'SI' then 1 else 0 end) as convocada
  from cat_distrito as d, sireac_informacion_seleccion as t 
  where d.id_distrito = t.distrito group by id_distrito order by id_distrito";
 $qry = sqlsrv_query($conn, $sql);

echo "<table width='100%' align='center' style='font-family: Calibri Light;'>";
  
 
    echo '<tr bgcolor="#FCE4D6"><th colspan="1" align="center">Dirección<br>Distrital</th><th>Asamblea de Casos<br>Especiales a celebrar</th><th colspan="2">Asambleas Convocadas</th><th colspan="2">Asambleas Celebradas</th></tr>';
    echo '<tr>';
    $total = 0;
    $totalconvocada = 0;
    $totalcelebrada = 0;
            while($row = sqlsrv_fetch_array($qry)){
                $porcentaje1 = round($row['celebrada']/$row['cantidad']*100);
                $porcentaje2 = round($row['convocada']/$row['cantidad']*100);
                echo '
                <td bgcolor="#FDF0E9" colspan= "1" align="center">'.utf8_encode($row['id_distrito']).'</td>
                <td bgcolor="#FDF0E9" align="center">'.$row['cantidad'].'</td> 
                <td bgcolor="#FDF0E9" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$row['convocada'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td bgcolor="#FDF0E9" align="center">'.$porcentaje1.'%</td>
                <td bgcolor="#FDF0E9" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$row['celebrada'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td bgcolor="#FDF0E9" align="center">'.$porcentaje2.'%</td>';
                $total += $row['cantidad']; 
                $totalconvocada += $row['convocada'];
                $totalcelebrada += $row['celebrada'];
                echo '</tr>';
            }

    $porcentajeconvocada = round($totalconvocada / $total *100);
    $porcentajecelebrada = round($totalcelebrada / $total * 100);
    echo '<td bgcolor="#FCE4D6" colspan = "1" align="center">Total</td>';
    echo '<td bgcolor="#FCE4D6"  align="center">'.$total.'</td>';
    echo '<td bgcolor="#FCE4D6"  align="center">'.$totalconvocada.'</td>';
    echo '<td bgcolor="#FCE4D6"  align="center">'.$porcentajeconvocada.'%</td>';
    echo '<td bgcolor="#FCE4D6"  align="center">'.$totalcelebrada.'</td>';
    echo '<td bgcolor="#FCE4D6"  align="center">'.$porcentajecelebrada.'%</td>';
    

echo "</table>";
echo "<br><br>";
echo "<br>";

$sql = "SELECT nombre_delegacion,count(t.clave_territorial) as cantidad,
 sum(case when comite_ejecucion_2020 = 'SI' then 1 else 0 end) as comite_ejecucion_2020,
  sum(case when comite_vigilancia_2020 = 'SI' then 1 else 0 end) as comite_vigilancia_2020,
   sum(case when comite_ejecucion_2021 = 'SI' then 1 else 0 end) as comite_ejecucion_2021,
    sum(case when comite_vigilancia_2021 = 'SI' then 1 else 0 end) as comite_vigilancia_2021
     from cat_delegacion as d, sireac_informacion_seleccion as t where d.id_delegacion = t.demarcacion
      group by nombre_delegacion order by nombre_delegacion";
 $qry = sqlsrv_query($conn, $sql);

echo "<table width='100%' align='center' style='font-family: Calibri Light;'>";
  
    echo '<th colspan= "13" bgcolor="#C5FFFF" align="center">COMITÉS CONFORMADOS</th>';
    echo '<tr bgcolor="#C5FFFF"><th colspan="2" align="center">Demarcación Territorial</th><th align="center">Unidades<br>Territoriales</th><th align="center" colspan="2">Ejecución 2020</th><th align="center" colspan="2">Vigilancia 2020</th><th align="center" colspan="2">Ejecución 2021</th><th align="center" colspan="2">Vigilancia 2021</th><th align="center" colspan="2">Total </th></tr>';
    echo '<tr>';
    $total = 0;
    $total_general = 0;
    $total_ejecucion_2020 = 0;
    $total_vigilancia_2020 = 0;
    $total_ejecucion_2021 = 0;
    $total_vigilancia_2021 = 0;
    $total_total = 0;
    // $total
            while($row = sqlsrv_fetch_array($qry)){
                $porcentaje1 = round($row['comite_ejecucion_2020']/$row['cantidad']*100);
                $porcentaje2 = round($row['comite_vigilancia_2020']/$row['cantidad']*100);
                $porcentaje3 = round($row['comite_ejecucion_2021']/$row['cantidad']*100);
                $porcentaje4 = round($row['comite_vigilancia_2021']/$row['cantidad']*100);
                // $porcentaje5 = round($row['']/$row['cantidad']*100);

                echo '
                <td bgcolor="#E7FFFF" colspan= "2" align="center">'.utf8_encode($row['nombre_delegacion']).'</td>
                <td bgcolor="#E7FFFF" align="center">'.$row['cantidad'].'</td> 
                <td bgcolor="#E7FFFF" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$row['comite_ejecucion_2020'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td bgcolor="#E7FFFF" align="center">'.$porcentaje1.'%</td>
                <td bgcolor="#E7FFFF" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$row['comite_vigilancia_2020'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td bgcolor="#E7FFFF" align="center">'.$porcentaje2.'%</td>
                <td bgcolor="#E7FFFF" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$row['comite_ejecucion_2021'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td bgcolor="#E7FFFF" align="center">'.$porcentaje3.'%</td>
                <td bgcolor="#E7FFFF" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$row['comite_vigilancia_2021'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td bgcolor="#E7FFFF" align="center">'.$porcentaje4.'%</td>';
                $total = $row['comite_ejecucion_2020'] + $row['comite_ejecucion_2021'] + $row['comite_vigilancia_2020'] + $row['comite_vigilancia_2021']; 
                echo '<td bgcolor="#E7FFFF" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$total.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
               $porcentaje = ($total / ($row['cantidad']*4)*100);
               echo '<td bgcolor="#E7FFFF" align="center">'.$porcentaje.'%</td>';
               $total_general += $row['cantidad'];
                $total_ejecucion_2020 += $row['comite_ejecucion_2020'];
                $total_vigilancia_2020 += $row['comite_vigilancia_2020'];
                $total_ejecucion_2021 += $row['comite_ejecucion_2021'];
                $total_vigilancia_2021 += $row['comite_vigilancia_2021'];
                $total_total += $total;

                echo '</tr>';
            }

   $porcentaje_ejecucion_2020 = (($total_ejecucion_2020 / $total_general) * 100);
   $porcentaje_vigilancia_2020 = (($total_vigilancia_2020 / $total_general) * 100);
   $porcentaje_ejecucion_2021 = (($total_ejecucion_2021 / $total_general) * 100);
   $porcentaje_vigilancia_2021 = (($total_vigilancia_2021 / $total_general) * 100);
   $porcentaje_total = (($total_total / (($total_general)*4)) * 100);
    echo '<td bgcolor="#C5FFFF" colspan = "2" align="center">Total</td>';
    echo '<td bgcolor="#C5FFFF"  align="center">'.$total_general.'</td>';
    echo '<td bgcolor="#C5FFFF"  align="center">'.$total_ejecucion_2020.'</td>';
    echo '<td bgcolor="#C5FFFF"  align="center">'.$porcentaje_ejecucion_2020.'%</td>';
    echo '<td bgcolor="#C5FFFF"  align="center">'.$total_vigilancia_2020.'</td>';
    echo '<td bgcolor="#C5FFFF"  align="center">'.$porcentaje_vigilancia_2020.'%</td>';
    echo '<td bgcolor="#C5FFFF"  align="center">'.$total_ejecucion_2021.'</td>';
    echo '<td bgcolor="#C5FFFF"  align="center">'.$porcentaje_ejecucion_2021.'%</td>';
    echo '<td bgcolor="#C5FFFF"  align="center">'.$total_vigilancia_2021.'</td>';
    echo '<td bgcolor="#C5FFFF"  align="center">'.$porcentaje_vigilancia_2021.'%</td>';
    echo '<td bgcolor="#C5FFFF"  align="center">'.$total_total.'</td>';
    echo '<td bgcolor="#C5FFFF"  align="center">'.$porcentaje_total.'%</td>';

    

echo "</table>";
echo "<br><br>";
echo "<br>";

$sql = "SELECT id_distrito,count(t.clave_territorial) as cantidad,
 sum(case when comite_ejecucion_2020 = 'SI' then 1 else 0 end) as comite_ejecucion_2020,
  sum(case when comite_vigilancia_2020 = 'SI' then 1 else 0 end) as comite_vigilancia_2020,
   sum(case when comite_ejecucion_2021 = 'SI' then 1 else 0 end) as comite_ejecucion_2021,
    sum(case when comite_vigilancia_2021 = 'SI' then 1 else 0 end) as comite_vigilancia_2021
     from cat_distrito as d, sireac_informacion_seleccion as t where d.id_distrito = t.distrito
      group by id_distrito order by id_distrito";
 $qry = sqlsrv_query($conn, $sql);

echo "<table width='100%' align='center' style='font-family: Calibri Light;'>";
  
    echo '<tr bgcolor="#C5FFFF"><th colspan="2" align="center">Direccion Distrital</th><th align="center">Unidades<br>Territoriales</th><th align="center" colspan="2">Ejecución 2020</th><th align="center" colspan="2">Vigilancia 2020</th><th align="center" colspan="2">Ejecución 2021</th><th align="center" colspan="2">Vigilancia 2021</th><th align="center" colspan="2">Total </th></tr>';
    echo '<tr>';
    $total = 0;
    $total_general = 0;
    $total_ejecucion_2020 = 0;
    $total_vigilancia_2020 = 0;
    $total_ejecucion_2021 = 0;
    $total_vigilancia_2021 = 0;
    $total_total = 0;
    // $total
            while($row = sqlsrv_fetch_array($qry)){
                $porcentaje1 = round($row['comite_ejecucion_2020']/$row['cantidad']*100);
                $porcentaje2 = round($row['comite_vigilancia_2020']/$row['cantidad']*100);
                $porcentaje3 = round($row['comite_ejecucion_2021']/$row['cantidad']*100);
                $porcentaje4 = round($row['comite_vigilancia_2021']/$row['cantidad']*100);
                // $porcentaje5 = round($row['']/$row['cantidad']*100);

                echo '
                <td bgcolor="#E7FFFF" colspan= "2" align="center">'.utf8_encode($row['id_distrito']).'</td>
                <td bgcolor="#E7FFFF" align="center">'.$row['cantidad'].'</td> 
                <td bgcolor="#E7FFFF" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$row['comite_ejecucion_2020'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td bgcolor="#E7FFFF" align="center">'.$porcentaje1.'%</td>
                <td bgcolor="#E7FFFF" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$row['comite_vigilancia_2020'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td bgcolor="#E7FFFF" align="center">'.$porcentaje2.'%</td>
                <td bgcolor="#E7FFFF" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$row['comite_ejecucion_2021'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td bgcolor="#E7FFFF" align="center">'.$porcentaje3.'%</td>
                <td bgcolor="#E7FFFF" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$row['comite_vigilancia_2021'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td bgcolor="#E7FFFF" align="center">'.$porcentaje4.'%</td>';
                $total = $row['comite_ejecucion_2020'] + $row['comite_ejecucion_2021'] + $row['comite_vigilancia_2020'] + $row['comite_vigilancia_2021']; 
                echo '<td bgcolor="#E7FFFF" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$total.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
               $porcentaje = ($total / ($row['cantidad']*4)*100);
               echo '<td bgcolor="#E7FFFF" align="center">'.$porcentaje.'%</td>';
               $total_general += $row['cantidad'];
                $total_ejecucion_2020 += $row['comite_ejecucion_2020'];
                $total_vigilancia_2020 += $row['comite_vigilancia_2020'];
                $total_ejecucion_2021 += $row['comite_ejecucion_2021'];
                $total_vigilancia_2021 += $row['comite_vigilancia_2021'];
                $total_total += $total;

                echo '</tr>';
            }

   $porcentaje_ejecucion_2020 = (($total_ejecucion_2020 / $total_general) * 100);
   $porcentaje_vigilancia_2020 = (($total_vigilancia_2020 / $total_general) * 100);
   $porcentaje_ejecucion_2021 = (($total_ejecucion_2021 / $total_general) * 100);
   $porcentaje_vigilancia_2021 = (($total_vigilancia_2021 / $total_general) * 100);
   $porcentaje_total = (($total_total / (($total_general)*4)) * 100);
    echo '<td bgcolor="#C5FFFF" colspan = "2" align="center">Total</td>';
    echo '<td bgcolor="#C5FFFF"  align="center">'.$total_general.'</td>';
    echo '<td bgcolor="#C5FFFF"  align="center">'.$total_ejecucion_2020.'</td>';
    echo '<td bgcolor="#C5FFFF"  align="center">'.$porcentaje_ejecucion_2020.'%</td>';
    echo '<td bgcolor="#C5FFFF"  align="center">'.$total_vigilancia_2020.'</td>';
    echo '<td bgcolor="#C5FFFF"  align="center">'.$porcentaje_vigilancia_2020.'%</td>';
    echo '<td bgcolor="#C5FFFF"  align="center">'.$total_ejecucion_2021.'</td>';
    echo '<td bgcolor="#C5FFFF"  align="center">'.$porcentaje_ejecucion_2021.'%</td>';
    echo '<td bgcolor="#C5FFFF"  align="center">'.$total_vigilancia_2021.'</td>';
    echo '<td bgcolor="#C5FFFF"  align="center">'.$porcentaje_vigilancia_2021.'%</td>';
    echo '<td bgcolor="#C5FFFF"  align="center">'.$total_total.'</td>';
    echo '<td bgcolor="#C5FFFF"  align="center">'.$porcentaje_total.'%</td>';

    

echo "</table>";


?>
</body>
</html>
