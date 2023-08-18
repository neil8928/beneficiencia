$(document).ready(function(){

    // alerterrorajax('sss');
    $('#btnocultartif').on('click',function(event){
        $('#conttableinffam').hide(700);
    });


    $('#btnmostrartif').on('click',function(event){
        let valor = $('#conttableinffam').css('display');
        if(valor=='block'){
            $('#conttableinffam').hide(700);
        }
        else{
            $('#conttableinffam').show(700);
        }
    });

    $('#btnmostrartifotro').on('click',function(event){
        let valor = $('#conttableinffam').css('display');
        if(valor=='block'){
            $('#conttableinffam').hide(700);
        }
        else{
            $('#conttableinffam').show(700);
        }
    });


    // $('#btnagregarregistropreaprobar').on('click',function(e){
    //     debugger;
    //     var fechainicio  = $('#lblfecharegistropreaprob').val();
    //     var fecha  = $('#fecha').val();
    //     // alerterrorajax(fechainicio);
    //     if(isFechaMenor(fecha,fechainicio)){
    //         e.preventDefault();
    //         alerterrorajax('La Fecha de Pre-Aprobacion debe ser mayor a la fecha de Registro Encuesta');
    //         $('#fecha').focus();
    //         return false;
    //     }
    //     return true;
    // });

   


    $(".ficha").on('click','.tabsalud', function() {
        var _token          =   $('#token').val();
        let ficha_id        =   $(this).attr('data_ficha');
        let idopcion        =   $(this).attr('data_opcion');
        data            =   {
                                _token                      : _token,
                                ficha_id                    : ficha_id,
                                idopcion                    : idopcion,
                            };

        abrircargando();
        $.ajax({            
            type    :   "POST",
            url     :   carpeta+"/ajax-cargar-combo-familiar-salud",
            data    :   data,
            success: function (data) {
                cerrarcargando();
                $('.ajaxfamiliarsalud').html(data);
            },
            error: function (data) {
                cerrarcargando();
                if(data.status = 500){
                    /** error 505 **/
                    var contenido = $(data.responseText);
                    alerterror505ajax($(contenido).find('.trace-message').html()); 
                    console.log($(contenido).find('.trace-message').html());     
                }
            }
        });
    });

    $(".ficha").on('click','.tabse', function() {
        var _token          =   $('#token').val();
        let ficha_id        =   $(this).attr('data_ficha');
        let idopcion        =   $(this).attr('data_opcion');
        data            =   {
                                _token                      : _token,
                                ficha_id                    : ficha_id,
                                idopcion                    : idopcion,
                            };

        abrircargando();
        $.ajax({            
            type    :   "POST",
            url     :   carpeta+"/ajax-cargar-combo-familiar-se",
            data    :   data,
            success: function (data) {
                cerrarcargando();
                $('.ajaxfamiliarse').html(data);
            },
            error: function (data) {
                cerrarcargando();
                if(data.status = 500){
                    /** error 505 **/
                    var contenido = $(data.responseText);
                    alerterror505ajax($(contenido).find('.trace-message').html()); 
                    console.log($(contenido).find('.trace-message').html());     
                }
            }
        });
    });


    $(".ficha").on('click','.tabapoyo', function() {
        var _token          =   $('#token').val();
        let ficha_id        =   $(this).attr('data_ficha');
        let idopcion        =   $(this).attr('data_opcion');
        data            =   {
                                _token                      : _token,
                                ficha_id                    : ficha_id,
                                idopcion                    : idopcion,
                            };

        abrircargando();
        $.ajax({            
            type    :   "POST",
            url     :   carpeta+"/ajax-cargar-combo-familiar-apoyo",
            data    :   data,
            success: function (data) {
                cerrarcargando();
                $('.ajaxfamiliarapoyo').html(data);
            },
            error: function (data) {
                cerrarcargando();
                if(data.status = 500){
                    /** error 505 **/
                    var contenido = $(data.responseText);
                    alerterror505ajax($(contenido).find('.trace-message').html()); 
                    console.log($(contenido).find('.trace-message').html());     
                }
            }
        });
    });





    /////indclonar
    $(".indclonar").on('change', function(){  

        var valor = $(this).val();
        if(valor=='0'){       
            $('.sectionclonarusuario').hide(700);            
        }
        else{
            $('.sectionclonarusuario').show(700);            
        }
    });


    /////indclonardatos
    $("#frmreevaluarficha").on('change','.indclonardatos', function(){  
        var valor = $(this).val();
        if(valor=='0'){       
            $('.indsectionficha').hide(700);            
        }
        else{
            $('.indsectionficha').show(700);            
        }
    });



    function validarControlesFicha(){
        // debugger;
        debugger;
        let indclonar   = true;
        indclonar       = $('#frmregistrarficha #rad94').prop('checked');
        let dbeneficiario   =   $('#frmregistrarficha #beneficiario_id').select2('data');
        let beneficiario_id  =   '';
        let niveleducativo     =   '';
        if(dbeneficiario){
            beneficiario_id  =   dbeneficiario[0].id;
            niveleducativo     =   dbeneficiario[0].text;
        }

        if(indclonar){
            if(beneficiario_id==''){
                alerterrorajax("Seleccione un Usuario");
                $('#frmregistrarficha #beneficiario_id').select2('open');
                return false;
            }
        }

        return true;
    }

   $('#frmregistrarficha').submit(function() {
      debugger;
     //alert("el sobretiempo es : "+ $('#sobretiempo').val() + " y el dia es: " + $('#diasemana').val() + " y la marcacion es: " +$('#programacion').val());
        if(validarControlesFicha()){
            return true;
        }
        else{
            return false;
        }
   });


    function validarControlesReevaluarFicha(){
        // debugger;
        debugger;
        let indclonarbeneficiario   = true;
        indclonarbeneficiario       = $('#frmreevaluarficha .indclonarbeneficiario').prop('checked');

        let indclonardatos   = true;
        indclonardatos       = $('#frmreevaluarficha .indclonardatos').prop('checked');

        let indclonartpif   = true;
        indclonartpif       = $('#frmreevaluarficha .indclonartpif').prop('checked');

        let indclonartpsa   = true;
        indclonartpsa       = $('#frmreevaluarficha .indclonartpsa').prop('checked');

        let indclonartpbe   = true;
        indclonartpbe       = $('#frmreevaluarficha .indclonartpbe').prop('checked');

        let indclonartpvi   = true;
        indclonartpvi       = $('#frmreevaluarficha .indclonartpvi').prop('checked');

        let indclonartpcf   = true;
        indclonartpcf       = $('#frmreevaluarficha .indclonartpcf').prop('checked');



        return true;
    }
    
    $('#frmreevaluarficha .indclonartpif').on('change',function(e){
        let indclonartpif   = true;
        indclonartpif       = $('#frmreevaluarficha .indclonartpif').prop('checked');
        if(!indclonartpif){
            $('#frmreevaluarficha #rad56').prop('checked',false);
            $('#frmreevaluarficha #rad47').prop('checked',false);
            $('#frmreevaluarficha #rad45').prop('checked',false);
        }
    });

    $('#frmreevaluarficha').submit(function() {
      debugger;
        if(validarControlesReevaluarFicha()){
            return true;
        }
        else{
            return false;
        }
   });



    /////indsueldo
    $("#frmregistrarpermanencia .indsueldo").on('change', function(){  

        var valor = $(this).val();
        if(valor=='0'){       
            $('#frmregistrarpermanencia .sectionsueldomaximo').hide(700);            
        }
        else{
            $('#frmregistrarpermanencia .sectionsueldomaximo').show(700);            
        }
    });


    /////indcantpersonas
    $("#frmregistrarpermanencia .indcantpersonas").on('change', function(){  

        var valor = $(this).val();
        if(valor=='0'){       
            $('#frmregistrarpermanencia .sectioncantidadpersonas').hide(700);            
        }
        else{
            $('#frmregistrarpermanencia .sectioncantidadpersonas').show(700);            
        }
    });

    /////indsinlimite
    $("#frmregistrarpermanencia .indsinlimite").on('change', function(){  

        var valor = $(this).val();
        if(valor=='1'){       
            $('#frmregistrarpermanencia .sectionlimiteduracion').hide(700);            
        }
        else{
            $('#frmregistrarpermanencia .sectionlimiteduracion').show(700);            
        }
    });

    function validarControlesRegistrarPermanencia(){
        // debugger;
        debugger;
        let indsueldo   = true;
        indsueldo       = $('#frmregistrarpermanencia #rad80').prop('checked');
        let sueldomaximo   =   $('#frmregistrarpermanencia #sueldomaximo').val();
        if(indsueldo){
            if(sueldomaximo<=0){
                alerterrorajax("Ingrese Sueldo Maximo");
                $('#frmregistrarpermanencia #sueldomaximo').focus();
                return false;
            }
        }

        let indcantpersonas   = true;
        indcantpersonas       = $('#frmregistrarpermanencia #rad82').prop('checked');
        let cantpersonas   =   $('#frmregistrarpermanencia #cantpersonas').val();
        if(indcantpersonas){
            if(cantpersonas<=0){
                alerterrorajax("Ingrese Cantidad de Personas");
                $('#frmregistrarpermanencia #cantpersonas').focus();
                return false;
            }
        }

        let indsinlimite   = true;
        indsinlimite       = $('#frmregistrarpermanencia #rad28').prop('checked');
        let anios   =   parseInt($('#frmregistrarpermanencia #anios').val());
        let meses   =   parseInt($('#frmregistrarpermanencia #meses').val());
        let dias   =    parseInt($('#frmregistrarpermanencia #dias').val());
        
        if(!indsinlimite){
            if((anios+meses+dias)==0){
                alerterrorajax("Ingrese Duracion Permanencia");
                $('#frmregistrarpermanencia #anios').focus();
                return false;
            }
        }

        return true;
    }


    $('#frmregistrarpermanencia').submit(function() {
      debugger;
        if(validarControlesRegistrarPermanencia()){
            return true;
        }
        else{
            return false;
        }
    });



    function isFechaMenor(fechaInicial,fechaFinal)
    {
        debugger;
        if(fechaInicial.includes('/')){
            valuesStart=fechaInicial.split("/");
        }
        else{
            valuesStart=fechaInicial.split("-");
        }

       if(fechaFinal.includes('/')){
            valuesEnd=fechaFinal.split("/");
        }
        else{
            valuesEnd=fechaFinal.split("-");
        }

        debugger;
        // Verificamos que la fecha no sea posterior a la actual
        var dateStart=new Date(valuesStart[2],(valuesStart[1]-1),valuesStart[0]);
        var dateEnd=new Date(valuesEnd[2],(valuesEnd[1]-1),valuesEnd[0]);
        if(dateStart<dateEnd)
        {
            return true;
        }
        return false;
    }



    function isFechaMenorIgual(fechaInicial,fechaFinal)
    {
        if(fechaInicial.includes('/')){
            valuesStart=fechaInicial.split("/");
        }
        else{
            valuesStart=fechaInicial.split("-");
        }

       if(fechaFinal.includes('/')){
            valuesEnd=fechaFinal.split("/");
        }
        else{
            valuesEnd=fechaFinal.split("-");
        }

        debugger;
        // Verificamos que la fecha no sea posterior a la actual
        var dateStart=new Date(valuesStart[2],(valuesStart[1]-1),valuesStart[0]);
        var dateEnd=new Date(valuesEnd[2],(valuesEnd[1]-1),valuesEnd[0]);
        if(dateStart<=dateEnd)
        {
            return true;
        }
        return false;
    }

    function isFechaMayorIgual(fechaInicial,fechaFinal)
    {
        if(fechaInicial.includes('/')){
            valuesStart=fechaInicial.split("/");
        }
        else{
            valuesStart=fechaInicial.split("-");
        }

       if(fechaFinal.includes('/')){
            valuesEnd=fechaFinal.split("/");
        }
        else{
            valuesEnd=fechaFinal.split("-");
        }

        debugger;
        // Verificamos que la fecha no sea posterior a la actual
        var dateStart=new Date(valuesStart[2],(valuesStart[1]-1),valuesStart[0]);
        var dateEnd=new Date(valuesEnd[2],(valuesEnd[1]-1),valuesEnd[0]);
        if(dateStart>=dateEnd)
        {
            return true;
        }
        return false;
    }



    // $('#mtpsalud').on('click',function(event){
    //     debugger;
    //     let idficha = $('#idficha').val();
    //     llenarComboFamiliares(idficha,'#tsaotros #combofamiliaresof');
    //     return true;
    // });

    // $('#mtpsituacioneconomica').on('click',function(event){
    //     debugger;
    //     let idficha = $('#idficha').val();
    //     llenarComboFamiliares(idficha,'#frmactividadeseconomicas #combofamiliaresse');
    //     return true;
    // });
    
    // $('#mtpbeneficios').on('click',function(event){
    //     debugger;
    //     let idficha = $('#idficha').val();
    //     llenarComboFamiliares(idficha,'#tpbeneficios #combofamiliaresbe');
    //     return true;
    // });
    

    
    // function llenarComboFamiliares(idficha,divcombo)
    // {
    //     debugger;
    //     // alerterrorajax('registro es: '+ idficha);
    //     var _token              =   $('#token').val();
    //     data = {
    //             _token              :   _token, 
    //             idficha             :   idficha
    //         }
    //     debugger;
    //     var datacombofamiliar = $(divcombo).html();
    //     $(divcombo).html('');
    //     $.ajax({
    //             type    :   "POST",
    //             url     :   carpeta+"/ajax-get-combo-informacion-familiar",
    //             data    :   data,
    //             success: function (data) {
    //                 debugger;
    //                 $(divcombo).html(data);
    //             },
    //             error: function (data) {
    //                 error500(data);
    //                 $(divcombo).html(datacombofamiliar);
    //             }
    //     });
    //     return true;
    // }
    

    // function llenarComboFamiliares(idficha,combo)
    // {
    //     debugger;
    //     // alerterrorajax('registro es: '+ idficha);
    //     var _token              =   $('#token').val();
    //     data = {
    //             _token              :   _token, 
    //             idficha             :   idficha
    //         }

    //     debugger;
    //     var datacombofamiliar = $("#tsaotros .combofamiliares").html();
    //     $("#tsaotros #combofamiliaresof").html('');
    //     $("#frmactividadeseconomicas #combofamiliaresse").html('');
    //     $("#tpbeneficios #combofamiliaresbe").html('');
    //     $.ajax({
    //             type    :   "POST",
    //             url     :   carpeta+"/ajax-get-combo-informacion-familiar",
    //             data    :   data,
    //             success: function (data) {
    //                 // datacombofamiliar=data;
    //                 $("#tsaotros #combofamiliaresof").html(data);
    //                 $("#frmactividadeseconomicas #combofamiliaresse").html(data);
    //                 $("#tpbeneficios #combofamiliaresbe").html(data);
    //             },
    //             error: function (data) {
    //                 error500(data);
    //                 $("#tsaotros #combofamiliaresof").html(datacombofamiliar);
    //                 $("#frmactividadeseconomicas #combofamiliaresse").html(datacombofamiliar);
    //                 $("#tpbeneficios #combofamiliaresbe").html(datacombofamiliar);

    //             }
    //     });
    //     debugger;
    // }

});



