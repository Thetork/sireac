<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  

<?php
$URL = "http://145.0.40.76/sedicop/registro_asambleas/img/";


include 'php/sqlconnector.php';
session_start();
$demarcacion = $_GET['demarcacion'];
      header('Content-type: application/vnd.ms-excel');
      header("Content-Disposition: attachment; filename=Reporte_Demarcacion.xls");
      header("Pragma: no-cache");
      header("Expires: 0");
      header("Content-Type: text/html;charset=utf-8");
      date_default_timezone_set('America/Mexico_City'); 
      echo "<table border=0 width='50' style='font-family: Calibri Light;'> ";
      echo "";
      echo "<tr height='20px'><th><img src='".$URL."header20_1.png' width='150' height='100' alt='Logo IECM 20 AÑOS' ></th></tr>"; 
      echo '<br><br><br>';
      echo "<tr><th colspan='12'style ='color:#6847A3;'><font style='font-size: 20px; align:center;'>COMISIÓN PERMANENTE DE PARTICIPACIÓN<br>CIUDADANA Y CAPACITACIÓN</font></th></tr>";
      echo "<tr></tr>";
      echo "<tr></tr>";
      echo"<tr><th colspan='10' align='right'>Fecha de corte: ".date('d/m/Y')."</th></tr>";
      
      echo "</table>";
      echo '<br>';

      echo '<br></br>';

      $sql = "SELECT t.nombre_delegacion as nombre,count(clave_territorial) as cantidad,
      sum(case when asamblea_celebrada = 'SI' then 1 else 0 end) as celebrada,
      sum(case when asamblea_convocada = 'SI' then 1 else 0 end) as convocada
        from sireac_casos_especiales as d, cat_delegacion as t where demarcacion = $demarcacion and t.id_delegacion = $demarcacion group by t.nombre_delegacion";
      $qry = sqlsrv_query($conn, $sql);
      $row = sqlsrv_fetch_array($qry); 

      echo "<table width='100%' align='center' style='font-family: Calibri Light;'>";
          $porcentaje1 = round(($row['convocada'] / $row['cantidad'] * 100),2);
          $porcentaje2 = round(($row['celebrada'] / $row['cantidad'] * 100),2);
          echo '<tr><th colspan="12" align="center">ALCALDÍA:&nbsp;&nbsp;&nbsp;'.utf8_decode(strtoupper($row['nombre'])).'</th></tr>   
          <tr></tr>
          <th colspan= "9" bgcolor="#BFB8D6" align="center">ASAMBLEAS CIUDADANAS DE CASOS ESPECIALES</th>
          <tr><td bgcolor="#D9C8EA" colspan= "3" align="center">Asambleas Convocadas</td><td colspan="3"></td><td bgcolor="#D9C8EA" colspan= "3" align="center">Asambleas Celebradas</td></tr>
          <tr><td bgcolor="#E5E2EE" colspan= "3" align="center">Demarcación Territorial</td><td colspan="3"></td><td bgcolor="#E5E2EE" colspan= "3" align="center">Demarcación Territorial</td></tr>
          <tr bgcolor="#E5E2EE" align="center"><td  colspan= "1" align="center">Asambleas<br>a celebrar</td><td colspan="1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td colspan="1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;% &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td bgcolor="#FFFFFF" colspan="3"></td><td  colspan= "1" align="center">Asambleas<br>a celebrar</td><td colspan="1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td colspan="1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;% &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>
          <tr align="center"><td colspan="1"><b>'.$row['cantidad'].'<b></td> <td colspan="1"><b>'.$row['convocada'].'<b></td> <td colspan="1"><b>'.$porcentaje1.'%<b></td>   <td bgcolor="#FFFFFF" colspan="3"></td>   <td colspan="1"><b>'.$row['cantidad'].'<b></td><td colspan="1"><b>'.$row['celebrada'].'<b></td><td colspan="1"><b>'.$porcentaje2.'%<b></td></tr>
          <tr></tr>';
          $sql = "SELECT distrito,count(asamblea_celebrada) as total_celebrada, sum(case when asamblea_celebrada = 'SI' then 1 else 0 end) as celebrada,
          count(asamblea_convocada) as total_convocada, sum(case when asamblea_convocada = 'SI' then 1 else 0 end) as convocada  from sireac_casos_especiales where demarcacion = $demarcacion group by distrito";
          $qry = sqlsrv_query($conn, $sql);
          echo '    <tr><td bgcolor="#D9C8EA" colspan= "4" align="center">Dirección Distrital</td><td colspan="1"></td><td bgcolor="#D9C8EA" colspan= "4" align="center">Dirección Distrital</td></tr>
          <tr bgcolor="#E5E2EE" align="center"><td>&nbsp;&nbsp;&nbsp;&nbsp;DD&nbsp;&nbsp;&nbsp;&nbsp;</td><td  colspan= "1" align="center">Asambleas<br>a celebrar</td><td colspan="1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td colspan="1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;% &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td bgcolor="#FFFFFF" colspan="1"></td><td>&nbsp;&nbsp;&nbsp;&nbsp;DD&nbsp;&nbsp;&nbsp;&nbsp;</td><td  colspan= "1" align="center">Asambleas<br>a celebrar</td><td colspan="1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td colspan="1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;% &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>';
          while($row = sqlsrv_fetch_array($qry)){
              $porcentaje1 = round(($row['convocada'] / $row['total_convocada'] * 100),2);
              $porcentaje2 = round(($row['celebrada'] / $row['total_celebrada'] * 100),2);
              echo '<tr align="center">
              <td>'.$row['distrito'].'</td><td>'.$row['total_convocada'].'</td><td>'.$row['convocada'].'</td><td>'.$porcentaje1.'%</td><td colspan="1"></td><td>'.$row['distrito'].'</td><td>'.$row['total_celebrada'].'</td><td>'.$row['celebrada'].'</td><td>'.$porcentaje2.'%</td>
              </tr>';
          }
      echo "</table>";
      echo "<br><br>";
      $sql = "SELECT count(clave_territorial) as cantidad,
      sum(case when asamblea_celebrada = 'SI' then 1 else 0 end) as celebrada,
      sum(case when asamblea_convocada = 'SI' then 1 else 0 end) as convocada
        from sireac_informacion_seleccion where demarcacion = $demarcacion";
      $qry = sqlsrv_query($conn, $sql);
      $row = sqlsrv_fetch_array($qry); 

      echo "<table width='100%' align='center' style='font-family: Calibri Light;'>";
          $porcentaje1 = round(($row['convocada'] / $row['cantidad'] * 100),2);
          $porcentaje2 = round(($row['celebrada'] / $row['cantidad'] * 100),2);
      
          echo'<th colspan= "9" bgcolor="#FCE4D6" align="center">ASAMBLEAS CIUDADANAS DE INFORMACIÓN Y SELECCIÓN</th>
          <tr bgcolor="#FCE4D6"><td  colspan= "3" align="center">Asambleas Convocadas</td><td colspan="3"></td><td colspan= "3" align="center">Asambleas Celebradas</td></tr>
          <tr><td bgcolor="#FCE4D6" colspan= "3" align="center">Demarcación Territorial</td><td colspan="3"></td><td bgcolor="#FCE4D6" colspan= "3" align="center">Demarcación Territorial</td></tr>
          <tr bgcolor="#FCE4D6" align="center"><td  colspan= "1" align="center">Asambleas<br>a celebrar</td><td colspan="1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td colspan="1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;% &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td bgcolor="#FFFFFF" colspan="3"></td><td  colspan= "1" align="center">Asambleas<br>a celebrar</td><td colspan="1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td colspan="1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;% &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>
          <tr align="center"><td colspan="1"><b>'.$row['cantidad'].'<b></td> <td colspan="1"><b>'.$row['convocada'].'<b></td> <td colspan="1"><b>'.$porcentaje1.'%<b></td>   <td bgcolor="#FFFFFF" colspan="3"></td>   <td colspan="1"><b>'.$row['cantidad'].'<b></td><td colspan="1"><b>'.$row['celebrada'].'<b></td><td colspan="1"><b>'.$porcentaje2.'%<b></td></tr>
          <tr></tr>';
          $sql = "SELECT distrito,count(asamblea_celebrada) as total_celebrada, sum(case when asamblea_celebrada = 'SI' then 1 else 0 end) as celebrada,
          count(asamblea_convocada) as total_convocada, sum(case when asamblea_convocada = 'SI' then 1 else 0 end) as convocada  from sireac_informacion_seleccion where demarcacion = $demarcacion group by distrito";
          $qry = sqlsrv_query($conn, $sql);
          echo '    <tr><td bgcolor="#FCE4D6" colspan= "4" align="center">Dirección Distrital</td><td colspan="1"></td><td bgcolor="#FCE4D6" colspan= "4" align="center">Dirección Distrital</td></tr>
          <tr bgcolor="#FCE4D6" align="center"><td>&nbsp;&nbsp;&nbsp;&nbsp;DD&nbsp;&nbsp;&nbsp;&nbsp;</td><td  colspan= "1" align="center">Asambleas<br>a celebrar</td><td colspan="1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td colspan="1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;% &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td bgcolor="#FFFFFF" colspan="1"></td><td>&nbsp;&nbsp;&nbsp;&nbsp;DD&nbsp;&nbsp;&nbsp;&nbsp;</td><td  colspan= "1" align="center">Asambleas<br>a celebrar</td><td colspan="1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td colspan="1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;% &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>';
          while($row = sqlsrv_fetch_array($qry)){
              $porcentaje1 = round(($row['convocada'] / $row['total_convocada'] * 100),2);
              $porcentaje2 = round(($row['celebrada'] / $row['total_celebrada'] * 100),2);
              echo '<tr align="center">
              <td>'.$row['distrito'].'</td><td>'.$row['total_convocada'].'</td><td>'.$row['convocada'].'</td><td>'.$porcentaje1.'%</td><td colspan="1"></td><td>'.$row['distrito'].'</td><td>'.$row['total_celebrada'].'</td><td>'.$row['celebrada'].'</td><td>'.$porcentaje2.'%</td>
              </tr>';
          }
      echo "</table>";
      echo "<br><br>";
      $sql = "SELECT count(clave_territorial) as cantidad,
      sum(case when comite_ejecucion_2020 = 'SI' then 1 else 0 end) as ejecucion_2020,
        sum(case when comite_vigilancia_2020 = 'SI' then 1 else 0 end) as vigilancia_2020,
        sum(case when comite_ejecucion_2021 = 'SI' then 1 else 0 end) as ejecucion_2021,
          sum(case when comite_vigilancia_2021 = 'SI' then 1 else 0 end) as vigilancia_2021
            from sireac_informacion_seleccion where demarcacion = $demarcacion";
      $qry = sqlsrv_query($conn, $sql);
      $row = sqlsrv_fetch_array($qry); 

      echo "<table width='100%' align='center' style='font-family: Calibri Light;'>";
          $porcentaje1 = round(($row['ejecucion_2020'] / $row['cantidad'] * 100),2);
          $porcentaje2 = round(($row['vigilancia_2020'] / $row['cantidad'] * 100),2);
          $porcentaje3 = round(($row['ejecucion_2021'] / $row['cantidad'] * 100),2);
          $porcentaje4 = round(($row['vigilancia_2021'] / $row['cantidad'] * 100),2);
          $total = $row['ejecucion_2020'] + $row['vigilancia_2020'] + $row['ejecucion_2021'] + $row['vigilancia_2021'];
          $porcentaje_total = round(($total / ($row['cantidad']*4)*100),2);
          echo'<th colspan= "5" bgcolor="#C5FFFF" align="center">COMITES CONFORMADOS</th>
          <tr><td colspan= "5" bgcolor="#C5FFFF" align="center">DEMARCACIÓN TERRITORIAL</td></tr>
          <tr bgcolor="#C5FFFF" align="center"><td>Ejecución<br>2020</td><td>Vigilancia<br>2020</td><td>Ejecucion<br>2021</td><td>Vigilancia<br>2021</td><td>Total<br></td></tr>
          <tr align="center"><td><b>'.$row['ejecucion_2020'].'<b></td><td><b>'.$row['vigilancia_2020'].'<b></td><td><b>'.$row['ejecucion_2021'].'<b></td><td><b>'.$row['vigilancia_2021'].'<b></td><td><b>'.$total.'<b></td></tr>
          <tr align="center"><td><b>'.$porcentaje1.'%<b></td><td><b>'.$porcentaje2.'%<b></td><td><b>'.$porcentaje3.'%<b></td><td><b>'.$porcentaje4.'%<b></td><td><b>'.$porcentaje_total.'%<b></td></tr>
          <tr></tr>';
          $sql = "SELECT distrito,count(clave_territorial) as cantidad,
          sum(case when comite_ejecucion_2020 = 'SI' then 1 else 0 end) as ejecucion_2020,
            sum(case when comite_vigilancia_2020 = 'SI' then 1 else 0 end) as vigilancia_2020,
            sum(case when comite_ejecucion_2021 = 'SI' then 1 else 0 end) as ejecucion_2021,
              sum(case when comite_vigilancia_2021 = 'SI' then 1 else 0 end) as vigilancia_2021
                from sireac_informacion_seleccion where demarcacion = $demarcacion group by distrito";
          $qry = sqlsrv_query($conn, $sql);
          echo '
          <tr><td colspan= "6" bgcolor="#C5FFFF" align="center">DIRECCIÓN DISTRITAL</td></tr>
          <tr bgcolor="#C5FFFF" align="center"><td>&nbsp;&nbsp;&nbsp;DD&nbsp;&nbsp;&nbsp;</td><td>Ejecución<br>2020</td><td>Vigilancia<br>2020</td><td>Ejecucion<br>2021</td><td>Vigilancia<br>2021</td><td>Total<br></td></tr>
        '; while($row = sqlsrv_fetch_array($qry)){
              $porcentaje1 = round(($row['ejecucion_2020'] / $row['cantidad'] * 100),2);
              $porcentaje2 = round(($row['vigilancia_2020'] / $row['cantidad'] * 100),2);
              $porcentaje3 = round(($row['ejecucion_2021'] / $row['cantidad'] * 100),2);
              $porcentaje4 = round(($row['vigilancia_2021'] / $row['cantidad'] * 100),2);
              $total = $row['ejecucion_2020'] + $row['vigilancia_2020'] + $row['ejecucion_2021'] + $row['vigilancia_2021'];
              $porcentaje_total = round(($total / ($row['cantidad']*4)*100),2);

              echo '<tr align="center">
              <td  rowspan="2">&nbsp;&nbsp;&nbsp;<b>'.$row['distrito'].'<b>&nbsp;&nbsp;&nbsp;</td><td>'.$row['ejecucion_2020'].'</td><td>'.$row['vigilancia_2020'].'</td><td>'.$row['ejecucion_2021'].'</td><td>'.$row['vigilancia_2021'].'</td><td>'.$total.'</td>
              <tr  align="center"><td><b>'.$porcentaje1.'%<b></td><td><b>'.$porcentaje2.'%<b></td><td><b>'.$porcentaje3.'%<b></td><td><b>'.$porcentaje4.'%<b></td><td><b>'.$porcentaje_total.'%<b></td></tr>
              </tr>';
          }
      echo "</table>";




?>
</body>
</html>
