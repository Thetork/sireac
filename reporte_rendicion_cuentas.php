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
include 'php/function.php';
session_start();
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=Reporte_Rendicion_Cuentas.xls");
header("Pragma: no-cache");
header("Expires: 0");
header("Content-Type: text/html;charset=utf-8");
date_default_timezone_set('America/Mexico_City'); 
echo "<table border=0 width='50' style='font-family: Calibri Light;'> ";
echo "<tr><th colspan='14'style ='color:#6847A3;'><font style='font-size: 20px; align:center;'>REPORTE DE ASAMBLEAS CIUDADANAS DE EVALUACIÓN Y RENDICIÓN DE CUENTAS</font></th></tr>";
echo "<tr height='20px'><th></th></tr>"; 
$sql1 = "SELECT (select count(id_distrito) as cantidad from sireac_formato2 where asamblea_cancelada = 2) as cantidad, (SELECT count(asamblea_celebrada) as forma from sireac_formato2 where asamblea_cancelada = 2 AND asamblea_celebrada = 'SI') AS celebrada";
$query1 = sqlsrv_query($conn,$sql1);
$row1 = sqlsrv_fetch_array($query1);
$cantidad = $row1['cantidad'];
$celebrada = $row1['celebrada'];

 
echo "<td bgcolor='#B29FD5'>Asambleas<br> Convocadas</td>
    <td colspan='1' align='center' bgcolor='#B5B5BF'>".$cantidad."</td>
    <td colspan='2'></td>
    <td bgcolor='#B29FD5'>Asambleas<br> Celebradas</td>
    <td colspan='1' align='center' bgcolor='#B5B5BF'>".$celebrada."</td>
    
    ";
echo "</table>";

echo '<br><br>';


// $sql = "SELECT del.id_delegacion,nombre_delegacion, count(id_distrito) as cantidad from sireac_formato3 as form1, cat_delegacion as del
// where form1.id_delegacion = del.id_delegacion
// group by del.id_delegacion, nombre_delegacion 
// union 
// select id_delegacion,nombre_delegacion, cantidad = ''  from cat_delegacion  group by id_delegacion,nombre_delegacion order by nombre_delegacion, cantidad desc";


$sql = "SELECT t.id_delegacion,t.nombre_delegacion, count(clave_colonia) as cantidad from cat_colonia as d,
cat_delegacion as t where d.id_delegacion = t.id_delegacion group by t.nombre_delegacion, t.id_delegacion order by nombre_delegacion";
 $qry = sqlsrv_query($conn, $sql);

 echo "<table border = '1' height='100' align='center' style='font-family: Calibri Light;'>";
 echo '<th colspan= "6" bgcolor="#B29FD5" align="center">Asambleas reportadas por demarcación territorial</th>';
  echo '<tr bgcolor="#B29FD5">
  <th align="center" rowspan="2"><br>DEMARCACIONES<br></th>
    <th rowspan="2"><br>UNIDADES<br> TERRITORIALES<br></th>
    <th colspan="2"><br>ASAMBLEAS<br> CONVOCADAS<br></th>
    <th colspan="2"><br>ASAMBLEAS<br> CELEBRADAS<br></th>
    <tr align="center" bgcolor="#B29FD5">
    <th>No.</th>
    <th>%</th>
    <th>No.</th>
    <th>%</th>
    </tr>
  </tr>';

  echo '<tr>';
  while($row = sqlsrv_fetch_array($qry)){
      $id_delegacion = $row['id_delegacion'];

      $cantidad = $del[$id_delegacion];
    $sql2 = "SELECT count(id_delegacion) as convocadas, ( select count(asamblea_celebrada) as forma from sireac_formato2 where asamblea_cancelada = 2 and asamblea_celebrada = 'SI' and id_delegacion = '$id_delegacion') as celebradas from sireac_formato2 where asamblea_cancelada = 2 and id_delegacion  = '$id_delegacion'";
     $qry2 = sqlsrv_query($conn, $sql2);
     $row2 = sqlsrv_fetch_array($qry2);
     $porcentaje1 = round(($row2['convocadas'] / $cantidad * 100),2);
     $porcentaje2 = round(($row2['celebradas'] / $cantidad * 100),2);

  echo '
  <td style="text-align: center;">'.utf8_encode($row['nombre_delegacion']).'</td>
  <td style="text-align: center;">'.$cantidad.'</td>
  <td style="text-align: center;">'.$row2['convocadas'].'</td>
  <td style="text-align: center;">'.$porcentaje1.'%</td>
  <td style="text-align: center;">'.$row2['celebradas'].'</td>
  <td style="text-align: center;">'.$porcentaje2.'%</td>
  </tr>';
  }
