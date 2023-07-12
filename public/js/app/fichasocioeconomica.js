$(document).ready(function(){

    // $('#boton-flotante').on('click',function(e){
    //     debugger;
    //     $("#menu-lateral").addClass("mostrar-menu");
    // });
    // $('.ir-arriba').click(function(){
    //     $('body, html').animate({
    //         scrollTop: '0px'
    //     }, 300);
    // });

    // $(window).scroll(function(){
    //     var windowWidth = $(window).width(); // Obtener el ancho de la ventana
    //     if( windowWidth > 600 ){
    //         if( $(this).scrollTop() > 0 ){
    //             $('.ir-arriba').slideDown(300);
    //         } else {
    //             $('.ir-arriba').slideUp(300);
    //         }
    //     }
    // });

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




    

});



