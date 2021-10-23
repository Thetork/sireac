eventListeners();

function eventListeners() {
    if (document.getElementById('form-login-censo')) {
        document.getElementById('form-login-censo').addEventListener('submit', fn_login);
    }

}
function mayus(e) {
    e.value = e.value.toUpperCase();
}

function fn_login(e) {

    e.preventDefault();

    var usuario = $('#usuario').val();
    var contrasena = $('#contrasena').val();
    $.post("php/login.php", {
        usuario: usuario,
        contrasena: contrasena
    }, function(result) {
        console.log(result);
        var obj = JSON.parse(result);
        if (obj.success) {
            if(obj.id === 1) {
                window.location.replace('eleccion.php');
            } else if(obj.id === 2){
                window.location.replace('central.php');
            }
           

        } else {
            var res = '<div class="alert alert-warning"><p>' + obj.mensaje1 + '</p></div>';
            $("#errormsg").html(res);
        }
    });

}
var campos_max = 50;   //max de 10 campos

        var x1 = 5;
        $('#add_2020').click (function(e) {
                e.preventDefault();     //prevenir novos clicks
                if (x1 < campos_max) {
                    var cadena = "<div class='row'><div class='col-8 center'><label>"+x1+"</label></div><div class='col-4'><input class='in' name ='proyecto_2020[]' id = 'proyecto_2020_"+x1+"' type='text' maxlength='300' onkeyup= 'mayus(this)'></div></div>";
                        $('.proyecto_propuesto_2020').append(cadena);
                        x1++;
                }
        });


        var x2 = 5;
        $('#add_2021').click (function(e) {
                e.preventDefault();     //prevenir novos clicks
                if (x2 < campos_max) {
                    var cadena = "<div class='row'><div class='col-8 center'><label>"+x2+"</label></div><div class='col-4'><input class='in' name ='proyecto_2021[]' id = 'proyecto_2021_"+x2+"' type='text' maxlength='300' onkeyup= 'mayus(this)'></div></div>";
                        $('.proyecto_propuesto_2021').append(cadena);
                        x2++;
                }
        });
        

