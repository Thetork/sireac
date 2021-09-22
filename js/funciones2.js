function mayus(e) {
    e.value = e.value.toUpperCase();
}

function sumar (valor, id) {
    var last = id.substr(id.length - 4);
    let hombre = "#hombres", 
        mujer = "#mujeres",
        otro = "#otros";

    ($(hombre+last).val() == "") ? value_hom = 0 : value_hom = $(hombre+last).val();
    ($(mujer+last).val() == "") ? value_muj = 0 : value_muj = $(mujer+last).val();
    ($(otro+last).val() == "") ? value_otro = 0 : value_otro = $(otro+last).val();

    let res = parseInt(value_hom)+parseInt(value_muj)+parseInt(value_otro);
    $("#total"+last).val(res);

    // var total = 0;    
    //   var last = id.substr(id.length - 4);
    
    // total = $('#total'+ last).val();
    //     // total = (Number(total)) ? 0 : total;
    //     // console.log(total);
    // // total = (isNaN(total)) ? $('#total'+ last).val(0) : total;
    // total = (total == null || total == undefined || total == "") ? 0 : total;

    // // valor = (isNaN(valor)) ? $('#total'+ last).val(0) : valor;
    // valor = (valor == null || valor == undefined || valor == "") ? 0 : valor;
    // // total = (total == "" || !total) ? total = 0 : total = total;
    // total = (parseInt(total) + parseInt(valor));
    // $('#total'+ last).val(total);  
    // console.log( total);
}


