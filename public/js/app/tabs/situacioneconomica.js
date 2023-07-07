$(document).ready(function(){


    //------------------------------------------------------------------------------------------------------
    // INICIO SECCION #frmactividadeseconomicas

    $('.tpsituacioneconomica').on('click','#frmactividadeseconomicas #btnagregarotrofamiliar',function(e){
        debugger;
        // alerterrorajax('ss');

        var _token              =   $('#token').val();
        let idficha             =   $(this).attr('data_id');
        let idregistro          =   $('#idregistro').val();

        let swjefefamilia       =   ($('#swjefefamilia').prop('checked'))?1:0;
    
        let dfamiliar           =   $('#frmactividadeseconomicas #familiar').select2('data');
        let familiar_id         =   '';
        let familiar            =   '';
        if(dfamiliar){
            familiar_id         =   dfamiliar[0].id;
            familiar            =   dfamiliar[0].text;
        }
        if(familiar_id=='')
        {
            alerterrorajax("Seleccione un Familiar");
            $('#frmactividadeseconomicas #familiar').select2('open');
            return false;   
        }

        let ocupacionprincipal   =   $('#frmactividadeseconomicas #ocupacionprincipal').val();
        if(ocupacionprincipal.length<=0){
            alerterrorajax("Ingrese Ocupacion Principal");
            $('#frmactividadeseconomicas #ocupacionprincipal').focus();
            return false;
        }

        let dfrecuenciaactividad           =   $('#frmactividadeseconomicas #frecuenciaactividad').select2('data');
        let frecuenciaactividad_id         =   '';
        let frecuenciaactividad            =   '';
        if(dfrecuenciaactividad){
            frecuenciaactividad_id         =   dfrecuenciaactividad[0].id;
            frecuenciaactividad            =   dfrecuenciaactividad[0].text;
        }
        if(frecuenciaactividad_id=='')
        {
            alerterrorajax("Seleccione un frecuenciaactividad");
            $('#frmactividadeseconomicas #frecuenciaactividad').select2('open');
            return false;   
        }


        // let frecuenciaactividad   =   $('#frmactividadeseconomicas #frecuenciaactividad').val();
        // if(frecuenciaactividad.length<=0){
        //     alerterrorajax("Ingrese Frecuencia Actividad");
        //     $('#frmactividadeseconomicas #frecuenciaactividad').focus();
        //     return false;
        // }


        let remuneracionmensual   =   $('#frmactividadeseconomicas #remuneracionmensual').val();
        if(parseInt(remuneracionmensual)<=0){
            alerterrorajax("Ingrese Remuneracion Mensual");
            $('#frmactividadeseconomicas #remuneracionmensual').focus();
            return false;
        }

        let actividadesextras   =   $('#frmactividadeseconomicas #actividadesextras').val();
        if(actividadesextras.length<=0){
            alerterrorajax("Ingrese Actividades Extras");
            $('#frmactividadeseconomicas #actividadesextras').focus();
            return false;
        }

        let validar         =   false; //no se valida ya que un persona puede tener varios trabajos
        // validar             =   validarTabla('#frmactividadeseconomicas #tifsituacioneconomica',familiar_id);
        // if(validar){
            data = {
                _token                  :   _token, 
                idficha                 :   idficha,
                idregistro              :   idregistro,
                familiar_id             :   familiar_id,
                ocupacionprincipal      :   ocupacionprincipal,
                frecuenciaactividad_id  :   frecuenciaactividad_id,
                frecuenciaactividad     :   frecuenciaactividad,
                swjefefamilia           :   swjefefamilia,
                remuneracionmensual     :   remuneracionmensual,
                actividadesextras       :   actividadesextras
            }
            debugger;
            //=========================================================
            // alerterrorajax(data);
            ajax_normal_section(data,"/ajax-tab-situacion-economica-agregar-otro-familiar",'ajaxtablaifsituacioneconomica');
            //debugger;
            $('#frmactividadeseconomicas #btnlimpiarregistros').click();
            $('#frmactividadeseconomicas #familiar').val('').trigger('change');
            $('#frmactividadeseconomicas #frecuenciaactividad').val('').trigger('change');
        // }
        // else{
        //     alerterrorajax('FAMILIAR : ' + familiar +' YA REGISTRADO');
        // }        
        return false;

    });

    $('.tpsituacioneconomica').on('click','#frmactividadeseconomicas .btneliminarotrofamiliar',function(e){

        debugger;
        let idregistro  =   $(this).attr('data_id');
        let idopcion    =   $(this).attr('data_opc');
        let idficha     =   $(this).attr('data_ficha');
        // return false;
        var _token              =   $('#token').val();

        data = {
                _token              :   _token, 
                idopcion            :   idopcion,
                idregistro          :   idregistro,
                idficha             :   idficha, 
            }
        //=========================================================
        // alerterrorajax(data);
        ajax_normal_section(data,"/ajax-tab-situacion-economica-eliminar-otro-familiar",'ajaxtablaifsituacioneconomica');
        //debugger;
        return false;
    });


    $('#frmactividadeseconomicas #btnocultartif').on('click',function(event){
        $('#frmactividadeseconomicas #conttableinffam').hide(700);
    });


    $('#frmactividadeseconomicas #btnmostrartif').on('click',function(event){
        let valor = $('#frmactividadeseconomicas #conttableinffam').css('display');
        if(valor=='block'){
            $('#frmactividadeseconomicas #conttableinffam').hide(700);
        }
        else{
            $('#frmactividadeseconomicas #conttableinffam').show(700);
        }
    });


     // FIN SECCION #frmactivoseconomicos
    //------------------------------------------------------------------------------------------------------


    //------------------------------------------------------------------------------------------------------
    // INICIO SECCION #tsamosrtalidad




    //------------------------------------------------------------------------------------------------------
    // INICIO SECCION #frmactivoseconomicos


    $('.tpsituacioneconomica').on('click','#frmactivoseconomicos #btnguardartdg',function(e){

        debugger;

        var _token          =   $('#token').val();
        let idopcion        =   $(this).attr('data_opcion');
        let idregistro      =   $(this).attr('data_id');

        let otrosbienes           =   $('#frmactivoseconomicos #otrosbienes').val();
        let bienes                =   $('#frmactivoseconomicos #bienes').val();

        data = {
            _token        :   _token, 
            idopcion      :   idopcion,
            idregistro    :   idregistro,
            otrosbienes   :   otrosbienes,
            bienes        :   bienes,
        }
        //=========================================================
        abrircargando();
        $.ajax({            
            type    :   "POST",
            url     :   carpeta+"/ajax-actualizar-tab-datos-situacion-economica-bienes",
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
    // FIN SECCION #frmactivoseconomicos
    //------------------------------------------------------------------------------------------------------



});