$(document).ready(function(){
    $('#form1').on('submit',function(e){
        e.preventDefault();
        $validar = true;
        validarSelect('#demarcacion_1');
        validarSelect('#unidad_territorial_1');
        validarText('#tipo_asamblea_1');
        validarTextNumeros('#lugar_1');
        validarFecha('#fecha_1');
        validarHora('#hora_1');
        validarSelect('#asamblea_cancelada_1');
        $valor = $('#asamblea_cancelada_1').val();
        if($valor == 1){
            validarText('#cancelacion_1');
        } else if($valor == ""){
            validarText('#cancelacion_1');
        } else{
            validarInputTextRequire('#cancelacion_1');
        }
        validarNumeros4('#total_1_1');
        validarNumeros('#mujeres_1_1');
        validarNumeros('#hombres_1_1');
        validarNumeros('#otros_1_1');
        validarNumeros4('#total_2_1');
        validarNumeros('#mujeres_2_1');
        validarNumeros('#hombres_2_1');
        validarNumeros('#otros_2_1');
        validarNumeros4('#total_3_1');
        validarNumeros('#mujeres_3_1');
        validarNumeros('#hombres_3_1');
        validarNumeros('#otros_3_1');
        validarNumeros4('#total_4_1');
        validarNumeros('#mujeres_4_1');
        validarNumeros('#hombres_4_1');
        validarNumeros('#otros_4_1');
        validarNumeros4('#total_5_1');
        validarNumeros('#mujeres_5_1');
        validarNumeros('#hombres_5_1');
        validarNumeros('#otros_5_1');
        validarNumeros4('#total_6_1');
        validarNumeros('#mujeres_6_1');
        validarNumeros('#hombres_6_1');
        validarNumeros('#otros_6_1');
        validarNumeros4('#total_7_1');
        validarNumeros('#mujeres_7_1');
        validarNumeros('#hombres_7_1');
        validarNumeros('#otros_7_1');
        validarNumeros4('#total_8_1');
        validarNumeros('#mujeres_8_1');
        validarNumeros('#hombres_8_1');
        validarNumeros('#otros_8_1');
        validarNumeros('#rango_1_1');
        validarNumeros('#rango_2_1');
        validarNumeros('#rango_3_1');
        validarNumeros('#rango_4_1');
        validarNumeros('#rango_5_1');
        validarNumeros('#rango_6_1');
        validarNumeros('#rango_7_1');
        validarInputTextRequire('#empate_1');
        validarInputTextRequire('#empate_2');
        validarInputTextRequire('#empate_3');
        validarInputTextRequire('#empate_4');
        for(i=0;i<50;i++)
        {
           validarInputTextRequire('#proyecto_2020_'+i+'');
           validarInputTextRequire('#proyecto_2021_'+i+'');
        }
        validarText('#elaboro_1');
        validarInputTextRequire('#observaciones_1');
    
        
        var datos = new FormData(this);
        
        var selec_empate1 = $('#select_empate_1 option:selected').text();
        var selec_empate2 = $('#select_empate_2 option:selected').text();
        var selec_empate3 = $('#select_empate_3 option:selected').text();
        var selec_empate4 = $('#select_empate_4 option:selected').text();

        datos.append('select_empate1', selec_empate1);
        datos.append('select_empate2', selec_empate2);
        datos.append('select_empate3', selec_empate3);
        datos.append('select_empate4', selec_empate4);

        if($validar){
            $.ajax({
                type: $(this).attr('method'),
                data: datos,
                url: $(this).attr('action'),
                cache: false,
                processData: false,  // tell jQuery not to process the data
                contentType: false, 
                success: function(response){
                console.log(response);
                 var respuesta = JSON.parse(response);
                 console.log(respuesta);
                    if(respuesta.respuesta == 'exito') {
                     Swal.fire({
                         title: respuesta.titulo,
                         text: respuesta.mensaje,
                         type: 'success',
                         confirmButtonText: 'Aceptar'
                       }).then((result) => {
                         if (result.value) {
                            window.location.href = "eleccion.php";
                         }
                       })
                    }else if(respuesta.respuesta == 'error1'){
                     Swal.fire({
                         type: 'error',
                         title: respuesta.titulo,
                         text: respuesta.mensaje
                       })
                    }
                }
            })
            
        } else {
            console.log("algun campo es incorrecto");
        }
        
    });

    $('#demarcacion_1').change(function(e){
        e.preventDefault();
        if ($('#demarcacion_1').val() != ""){
            var dema = $('#demarcacion_1').val();
            $('#unidad_territorial_1').load('./php/load.php',{accion: 1, dema: dema});
        }
    });
    $('#seleccionador').change(function(e){
        e.preventDefault();
        if ($('#seleccionador').val() != ""){
            var dema = $('#seleccionador').val();
            console.log(dema);
            window.location.href = "./reporte_demarcacion.php?demarcacion="+ dema;
        }
    });
    $('#unidad_territorial_1').change(function(e){
        e.preventDefault();
        if ($('#unidad_territorial_1').val() != ""){
            var cve = $('#unidad_territorial_1').val();
            $('#select_empate_1').load('./php/load.php',{accion: 2, cve: cve});
            $('#select_empate_2').load('./php/load.php',{accion: 3, cve: cve});
            $('#select_empate_3').load('./php/load.php',{accion: 4, cve: cve});
            $('#select_empate_4').load('./php/load.php',{accion: 5, cve: cve});
        }
    });

    $('#select_empate_1').change(function(e){
        e.preventDefault();
        if ($('#select_empate_1').val() == "OTRO") {
            var cadena = `<div class="col-8" id="div_otro1">
                            <label>OTRO PROYECTO GANADOR 2020 (DESEMPATE EN 1er LUGAR)</label>
                        </div>
                        <div class="col-4" id="div_otro1">
                            <input class="in" name ="empate_1" id = "empate_1" type="text" onkeyup= "mayus(this)">
                        </div>`;
            $('#divempate_1').append(cadena);
        } else {
            document.querySelector('#empate_1').remove();
            document.querySelector('#div_otro1').remove();
        }
    });

    $('#select_empate_2').change(function(e){
        e.preventDefault();
        if ($('#select_empate_2').val() == "OTRO") {
            var cadena = `<div class="col-8" id="div_otro2">
                            <label>OTRO PROYECTO SEGUNDO LUGAR 2020 (DESEMPATE EN 2o LUGAR)</label>
                        </div>
                        <div class="col-4" id="div_otro2">
                            <input class="in" name ="empate_2" id = "empate_2" type="text" onkeyup= "mayus(this)">
                        </div>`;
            $('#divempate_2').append(cadena);
        } else {
            document.querySelector('#empate_2').remove();
            document.querySelector('#div_otro2').remove();
        }
    });

    $('#select_empate_3').change(function(e){
        e.preventDefault();
        if ($('#select_empate_3').val() == "OTRO") {
            var cadena = `<div class="col-8" id="div_otro3">
                            <label>OTRO PROYECTO GANADOR 2021 (DESEMPATE EN 1er LUGAR)</label>
                        </div>
                        <div class="col-4" id="div_otro3">
                            <input class="in" name ="empate_3" id = "empate_3" type="text" onkeyup= "mayus(this)">
                        </div>`;
            $('#divempate_3').append(cadena);
        } else {
            document.querySelector('#empate_3').remove();
            document.querySelector('#div_otro3').remove();
        }
    });

    $('#select_empate_4').change(function(e){
        e.preventDefault();
        if ($('#select_empate_4').val() == "OTRO") {
            var cadena = `<div class="col-8" id="div_otro4">
                            <label>OTRO PROYECTO SEGUNDO LUGAR 2021 (DESEMPATE EN 2o LUGAR)</label>
                        </div>
                        <div class="col-4" id="div_otro4">
                            <input class="in" name ="empate_4" id = "empate_4" type="text" onkeyup= "mayus(this)">
                        </div>`;
            $('#divempate_4').append(cadena);
        } else {
            document.querySelector('#empate_4').remove();
            document.querySelector('#div_otro4').remove();
        }
    });

    // function validarInputText($valor) {
    //     var $searchValue = $($valor).val();
    //     $texto = /^[a-zA-Z0-9 áéíóúü.]*$/;
    // if ($searchValue === "" || $searchValue === null) {
    //         $($valor).focus();
    //         var error = '<br><span class="display-block " style="color: red;">Error. Campo vacío.</span>';
    //         $($valor).after($(error).show());
    //         $($valor).css( "border-color","red");
    //         return $validar = false;
    //  }else if(!$texto.test($searchValue)){
    //     $($valor).focus();
    //     var error = '<br><span class="display-block " style="color: red;">Texto o carácter inválido.</span>';
    //                 $($valor).after($(error));

    //     $($valor).css( "border-color","red");
    //     return $validar = false;
    //  }
    //  }
     function validarInputTextRequire($valor) {
     
        $($valor).css( "border-color","black");
        var $searchValue = $($valor).val();
        $texto = /^[a-zA-Z áéíóúüñ ÁÉÍÓÚÜÑ.'"]*$/;
     if(!$texto.test($searchValue)){
        $($valor).next('div').remove();
        $($valor).focus();
        var error = '<div class="display-block ocultar"><span style="color: red;">Error. Carácter inválido.</span></div>';
        $($valor).after($(error));
        $($valor).css( "border-color","red");
        return $validar = false;
     }
     else{
        
        $($valor).next('div').remove();
        $($valor).css( "border-color","black");
    
     }
     }
     
     function validarText($valor) {
        // console.log(e.target());
        var $searchValue = $($valor).val();
        $texto = /^[a-zA-Z áéíóúüñ ÁÉÍÓÚÜÑ.'"]*$/;
    if ($searchValue === "" || $searchValue === null) {
        $($valor).next('div').remove();
            $($valor).focus();
            var error = '<div class="display-block ocultar"><span style="color: red;">Error. Campo vacío.</span></div>';
            $($valor).after($(error));
            $($valor).css( "border-color","red");
            return $validar = false;
     }else if(!$texto.test($searchValue)){
        $($valor).next('div').remove();

        $($valor).focus();
        var error = '<div class="display-block ocultar"><span style="color: red;">Error. Carácter inválido.</span></div>';
        $($valor).after($(error));
        $($valor).css( "border-color","red");
        return $validar = false;
     } else{
        $($valor).next('div').remove();
        $($valor).css( "border-color","black");
     }
     }
     function validarTextNumeros($valor) {
        // console.log(e.target());
        var $searchValue = $($valor).val();
        $texto = /^[a-zA-Z0-9 áéíóúüñ ÁÉÍÓÚÜÑ.'"]*$/;
    if ($searchValue === "" || $searchValue === null) {
        $($valor).next('div').remove();
            $($valor).focus();
            var error = '<div class="display-block ocultar"><span style="color: red;">Error. Campo vacío.</span></div>';
            $($valor).after($(error));
            $($valor).css( "border-color","red");
            return $validar = false;
     }else if(!$texto.test($searchValue)){
        $($valor).next('div').remove();

        $($valor).focus();
        var error = '<div class="display-block ocultar"><span style="color: red;">Error. Carácter inválido.</span></div>';
        $($valor).after($(error));
        $($valor).css( "border-color","red");
        return $validar = false;
     } else{
        $($valor).next('div').remove();
        $($valor).css( "border-color","black");
     }
     }
     function validarNumeros4($valor){
     
        $($valor).css( "border-color","black");
        var $searchValue = $($valor).val();
        var $Tamaño = $searchValue.length;
        
        console.log($Tamaño);
        $texto = /[0-9]/;
        
        if ($searchValue === "" || $searchValue === null) {
            $($valor).next('div').remove();
                $($valor).focus();
                var error = '<div class="display-block ocultar"><span style="color: red;">Error. Campo vacío.</span></div>';
                $($valor).after($(error));
                $($valor).css( "border-color","red");
                return $validar = false;
         }else if(!$texto.test($searchValue)){
            $($valor).next('div').remove();
            $($valor).focus();
            var error = '<div class="display-block ocultar"><span style="color: red;">Error. Solo se aceptan numeros.</span></div>';
                        $($valor).after($(error));

            $($valor).css( "border-color","red");
            return $validar = false;
         } else if ($Tamaño > 4) {
            $($valor).next('div').remove();
            $($valor).focus();
            var error = '<div class="display-block ocultar"><span style="color: red;">Error. El número no debe ser mayor a 4 digitos.</span></div>';
                        $($valor).after($(error));

            $($valor).css( "border-color","red");
            return $validar = false;
     }
     else{
        $($valor).next('div').remove();
        $($valor).css( "border-color","black");
     }
     }
     function validarNumeros($valor){
     
        $($valor).css( "border-color","black");
        var $searchValue = $($valor).val();
        var $Tamaño = $searchValue.length;
        console.log($Tamaño);
        $texto = /[0-9]/;
        if ($searchValue === "" || $searchValue === null) {
            $($valor).next('div').remove();
            $($valor).focus();
                var error = '<div class="display-block ocultar"><span style="color: red;">Error. Campo vacío.</span></div>';
                            $($valor).after($(error));

                $($valor).css( "border-color","red");
                return $validar = false;
         }else if(!$texto.test($searchValue)){
            $($valor).next('div').remove();
            $($valor).focus();
            var error = '<div class="display-block ocultar"><span style="color: red;">Error. Solo se aceptan numeros.</span></div>';
                        $($valor).after($(error));

            $($valor).css( "border-color","red");
            return $validar = false;
         } else if ($Tamaño > 3) {
            $($valor).next('div').remove();
            $($valor).focus();
            var error = '<div class="display-block ocultar"><span style="color: red;">Error. El número no debe ser mayor a 3 digitos.</span></div>';
                        $($valor).after($(error));

            $($valor).css( "border-color","red");
            return $validar = false;
     }
     else{
        $($valor).next('div').remove();
        $($valor).css( "border-color","black");
     }
     }
    function validarSelect($valor) {
     
        $($valor).css( "border-color","black");
        var $searchValue = $($valor).val();
        if ($searchValue === "" || $searchValue === null) {
            $($valor).next('div').remove();
            $($valor).focus();
            var error = '<div class="display-block ocultar"><span style="color: red;">Error. Seleccione una opcion.</span></div>';
                        $($valor).after($(error));

            $($valor).css( "border-color","red");
            return $validar = false;
     }
     else{
        $($valor).next('div').remove();
        $($valor).css( "border-color","black");
     }
    }
    function validarFecha($valor) {
     
        $($valor).css( "border-color","black");
        $value = $($valor).val();
        // var f = new Date();
        // var year  = f.getFullYear();
        // var month = (f.getMonth() + 1).toString().padStart(2, "0");
        // var day   = f.getDate().toString().padStart(2, "0");
        // $fecha = year + "-" + month + "-" + day;
        if($value === "" || $value === null){
            $($valor).next('div').remove();
            $($valor).focus();
            var error = '<div class="display-block ocultar"><span style="color: red;">Error. Coloque una fecha.</span></div>';
                        $($valor).after($(error));

            $($valor).css( "border-color","red");
            return $validar = false;
        }
        else{
            $($valor).next('div').remove();
            $($valor).css( "border-color","black");
         }
        // else if($fecha > $value){
        //     $($valor).focus();
        //     var error = '<br><span class="display-block " style="color: red;">Error.La fecha no puede ser inferior a la fecha actual.</span>';
        //                 $($valor).after($(error));

        //     $($valor).css( "border-color","red");
        //     return $validar = false;
        // }
    }
    function validarHora($valor) {
     
        $($valor).css( "border-color","black");
        var hora = $($valor).val();
        if (hora === "" || hora === null){
            $($valor).next('div').remove();
            $($valor).focus();
            var error = '<div class="display-block ocultar"><span style="color: red;">Error. Colocar una hora.</span></div>';
                        $($valor).after($(error));

            $($valor).css( "border-color","red");
            return $validar = false;
        }
        else{
            $($valor).next('div').remove();
            $($valor).css( "border-color","black");
         }
    }

    function soloNumeros(e){
     
        $($valor).css( "border-color","black");
        key = e.keyCode || e.which;
        tecla = String.fromCharCode(key).toLowerCase();
        letras = "1234567890";
        tecla_especial = false
        
        if (letras.indexOf(tecla) == -1 ) {
            return false;
        }
    }


});
    
    
