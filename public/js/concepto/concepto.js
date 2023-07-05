$(document).ready(function(){

    var carpeta = $("#carpeta").val();



    $(".lconceptos").on('click','.buscarconcepto', function() {

        event.preventDefault();

        var concepto_id =   $('#concepto_id').val();
        var idopcion    =   $('#idopcion').val();
        var _token      =   $('#token').val();


        data            =   {
                                _token      : _token,
                                concepto_id : concepto_id,
                                idopcion    : idopcion,
                            };
        ajax_normal(data,"/ajax-detalle-concepto");

    });





});