echo "</table>";

echo '<br></br>';

$sql = "SELECT id_distrito, count(clave_colonia) as cantidad from cat_colonia group by id_distrito order by id_distrito";
 $qry = sqlsrv_query($conn, $sql);

 echo "<table border = '1' height='100' align='center' style='font-family: Calibri Light;'>";
 echo '<th colspan= "6" bgcolor="#B29FD5" align="center">Asambleas reportadas por dirección distrital</th>';
  echo '<tr bgcolor="#B29FD5">
  <th align="center" rowspan="2"><br>DD<br></th>
    <th rowspan="2"><br>UNIDADES<br> TERRITORIALES<br></th>
    <th colspan="2"><br>ASAMBLEAS<br> CONVOCADAS<br></th>
    <th colspan="2"><br>ASAMBLEAS<br> CELEBRADAS<br></th>
    <tr align="center" bgcolor="#B29FD5">
    <th>No.</th>
    <th>%</th>
    <th>No.</th>
    <th>%</th>
    </tr>
  </tr>';

  echo '<tr>';
  while($row = sqlsrv_fetch_array($qry)){

      $id_distrito = $row['id_distrito'];

      $cantidad = $dist[$id_distrito];
    $sql2 = "SELECT count(id_distrito) as convocadas, ( select count(fecha) as celebradas from sireac_formato2 
    where asamblea_cancelada = 2 and asamblea_celebrada = 'SI' and id_distrito = '$id_distrito') as celebradas
    from sireac_formato2 where asamblea_cancelada = 2 and id_distrito  = '$id_distrito'";
     $qry2 = sqlsrv_query($conn, $sql2);
     $row2 = sqlsrv_fetch_array($qry2);
     $porcentaje1 = round(($row2['convocadas'] / $cantidad * 100),2);
     $porcentaje2 = round(($row2['celebradas'] / $cantidad * 100),2);

  echo '
  <td align="center">'.utf8_encode($row['id_distrito']).'</td>
  <td style="text-align: center;">'.$cantidad.'</td>
  <td style="text-align: center;">'.$row2['convocadas'].'</td>
  <td style="text-align: center;">'.$porcentaje1.'%</td>
  <td style="text-align: center;">'.$row2['celebradas'].'</td>
  <td style="text-align: center;">'.$porcentaje2.'%</td>
  </tr>';
  }
echo "</table>";

echo '<br><br><br>';

