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
header("Content-Disposition: attachment; filename=Reporte_Informacion_Seleccion.xls");
header("Pragma: no-cache");
header("Expires: 0");
header("Content-Type: text/html;charset=utf-8");
date_default_timezone_set('America/Mexico_City'); 
echo "<table border=0 width='50' style='font-family: Calibri Light;'> ";
echo "<tr><th colspan='22'style ='color:#6847A3;'><font style='font-size: 20px; align:center;'>REPORTE DE ASAMBLEAS CIUDADANAS DE INFORMACIÓN Y SELECCIÓN</font></th></tr>";
echo "<tr height='20px'><th></th></tr>"; 
$sql1 = "SELECT count(id_distrito) as cantidad, (select count(asamblea_cancelada) from sireac_formato3 where asamblea_cancelada = 1) as forma from sireac_formato3 where asamblea_cancelada = 2";
$query1 = sqlsrv_query($conn,$sql1);
$row1 = sqlsrv_fetch_array($query1);
$cantidad = $row1['cantidad'];
$canceladas = $row1['forma'];

 
echo "<td bgcolor='#B29FD5'>Asambleas Convocadas</td>
    <td colspan='1' align='center' bgcolor='#B5B5BF'>".$cantidad."</td>
    <td colspan='2'></td>
    <td bgcolor='#B29FD5'>Asambleas Canceladas</td>
    <td colspan='1' align='center' bgcolor='#B5B5BF'>".$canceladas."</td>
    
    ";
echo "</table>";

echo '<br><br>';


// $sql = "SELECT del.id_delegacion,nombre_delegacion, count(id_distrito) as cantidad from sireac_formato3 as form1, cat_delegacion as del
// where form1.id_delegacion = del.id_delegacion
// group by del.id_delegacion, nombre_delegacion 
// union 
// select id_delegacion,nombre_delegacion, cantidad = ''  from cat_delegacion  group by id_delegacion,nombre_delegacion order by nombre_delegacion, cantidad desc";


$sql = "SELECT del.id_delegacion,nombre_delegacion, count(id_distrito) as cantidad FROM cat_delegacion as del 
LEFT JOIN sireac_formato3 as form1  ON del.id_delegacion = form1.id_delegacion and form1.asamblea_cancelada = 2 group by del.id_delegacion, nombre_delegacion";
 $qry = sqlsrv_query($conn, $sql);

echo "<table border = '1' height='100' align='center' style='font-family: Calibri Light;'>";
    $alto = 1;
    echo '<th colspan= "8" bgcolor="#B29FD5" aling="center">Asambleas reportadas por demarcacion territorial</th>';
    echo '<tr>';
            while($row = sqlsrv_fetch_array($qry)){

                echo '
                <td align="center">'.utf8_encode($row['nombre_delegacion']).'</td> 
                <td align="center" bgcolor="#B29FD5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.($row['cantidad']).'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td> 
                    ';
                    if($alto == 4 || $alto == 8 || $alto == 12){
                            echo '</tr>
                            <tr>';
                            
                        }
                    $alto++;
            }
echo "</table>";

echo '<br></br>';

$sql = "SELECT del.id_distrito, count(form1.id_distrito) as cantidad FROM cat_distrito as del
LEFT JOIN sireac_formato3 as form1 ON (del.id_distrito = form1.id_distrito) and form1.asamblea_cancelada = 2 group by del.id_distrito";
 $qry = sqlsrv_query($conn, $sql);

