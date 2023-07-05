$(document).ready(function(){
    var carpeta = $("#carpeta").val();

    $(".tpdatosgenerales").on('change','#departamento_id', function(e) {
        debugger;
        var _token      = $('#token').val();
        let valor = $(this).val();
        // if(valor.length<=0){
        //     alerterrorajax("Seleccione un Departamento");
        //     $('#departamento_id').focus();
        //     return false;
        // }

        data =   {
            _token          :   _token,
            iddepartamento  :   valor,
        };

        ajax_normal_section(data,"/ajax-select-provincia",'ajaxprovincia');
        $('.tpdatosgenerales #provincia_id').change();
        return true;
    });

    $(".tpdatosgenerales").on('change','#provincia_id', function(e) {
        debugger;
        var _token      = $('#token').val();
        let valor = $(this).val();
        // if(valor.length<=0){
        //     alerterrorajax("Seleccione una Provincia");
        //     $('#provincia_id').focus();
        //     return false;
        // }

        data =   {
            _token          :   _token,
            idprovincia     :   valor,
        };

        ajax_normal_section(data,"/ajax-select-distrito",'ajaxdistrito');
        return true;
    });

    $(".tpdatosgenerales").on('change','#distrito_id', function(e) {
        // let valor = $(this).val();
        // alerterrorajax(valor);
    });    

    
    $(".tpdatosgenerales").on('click','#btnguardartdg', function(e) {
        debugger;
        var _token          =   $('#token').val();
        let idopcion        =   $(this).attr('data_opcion');
        let idregistro      =   $(this).attr('data_id');

        let iddepartamento  =   $('#departamento_id').val();
        if(iddepartamento.length<=0){
            alerterrorajax("Seleccione un Departamento");
            $('#departamento_id').focus();
            return false;
        }

        let idprovincia  =   $('#provincia_id').val();
        if(idprovincia.length<=0){
            alerterrorajax("Seleccione un Provincia");
            $('#provincia_id').focus();
            return false;
        }

        let iddistrito  =   $('#distrito_id').val();
        if(iddistrito.length<=0){
            alerterrorajax("Seleccione un Distrito");
            $('#distrito_id').focus();
            return false;
        }

        let centropoblado = $('#centropoblado').val();
        let direccion = $('#direccionvivienda').val();
        if(direccion.length<=0){
            alerterrorajax("Ingrese Direccion");
            $('#direccionvivienda').focus();
            return false;
        }

        data = {
            _token          :   _token, 
            idopcion        :   idopcion,
            idregistro      :   idregistro,
            iddepartamento  :   iddepartamento,
            idprovincia     :   idprovincia,
            iddistrito      :   iddistrito,
            centropoblado   :   centropoblado,
            direccion       :   direccion,
        }
        //=========================================================
        abrircargando();
        $.ajax({            
            type    :   "POST",
            url     :   carpeta+"/ajax-actualizar-tab-datos-generales",
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