echo "<table cellspacing='5' cellpadding='5' width='100%' border='1'  align='center' style='font-family: Calibri Light;'>";
        echo '<tr bgcolor="#B29FD5"">
        <th align= "center" colspan="2"> Personas Participantes</th>
        <th align= "center" colspan="1">Mujeres</th>
        <th align= "center" colspan="1">&nbsp;&nbsp;Hombres&nbsp;&nbsp;</th>
        <th align= "center" colspan="1">Otro</th>
        <th align= "center" colspan="1">Total</th>
        </tr>';
        $sql = " SELECT sum(mujeres_1) as mujeres_1, sum(hombres_1) as hombres_1, sum(otros_1) as otros_1, sum(total_1) as total_1,
		sum(mujeres_2) as mujeres_2, sum(hombres_2) as hombres_2, sum(otros_2) as otros_2, sum(total_2) as total_2,
		sum(mujeres_3) as mujeres_3, sum(hombres_3) as hombres_3, sum(otros_3) as otros_3, sum(total_3) as total_3,
		sum(mujeres_4) as mujeres_4, sum(hombres_4) as hombres_4, sum(otros_4) as otros_4, sum(total_4) as total_4,
		sum(mujeres_5) as mujeres_5, sum(hombres_5) as hombres_5, sum(otros_5) as otros_5, sum(total_5) as total_5,
		sum(mujeres_6) as mujeres_6, sum(hombres_6) as hombres_6, sum(otros_6) as otros_6, sum(total_6) as total_6,
		sum(mujeres_7) as mujeres_7, sum(hombres_7) as hombres_7, sum(otros_7) as otros_7, sum(total_7) as total_7,
		sum(mujeres_8) as mujeres_8, sum(hombres_8) as hombres_8, sum(otros_8) as otros_8, sum(total_8) as total_8
		from sireac_formato2 where asamblea_cancelada = 2";
        $qry = sqlsrv_query($conn, $sql);
        $row = sqlsrv_fetch_array($qry);
        
        echo '
        
        <tr>
        <td colspan="1" align="center"><img  width="13%"  height="9%" src="'.$URL.'icono_1.png"  alt="Icono_1"></td>
        <td colspan="1" align="center"><br>Integrantes <br>de Copaco<br></td>
        <td colspan="1" align="center"><br>'.$row['mujeres_1'].'<br></td>
        <td colspan="1" align="center"><br>'.$row['hombres_1'].'<br></td>
        <td colspan="1" align="center"><br>'.$row['otros_1'].'<br></td>
        <td colspan="1" align="center"><br>'.$row['total_1'].'<br></td>
        </tr>
        
        <tr>
        <td ><img width="13%"  height="9%" src="'.$URL.'icono_2.png"  alt="Icono_2"></td>
        <td colspan="1" align="center">Habitantes con<br> credencial <br>para votar</td>
        <td colspan="1" align="center"><br>'.$row['mujeres_2'].'<br></td>
        <td colspan="1" align="center"><br>'.$row['hombres_2'].'<br></td>
        <td colspan="1" align="center"><br>'.$row['otros_2'].'<br></td>
        <td colspan="1" align="center"><br>'.$row['total_2'].'<br></td>
        </tr>

        <tr>
        <td ><img width="13%"  height="9%" src="'.$URL.'icono_3.png" alt="Icono_3"></td>
        <td colspan="1" align="center">Habitantes <br> entre 16 <br>y 17 años</td>
        <td colspan="1" align="center"><br>'.$row['mujeres_3'].'<br></td>
        <td colspan="1" align="center"><br>'.$row['hombres_3'].'<br></td>
        <td colspan="1" align="center"><br>'.$row['otros_3'].'<br></td>
        <td colspan="1" align="center"><br>'.$row['total_3'].'<br></td>
        </tr>

        <tr>
        <td ><img width="13%"  height="9%" src="'.$URL.'icono_4.png" alt="Icono_4"></td>
        <td colspan="1" align="center">Habitantes <br>menores <br>de edad</td>
        <td colspan="1" align="center"><br>'.$row['mujeres_4'].'<br></td>
        <td colspan="1" align="center"><br>'.$row['hombres_4'].'<br></td>
        <td colspan="1" align="center"><br>'.$row['otros_4'].'<br></td>
        <td colspan="1" align="center"><br>'.$row['total_4'].'<br></td>
        </tr>

        <tr>
        <td ><img width="13%"  height="9%" src="'.$URL.'icono_5.png" alt="Icono_5"></td>
        <td colspan="1" align="center">Funcionarias <br> públicas</td>
        <td colspan="1" align="center"><br>'.$row['mujeres_5'].'<br></td>
        <td colspan="1" align="center"><br>'.$row['hombres_5'].'<br></td>
        <td colspan="1" align="center"><br>'.$row['otros_5'].'<br></td>
        <td colspan="1" align="center"><br>'.$row['total_5'].'<br></td>
        </tr>

        <tr>
        <td ><img width="13%"  height="9%" src="'.$URL.'icono_6.png" alt="Icono_6"></td>
        <td colspan="1" align="center">Con interés <br>de carácter <br> consultivo</td>
        <td colspan="1" align="center"><br>'.$row['mujeres_6'].'<br></td>
        <td colspan="1" align="center"><br>'.$row['hombres_6'].'<br></td>
        <td colspan="1" align="center"><br>'.$row['otros_6'].'<br></td>
        <td colspan="1" align="center"><br>'.$row['total_6'].'<br></td>
        </tr>

        <tr>
        <td ><img width="13%"  height="9%" src="'.$URL.'icono_7.png" alt="Icono_7"></td>
        <td colspan="1" align="center">Integrantes de <br>OC con <br>registro ante<br> el IECM</td>
        <td colspan="1" align="center"><br>'.$row['mujeres_7'].'<br></td>
        <td colspan="1" align="center"><br>'.$row['hombres_7'].'<br></td>
        <td colspan="1" align="center"><br>'.$row['otros_7'].'<br></td>
        <td colspan="1" align="center"><br>'.$row['total_7'].'<br></td>
        </tr>

        <tr>
        <td ><img width="13%"  height="9%" src="'.$URL.'icono_8.png" alt="Icono_8"></td>
        <td colspan="1" align="center">Observadoras y <br> visitantes <br>extranjeras</td>
        <td colspan="1" align="center"><br>'.$row['mujeres_8'].'<br></td>
        <td colspan="1" align="center"><br>'.$row['hombres_8'].'<br></td>
        <td colspan="1" align="center"><br>'.$row['otros_8'].'<br></td>
        <td colspan="1" align="center"><br>'.$row['total_8'].'<br></td>
        </tr>';
        $total_mujeres = $row['mujeres_1'] + $row['mujeres_2'] + $row['mujeres_3'] + $row['mujeres_4'] + $row['mujeres_5'] + $row['mujeres_6'] + $row['mujeres_7'] + $row['mujeres_8'];
        $total_hombres = $row['hombres_1'] + $row['hombres_2'] + $row['hombres_3'] + $row['hombres_4'] + $row['hombres_5'] + $row['hombres_6'] + $row['hombres_7'] + $row['hombres_8'];
        $total_otros = $row['otros_1'] + $row['otros_2'] + $row['otros_3'] + $row['otros_4'] + $row['otros_5'] + $row['otros_6'] + $row['otros_7'] + $row['otros_8'];
        $total = $row['total_1'] + $row['total_2'] + $row['total_3'] + $row['total_4'] + $row['total_5'] + $row['total_6'] + $row['total_7'] + $row['total_8'];
        
        echo '<tr>
        <td colspan="2" align="center">Total</td>
        <td colspan="1" align="center">'.$total_mujeres.'</td>
        <td colspan="1" align="center">'.$total_hombres.'</td>
        <td colspan="1" align="center">'.$total_otros.'</td>
        <td colspan="1" align="center">'.$total.'</td>
        </tr>
        ';
