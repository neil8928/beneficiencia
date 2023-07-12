$(document).ready(function(){

    
    // $('#boton-flotante').on('click',function(e){
    //     debugger;
    //     $("#menu-lateral").addClass("mostrar-menu");
    // });

    //------------------------------------------------------------------------------------------------------
    // INICIO SECCION #tifbeneficiario
    $('.tpinformacionfamiliar').on('change','#fechanacimiento',function(e){
        // debugger;
        let fecha       =   $(this).val();
        if(fecha.length>=0){
            let hoy         =   new Date();
            let fechainicio =   convertToDate(fecha);
            let diferencia = (hoy - fechainicio)/31536000000;
            let anios       =   parseInt(diferencia);
            $('#tifbeneficiario #edad').val(anios);
        }
    });

    $('.tpinformacionfamiliar').on('click','#tifbeneficiario #btnagregarbeneficiario',function(e){

        debugger;

        var _token              =   $('#token').val();
        let idregistro          =   $(this).attr('data_id');
        
        let nombres             =   $('#tifbeneficiario #txtnombres').val();
        if(nombres.length<=0){
            alerterrorajax("Ingrese Nombres");
            $('#tifbeneficiario #txtnombres').focus();
            return false;
        }

        let apellidopaterno     =   $('#tifbeneficiario #txtapellidopaterno').val();
        if(apellidopaterno.length<=0){
            alerterrorajax("Ingrese Apellido Paterno");
            $('#tifbeneficiario #txtapellidopaterno').focus();
            return false;
        }

        let apellidomaterno     =   $('#tifbeneficiario #txtapellidomaterno').val();
        if(apellidomaterno.length<=0){
            alerterrorajax("Ingrese Apellido Materno");
            $('#tifbeneficiario #txtapellidomaterno').focus();
            return false;
        }

        let fechanacimiento     =   $('#tifbeneficiario #fechanacimiento').val();
        if(!valVacio(fechanacimiento) || !valNaN(fechanacimiento)){
            alerterrorajax("Ingrese Fecha Nacimiento");
            $('#tifbeneficiario #fechanacimiento').focus();
            return false;
        }

        let edad                =   $('#tifbeneficiario #edad').val();
        if(parseInt(edad)<=0){
            alerterrorajax("Ingrese Edad");
            $('#tifbeneficiario #edad').focus();
            return false;
        }

        let swentrevistado      =   ($('#swentrevistado').prop('checked'))?1:0;
        let sexom               =   $('#rad2').prop('checked');
        let sexo                =   0;
        if(sexom==true){
            sexo=1;
        }

        let dni                 =   $('#tifbeneficiario #dni').val();
        if(dni.length<=0){
            alerterrorajax("Ingrese Dni");
            $('#tifbeneficiario #dni').focus();
            return false;
        }

        let telefono            =   $('#tifbeneficiario #telefono').val();
        if(telefono.length<=0){
            alerterrorajax("Ingrese Telefono");
            $('#tifbeneficiario #telefono').focus();
            return false;
        }

        let email               =   $('#tifbeneficiario #email').val();
        if(email.length<=0){
            alerterrorajax("Ingrese Email");
            $('#tifbeneficiario #email').focus();
            return false;
        }

        let destadocivil    =   $('#tifbeneficiario #estadocivil').select2('data');
        let estadocivil_id  =   '';
        let estadocivil     =   '';
        if(destadocivil){
            estadocivil_id  =   destadocivil[0].id;
            estadocivil     =   destadocivil[0].text;
        }
        if(estadocivil_id=='')
        {
            alerterrorajax("Seleccione un Estado Civil");
            $('#tifbeneficiario #estadocivil').select2('open');
            return false;   
        }


        let dniveleducativo   =   $('#tifbeneficiario #niveleducativo').select2('data');
        let niveleducativo_id  =   '';
        let niveleducativo     =   '';
        if(dniveleducativo){
            niveleducativo_id  =   dniveleducativo[0].id;
            niveleducativo     =   dniveleducativo[0].text;
        }
        if(niveleducativo_id==''){
            alerterrorajax("Seleccione un Nivel Educativo");
            $('#tifbeneficiario #niveleducativo').select2('open');
            return false;
        }

        let dtiposeguro       =   $('#tifbeneficiario #tipodeseguro').select2('data');
        let tiposeguro_id  =   '';
        let tiposeguro     =   '';
        if(dtiposeguro){
            tiposeguro_id  =   dtiposeguro[0].id;
            tiposeguro     =   dtiposeguro[0].text;
        }
        if(tiposeguro_id==''){
            alerterrorajax("Seleccione Tipo de Seguro");
            $('#tifbeneficiario #tipodeseguro').select2('open');
            return false;
        }

        let cargafamiliar       =   $('#tifbeneficiario #cargafamiliar').val();

        // alerterrorajax(idopcion + ' '+ idregistro);
        data = {
            _token              :   _token, 
            idregistro          :   idregistro,
            swentrevistado      :   swentrevistado,
            nombres             :   nombres,
            apellidopaterno     :   apellidopaterno,
            apellidomaterno     :   apellidomaterno,
            edad                :   edad,
            fechanacimiento     :   fechanacimiento,
            sexo                :   sexo,
            dni                 :   dni,
            telefono            :   telefono,
            email               :   email,
            estadocivil         :   estadocivil,
            estadocivil_id      :   estadocivil_id,
            niveleducativo      :   niveleducativo,
            niveleducativo_id   :   niveleducativo_id,
            tiposeguro          :   tiposeguro,
            tiposeguro_id       :   tiposeguro_id,
            cargafamiliar       :   cargafamiliar,
        }
        //=========================================================
        abrircargando();
        $.ajax({            
            type    :   "POST",
            url     :   carpeta+"/ajax-actualizar-tab-informacion-familiar-beneficiario",
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
    });
    // FIN SECCION #tifbeneficiario
    //------------------------------------------------------------------------------------------------------


    //------------------------------------------------------------------------------------------------------
    // INICIO SECCION #tifotros

    $('.tpinformacionfamiliar').on('change','#fechanacimientoof',function(e){
        // debugger;
        let fecha       =   $(this).val();
        if(fecha.length>=0){
            let hoy         =   new Date();
            let fechainicio =   convertToDate(fecha);
            let diferencia = (hoy - fechainicio)/31536000000;
            let anios       =   parseInt(diferencia);
            $('#tifotros #edadof').val(anios);
        }
    });

    function validarTablaFamiliarDni(tabla,dni){
        let valor = true;
        $(tabla+" tbody tr").each(function(){
            dnifila                 = $(this).find('.tdifdni').html();
            if(dnifila==dni){
                valor=false;
            }               
        });
        return valor;
    }    


    $('.tpinformacionfamiliar').on('click','#tifotros #btnagregarotrofamiliar',function(e){
        debugger;
        // alerterrorajax('ss');

        var _token              =   $('#token').val();
        let idficha             =   $(this).attr('data_id');
        let idregistro          =   $('#idregistroof').val();
        
        let nombres             =   $('#tifotros #txtnombresof').val();
          if(nombres.length<=0){
            alerterrorajax("Ingrese Nombres");
            $('#tifotros #txtnombresof').focus();
            return false;
        }

        let apellidopaterno     =   $('#tifotros #txtapellidopaternoof').val();
          if(apellidopaterno.length<=0){
            alerterrorajax("Ingrese Apellido Paterno");
            $('#tifotros #txtapellidopaternoof').focus();
            return false;
        }

        let apellidomaterno     =   $('#tifotros #txtapellidomaternoof').val();
          if(apellidomaterno.length<=0){
            alerterrorajax("Ingrese Apellido Materno");
            $('#tifotros #txtapellidomaternoof').focus();
            return false;
        }

        let fechanacimiento     =   $('#tifotros #fechanacimientoof').val();
        if(!valVacio(fechanacimiento) || !valNaN(fechanacimiento)){
            alerterrorajax("Ingrese Fecha Nacimiento");
            $('#tifotros #fechanacimientoof').focus();
            return false;
        }

        let edad                =   $('#tifotros #edadof').val();
        if(parseInt(edad)<=0){
            alerterrorajax("Ingrese Edad");
            $('#tifotros #edadof').focus();
            return false;
        }

        let swentrevistado      =   ($('#tifotros #swentrevistadoof').prop('checked'))?1:0;
        let sexom               =   $('#rad4').prop('checked');
        let sexo                =   0;
        if(sexom==true){
            sexo=1;
        }

        let dni                 =   $('#tifotros #dniof').val();
        if(dni.length<=0){
            alerterrorajax("Ingrese Dni");
            $('#tifotros #dniof').focus();
            return false;
        }

        let telefono            =   $('#tifotros #telefonoof').val();
        if(telefono.length<=0){
            alerterrorajax("Ingrese Telefono");
            $('#tifotros #telefonoof').focus();
            return false;
        }

        let email               =   $('#tifotros #emailof').val();
        if(email.length<=0){
            alerterrorajax("Ingrese Email");
            $('#tifotros #emailof').focus();
            return false;
        }





        let destadocivil    =   $('#tifotros #estadocivilof').select2('data');
        let estadocivil_id  =   '';
        let estadocivil     =   '';
        if(destadocivil){
            estadocivil_id  =   destadocivil[0].id;
            estadocivil     =   destadocivil[0].text;
        }
        if(estadocivil_id=='')
        {
            alerterrorajax("Seleccione un Estado Civil");
            $('#tifotros #estadocivilof').select2('open');
            return false;   
        }


        let dniveleducativo   =   $('#tifotros #niveleducativoof').select2('data');
        let niveleducativo_id  =   '';
        let niveleducativo     =   '';
        if(dniveleducativo){
            niveleducativo_id  =   dniveleducativo[0].id;
            niveleducativo     =   dniveleducativo[0].text;
        }
        if(niveleducativo_id==''){
            alerterrorajax("Seleccione un Nivel Educativo");
            $('#tifotros #niveleducativoof').select2('open');
            return false;
        }

        let dtiposeguro       =   $('#tifotros #tipodeseguroof').select2('data');
        let tiposeguro_id  =   '';
        let tiposeguro     =   '';
        if(dtiposeguro){
            tiposeguro_id  =   dtiposeguro[0].id;
            tiposeguro     =   dtiposeguro[0].text;
        }
        if(tiposeguro_id==''){
            alerterrorajax("Seleccione Tipo de Seguro");
            $('#tifotros #tipodeseguroof').select2('open');
            return false;
        }


        let dparentesco       =   $('#tifotros #parentescoof').select2('data');
        let parentesco_id  =   '';
        let parentesco     =   '';
        if(dparentesco){
            parentesco_id  =   dparentesco[0].id;
            parentesco     =   dparentesco[0].text;
        }
        if(parentesco_id==''){
            alerterrorajax("Seleccione Parentesco");
            $('#tifotros #parentescoof').select2('open');
            return false;
        }


        let cargafamiliar   =   $('#tifotros #cargafamiliarof').val();

        let validar         =   false;
        validar             =   validarTablaFamiliarDni('.tinformacionfamiliar',dni);
        if(validar){
            data = {
                _token              :   _token, 
                idficha             :   idficha,
                idregistro          :   idregistro,
                swentrevistado      :   swentrevistado,
                nombres             :   nombres,
                apellidopaterno     :   apellidopaterno,
                apellidomaterno     :   apellidomaterno,
                edad                :   edad,
                fechanacimiento     :   fechanacimiento,
                sexo                :   sexo,
                dni                 :   dni,
                telefono            :   telefono,
                email               :   email,
                estadocivil_id      :   estadocivil_id,
                estadocivil         :   estadocivil,
                niveleducativo_id   :   niveleducativo_id,
                niveleducativo      :   niveleducativo,
                tiposeguro_id       :   tiposeguro_id,
                tiposeguro          :   tiposeguro,
                parentesco_id       :   parentesco_id,
                parentesco          :   parentesco,
                cargafamiliar       :   cargafamiliar,
            }
            //=========================================================
            // alerterrorajax(data);
            // ajax_normal_section(data,"/ajax-tab-informacion-familiar-agregar-otro-familiar",'ajaxtablaifotros');

            $(".ajaxtablaifotros").html("");
            abrircargando();
            $.ajax({
                    type    :   "POST",
                    url     :   carpeta+"/ajax-tab-informacion-familiar-agregar-otro-familiar",
                    data    :   data,
                    success: function (data) {
                        cerrarcargando();
                        $(".ajaxtablaifotros").html(data);
                        // llenarComboFamiliares(idficha);
                    },
                    error: function (data) {
                        cerrarcargando();
                        error500(data);
                    }
            });

            debugger;
            $('#tifotros #btnlimpiarregtifotros').click();

            $('#tifotros #estadocivilof').val('').trigger('change');
            $('#tifotros #niveleducativoof').val('').trigger('change');
            $('#tifotros #tipodeseguroof').val('').trigger('change');
            $('#tifotros #parentescoof').val('').trigger('change');

            // $('#tifotros #estadocivilof').select2('val','');
            // $('#tifotros #niveleducativoof').select2('val','');
            // $('#tifotros #tipodeseguroof').select2('val','');
            // $('#tifotros #parentescoof').select2('val','');
        }
        else{
            alerterrorajax('DNI : ' + dni +' YA REGISTRADO COMO FAMILIAR');
        }
        

        return false;
        // abrircargando();
        // $.ajax({            
        //     type    :   "POST",
        //     url     :   carpeta+"/ajax-tab-informacion-familiar-agregar-otro-familiar",
        //     data    :   data,
        //     success: function (data) {

        //         JSONdata     = JSON.parse(data);
        //         error        = JSONdata[0].error;
        //         mensaje      = JSONdata[0].mensaje;

        //         if(error==false){ 
        //             cerrarcargando();
        //             alertajax(mensaje); 
        //         }else{
        //             cerrarcargando();
        //             alerterror505ajax(mensaje); 
        //             return false;                
        //         }

        //     },
        //     error: function (data) {
        //         cerrarcargando();
        //         if(data.status = 500){
        //             /** error 505 **/
        //             var contenido = $(data.responseText);
        //             alerterror505ajax($(contenido).find('.trace-message').html()); 
        //             console.log($(contenido).find('.trace-message').html());     
        //         }
        //     }
        // });

    });

    $('.tpinformacionfamiliar').on('click','.btneliminarotrofamiliar',function(e){

        debugger;
        let idregistro  =   $(this).attr('data_id');
        let idopcion    =   $(this).attr('data_opc');
        let idficha     =   $(this).attr('data_ficha');
 // alerterrorajax('bton eliminar: '+idregistro);
        var _token              =   $('#token').val();

        data = {
                _token              :   _token, 
                idopcion            :   idopcion,
                idregistro          :   idregistro,
                idficha             :   idficha, 
            }
            //=========================================================
            // alerterrorajax(data);
            ajax_normal_section(data,"/ajax-tab-informacion-familiar-eliminar-otro-familiar",'ajaxtablaifotros');
            debugger;
    });
});



