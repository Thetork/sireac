<?php
  date_default_timezone_set('America/Mexico_City');
  include_once("sqlconnector.php"); 
  $usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);
  $contrasena = filter_input(INPUT_POST, 'contrasena', FILTER_SANITIZE_STRING);

  $usuario_correcto=false;

  $query="SELECT * FROM sireac_usuarios WHERE usuario = '".$usuario."' AND contrasena = '".$contrasena."' AND status = 'T'";
function get_real_ip()
{
  if (isset($_SERVER["HTTP_CLIENT_IP"])) {
      return $_SERVER["HTTP_CLIENT_IP"];
  } elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
      return $_SERVER["HTTP_X_FORWARDED_FOR"];
  } elseif (isset($_SERVER["HTTP_X_FORWARDED"])) {
      return $_SERVER["HTTP_X_FORWARDED"];
  } elseif (isset($_SERVER["HTTP_FORWARDED_FOR"])) {
      return $_SERVER["HTTP_FORWARDED_FOR"];
  } elseif (isset($_SERVER["HTTP_FORWARDED"])) {
      return $_SERVER["HTTP_FORWARDED"];
  } else {
      return $_SERVER["REMOTE_ADDR"];
  }
}
$ip = get_real_ip();
$nomcliente = gethostname();

$version_sistema = "sireac_produccion_1.0";


  $res = sqlsrv_query($conn,$query);

  if($row = sqlsrv_fetch_array($res)){
    if ($usuario == $row["usuario"]){
      if($contrasena == $row["contrasena"]){
        $usuario_correcto=true;
        $idusuario=$row["id_usuario"];
        $nombre=utf8_encode($row["nombre"]);
        $id_distrito=$row["id_distrito"];
        $estatus=$row["status"];
        $perfil = $row["perfil"];

        $sql = "INSERT INTO sireac_transaccion (id_distrito, version_sistema, ip_servidor, ip_cliente, nombre_cliente, id_usuario, fecha_hora) VALUES($id_distrito, '$version_sistema', '$serverName', '$ip', '$nomcliente', $idusuario, current_timestamp);";
        $qry = sqlsrv_query($conn, $sql);
        $id_trans = "SELECT SCOPE_IDENTITY() AS id_transaccion;";
        $es_trans = sqlsrv_query($conn, $id_trans);
        $row_trans = sqlsrv_fetch_array($es_trans);
        $id_transaccion = $row_trans['id_transaccion'];
        

      

      } else{
        $respuesta = array("success" => false, "mensaje1" => "Contraseña incorrecta");
        echo json_encode($respuesta);
        exit;
      }
    }
  } else{
    $respuesta = array("success" => false, "mensaje1" => "&bull; Verifique sus datos, usuario o contraseña incorrecta.");
    echo json_encode($respuesta);
    exit;
  }

  if($usuario_correcto && $perfil === 1 ){
      session_start();

      # NUESTRAS VARIABLES DE SESIÓN

      $usuario_correcto=true;
      $_SESSION['id_transaccion'] = $id_transaccion;
      $_SESSION['id_usuario']=$row["id_usuario"];
      $_SESSION['nombre']=utf8_encode($row["nombre"]);
      $_SESSION['id_distrito']=$row["id_distrito"];
      $_SESSION['estatus']=$row["status"];
      $_SESSION['perfil'] = $row['perfil'];

      echo json_encode(array("success" => true,"id"=> 1,"mensaje1"=>$query, "funciona"=>$usuario_correcto));

  } else if($usuario_correcto && $perfil === 2 ){
    session_start();

    # NUESTRAS VARIABLES DE SESIÓN
    $usuario_correcto=true;
    $_SESSION['id_transaccion'] = $id_transaccion;
    $_SESSION['id_usuario']=$row["id_usuario"];
    $_SESSION['nombre']=utf8_encode($row["nombre"]);
    $_SESSION['id_distrito']=$row["id_distrito"];
    $_SESSION['estatus']=$row["status"];
    $_SESSION['perfil'] = $row['perfil'];

    echo json_encode(array("success" => true,"id"=> 2,"mensaje1"=>$query, "funciona"=>$usuario_correcto));

}
?>