echo "</table>";

echo '<br><br><br>';

echo "<table cellspacing='5' cellpadding='5' width='100%' border='1'  align='center' style='font-family: Calibri Light;'>";
        echo '
        <th colspan="7" bgcolor="#B29FD5" align="center">Rangos de Edad de las Personas Participantes</th>';
        $sql = "SELECT sum(menor_16) as rango_1, sum(edad_16_17) as rango_2,
        sum(edad_18_29) as rango_3, sum(edad_30_39) as rango_4, sum(edad_40_49) as rango_5, 
        sum(edad_50_59) as rango_6, sum(edad_60_mas) as rango_7  from sireac_formato2 where asamblea_cancelada = 2";
        $qry = sqlsrv_query($conn, $sql);
        $row = sqlsrv_fetch_array($qry);

        echo '
        
        <tr>
        <td colspan="1" align="center"><br>Menores de <br> 16 años<br></td>
        <td colspan="1" align="center"><br>Entre 16 y<br> 17 años<br></td>
        <td colspan="1" align="center"><br>De 18 a <br> 29 años<br></td>
        <td colspan="1" align="center"><br>De 30 a <br> 39 años<br></td>
        <td colspan="1" align="center"><br>De 40 a <br> 49 años<br></td>
        <td colspan="1" align="center"><br>De 50 a <br> 59 años<br></td>
        <td colspan="1" align="center"><br>60 años o <br> más<br></td>
        </tr>
        
        <tr>
        <td colspan="1" align="center">'.$row['rango_1'].'</td>
        <td colspan="1" align="center">'.$row['rango_2'].'</td>
        <td colspan="1" align="center">'.$row['rango_3'].'</td>
        <td colspan="1" align="center">'.$row['rango_4'].'</td>
        <td colspan="1" align="center">'.$row['rango_5'].'</td>
        <td colspan="1" align="center">'.$row['rango_6'].'</td>
        <td colspan="1" align="center">'.$row['rango_7'].'</td>
        </tr>
        ';