$(document).ready(function(){
    $('#form2').on('submit',function(e){
        e.preventDefault();
        $validar = true;
        validarSelect('#demarcacion_2');
        validarSelect('#unidad_territorial_2');
        validarText('#tipo_asamblea_2');
        validarTextNumeros('#lugar_2');
        validarFecha('#fecha_2');
        validarHora('#hora_2');
        validarSelect('#asamblea_cancelada_2');
        $valor = $('#asamblea_cancelada_2').val();
        if($valor == 1){
            validarTextNumerosRequire('#cancelacion_2');
        } else if($valor == ""){
            validarTextNumerosRequire('#cancelacion_2');
        } else{
            validarTextNumerosRequire('#cancelacion_2');
        }
        if($valor == 1 ) {
        validarNumeros4Require('#total_1_2');
        validarNumeros4Require('#mujeres_1_2');
        validarNumeros4Require('#hombres_1_2');
        validarNumeros4Require('#otros_1_2');
        validarNumeros4Require('#total_2_2');
        validarNumeros4Require('#mujeres_2_2');
        validarNumeros4Require('#hombres_2_2');
        validarNumeros4Require('#otros_2_2');
        validarNumeros4Require('#total_3_2');
        validarNumeros4Require('#mujeres_3_2');
        validarNumeros4Require('#hombres_3_2');
        validarNumeros4Require('#otros_3_2');
        validarNumeros4Require('#total_4_2');
        validarNumeros4Require('#mujeres_4_2');
        validarNumeros4Require('#hombres_4_2');
        validarNumeros4Require('#otros_4_2');
        validarNumeros4Require('#total_5_2');
        validarNumeros4Require('#mujeres_5_2');
        validarNumeros4Require('#hombres_5_2');
        validarNumeros4Require('#otros_5_2');
        validarNumeros4Require('#total_6_2');
        validarNumeros4Require('#mujeres_6_2');
        validarNumeros4Require('#hombres_6_2');
        validarNumeros4Require('#otros_6_2');
        validarNumeros4Require('#total_7_2');
        validarNumeros4Require('#mujeres_7_2');
        validarNumeros4Require('#hombres_7_2');
        validarNumeros4Require('#otros_7_2');
        validarNumeros4Require('#total_8_2');
        validarNumeros4Require('#mujeres_8_2');
        validarNumeros4Require('#hombres_8_2');
        validarNumeros4Require('#otros_8_2');
        validarNumeros4Require('#rango_1_2');
        validarNumeros4Require('#rango_2_2');
        validarNumeros4Require('#rango_3_2');
        validarNumeros4Require('#rango_4_2');
        validarNumeros4Require('#rango_5_2');
        validarNumeros4Require('#rango_6_2');
        validarNumeros4Require('#rango_7_2');
        } else{
        validarNumeros4('#total_1_2');
        validarNumeros('#mujeres_1_2');
        validarNumeros('#hombres_1_2');
        validarNumeros('#otros_1_2');
        validarNumeros4('#total_2_2');
        validarNumeros('#mujeres_2_2');
        validarNumeros('#hombres_2_2');
        validarNumeros('#otros_2_2');
        validarNumeros4('#total_3_2');
        validarNumeros('#mujeres_3_2');
        validarNumeros('#hombres_3_2');
        validarNumeros('#otros_3_2');
        validarNumeros4('#total_4_2');
        validarNumeros('#mujeres_4_2');
        validarNumeros('#hombres_4_2');
        validarNumeros('#otros_4_2');
        validarNumeros4('#total_5_2');
        validarNumeros('#mujeres_5_2');
        validarNumeros('#hombres_5_2');
        validarNumeros('#otros_5_2');
        validarNumeros4('#total_6_2');
        validarNumeros('#mujeres_6_2');
        validarNumeros('#hombres_6_2');
        validarNumeros('#otros_6_2');
        validarNumeros4('#total_7_2');
        validarNumeros('#mujeres_7_2');
        validarNumeros('#hombres_7_2');
        validarNumeros('#otros_7_2');
        validarNumeros4('#total_8_2');
        validarNumeros('#mujeres_8_2');
        validarNumeros('#hombres_8_2');
        validarNumeros('#otros_8_2');
        validarNumeros('#rango_1_2');
        validarNumeros('#rango_2_2');
        validarNumeros('#rango_3_2');
        validarNumeros('#rango_4_2');
        validarNumeros('#rango_5_2');
        validarNumeros('#rango_6_2');
        validarNumeros('#rango_7_2');
    }
        validarTextNumeros('#elaboro_2');
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

    $('#demarcacion_2').change(function(e){
        e.preventDefault();
        if ($('#demarcacion_2').val() != ""){
            var dema = $('#demarcacion_2').val();
            $('#unidad_territorial_2').load('./php/load.php',{accion: 1, dema: dema});
        }
    });

    $('#asamblea_cancelada_2').change(function(e){
        e.preventDefault();
        $('.total').val("");
        if ($('#asamblea_cancelada_2').val() == 1) {
            $('#cancelacion_2').attr('disabled', false);
            $('.total').attr('disabled', true);
        } else if ($('#asamblea_cancelada_2').val() == 2) {
            $('#cancelacion_2').attr('disabled', true);
            $('.total').attr('disabled', false);
        } else if ($('#asamblea_cancelada_2').val() == "") {
            $('#cancelacion_2').attr('disabled', false);
            $('.total').attr('disabled', false);
		}
    });
    // $('#unidad_territorial_2').change(function(e){
    //     e.preventDefault();
    //     if ($('#unidad_territorial_2').val() != "") {
    //         var data =  {
    //             cve:$("#unidad_territorial_2").val(),
    //             accion:6
    //         };

    //         $.ajax({
    //             type: "POST",
    //             data: data,
    //             url: 'php/load.php',
    //             success: function(response) {
    //                 if(response == 'row1') {
    //                     Swal.fire({
    //                         type: 'warning',
    //                         title: 'Alerta!!!',
    //                         text: 'Ya se registró la asamblea para esta Unidad Territorial'
    //                     });

    //                     frm = document.forms['form2'];
    //                     for(i=0; ele=frm.elements[i]; i++) {
    //                         ele.disabled=true;
    //                     }
    //                     $("#unidad_territorial_2").attr("disabled", false);
    //                 } else {
    //                     frm = document.forms['form2'];
    //                     for(i=0; ele=frm.elements[i]; i++) {
    //                         ele.disabled=false;
    //                     }
    //                 }
    //             }
    //         })
    //     }        
    // });


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
        $texto = /^[a-zA-Z0-9 áéíóúüñ ÁÉÍÓÚÜÑ.,#'"]*$/;
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
     function validarTextNumerosRequire($valor) {
        // console.log(e.target());
        var $searchValue = $($valor).val();
        return $validar = true;
     }
     function validarNumeros4Require($valor){
     
        $($valor).css( "border-color","black");
        var $searchValue = $($valor).val();
        return $validar = true;
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
            var error = '<div class="display-block ocultar"><span style="color: red;">Error. Seleccione una opción.</span></div>';
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