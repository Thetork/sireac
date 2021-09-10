function mayus(e) {
    e.value = e.value.toUpperCase();
}
var campos_max = 50;   //max de 10 campos

        var x1 = 11;
        $('#add_ejecucion_2020').click (function(e) {
                e.preventDefault();     //prevenir novos clicks
                if (x1 < campos_max) {
                    var cadena = "<div class='row'><div class='col-8 center'><label>"+x1+"</label></div><div class='col-4'><input class='in' name ='ejecucion_2020[] id ='ejecucion_"+x1+"_2020' type='text' maxlength='300' onkeyup= 'mayus(this)'></div></div>";
                        $('.ejecucion_2020').append(cadena);
                        x1++;
                }
        });


        var x2 = 11;
        $('#add_vigilancia_2020').click (function(e) {
                e.preventDefault();     //prevenir novos clicks
                if (x2 < campos_max) {
                    var cadena = "<div class='row'><div class='col-8 center'><label>"+x2+"</label></div><div class='col-4'><input class='in' name ='vigilancia_2020[]' id ='vigilancia_2020_"+x2+"' type='text' maxlength='300' onkeyup= 'mayus(this)'></div></div>";
                        $('.vigilancia_2020').append(cadena);
                        x2++;
                }
        });
        var x3 = 11; 
        $('#add_ejecucion_2021').click (function(e) {
            e.preventDefault();     //prevenir novos clicks
            if (x3 < campos_max) {
                var cadena = "<div class='row'><div class='col-8 center'><label>"+x3+"</label></div><div class='col-4'><input class='in' name ='ejecucion_2021[] id ='ejecucion_"+x3+"_2021' type='text' maxlength='300' onkeyup= 'mayus(this)'></div></div>";
                    $('.ejecucion_2021').append(cadena);
                    x3++;
            }
    });


    var x4 = 11;
    $('#add_vigilancia_2021').click (function(e) {
            e.preventDefault();     //prevenir novos clicks
            if (x4 < campos_max) {
                var cadena = "<div class='row'><div class='col-8 center'><label>"+x4+"</label></div><div class='col-4'><input class='in' name ='vigilancia_2021[]' id ='vigilancia_2021_"+x4+"' type='text' maxlength='300' onkeyup= 'mayus(this)'></div></div>";
                    $('.vigilancia_2021').append(cadena);
                    x4++;
            }
    });

$(document).ready(function(){
    $('#form3').on('submit',function(e){
        e.preventDefault();
        $validar = true;
        validarSelect('#demarcacion_3');
        validarSelect('#unidad_territorial_3');
        validarText('#tipo_asamblea_3');
        validarTextNumeros('#lugar_3');
        validarFecha('#fecha_3');
        validarHora('#hora_3');
        validarSelect('#asamblea_cancelada_3');
        $valor = $('#asamblea_cancelada_3').val();
        if($valor == 1){
            validarText('#cancelacion_3');
        } else if($valor == ""){
            validarText('#cancelacion_3');
        } else{
            validarInputTextRequire('#cancelacion_3');
        }
        validarNumeros4('#total_1_3');
        validarNumeros('#mujeres_1_3');
        validarNumeros('#hombres_1_3');
        validarNumeros('#otros_1_3');
        validarNumeros4('#total_2_3');
        validarNumeros('#mujeres_2_3');
        validarNumeros('#hombres_2_3');
        validarNumeros('#otros_2_3');
        validarNumeros4('#total_3_3');
        validarNumeros('#mujeres_3_3');
        validarNumeros('#hombres_3_3');
        validarNumeros('#otros_3_3');
        validarNumeros4('#total_4_3');
        validarNumeros('#mujeres_4_3');
        validarNumeros('#hombres_4_3');
        validarNumeros('#otros_4_3');
        validarNumeros4('#total_5_3');
        validarNumeros('#mujeres_5_3');
        validarNumeros('#hombres_5_3');
        validarNumeros('#otros_5_3');
        validarNumeros4('#total_6_3');
        validarNumeros('#mujeres_6_3');
        validarNumeros('#hombres_6_3');
        validarNumeros('#otros_6_3');
        validarNumeros4('#total_7_3');
        validarNumeros('#mujeres_7_3');
        validarNumeros('#hombres_7_3');
        validarNumeros('#otros_7_3');
        validarNumeros4('#total_8_3');
        validarNumeros('#mujeres_8_3');
        validarNumeros('#hombres_8_3');
        validarNumeros('#otros_8_3');
        validarNumeros('#rango_1_3');
        validarNumeros('#rango_2_3');
        validarNumeros('#rango_3_3');
        validarNumeros('#rango_4_3');
        validarNumeros('#rango_5_3');
        validarNumeros('#rango_6_3');
        validarNumeros('#rango_7_3');

        for(i=0;i<50;i++)
        {
           validarInputTextRequire('#ejecucion_'+i+'_2020');
           validarInputTextRequire('#vigilancia_2020_'+i+'');
           
           validarInputTextRequire('#ejecucion_'+i+'_2021');
           validarInputTextRequire('#vigilancia_2021_'+i+'');
        }

        validarInputTextRequire('#persona_responsable_1');
        validarInputTextRequire('#persona_responsable_2');
        validarInputTextRequire('#persona_responsable_3');
        validarInputTextRequire('#persona_responsable_4');

        validarText('#elaboro_3');
        validarInputTextRequire('#observaciones_3');
        var datos = new FormData(this);
        
        if($validar){
            $.ajax({
                type: $(this).attr('method'),
                data: datos,
                url: $(this).attr('action'),
                cache: false,
                processData: false,
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
    $('.lista-desplegable').click(function(e){
        e.preventDefault();
        $cadena = '<li class="list-group-item lista-desplegable"><a href="reporte_demarcacion.php" class="links">Reporte Demarcación</a></li>';
        $('.lista_desplegable').append($cadena);
    });

    $('#demarcacion_3').change(function(e){
        e.preventDefault();
        if ($('#demarcacion_3').val() != ""){
            var dema = $('#demarcacion_3').val();
            $('#unidad_territorial_3').load('./php/load.php',{accion: 1, dema: dema});
        }
    });
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
})