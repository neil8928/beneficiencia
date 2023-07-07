$(document).ready(function(){

    var carpeta = $("#carpeta").val();

    $(".ficha").on('click','.icoobservacion', function() {

        var _token                  =   $('#token').val();

        let observacion             =   $(this).attr('data_observacion');
        let ficha_id                =   $(this).attr('data_ficha');
        let tab                     =   $(this).attr('data_tab');
        let idopcion                =   $(this).attr('data_opcion');
        let data_descripcion        =   $(this).attr('data_descripcion');

        data                        =   {
                                            _token                  : _token,
                                            observacion             : observacion,
                                            ficha_id                : ficha_id,
                                            tab                     : tab,
                                            idopcion                : idopcion,
                                            data_descripcion        : data_descripcion,
                                        };

        ajax_modal(data,"/ajax-modal-observacion",
                  "modal-observacion","modal-observacion-container");

    });


    $(".ficha").on('click','.btn-guardar-observacion', function() {
        debugger;
        var _token      = $('#token').val();
        var ficha_id                =   $('#ficha_id').val();
        var tab                     =   $('#tab').val();
        var idopcion                =   $('#idopcion').val();
        var observacion             =   $('#observacion').val();

        //cerrar modal
        $('#modal-observacion').niftyModal('hide');

        data            =   {
                                _token                      : _token,
                                ficha_id                    : ficha_id,
                                tab                         : tab,
                                idopcion                    : idopcion,
                                observacion                 : observacion,
                            };

        var input   = 'observacion-'+tab;
        ajax_normal_guardar_observacion(data,"/ajax-guardar-observacion",input,observacion);                 

    });



});


