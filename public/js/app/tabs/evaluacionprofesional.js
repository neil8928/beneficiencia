$(document).ready(function(){

    

    $('.tpevaluacionprofesional').on('click','#btnguardartevalp',function(e){
        debugger;
       
        var _token          =   $('#token').val();
        let idopcion        =   $(this).attr('data_opcion');
        let idregistro      =   $(this).attr('data_id');

        let diagnosticosocial = $('#diagnosticosocial').val();
        if(diagnosticosocial.length<=0){
            alerterrorajax("Ingrese un Diagnostico");
            $('#tpevaluacionprofesional #diagnosticosocial').focus();
            return false;
        }

        let conclusiones = $('#conclusiones').val();
        if(conclusiones.length<=0){
            alerterrorajax("Ingrese una Conclusion");
            $('#tpevaluacionprofesional #conclusiones').focus();
            return false;
        }

        data = {
            _token              :   _token, 
            idopcion            :   idopcion,
            idregistro          :   idregistro,
            diagnosticosocial   :   diagnosticosocial,
            conclusiones        :   conclusiones        
        }
        //=========================================================
        abrircargando();
        $.ajax({            
            type    :   "POST",
            url     :   carpeta+"/ajax-actualizar-tab-datos-evaluacion-profesional",
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