echo "</table>";
echo '<br><br>';
$sql = "SELECT nombre_delegacion, sum(total1) as total1, sum(mujeres1) as mujeres1, sum(hombres1) as hombres1,sum(otros1) as otros1,
sum(total2) as total2, sum(mujeres2) as mujeres2, sum(hombres2) as hombres2,sum(otros2) as otros2,
sum(total3) as total3, sum(mujeres3) as mujeres3, sum(hombres3) as hombres3,sum(otros3) as otros3,
sum(total4) as total4, sum(mujeres4) as mujeres4, sum(hombres4) as hombres4,sum(otros4) as otros4,
sum(total5) as total5, sum(mujeres5) as mujeres5, sum(hombres5) as hombres5,sum(otros5) as otros5,
sum(total6) as total6, sum(mujeres6) as mujeres6, sum(hombres6) as hombres6,sum(otros6) as otros6,
sum(total7) as total7, sum(mujeres7) as mujeres7, sum(hombres7) as hombres7,sum(otros7) as otros7,
sum(total8) as total8, sum(mujeres8) as mujeres8, sum(hombres8) as hombres8,sum(otros8) as otros8,
sum(rango1) as rango1, sum(rango2) as rango2, sum(rango3) as rango3, sum(rango4) as rango4, sum(rango5) as rango5, sum(rango6) as rango6, sum(rango7) as rango7 from
(SELECT nombre_delegacion,
sum(total_1) as total1,sum(mujeres_1) as mujeres1, sum(hombres_1) as hombres1, sum(otros_1) as otros1,
sum(total_2) as total2,sum(mujeres_2) as mujeres2, sum(hombres_2) as hombres2, sum(otros_2) as otros2,
sum(total_3) as total3,sum(mujeres_3) as mujeres3, sum(hombres_3) as hombres3, sum(otros_3) as otros3,
sum(total_4) as total4,sum(mujeres_4) as mujeres4, sum(hombres_4) as hombres4, sum(otros_4) as otros4,
sum(total_5) as total5,sum(mujeres_5) as mujeres5, sum(hombres_5) as hombres5, sum(otros_5) as otros5,
sum(total_6) as total6,sum(mujeres_6) as mujeres6, sum(hombres_6) as hombres6, sum(otros_6) as otros6,
sum(total_7) as total7,sum(mujeres_7) as mujeres7, sum(hombres_7) as hombres7, sum(otros_7) as otros7,
sum(total_8) as total8,sum(mujeres_8) as mujeres8, sum(hombres_8) as hombres8, sum(otros_8) as otros8,
sum(menor_16) as rango1, sum(edad_16_17) as rango2, sum(edad_18_29) as rango3,
sum(edad_30_39) as rango4, sum(edad_40_49) as rango5, sum(edad_50_59) as rango6,
sum(edad_60_mas) as rango7
from cat_delegacion as d, sireac_formato2 as t where d.id_delegacion = t.id_delegacion group by nombre_delegacion
union all
select nombre_delegacion, 
total1 = '', mujeres1 = '', hombres1= '', otros1 = '',
total2 = '', mujeres2 = '', hombres2= '', otros2 = '',
total3 = '', mujeres3 = '', hombres3= '', otros3 = '',
total4 = '', mujeres4 = '', hombres4= '', otros4 = '',
total5 = '', mujeres5 = '', hombres5= '', otros5 = '',
total6 = '', mujeres6 = '', hombres6= '', otros6 = '',
total7 = '', mujeres7 = '', hombres7= '', otros7 = '',
total8 = '', mujeres8 = '', hombres8= '', otros8 = '',
rango1= '', rango2= '', rango3= '', rango4= '', rango5= '',
rango6= '', rango7= '' from cat_delegacion ) as a group by nombre_delegacion order by nombre_delegacion";
 $qry = sqlsrv_query($conn, $sql);

 echo "<table border = '1' height='100' align='center' style='font-family: Calibri Light;'>";
 echo '<th colspan= "40" bgcolor="#B29FD5" align="center">Participación Ciudadana por Demarcación</th>';
  echo '<tr bgcolor="#B29FD5">
  <th align="center" rowspan="2"><br>DEMARCACIÓN<br></th>
    <th colspan="4">PERSONAS INTEGRANTES DE LA COMISIÓN DE PARTICIPACIÓN COMUNITARIA PRESENTES</th>
    <th colspan="4">PERSONAS HABITANTES CON CREDENCIAL DE ELECTOR PRESENTES</th>
    <th colspan="4">PERSONAS HABITANTES DE ENTRE 16 Y 17 AÑOS PRESENTES</th>
    <th colspan="4">PERSONAS HABITANTES MENORES DE EDAD PRESENTES</th>
    <th colspan="4">PERSONAS FUNCIONARIAS PÚBLICAS PRESENTES</th>
    <th colspan="4">PERSONAS CON INTERES DE CARÁCTER CONSULTIVO PRESENTES</th>
    <th colspan="4">PERSONAS INTEGRANTES DE ORGANIZACIÓN CIUDADANA CON REGISTRO ANTE IECM</th>
    <th colspan="4">PERSONAS OBSERVADORAS Y VISITANTES EXTRANJERAS</th>
    <th colspan="7">SUMAR EL NÚMERO DE PERSONAS POR RANGO DE EDAD Y CAPTURARLO EN LOS SIGUIENTES CAMPOS</th>

    <tr align="center" bgcolor="#B29FD5">
    <th>MUJERES</th>
    <th>HOMBRES</th>
    <th>OTRO</th>
    <th>TOTAL</th>

    <th>MUJERES</th>
    <th>HOMBRES</th>
    <th>OTRO</th>
    <th>TOTAL</th>

    <th>MUJERES</th>
    <th>HOMBRES</th>
    <th>OTRO</th>
    <th>TOTAL</th>

    <th>MUJERES</th>
    <th>HOMBRES</th>
    <th>OTRO</th>
    <th>TOTAL</th>

    <th>MUJERES</th>
    <th>HOMBRES</th>
    <th>OTRO</th>
    <th>TOTAL</th>

    <th>MUJERES</th>
    <th>HOMBRES</th>
    <th>OTRO</th>
    <th>TOTAL</th>

    <th>MUJERES</th>
    <th>HOMBRES</th>
    <th>OTRO</th>
    <th>TOTAL</th>

    <th>MUJERES</th>
    <th>HOMBRES</th>
    <th>OTRO</th>
    <th>TOTAL</th>

    <th>MENORES DE 16</th>
    <th>16 A 17</th>
    <th>18 A 29</th>
    <th>30 A 39</th>
    <th>40 A 49</th>
    <th>50 A 59</th>
    <th>60 o MÁS</th>

    
    </tr>
  </tr>';

  echo '<tr>';
  while($row = sqlsrv_fetch_array($qry)){
     
  echo '
  <td align="center">'.utf8_encode($row['nombre_delegacion']).'</td>
  <td align="center">'.$row['mujeres1'].'</td>
  <td align="center">'.$row['hombres1'].'</td>
  <td align="center">'.$row['otros1'].'</td>
  <td align="center">'.$row['total1'].'</td>

  <td align="center">'.$row['mujeres2'].'</td>
  <td align="center">'.$row['hombres2'].'</td>
  <td align="center">'.$row['otros2'].'</td>
  <td align="center">'.$row['total2'].'</td>

  <td align="center">'.$row['mujeres3'].'</td>
  <td align="center">'.$row['hombres3'].'</td>
  <td align="center">'.$row['otros3'].'</td>
  <td align="center">'.$row['total3'].'</td>

  <td align="center">'.$row['mujeres4'].'</td>
  <td align="center">'.$row['hombres4'].'</td>
  <td align="center">'.$row['otros4'].'</td>
  <td align="center">'.$row['total4'].'</td>

  <td align="center">'.$row['mujeres5'].'</td>
  <td align="center">'.$row['hombres5'].'</td>
  <td align="center">'.$row['otros5'].'</td>
  <td align="center">'.$row['total5'].'</td>

  <td align="center">'.$row['mujeres6'].'</td>
  <td align="center">'.$row['hombres6'].'</td>
  <td align="center">'.$row['otros6'].'</td>
  <td align="center">'.$row['total6'].'</td>

  <td align="center">'.$row['mujeres7'].'</td>
  <td align="center">'.$row['hombres7'].'</td>
  <td align="center">'.$row['otros7'].'</td>
  <td align="center">'.$row['total7'].'</td>

  <td align="center">'.$row['mujeres8'].'</td>
  <td align="center">'.$row['hombres8'].'</td>
  <td align="center">'.$row['otros8'].'</td>
  <td align="center">'.$row['total8'].'</td>

  <td align="center">'.$row['rango1'].'</td>
  <td align="center">'.$row['rango2'].'</td>
  <td align="center">'.$row['rango3'].'</td>
  <td align="center">'.$row['rango4'].'</td>
  <td align="center">'.$row['rango5'].'</td>
  <td align="center">'.$row['rango6'].'</td>
  <td align="center">'.$row['rango7'].'</td>

  
  </tr>';
  }
echo "</table>";
echo '<br><br>';


echo "<td colspan='1' align='center'>Fecha de corte:&nbsp;&nbsp;&nbsp;&nbsp; ".date('d/m/Y')."</td>";

?>
</body>
</html>
