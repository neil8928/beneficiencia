$(document).ready(function(){
    var carpeta = $("#carpeta").val();



    $(".tpvivienda").on('click','#btnguardartdg', function(e) {
        debugger;
        var _token          =   $('#token').val();
        let idopcion        =   $(this).attr('data_opcion');
        let idregistro      =   $(this).attr('data_id');

        let tenenciavivienda_id             =   $('#tenenciavivienda_id').val();
        let acreditepropiedadvivienda_id    =   $('#acreditepropiedadvivienda_id').val();
        let numeropisosvivienda             =   $('#numeropisosvivienda').val();
        let numeroambientevivienda          =   $('#numeroambientevivienda').val();

        let materialparedesvivienda_id      =   $('#materialparedesvivienda_id').val();
        let materialtechosvivienda_id       =   $('#materialtechosvivienda_id').val();
        let materialpisosvivienda_id        =   $('#materialpisosvivienda_id').val();

        let serviciopublicos                =   $('#serviciopublicos').val();
        let abastecimientoagua              =   $('#abastecimientoagua').val();
        let servicioshigienicos             =   $('#servicioshigienicos').val();
        let alumbradopublicovivienda        =   $('#alumbradopublicovivienda').val();

        data = {
            _token                          :   _token, 
            idopcion                        :   idopcion,
            idregistro                      :   idregistro,
            tenenciavivienda_id             :   tenenciavivienda_id,
            acreditepropiedadvivienda_id    :   acreditepropiedadvivienda_id,
            numeropisosvivienda             :   numeropisosvivienda,
            numeroambientevivienda          :   numeroambientevivienda,
            materialparedesvivienda_id      :   materialparedesvivienda_id,
            materialtechosvivienda_id       :   materialtechosvivienda_id,
            materialpisosvivienda_id        :   materialpisosvivienda_id,

            serviciopublicos                :   serviciopublicos,
            abastecimientoagua              :   abastecimientoagua,
            servicioshigienicos             :   servicioshigienicos,
            alumbradopublicovivienda        :   alumbradopublicovivienda,

        }
        //=========================================================
        abrircargando();
        $.ajax({            
            type    :   "POST",
            url     :   carpeta+"/ajax-actualizar-tab-datos-vivienda",
            data    :   data,
            success: function (data) {

                JSONdata     = JSON.parse(data);
                error        = JSONdata[0].error;
                mensaje      = JSONdata[0].mensaje;

                if(error==false){ 
                    cerrarcargando();
                    alertajax(mensaje); 
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
        //=========================================================

        return true;

    });    


    

});



