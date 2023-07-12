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