echo "<table width='100%' border = '1' align='center' style='font-family: Calibri Light;'>";
    $alto = 1;
    
    echo '<th colspan= "8" bgcolor="#B29FD5" align="center">Asambleas reportadas por dirección distrital</th>';
    echo '<tr>';
            while($row = sqlsrv_fetch_array($qry)){
                echo '
                <td width="500" align="center">'.utf8_encode($row['id_distrito']).'</td> 
                <td width="500" align="center" bgcolor="#B29FD5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.($row['cantidad']).'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td> 
                    ';
                    if($alto == 4 || $alto == 8 || $alto == 12 || $alto == 16 || $alto == 20 || $alto == 24 || $alto == 28 || $alto == 32 ){
                            echo '</tr>
                            <tr>';
                            
                        }
                    $alto++;
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
		from sireac_formato3 where asamblea_cancelada = 2";
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
        <td ><img width="13%"  height="9%" ssrc="'.$URL.'icono_2.png"  alt="Icono_2"></td>
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
        sum(edad_50_59) as rango_6, sum(edad_60_mas) as rango_7  from sireac_formato3 where asamblea_cancelada = 2";
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
echo '<br><br><br>';
echo "<table cellspacing='5' cellpadding='5' width='100%' border='1'  align='center' style='font-family: Calibri Light;'>";
        echo '
        <tr bgcolor="#B29FD5">
        <th rowspan="2" colspan="1" align="center">Comité</th>
        <th rowspan="2" colspan="1" align="center">Año</th>
        <td colspan="11" align="center">Número de integrantes</td>
        <tr bgcolor="#B29FD5">
        <th colspan="1" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
        <th colspan="1" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
        <th colspan="1" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
        <th colspan="1" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
        <th colspan="1" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;5&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
        <th colspan="1" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;6&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
        <th colspan="1" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;7&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
        <th colspan="1" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;8&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
        <th colspan="1" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;9&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
        <th colspan="1" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;10&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
        <th colspan="1" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;10+&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th></tr>
        </tr>
        ';
        $sql = "SELECT comite_ejecucion_2020_1, comite_ejecucion_2021_1, comite_vigilancia_2020_1, comite_vigilancia_2021_1 from sireac_formato3 where asamblea_cancelada = 2";
        $qry = sqlsrv_query($conn, $sql);
        $count1 = 0;
        $count2 = 0;
        $count3 = 0;
        $count4 = 0;
        $count5 = 0;
        $count6 = 0;
        $count7 = 0;
        $count8 = 0;
        $count9 = 0;
        $count10 = 0;
        $count11 = 0;

        $count12 = 0;
        $count13 = 0;
        $count14 = 0;
        $count15 = 0;
        $count16 = 0;
        $count17 = 0;
        $count18 = 0;
        $count19 = 0;
        $count20 = 0;
        $count21 = 0;
        $count22 = 0; 

        $count23 = 0;
        $count24 = 0;
        $count25 = 0;
        $count26 = 0;
        $count27 = 0;
        $count28 = 0;
        $count29 = 0;
        $count30 = 0;
        $count31 = 0;
        $count32 = 0;
        $count33 = 0; 

        $count34 = 0;
        $count35 = 0;
        $count36 = 0;
        $count37 = 0;
        $count38 = 0;
        $count39 = 0;
        $count40 = 0;
        $count41 = 0;
        $count42 = 0;
        $count43 = 0;
        $count44 = 0;
        while($row = sqlsrv_fetch_array($qry)){
        $comite_ejecucion_2020 = json_decode($row['comite_ejecucion_2020_1']);
        // echo '<pre>'.var_dump($comite_ejecucion_2020).'</pre>';
            foreach ($comite_ejecucion_2020 as $key => $value) {
                if($key == 0 && $value != ''){
                    $count1++;
                }
                if($key == 1 && $value != ''){
                    $count2++;
                }
                if($key == 2 && $value != ''){
                    $count3++;
                }
                if($key == 3 && $value != ''){
                    $count4++;
                }
                if($key == 4 && $value != ''){
                    $count5++;
                }
                if($key == 5 && $value != ''){
                    $count6++;
                }
                if($key == 6 && $value != ''){
                    $count7++;
                }
                if($key == 7 && $value != ''){
                    $count8++;
                }
                if($key == 8 && $value != ''){
                    $count9++;
                }
                if($key == 9 && $value != ''){
                    $count10++;
                }
                if($key > 9 && $value != ''){
                    $count11++;
                }
            }

            $comite_ejecucion_2021 = json_decode($row['comite_ejecucion_2021_1']);
            // echo '<pre>'.var_dump($comite_ejecucion_2020).'</pre>';
            foreach ($comite_ejecucion_2021 as $key => $value) {
                if($key == 0 && $value != ''){
                    $count12++;
                }
                if($key == 1 && $value != ''){
                    $count13++;
                }
                if($key == 2 && $value != ''){
                    $count14++;
                }
                if($key == 3 && $value != ''){
                    $count15++;
                }
                if($key == 4 && $value != ''){
                    $count16++;
                }
                if($key == 5 && $value != ''){
                    $count17++;
                }
                if($key == 6 && $value != ''){
                    $count18++;
                }
                if($key == 7 && $value != ''){
                    $count19++;
                }
                if($key == 8 && $value != ''){
                    $count20++;
                }
                if($key == 9 && $value != ''){
                    $count21++;
                }
                if($key > 9 && $value != ''){
                    $count22++;
                }
            }
            $comite_vigilancia_2021 = json_decode($row['comite_vigilancia_2020_1']);
            // echo '<pre>'.var_dump($comite_ejecucion_2020).'</pre>';
                foreach ($comite_vigilancia_2021 as $key => $value) {
                    if($key == 0 && $value != ''){
                        $count23++;
                    }
                    if($key == 1 && $value != ''){
                        $count24++;
                    }
                    if($key == 2 && $value != ''){
                        $count25++;
                    }
                    if($key == 3 && $value != ''){
                        $count26++;
                    }
                    if($key == 4 && $value != ''){
                        $count27++;
                    }
                    if($key == 5 && $value != ''){
                        $count28++;
                    }
                    if($key == 6 && $value != ''){
                        $count29++;
                    }
                    if($key == 7 && $value != ''){
                        $count30++;
                    }
                    if($key == 8 && $value != ''){
                        $count31++;
                    }
                    if($key == 9 && $value != ''){
                        $count32++;
                    }
                    if($key > 9 && $value != ''){
                        $count33++;
                    }
                }
            $comite_ejecucion_2021 = json_decode($row['comite_vigilancia_2021_1']);
            // echo '<pre>'.var_dump($comite_ejecucion_2020).'</pre>';
                foreach ($comite_ejecucion_2021 as $key => $value) {
                    if($key == 0 && $value != ''){
                        $count34++;
                    }
                    if($key == 1 && $value != ''){
                        $count35++;
                    }
                    if($key == 2 && $value != ''){
                        $count36++;
                    }
                    if($key == 3 && $value != ''){
                        $count37++;
                    }
                    if($key == 4 && $value != ''){
                        $count38++;
                    }
                    if($key == 5 && $value != ''){
                        $count39++;
                    }
                    if($key == 6 && $value != ''){
                        $count40++;
                    }
                    if($key == 7 && $value != ''){
                        $count41++;
                    }
                    if($key == 8 && $value != ''){
                        $count42++;
                    }
                    if($key == 9 && $value != ''){
                        $count43++;
                    }
                    if($key > 9 && $value != ''){
                        $count44++;
                    }
                }
        }
     
        
        echo '
        
        <tr>
        <td colspan="1" rowspan="2" align="center">De ejecución</td>
        <td colspan="1" align="center">&nbsp;&nbsp;&nbsp;2020&nbsp;&nbsp;&nbsp;</td>
        <td colspan="1" align="center">&nbsp;&nbsp;&nbsp;'.$count1.'&nbsp;&nbsp;&nbsp;</td>
        <td colspan="1" align="center">&nbsp;&nbsp;&nbsp;'.$count2.'&nbsp;&nbsp;&nbsp;</td>
        <td colspan="1" align="center">&nbsp;&nbsp;&nbsp;'.$count3.'&nbsp;&nbsp;&nbsp;</td>
        <td colspan="1" align="center">&nbsp;&nbsp;&nbsp;'.$count4.'&nbsp;&nbsp;&nbsp;</td>
        <td colspan="1" align="center">&nbsp;&nbsp;&nbsp;'.$count5.'&nbsp;&nbsp;&nbsp;</td>
        <td colspan="1" align="center">&nbsp;&nbsp;&nbsp;'.$count6.'&nbsp;&nbsp;&nbsp;</td>
        <td colspan="1" align="center">&nbsp;&nbsp;&nbsp;'.$count7.'&nbsp;&nbsp;&nbsp;</td>
        <td colspan="1" align="center">&nbsp;&nbsp;&nbsp;'.$count8.'&nbsp;&nbsp;&nbsp;</td>
        <td colspan="1" align="center">&nbsp;&nbsp;&nbsp;'.$count9.'&nbsp;&nbsp;&nbsp;</td>
        <td colspan="1" align="center">&nbsp;&nbsp;&nbsp;'.$count10.'&nbsp;&nbsp;&nbsp;</td>
        <td colspan="1" align="center">&nbsp;&nbsp;&nbsp;'.$count11.'&nbsp;&nbsp;&nbsp;</td>
        <tr>
        <td colspan="1" align="center">&nbsp;&nbsp;&nbsp;2021&nbsp;&nbsp;&nbsp;</td>
        <td colspan="1" align="center">&nbsp;&nbsp;&nbsp;'.$count12.'&nbsp;&nbsp;&nbsp;</td>
        <td colspan="1" align="center">&nbsp;&nbsp;&nbsp;'.$count13.'&nbsp;&nbsp;&nbsp;</td>
        <td colspan="1" align="center">&nbsp;&nbsp;&nbsp;'.$count14.'&nbsp;&nbsp;&nbsp;</td>
        <td colspan="1" align="center">&nbsp;&nbsp;&nbsp;'.$count15.'&nbsp;&nbsp;&nbsp;</td>
        <td colspan="1" align="center">&nbsp;&nbsp;&nbsp;'.$count16.'&nbsp;&nbsp;&nbsp;</td>
        <td colspan="1" align="center">&nbsp;&nbsp;&nbsp;'.$count17.'&nbsp;&nbsp;&nbsp;</td>
        <td colspan="1" align="center">&nbsp;&nbsp;&nbsp;'.$count18.'&nbsp;&nbsp;&nbsp;</td>
        <td colspan="1" align="center">&nbsp;&nbsp;&nbsp;'.$count19.'&nbsp;&nbsp;&nbsp;</td>
        <td colspan="1" align="center">&nbsp;&nbsp;&nbsp;'.$count20.'&nbsp;&nbsp;&nbsp;</td>
        <td colspan="1" align="center">&nbsp;&nbsp;&nbsp;'.$count21.'&nbsp;&nbsp;&nbsp;</td>
        <td colspan="1" align="center">&nbsp;&nbsp;&nbsp;'.$count22.'&nbsp;&nbsp;&nbsp;</td>
        </tr>


        <tr>
        <td colspan="1" rowspan="2" align="center">De vigilancia</td>
        <td colspan="1" align="center">&nbsp;&nbsp;&nbsp;2020&nbsp;&nbsp;&nbsp;</td>
        <td colspan="1" align="center">&nbsp;&nbsp;&nbsp;'.$count23.'&nbsp;&nbsp;&nbsp;</td>
        <td colspan="1" align="center">&nbsp;&nbsp;&nbsp;'.$count24.'&nbsp;&nbsp;&nbsp;</td>
        <td colspan="1" align="center">&nbsp;&nbsp;&nbsp;'.$count25.'&nbsp;&nbsp;&nbsp;</td>
        <td colspan="1" align="center">&nbsp;&nbsp;&nbsp;'.$count26.'&nbsp;&nbsp;&nbsp;</td>
        <td colspan="1" align="center">&nbsp;&nbsp;&nbsp;'.$count27.'&nbsp;&nbsp;&nbsp;</td>
        <td colspan="1" align="center">&nbsp;&nbsp;&nbsp;'.$count28.'&nbsp;&nbsp;&nbsp;</td>
        <td colspan="1" align="center">&nbsp;&nbsp;&nbsp;'.$count29.'&nbsp;&nbsp;&nbsp;</td>
        <td colspan="1" align="center">&nbsp;&nbsp;&nbsp;'.$count30.'&nbsp;&nbsp;&nbsp;</td>
        <td colspan="1" align="center">&nbsp;&nbsp;&nbsp;'.$count31.'&nbsp;&nbsp;&nbsp;</td>
        <td colspan="1" align="center">&nbsp;&nbsp;&nbsp;'.$count32.'&nbsp;&nbsp;&nbsp;</td>
        <td colspan="1" align="center">&nbsp;&nbsp;&nbsp;'.$count33.'&nbsp;&nbsp;&nbsp;</td>
        <tr>
        <td colspan="1" align="center">&nbsp;&nbsp;&nbsp;2021&nbsp;&nbsp;&nbsp;</td>
        <td colspan="1" align="center">&nbsp;&nbsp;&nbsp;'.$count34.'&nbsp;&nbsp;&nbsp;</td>
        <td colspan="1" align="center">&nbsp;&nbsp;&nbsp;'.$count35.'&nbsp;&nbsp;&nbsp;</td>
        <td colspan="1" align="center">&nbsp;&nbsp;&nbsp;'.$count36.'&nbsp;&nbsp;&nbsp;</td>
        <td colspan="1" align="center">&nbsp;&nbsp;&nbsp;'.$count37.'&nbsp;&nbsp;&nbsp;</td>
        <td colspan="1" align="center">&nbsp;&nbsp;&nbsp;'.$count38.'&nbsp;&nbsp;&nbsp;</td>
        <td colspan="1" align="center">&nbsp;&nbsp;&nbsp;'.$count39.'&nbsp;&nbsp;&nbsp;</td>
        <td colspan="1" align="center">&nbsp;&nbsp;&nbsp;'.$count40.'&nbsp;&nbsp;&nbsp;</td>
        <td colspan="1" align="center">&nbsp;&nbsp;&nbsp;'.$count41.'&nbsp;&nbsp;&nbsp;</td>
        <td colspan="1" align="center">&nbsp;&nbsp;&nbsp;'.$count42.'&nbsp;&nbsp;&nbsp;</td>
        <td colspan="1" align="center">&nbsp;&nbsp;&nbsp;'.$count43.'&nbsp;&nbsp;&nbsp;</td>
        <td colspan="1" align="center">&nbsp;&nbsp;&nbsp;'.$count44.'&nbsp;&nbsp;&nbsp;</td>
        </tr>
        ';
echo "</table>";
echo '<br><br><br>';
echo "<td colspan='1' align='center'>Fecha de corte:".date('d/m/Y')."</td>";

?>
</body>
</html>
