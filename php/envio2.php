<?php
session_start();
include "sqlconnector.php";
date_default_timezone_set('America/Mexico_City');

    $id_distrito = $_SESSION['id_distrito'];
    $demarcacion = $_POST['demarcacion_2'];
    $unidad_territorial = $_POST['unidad_territorial_2'];
    $tipo_asamblea = trim(utf8_decode($_POST['tipo_asamblea_2']));
    $lugar = htmlspecialchars(trim($_POST['lugar_2']), ENT_QUOTES);
    $lugar_1 = utf8_decode($lugar);
    $fecha = $_POST['fecha_2'];
    $hora = $_POST['hora_2'];
    $asamblea_cancelada = $_POST['asamblea_cancelada_2'];
    $cancelacion = isset($_POST['cancelacion_2'])? $cancelacion = htmlspecialchars(trim($_POST['cancelacion_2'])) : $cancelacion = "";
    $cancelacion_1 = utf8_decode($cancelacion);

    $total_1_1 = isset($_POST['total_1_2'])? $total_1_1 = trim($_POST['total_1_2']):$total_1_1 = "";
    $mujeres_1_1 = isset($_POST['mujeres_1_2'])? $mujeres_1_1 = trim($_POST['mujeres_1_2']):$mujeres_1_1 = "";
    $hombres_1_1 = isset($_POST['hombres_1_2'])? $hombres_1_1 = trim($_POST['hombres_1_2']):$hombres_1_1 = "";
    $otros_1_1 = isset($_POST['otros_1_2'])? $otros_1_1 = trim($_POST['otros_1_2']):$otros_1_1 = "";

    $total_2_1 = isset($_POST['total_2_2'])? $total_2_1 = trim($_POST['total_2_2']):$total_2_1 = "";
    $mujeres_2_1 = isset($_POST['mujeres_2_2'])? $mujeres_2_1 = trim($_POST['mujeres_2_2']):$mujeres_2_1 = "";
    $hombres_2_1 = isset($_POST['hombres_2_2'])? $hombres_2_1 = trim($_POST['hombres_2_2']):$hombres_2_1 = "";
    $otros_2_1 = isset($_POST['otros_2_2'])? $otros_2_1 = trim($_POST['otros_2_2']):$otros_2_1 = "";

    $total_3_1 = isset($_POST['total_3_2'])? $total_3_1 = trim($_POST['total_3_2']):$total_3_1 = "";
    $mujeres_3_1 = isset($_POST['mujeres_3_2'])? $mujeres_3_1 = trim($_POST['mujeres_3_2']):$mujeres_3_1 = "";
    $hombres_3_1 = isset($_POST['hombres_3_2'])? $hombres_3_1 = trim($_POST['hombres_3_2']):$hombres_3_1 = "";
    $otros_3_1 = isset($_POST['otros_3_2'])? $otros_3_1 = trim($_POST['otros_3_2']):$otros_3_1 = "";

    $total_4_1 = isset($_POST['total_4_2'])? $total_4_1 = trim($_POST['total_4_2']):$total_4_1 = "";
    $mujeres_4_1 = isset($_POST['mujeres_4_2'])? $mujeres_4_1 = trim($_POST['mujeres_4_2']):$mujeres_4_1 = "";
    $hombres_4_1 = isset($_POST['hombres_4_2'])? $hombres_4_1 = trim($_POST['hombres_4_2']):$hombres_4_1 = "";
    $otros_4_1 = isset($_POST['otros_4_2'])? $otros_4_1 = trim($_POST['otros_4_2']):$otros_4_1 = "";

    $total_5_1 = isset($_POST['total_5_2'])? $total_5_1 = trim($_POST['total_5_2']):$total_5_1 = "";
    $mujeres_5_1 = isset($_POST['mujeres_5_2'])? $mujeres_5_1 = trim($_POST['mujeres_5_2']):$mujeres_5_1 = "";
    $hombres_5_1 = isset($_POST['hombres_5_2'])? $hombres_5_1 = trim($_POST['hombres_5_2']):$hombres_5_1 = "";
    $otros_5_1 = isset($_POST['otros_5_2'])? $otros_5_1 = trim($_POST['otros_5_2']):$otros_5_1 = "";

    $total_6_1 = isset($_POST['total_6_2'])? $total_6_1 = trim($_POST['total_6_2']):$total_6_1 = "";
    $mujeres_6_1 = isset($_POST['mujeres_6_2'])? $mujeres_6_1 = trim($_POST['mujeres_6_2']):$mujeres_6_1 = "";
    $hombres_6_1 = isset($_POST['hombres_6_2'])? $hombres_6_1 = trim($_POST['hombres_6_2']):$hombres_6_1 = "";
    $otros_6_1 = isset($_POST['otros_6_2'])? $otros_6_1 = trim($_POST['otros_6_2']):$otros_6_1 = "";

    $total_7_1 = isset($_POST['total_7_2'])? $total_7_1 = trim($_POST['total_7_2']):$total_7_1 = "";
    $mujeres_7_1 = isset($_POST['mujeres_7_2'])? $mujeres_7_1 = trim($_POST['mujeres_7_2']):$mujeres_7_1 = "";
    $hombres_7_1 = isset($_POST['hombres_7_2'])? $hombres_7_1 = trim($_POST['hombres_7_2']):$hombres_7_1 = "";
    $otros_7_1 = isset($_POST['otros_7_2'])? $otros_7_1 = trim($_POST['otros_7_2']):$otros_7_1 = "";

    $total_8_1 = isset($_POST['total_8_2'])? $total_8_1 = trim($_POST['total_8_2']):$total_8_1 = "";
    $mujeres_8_1 = isset($_POST['mujeres_8_2'])? $mujeres_8_1 = trim($_POST['mujeres_8_2']):$mujeres_8_1 = "";
    $hombres_8_1 = isset($_POST['hombres_8_2'])? $hombres_8_1 = trim($_POST['hombres_8_2']):$hombres_8_1 = "";
    $otros_8_1 = isset($_POST['otros_8_2'])? $otros_8_1 = trim($_POST['otros_8_2']):$otros_8_1 = "";

    $rango_1_1 = isset($_POST['rango_1_2'])? $rango_1_1 = trim($_POST['rango_1_2']): $rango_1_1 = "";
    $rango_2_1 = isset($_POST['rango_2_2'])? $rango_2_1 = trim($_POST['rango_2_2']): $rango_2_1 = "";
    $rango_3_1 = isset($_POST['rango_3_2'])? $rango_3_1 = trim($_POST['rango_3_2']): $rango_3_1 = "";
    $rango_4_1 = isset($_POST['rango_4_2'])? $rango_4_1 = trim($_POST['rango_4_2']): $rango_4_1 = "";
    $rango_5_1 = isset($_POST['rango_5_2'])? $rango_5_1 = trim($_POST['rango_5_2']): $rango_5_1 = "";
    $rango_6_1 = isset($_POST['rango_6_2'])? $rango_6_1 = trim($_POST['rango_6_2']): $rango_6_1 = "";
    $rango_7_1 = isset($_POST['rango_7_2'])? $rango_7_1 = trim($_POST['rango_7_2']): $rango_7_1 = "";

    
    $elaboro_1 = htmlspecialchars(trim($_POST['elaboro_2']), ENT_QUOTES);
    $elaboro_1_1 = utf8_decode($elaboro_1);
    $observaciones_1 = htmlspecialchars(trim($_POST['observaciones_2']), ENT_QUOTES);
 
    $observaciones_1_1 = utf8_decode($observaciones_1);

    $transaccion = $_SESSION['id_transaccion'];
    $id_usuario = $_SESSION['id_usuario'];

    $actual = date("Y/m/d");
    $fecha1 = date('Y/m/d', strtotime($_POST['fecha_2']));

    if ($actual > $fecha1 && $_POST['asamblea_cancelada_2'] == '2') {
        $celebrada = 'SI';
    } else {
        $celebrada = 'NO';
    }


    $query = "INSERT INTO sireac_formato2 VALUES ('$id_distrito', '$unidad_territorial', '$demarcacion', current_timestamp, '$tipo_asamblea', '$lugar_1', 'SI', '$celebrada', '$fecha', '$hora', '$asamblea_cancelada', '$cancelacion_1', '$total_1_1', '$mujeres_1_1', '$hombres_1_1', '$otros_1_1', '$total_2_1', '$mujeres_2_1', '$hombres_2_1', '$otros_2_1', '$total_3_1', '$mujeres_3_1', '$hombres_3_1', '$otros_3_1', '$total_4_1', '$mujeres_4_1', '$hombres_4_1', '$otros_4_1', '$total_5_1', '$mujeres_5_1', '$hombres_5_1', '$otros_5_1', '$total_6_1', '$mujeres_6_1', '$hombres_6_1', '$otros_6_1', '$total_7_1', '$mujeres_7_1', '$hombres_7_1', '$otros_7_1', '$total_8_1', '$mujeres_8_1', '$hombres_8_1', '$otros_8_1', '$rango_1_1', '$rango_2_1', '$rango_3_1', '$rango_4_1', '$rango_5_1', '$rango_6_1', '$rango_7_1', '$elaboro_1_1',current_timestamp, '$transaccion', '$observaciones_1_1', '$id_usuario', current_timestamp, current_timestamp, 'T')";

    if(!sqlsrv_query($conn, $query)){
        $respuesta = array('respuesta' => 'error1',
                            'titulo' => '¡Error!',
                            'mensaje' => $query);
    }else{
		$respuesta = array('respuesta' => 'exito',
                            'titulo' => 'Buen trabajo!!!',
                            'mensaje' => 'El registro se completó con éxito');
    }
    
    die (json_encode($respuesta));
?>