$(document).ready(function(){
    var carpeta = $("#carpeta").val();



    $(".tpconvivenciafamiliar").on('click','#btnguardartdg', function(e) {
        debugger;
        var _token          =   $('#token').val();
        let idopcion        =   $(this).attr('data_opcion');
        let idregistro      =   $(this).attr('data_id');


        let tipoviolenciageneral        =   $('#tipoviolenciageneral').val();
        let tipoviolenciahijo           =   $('#tipoviolenciahijo').val();
        let cfhabandono                 =   $('#cfhabandono').val();
        let cfhpensionalimenticia       =   $('#cfhpensionalimenticia').val();

        let cfhdenunciapension          =   $('#cfhdenunciapension').val();
        let cfhdenunciamaltrato         =   $('#cfhdenunciamaltrato').val();
        let institucionhijo             =   $('#institucionhijo').val();

        let tipoviolenciaabuelo         =   $('#tipoviolenciaabuelo').val();
        let cfamabandono                =   $('#cfamabandono').val();
        let cfampensionalimenticia      =   $('#cfampensionalimenticia').val();
        let cfamdenunciapension         =   $('#cfamdenunciapension').val();
        let cfamdenunciamaltrato        =   $('#cfamdenunciamaltrato').val();
        let institucionabuelo           =   $('#institucionabuelo').val();


        data = {
            _token                          :   _token, 
            idopcion                        :   idopcion,
            idregistro                      :   idregistro,

            tipoviolenciageneral            :   tipoviolenciageneral,
            tipoviolenciahijo               :   tipoviolenciahijo,
            cfhabandono                     :   cfhabandono,
            cfhpensionalimenticia           :   cfhpensionalimenticia,
            cfhdenunciapension              :   cfhdenunciapension,
            cfhdenunciamaltrato             :   cfhdenunciamaltrato,
            institucionhijo                 :   institucionhijo,

            tipoviolenciaabuelo             :   tipoviolenciaabuelo,
            cfamabandono                    :   cfamabandono,
            cfampensionalimenticia          :   cfampensionalimenticia,
            cfamdenunciapension             :   cfamdenunciapension,
            cfamdenunciamaltrato            :   cfamdenunciamaltrato,
            institucionabuelo               :   institucionabuelo,


        }
        //=========================================================
        abrircargando();
        $.ajax({            
            type    :   "POST",
            url     :   carpeta+"/ajax-actualizar-tab-datos-convivencia-familiar",
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



