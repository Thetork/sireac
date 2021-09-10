<?php
session_start();
include "sqlconnector.php";
date_default_timezone_set('America/Mexico_City'); 
    $id_distrito = $_SESSION['id_distrito'];
    $demarcacion = $_POST['demarcacion_1'];
    $unidad_territorial = $_POST['unidad_territorial_1'];
    $tipo_asamblea = trim(utf8_decode($_POST['tipo_asamblea_1']));
    $lugar = htmlspecialchars(trim($_POST['lugar_1']), ENT_QUOTES);
    $lugar_1 = utf8_decode($lugar);
    $fecha = $_POST['fecha_1'];
    $hora = $_POST['hora_1'];
    $asamblea_cancelada = $_POST['asamblea_cancelada_1'];
    $cancelacion = htmlspecialchars(trim($_POST['cancelacion_1']));
    $cancelacion_1 = utf8_decode($cancelacion);

    $total_1_1 = trim($_POST['total_1_1']);
    $mujeres_1_1 = trim($_POST['mujeres_1_1']);
    $hombres_1_1 = trim($_POST['hombres_1_1']);
    $otros_1_1 = trim($_POST['otros_1_1']);

    $total_2_1 = trim($_POST['total_2_1']);
    $mujeres_2_1 = trim($_POST['mujeres_2_1']);
    $hombres_2_1 = trim($_POST['hombres_2_1']);
    $otros_2_1 = trim($_POST['otros_2_1']);

    $total_3_1 = trim($_POST['total_3_1']);
    $mujeres_3_1 = trim($_POST['mujeres_3_1']);
    $hombres_3_1 = trim($_POST['hombres_3_1']);
    $otros_3_1 = trim($_POST['otros_3_1']);

    $total_4_1 = trim($_POST['total_4_1']);
    $mujeres_4_1 = trim($_POST['mujeres_4_1']);
    $hombres_4_1 = trim($_POST['hombres_4_1']);
    $otros_4_1 = trim($_POST['otros_4_1']);

    $total_5_1 = trim($_POST['total_5_1']);
    $mujeres_5_1 = trim($_POST['mujeres_5_1']);
    $hombres_5_1 = trim($_POST['hombres_5_1']);
    $otros_5_1 = trim($_POST['otros_5_1']);

    $total_6_1 = trim($_POST['total_6_1']);
    $mujeres_6_1 = trim($_POST['mujeres_6_1']);
    $hombres_6_1 = trim($_POST['hombres_6_1']);
    $otros_6_1 = trim($_POST['otros_6_1']);

    $total_7_1 = trim($_POST['total_7_1']);
    $mujeres_7_1 = trim($_POST['mujeres_7_1']);
    $hombres_7_1 = trim($_POST['hombres_7_1']);
    $otros_7_1 = trim($_POST['otros_7_1']);

    $total_8_1 = trim($_POST['total_8_1']);
    $mujeres_8_1 = trim($_POST['mujeres_8_1']);
    $hombres_8_1 = trim($_POST['hombres_8_1']);
    $otros_8_1 = trim($_POST['otros_8_1']);

    $rango_1_1 = trim($_POST['rango_1_1']);
    $rango_2_1 = trim($_POST['rango_2_1']);
    $rango_3_1 = trim($_POST['rango_3_1']);
    $rango_4_1 = trim($_POST['rango_4_1']);
    $rango_5_1 = trim($_POST['rango_5_1']);
    $rango_6_1 = trim($_POST['rango_6_1']);
    $rango_7_1 = trim($_POST['rango_7_1']);
    
    if ($_POST['select_empate1'] == 'OTRO') {
        $empate_1 = trim(utf8_decode($_POST['empate_1']));
        $exiempate12020 = 1;    
    } else {
        if ($_POST['select_empate1'] == 'NO APLICA'){
            $exiempate12020 = 0;
        } else {
            $exiempate12020 = 1;
        }
        $empate_1 = trim(utf8_decode($_POST['select_empate1']));
    }
    
    if ($_POST['select_empate2'] == 'OTRO') {
        $empate_2 = trim(utf8_decode($_POST['empate_2']));   
        $exiempate22020 = 0; 
    } else {
        if ($_POST['select_empate2'] == 'NO APLICA'){
            $exiempate22020 = 0;
        } else {
            $exiempate22020 = 1;
        }
        $empate_2 = trim(utf8_decode($_POST['select_empate2']));
    }
    
    if ($_POST['select_empate3'] == 'OTRO') {
        $empate_3 = trim(utf8_decode($_POST['empate_3'])); 
        $exiempate12021 = 0;   
    } else {
        if ($_POST['select_empate3'] == 'NO APLICA'){
            $exiempate12021 = 0;
        } else {
            $exiempate12021 = 1;
        }
        $empate_3 = trim(utf8_decode($_POST['select_empate3']));
    }

    if ($_POST['select_empate4'] == 'OTRO') {
        $empate_4 = trim(utf8_decode($_POST['empate_4']));   
        $exiempate22021 = 0; 
    } else {
        if ($_POST['select_empate4'] == 'NO APLICA'){
            $exiempate22021 = 0;
        } else {
            $exiempate22021 = 1;
        }
        $empate_4 = trim(utf8_decode($_POST['select_empate4']));
    }

        
    $array = array_map('htmlentities', $_POST['proyecto_2020']);
    $array1 = array_map('trim', $array);

    $proyecto_2020 = json_encode($array1);

    $array2 = array_map('htmlentities',$_POST['proyecto_2021']);
    $array3 = array_map('trim', $array2);
    $proyecto_2021 = json_encode($array3);
  

    $elaboro_1 = htmlspecialchars(trim($_POST['elaboro_1']), ENT_QUOTES);
    $elaboro_1_1 = utf8_decode($elaboro_1);
    $transaccion = $_SESSION['id_transaccion'];
    $observaciones_1 = htmlspecialchars(trim($_POST['observaciones_1']), ENT_QUOTES);
 
    $observaciones_1_1 = utf8_decode($observaciones_1);

    $id_usuario = $_SESSION['id_usuario'];
    

    $query = "INSERT into sireac_formato1 (id_distrito, clave_colonia, id_delegacion, fecha_ingreso, tipo_asamblea, lugar, fecha, hora, asamblea_cancelada, motivo_cancelacion, total_1, mujeres_1, hombres_1, otros_1, total_2, mujeres_2, hombres_2, otros_2, total_3, mujeres_3, hombres_3, otros_3, total_4, mujeres_4, hombres_4, otros_4, total_5, mujeres_5, hombres_5, otros_5, total_6, mujeres_6, hombres_6, otros_6, total_7, mujeres_7, hombres_7, otros_7, total_8, mujeres_8, hombres_8, otros_8, menor_16, edad_16_17, edad_18_29, edad_30_39, edad_40_49, edad_50_59, edad_60_mas, empates_1, empates_2, empates_3, empates_4, no_celebro_1, no_celebro_2, elaboro, fecha_modifica, id_transaccion, observaciones, id_usuario, fecha_alta, fecha_modif, estatus) values ('$id_distrito','$unidad_territorial','$demarcacion',current_timestamp,'$tipo_asamblea','$lugar_1','$fecha','$hora','$asamblea_cancelada','$cancelacion_1', '$total_1_1','$mujeres_1_1','$hombres_1_1','$otros_1_1', '$total_2_1','$mujeres_2_1','$hombres_2_1','$otros_2_1', '$total_3_1','$mujeres_3_1','$hombres_3_1','$otros_3_1', '$total_4_1','$mujeres_4_1','$hombres_4_1','$otros_4_1', '$total_5_1','$mujeres_5_1','$hombres_5_1','$otros_5_1', '$total_6_1','$mujeres_6_1','$hombres_6_1','$otros_6_1', '$total_7_1','$mujeres_7_1','$hombres_7_1','$otros_7_1', '$total_8_1','$mujeres_8_1','$hombres_8_1','$otros_8_1', '$rango_1_1','$rango_2_1','$rango_3_1','$rango_4_1','$rango_5_1','$rango_6_1','$rango_7_1',
        '$empate_1','$empate_2','$empate_3','$empate_4', '$proyecto_2020','$proyecto_2021', '$elaboro_1_1',current_timestamp,'$transaccion','$observaciones_1_1', '$id_usuario', current_timestamp, current_timestamp, 'T')";

    if (!sqlsrv_query($conn, $query)) {
        $respuesta = array('respuesta' => 'error1',
                            'titulo' => '¡Error!',
                            'mensaje' => $query);
    } else {

        $actual = date("Y/m/d");
        $fecha1 = date('Y/m/d', strtotime($_POST['fecha_1']));

        if ($actual > $fecha1 && $_POST['asamblea_cancelada_1'] == '2') {
            $celebrada = 'SI';
         } else {
            $celebrada = 'NO';
         }

        

        $upd = "UPDATE sireac_casos_especiales SET asamblea_convocada = 'SI', fecha = '$fecha', asamblea_celebrada = '$celebrada', empate_primer_lugar_2020 = '$exiempate12020', empate_segundo_lugar_2020 = '$exiempate22020',
        empate_primer_lugar_2021 = '$exiempate12021', empate_segundo_lugar_2021 = '$exiempate22021', proyecto_ganador_2020 = '$empate_1', proyecto_ganador_2021 = '$empate_3', proyecto_segundo_2020 = '$empate_2', 
        proyecto_segundo_2021 = '$empate_4', proyecto_propuesto_1_2020 = '$proyecto_2020', proyecto_propuesto_1_2021 = '$proyecto_2021', observaciones = '$observaciones_1_11', id_usuario = '$id_usuario', fecha_modif = current_timestamp, estatus = 'T'
        WHERE clave_territorial = '$unidad_territorial'";

        $sqlqryupd = sqlsrv_query($conn, $upd);

        if ($_POST['select_empate1'] != 'NO APLICA') {
            if ($_POST['select_empate1'] == 'OTRO') {
                $sqlupd = "UPDATE sireac_informacion_seleccion SET numero_ganador_2020 = '', nombre_ganador_2020 = '". $empate_1 ."' WHERE clave_territorial = '". $unidad_territorial ."'";    
            } else {
                $sqlupd = "UPDATE sireac_informacion_seleccion SET numero_ganador_2020 = '". $_POST['select_empate_1'] ."', nombre_ganador_2020 = '". $empate_1 ."' WHERE clave_territorial = '". $unidad_territorial ."'";
            }
            $qryupd = sqlsrv_query($conn, $sqlupd);
        
        } else {
            $qryupd = true;
        }

        if ($_POST['select_empate3'] != 'NO APLICA') {
            if ($_POST['select_empate3'] == 'OTRO') {
                $sqlupd2 = "UPDATE sireac_informacion_seleccion SET numero_ganador_2021 = '', nombre_ganador_2021 = '". $empate_3 ."' WHERE clave_territorial = '". $unidad_territorial ."'";    
            } else {
                $sqlupd2 = "UPDATE sireac_informacion_seleccion SET numero_ganador_2021 = '". $_POST['select_empate_3'] ."', nombre_ganador_2021 = '". $empate_3 ."' WHERE clave_territorial = '". $unidad_territorial ."'";
            }
            $qryupd2 = sqlsrv_query($conn, $sqlupd2);
            echo $sqlupd2;
        } else {
            $qryupd2 = true;
        }       

        if ($qryupd && $qryupd2 && $sqlqryupd ) {
            $respuesta = array('respuesta' => 'exito',
                            'titulo' => 'Buen trabajo!!!',
                            'mensaje' => 'El registro se completó con éxito');
        } else {
            $respuesta = array('respuesta' => 'error1',
                            'titulo' => '¡Error!',
                            'mensaje' => $sqlupd2);
        }	
    }

    die(json_encode($respuesta));

?>