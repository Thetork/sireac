<?php
session_start();
include "sqlconnector.php";
date_default_timezone_set('America/Mexico_City'); 
    $id_distrito = $_SESSION['id_distrito'];
    $demarcacion = $_POST['demarcacion_3'];
    $unidad_territorial = $_POST['unidad_territorial_3'];
    $tipo_asamblea = trim(utf8_decode($_POST['tipo_asamblea_3']));
    $lugar = htmlspecialchars(trim($_POST['lugar_3']), ENT_QUOTES);
    $lugar_1 = utf8_decode($lugar);
    $fecha = $_POST['fecha_3'];
    $hora = $_POST['hora_3'];
    $asamblea_cancelada = $_POST['asamblea_cancelada_3'];
    $cancelacion = htmlspecialchars(trim($_POST['cancelacion_3'], ENT_QUOTES));
    $cancelacion_1 = utf8_decode($cancelacion);

    $total_1_1 = trim($_POST['total_1_3']);
    $mujeres_1_1 = trim($_POST['mujeres_1_3']);
    $hombres_1_1 = trim($_POST['hombres_1_3']);
    $otros_1_1 = trim($_POST['otros_1_3']);

    $total_2_1 = trim($_POST['total_2_3']);
    $mujeres_2_1 = trim($_POST['mujeres_2_3']);
    $hombres_2_1 = trim($_POST['hombres_2_3']);
    $otros_2_1 = trim($_POST['otros_2_3']);

    $total_3_1 = trim($_POST['total_3_3']);
    $mujeres_3_1 = trim($_POST['mujeres_3_3']);
    $hombres_3_1 = trim($_POST['hombres_3_3']);
    $otros_3_1 = trim($_POST['otros_3_3']);

    $total_4_1 = trim($_POST['total_4_3']);
    $mujeres_4_1 = trim($_POST['mujeres_4_3']);
    $hombres_4_1 = trim($_POST['hombres_4_3']);
    $otros_4_1 = trim($_POST['otros_4_3']);

    $total_5_1 = trim($_POST['total_5_3']);
    $mujeres_5_1 = trim($_POST['mujeres_5_3']);
    $hombres_5_1 = trim($_POST['hombres_5_3']);
    $otros_5_1 = trim($_POST['otros_5_3']);

    $total_6_1 = trim($_POST['total_6_3']);
    $mujeres_6_1 = trim($_POST['mujeres_6_3']);
    $hombres_6_1 = trim($_POST['hombres_6_3']);
    $otros_6_1 = trim($_POST['otros_6_3']);

    $total_7_1 = trim($_POST['total_7_3']);
    $mujeres_7_1 = trim($_POST['mujeres_7_3']);
    $hombres_7_1 = trim($_POST['hombres_7_3']);
    $otros_7_1 = trim($_POST['otros_7_3']);

    $total_8_1 = trim($_POST['total_8_3']);
    $mujeres_8_1 = trim($_POST['mujeres_8_3']);
    $hombres_8_1 = trim($_POST['hombres_8_3']);
    $otros_8_1 = trim($_POST['otros_8_3']);

    $rango_1_1 = trim($_POST['rango_1_3']);
    $rango_2_1 = trim($_POST['rango_2_3']);
    $rango_3_1 = trim($_POST['rango_3_3']);
    $rango_4_1 = trim($_POST['rango_4_3']);
    $rango_5_1 = trim($_POST['rango_5_3']);
    $rango_6_1 = trim($_POST['rango_6_3']);
    $rango_7_1 = trim($_POST['rango_7_3']);
   

    $array1 = array_map('htmlentities', $_POST['ejecucion_2020']);
    $array1_1 = array_map('trim', $array1);
    $ejecucion_2020 = json_encode($array1_1);
    $array2 = array_map('htmlentities', $_POST['vigilancia_2020']);
    $array2_1 = array_map('trim', $array2);
    $vigilancia_2020 = json_encode($array2_1);
    $array3 = array_map('htmlentities', $_POST['ejecucion_2021']);
    $array3_1 = array_map('trim', $array3);
    $ejecucion_2021 = json_encode($array3_1);
    $array4 = array_map('htmlentities', $_POST['vigilancia_2021']);
    $array4_1 = array_map('trim', $array4);
    $vigilancia_2021 = json_encode($array4_1);
   
    $responsable_1 = utf8_decode(trim($_POST['persona_responsable_1']));
   
    $responsable_2 = utf8_decode(trim($_POST['persona_responsable_2']));
    
    $responsable_3 = utf8_decode(trim($_POST['persona_responsable_3']));
   
    $responsable_4 = utf8_decode(trim($_POST['persona_responsable_4']));

    $elaboro_1 = htmlspecialchars(trim($_POST['elaboro_3']), ENT_QUOTES);
    $elaboro_1_1 = utf8_decode($elaboro_1);
    $transaccion = $_SESSION['id_transaccion'];
    $observaciones_1 = htmlspecialchars(trim($_POST['observaciones_3']), ENT_QUOTES);
 
    $observaciones_1_1 = utf8_decode($observaciones_1);
    $id_usuario = $_SESSION['id_usuario'];

    $query = "INSERT into sireac_formato3 (id_distrito, clave_colonia, id_delegacion, fecha_ingreso, tipo_asamblea, lugar, fecha, hora, asamblea_cancelada, motivo_cancelacion, total_1, mujeres_1, hombres_1, otros_1, total_2, mujeres_2, hombres_2, otros_2, total_3, mujeres_3, hombres_3, otros_3, total_4, mujeres_4, hombres_4, otros_4, total_5, mujeres_5, hombres_5, otros_5, total_6, mujeres_6, hombres_6, otros_6, total_7, mujeres_7, hombres_7, otros_7, total_8, mujeres_8, hombres_8, otros_8, menor_16, edad_16_17, edad_18_29, edad_30_39, edad_40_49, edad_50_59, edad_60_mas, comite_ejecucion_2020_1, persona_responsable_1, comite_vigilancia_2020_1, persona_responsable_2, comite_ejecucion_2021_1, persona_responsable_3, comite_vigilancia_2021_1, personsa_responsable_4, elaboro, fecha_modifica, id_transaccion, observaciones, id_usuario, fecha_alta, fecha_modif, estatus)
                                                 values ('$id_distrito','$unidad_territorial','$demarcacion',current_timestamp,'$tipo_asamblea','$lugar_1','$fecha','$hora','$asamblea_cancelada','$cancelacion_1',
                                                '$total_1_1','$mujeres_1_1','$hombres_1_1','$otros_1_1',
                                                '$total_2_1','$mujeres_2_1','$hombres_2_1','$otros_2_1',
                                                '$total_3_1','$mujeres_3_1','$hombres_3_1','$otros_3_1',
                                                '$total_4_1','$mujeres_4_1','$hombres_4_1','$otros_4_1',
                                                '$total_5_1','$mujeres_5_1','$hombres_5_1','$otros_5_1',
                                                '$total_6_1','$mujeres_6_1','$hombres_6_1','$otros_6_1',
                                                '$total_7_1','$mujeres_7_1','$hombres_7_1','$otros_7_1',
                                                '$total_8_1','$mujeres_8_1','$hombres_8_1','$otros_8_1',
                                                '$rango_1_1','$rango_2_1','$rango_3_1','$rango_4_1','$rango_5_1','$rango_6_1','$rango_7_1',
                                                '$ejecucion_2020','$responsable_1',
                                                '$vigilancia_2020','$responsable_2',
                                                '$ejecucion_2021', '$responsable_3',
                                                '$vigilancia_2021', '$responsable_4',
                                                '$elaboro_1_1',current_timestamp,'$transaccion','$observaciones_1_1', '$id_usuario', current_timestamp, current_timestamp, 'T')";

    if(!sqlsrv_query($conn, $query)){
        $respuesta = array('respuesta' => 'error1',
                            'titulo' => '¡Error!',
                            'mensaje' => $query);
    } else {

        $actual = date("Y/m/d");
        $fecha1 = date('Y/m/d', strtotime($_POST['fecha_3']));

        if ($actual > $fecha1 && $_POST['asamblea_cancelada_3'] == '2') {
            $celebrada = 'SI';
         } else {
            $celebrada = 'NO';
         }

         if ($responsable_1 == '') {
            $sino1 = "NO";
         } else {
            $sino1 = "SI";
         }

         if ($responsable_2 == '') {
            $sino2 = "NO";
         } else {
            $sino2 = "SI";
         }

         if ($responsable_3 == '') {
            $sino3 = "NO";
         } else {
            $sino3 = "SI";
         }

         if ($responsable_4 == '') {
            $sino4 = "NO";
         } else {
            $sino4 = "SI";
         }          

        $upd = "UPDATE sireac_informacion_seleccion SET asamblea_convocada = 'SI', fecha = '". $fecha ."', asamblea_celebrada = '". $celebrada ."', comite_ejecucion_2020 = '". $sino1 ."', comite_vigilancia_2020 = '". $sino2 ."', comite_ejecucion_2021 = '". $sino3 ."', comite_vigilancia_2021 = '". $sino4 ."', observaciones = '". $observaciones_1_1 ."' WHERE clave_territorial = '". $unidad_territorial ."'";

        $qryupd = sqlsrv_query($conn, $upd);

        if ($qryupd) {
            $respuesta = array('respuesta' => 'exito',
                            'titulo' => 'Buen trabajo!!!',
                            'mensaje' => 'El registro se completó con éxito');
        } else {
            $respuesta = array('respuesta' => 'error1',
                            'titulo' => '¡Error!',
                            'mensaje' => $upd);
        }
    }

    die(json_encode($respuesta));

?>