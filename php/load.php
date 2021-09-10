<?php
session_start();
include "sqlconnector.php";

$action = $_POST['accion'];
$id_distrito = $_SESSION['id_distrito'];
switch ($action) {
    case '1':
        $dema = $_POST['dema'];
        $query = "SELECT clave_colonia, nombre_colonia from cat_colonia where id_delegacion = $dema and id_distrito = $id_distrito  order by nombre_colonia";
        $res = sqlsrv_query($conn, $query);
        echo '<option value="">-------------------</option>';
        while ($row = sqlsrv_fetch_array($res)) {
          echo '<option value='.$row['clave_colonia'].'>'.utf8_encode(trim($row['nombre_colonia'])).'</option>';}
        break;
    case '2':
        $cve = $_POST['cve'];
        $query = "SELECT  REPLACE(clave_espacifico, ' ', '') AS clave_espacifico, nombre_proyecto FROM sireac_proy_primer_lugar WHERE anio = 2020 AND clave_territorial = '". $cve ."'";
        $res = sqlsrv_query($conn, $query);
        echo '<option value="NO APLICA" selected>NO APLICA</option>';
        while ($row = sqlsrv_fetch_array($res)) {
          echo '<option value='.$row['clave_espacifico'].'>'.utf8_encode(trim($row['nombre_proyecto'])).'</option>';}
          echo '<option value="OTRO">OTRO</option>';
        break;
    case '3':
        $cve = $_POST['cve'];
        $query = "SELECT  REPLACE(clave_espacifico, ' ', '') AS clave_espacifico, nombre_proyecto FROM sireac_proy_segundo_lugar WHERE anio = 2020 AND clave_territorial = '". $cve ."'";
        $res = sqlsrv_query($conn, $query);
        echo '<option value="NO APLICA" selected>NO APLICA</option>';
        while ($row = sqlsrv_fetch_array($res)) {
          echo '<option value='.$row['clave_espacifico'].'>'.utf8_encode(trim($row['nombre_proyecto'])).'</option>';}
          echo '<option value="OTRO">OTRO</option>';
        break;
    case '4':
        $cve = $_POST['cve'];
        $query = "SELECT  REPLACE(clave_espacifico, ' ', '') AS clave_espacifico, nombre_proyecto FROM sireac_proy_primer_lugar WHERE anio = 2021 AND clave_territorial = '". $cve ."'";
        $res = sqlsrv_query($conn, $query);
        echo '<option value="NO APLICA" selected>NO APLICA</option>';
        while ($row = sqlsrv_fetch_array($res)) {
          echo '<option value='. $row["clave_espacifico"] .'>'.utf8_encode(trim($row['nombre_proyecto'])).'</option>';}
          echo '<option value="OTRO">OTRO</option>';

        break;
    case '5':
        $cve = $_POST['cve'];
        $query = "SELECT  REPLACE(clave_espacifico, ' ', '') AS clave_espacifico, nombre_proyecto FROM sireac_proy_segundo_lugar WHERE anio = 2021 AND clave_territorial = '". $cve ."'";
        $res = sqlsrv_query($conn, $query);
        echo '<option value="NO APLICA" selected>NO APLICA</option>';
        while ($row = sqlsrv_fetch_array($res)) {
          echo '<option value='.$row['clave_espacifico'].'>'.utf8_encode(trim($row['nombre_proyecto'])).'</option>';}
          echo '<option value="OTRO">OTRO</option>';
        break;
    case '6':
        $cve = $_POST['cve'];
        $query = "SELECT * FROM sireac_formato2 WHERE clave_colonia = '". $cve ."' AND asamblea_cancelada = 2";
        $params = array();
        $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
        $qrybj = sqlsrv_query($conn, $query, $params, $options);
        $rowbj = sqlsrv_num_rows($qrybj);

        if ($rowbj >= '1') {
          echo "row1";
        } else {
         echo "row0";
        }
        break;
    case '7':
        $query = "SELECT * FROM sireac_formato2 WHERE id_distrito = ". $id_distrito;
        $params = array();
        $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
        $qrybj = sqlsrv_query($conn, $query, $params, $options);
        echo $rowbj = sqlsrv_num_rows($qrybj);        
      break;
}

?>