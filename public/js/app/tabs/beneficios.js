$(document).ready(function(){


    $('.tpbeneficios').on('click','#frmbeneficiousuario #btnguardartdg',function(e){

        debugger;

        var _token          =   $('#token').val();
        let idopcion        =   $(this).attr('data_opcion');
        let idregistro      =   $(this).attr('data_id');

        let bienesusuario   =   $('#frmbeneficiousuario #bienesusuario').val();
        debugger;

        data = {
            _token        :   _token, 
            idopcion      :   idopcion,
            idregistro    :   idregistro,
            bienesusuario :   bienesusuario,
        }
        //=========================================================
        abrircargando();
        $.ajax({            
            type    :   "POST",
            url     :   carpeta+"/ajax-actualizar-tab-datos-programa-usuario",
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

    $('.tpbeneficios').on('click','#btnagregarapoyosocial',function(e){
        debugger;
        // alerterrorajax('ss');

        var _token              =   $('#token').val();
        let idficha             =   $(this).attr('data_id');
        let idopcion             =   $(this).attr('data_opcion');


        let familiar_id         =   $('#tpbeneficios #familiar').val();
        let programabeneficiario_id  =   $('#tpbeneficios #programabeneficiario_id').val();

        if(familiar_id==''){
            alerterrorajax("Seleccione un Familiar");
            $('#tpbeneficios #familiar').select2('open');
            return false;
        }
        if(programabeneficiario_id==''){
            alerterrorajax("Seleccione un Porgrama Beneficiario");
            $('#tpbeneficios #programabeneficiario_id').select2('open');
            return false;
        }

        let existebeneficio = existe_beneficio(familiar_id,programabeneficiario_id);
        if(existebeneficio=='1'){
            alerterrorajax("Ya existe la Relacion de Beneficio");
            return false;
            
        }


        data = {
            _token                          :   _token, 
            idficha                         :   idficha,
            familiar_id                     :   familiar_id,
            programabeneficiario_id         :   programabeneficiario_id,
            idopcion                        :   idopcion,
        }
        //=========================================================
        // alerterrorajax(data);
        ajax_normal_section(data,"/ajax-tab-beneficios-agregar",'ajaxtablabeneficios');

        $('#tpbeneficios #familiar').val('').trigger('change');
        $('#tpbeneficios #programabeneficiario_id').val('').trigger('change');


        return false;


    });

    $('.tpbeneficios').on('click','.btneliminarbeneficio',function(e){

        debugger;
        let idregistro  =   $(this).attr('data_id');
        let idopcion    =   $(this).attr('data_opc');
        let idficha     =   $(this).attr('data_ficha');
        var _token      =   $('#token').val();
        data = {
                _token              :   _token, 
                idopcion            :   idopcion,
                idregistro          :   idregistro,
                idficha             :   idficha, 
            }
            //=========================================================
            // alerterrorajax(data);
            ajax_normal_section(data,"/ajax-tab-beneficios-eliminar",'ajaxtablabeneficios');
            debugger;
    });
});

function existe_beneficio(familiar_id,programabeneficiario_id){

    var sw = '0';
    $("#tbeneficios .select").each(function(){

        var data_familiar_id = $(this).attr('data_familiar_id');
        var data_programabeneficiario_id = $(this).attr('data_programabeneficiario_id');

        if(data_familiar_id == familiar_id && data_programabeneficiario_id == programabeneficiario_id){
            sw = '1';
        }        

    });
    return sw;

}

