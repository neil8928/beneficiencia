$(document).ready(function(){

    var carpeta = $("#carpeta").val();

    $(".ficha").on('click','.icoclonar', function() {

        var _token                  =   $('#token').val();
        let ficha_id                =   $(this).attr('data_ficha');
        let idopcion                =   $(this).attr('data_opcion');

        data                        =   {
                                            _token                  : _token,
                                            ficha_id                : ficha_id,
                                            idopcion                : idopcion,
                                        };

        ajax_modal(data,"/ajax-modal-clonar",
                  "modal-observacion","modal-observacion-container");

    });


    $(".ficha").on('click','.btn-guardar-clonar', function() {
        debugger;
        var _token      = $('#token').val();
        var ficha_id                =   $('#ficha_id').val();
        var idopcion                =   $('#idopcion').val();
        var beneficiario_id         =   $('#beneficiario_id').val();

        if(beneficiario_id.length<=0){
            alerterrorajax("Seleccione un usuario para poder clonar");
            return false;
        }

        $('#modal-observacion').niftyModal('hide');

        data            =   {
                                _token                      : _token,
                                ficha_id                    : ficha_id,
                                idopcion                    : idopcion,
                                beneficiario_id             : beneficiario_id,
                            };
        abrircargando();
        $.ajax({            
            type    :   "POST",
            url     :   carpeta+"/ajax-guardar-clonar",
            data    :   data,
            success: function (data) {


                JSONdata     = JSON.parse(data);
                error        = JSONdata[0].error;
                mensaje      = JSONdata[0].mensaje;

                if(error==false){ 
                    cerrarcargando();
                    alertajax(mensaje);
                    location.reload();

                }else{
                    cerrarcargando();
                    alerterror505ajax(mensaje); 
                    return false;                
                }

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


