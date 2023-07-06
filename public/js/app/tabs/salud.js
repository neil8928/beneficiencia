$(document).ready(function(){


    //------------------------------------------------------------------------------------------------------
    // INICIO SECCION #tsabeneficiario


    $('.tpsalud').on('click','#tsabeneficiario #btnagregarbeneficiario',function(e){

        debugger;

        var _token              =   $('#token').val();
        let idregistro          =   $(this).attr('data_id');
        
        let ddiscapacidad       =   $('#tsabeneficiario #discapacidad').select2('data');
        let discapacidad_id       =   '';
        let discapacidad        =   '';
        if(ddiscapacidad){
            discapacidad_id       =   ddiscapacidad[0].id;
            discapacidad        =   ddiscapacidad[0].text;
        }
        if(discapacidad_id=='')
        {
            alerterrorajax("Seleccione una Discapacidad");
            $('#tsabeneficiario #discapacidad').select2('open');
            return false;   
        }


        let dniveldiscapacidad   =   $('#tsabeneficiario #niveldiscapacidad').select2('data');
        let niveldiscapacidad_id  =   '';
        let niveldiscapacidad     =   '';
        if(dniveldiscapacidad){
            niveldiscapacidad_id  =   dniveldiscapacidad[0].id;
            niveldiscapacidad     =   dniveldiscapacidad[0].text;
        }
        if(niveldiscapacidad_id==''){
            alerterrorajax("Seleccione un Nivel Discapacidad");
            $('#tsabeneficiario #niveldiscapacidad').select2('open');
            return false;
        }

        let caddiscapacidad   =   $('#tsabeneficiario #caddiscapacidad').val();
        if(caddiscapacidad.length<=0){
            alerterrorajax("Ingrese un Tipo de Discapacidad");
            $('#tsabeneficiario #caddiscapacidad').focus();
            return false;
        }


        let dtiposeguro       =   $('#tsabeneficiario #tipodeseguro').select2('data');
        let tiposeguro_id  =   '';
        let tiposeguro     =   '';
        if(dtiposeguro){
            tiposeguro_id  =   dtiposeguro[0].id;
            tiposeguro     =   dtiposeguro[0].text;
        }
        if(tiposeguro_id==''){
            alerterrorajax("Seleccione Tipo de Seguro");
            $('#tsabeneficiario #tipodeseguro').select2('open');
            return false;
        }


        let cadtiposeguro = $('#tsabeneficiario #cadtiposeguro').val();
        if(cadtiposeguro.length<=0){
            cadtiposeguro='';
        }

        // alerterrorajax('guardar salud beneficiario');
        // return false;

        // alerterrorajax(idopcion + ' '+ idregistro);
        data = {
            _token              :   _token, 
            idregistro          :   idregistro,
            discapacidad_id     :   discapacidad_id,
            discapacidad        :   discapacidad,
            
            niveldiscapacidad_id:   niveldiscapacidad_id,
            niveldiscapacidad   :   niveldiscapacidad,
            tipodiscapacidad    :   caddiscapacidad,
            tiposeguro_id       :   tiposeguro_id,
            tiposeguro          :   tiposeguro,
            cadtiposeguro       :   cadtiposeguro,
        }
        //=========================================================
        abrircargando();
        $.ajax({            
            type    :   "POST",
            url     :   carpeta+"/ajax-actualizar-tab-salud-beneficiario",
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
    // FIN SECCION #tsabeneficiario
    //------------------------------------------------------------------------------------------------------


    //------------------------------------------------------------------------------------------------------
    // INICIO SECCION #tsaotros

    $('.tpsalud').on('click','#tsaotros #btnagregarotrofamiliar',function(e){
        debugger;
        // alerterrorajax('ss');

        var _token              =   $('#token').val();
        let idficha             =   $(this).attr('data_id');
        let idregistro          =   $('#idregistro').val();

        let dfamiliar           =   $('#tsaotros #familiarof').select2('data');
        let familiar_id         =   '';
        let familiar            =   '';
        if(dfamiliar){
            familiar_id         =   dfamiliar[0].id;
            familiar            =   dfamiliar[0].text;
        }
        if(familiar_id=='')
        {
            alerterrorajax("Seleccione un Familiar");
            $('#tsaotros #familiarof').select2('open');
            return false;   
        }

       
         let cadenfermedad   =   $('#tsaotros #cadenfermedad').val();
        if(cadenfermedad.length<=0){
            alerterrorajax("Ingrese Enfermedad");
            $('#tsaotros #cadenfermedad').focus();
            return false;
        }

        debugger;   
        let validar         =   false;
        validar             =   validarTabla('#tsaotros #table1',familiar_id);
        if(validar){
            data = {
                _token              :   _token, 
                idficha             :   idficha,
                idregistro          :   idregistro,
                familiar_id         :   familiar_id,
                cadenfermedad       :   cadenfermedad,
            }
            debugger;
            //=========================================================
            // alerterrorajax(data);
            ajax_normal_section(data,"/ajax-tab-salud-agregar-otro-familiar",'ajaxtablaifotrossalud');
            //debugger;
            $('#tsaotros #btnlimpiarregotros').click();

            $('#tsaotros #familiarof').val('').trigger('change');
        }
        else{
            alerterrorajax('FAMILIAR : ' + familiar +' YA REGISTRADO');
        }        
        return false;

    });

    $('.tpsalud').on('click','#tsaotros .btneliminarotrofamiliar',function(e){

        debugger;
        let idregistro  =   $(this).attr('data_id');
        let idopcion    =   $(this).attr('data_opc');
        let idficha     =   $(this).attr('data_ficha');
        alerterrorajax('bton eliminar: '+idregistro);
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
        ajax_normal_section(data,"/ajax-tab-salud-eliminar-otro-familiar",'ajaxtablaifotrossalud');
        //debugger;
        return false;
    });


    $('#tsaotros #btnocultartif').on('click',function(event){
        $('#tsaotros #conttableinffam').hide(700);
    });


    $('#tsaotros #btnmostrartif').on('click',function(event){
        let valor = $('#tsaotros #conttableinffam').css('display');
        if(valor=='block'){
            $('#tsaotros #conttableinffam').hide(700);
        }
        else{
            $('#tsaotros #conttableinffam').show(700);
        }
    });


     // FIN SECCION #tsabeneficiario
    //------------------------------------------------------------------------------------------------------


    //------------------------------------------------------------------------------------------------------
    // INICIO SECCION #tsamosrtalidad
    $('#tsamortalidad #btnagregarotrofamiliar').on('click',function(event){
        debugger;
        // alerterrorajax('boton agregar mortalidad');

        var _token              =   $('#token').val();
        let idficha             =   $(this).attr('data_id');
        let idregistro          =   $('#idregistro').val();

        let nombrefamiliar   =   $('#tsamortalidad #txtnombrefamiliar').val();
        if(nombrefamiliar.length<=0){
            alerterrorajax("Ingrese Nombre Familiar");
            $('#tsamortalidad #txtnombrefamiliar').focus();
            return false;
        }
        
        let enfermedad   =   $('#tsamortalidad #txtenfermedad').val();
        if(enfermedad.length<=0){
            alerterrorajax("Ingrese Enfermedad de Deceso");
            $('#tsamortalidad #txtenfermedad').focus();
            return false;
        }

        let dparentesco           =   $('#tsamortalidad #parentescomo').select2('data');
        let parentesco_id         =   '';
        let parentesco            =   '';
        if(dparentesco){
            parentesco_id         =   dparentesco[0].id;
            parentesco            =   dparentesco[0].text;
        }
        if(parentesco_id=='')
        {
            alerterrorajax("Seleccione Parentesco");
            $('#tsamortalidad #parentescomo').select2('open');
            return false;   
        }



        let dlugarfallecimiento           =   $('#tsamortalidad #lugarfallecimiento').select2('data');
        let lugarfallecimiento_id         =   '';
        let lugarfallecimiento            =   '';
        if(dlugarfallecimiento){
            lugarfallecimiento_id         =   dlugarfallecimiento[0].id;
            lugarfallecimiento            =   dlugarfallecimiento[0].text;
        }
        if(lugarfallecimiento_id=='')
        {
            alerterrorajax("Seleccione Lugar de Fallecimiento");
            $('#tsamortalidad #lugarfallecimiento').select2('open');
            return false;   
        }

        let cadlugarfallecimiento   =   $('#tsamortalidad #cadlugarfallecimiento').val();
        if(cadlugarfallecimiento.length<=0){
            cadlugarfallecimiento='';
        }



        debugger;   
        let validar         =   false;
        validar             =   validarTabla('#tsamortalidad #table1',nombrefamiliar);
        if(validar){
            data = {
                _token                  :   _token, 
                idficha                 :   idficha,
                idregistro              :   idregistro,
                nombrefamiliar          :   nombrefamiliar,
                enfermedad              :   enfermedad,
                parentesco_id           :   parentesco_id,
                parentesco              :   parentesco,
                lugarfallecimiento_id   :   lugarfallecimiento_id,
                lugarfallecimiento      :   lugarfallecimiento,
                cadlugarfallecimiento   :   cadlugarfallecimiento,
            }
            debugger;
            //=========================================================
            // alerterrorajax(data);
            ajax_normal_section(data,"/ajax-tab-salud-agregar-otro-mortalidad",'ajaxtablaifotrosmortalidad');
            //debugger;
            $('#tsamortalidad #btnlimpiarregotros').click();
            $('#tsamortalidad #parentescomo').val('').trigger('change');
            $('#tsamortalidad #lugarfallecimiento').val('').trigger('change');
        }
        else{
            alerterrorajax('FAMILIAR : ' + familiar +' YA REGISTRADO');
        }        
        return false;
    });

    $('.tpsalud').on('click','#tsamortalidad .btneliminarotrofamiliar',function(e){

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
        ajax_normal_section(data,"/ajax-tab-salud-eliminar-otro-mortalidad",'ajaxtablaifotrosmortalidad');
        //debugger;
        return false;
    });

    $('#tsamortalidad #btnocultartif').on('click',function(event){
        $('#tpsalud #conttableinfmortalidad').hide(700);
    });


    $('#tsamortalidad #btnmostrartif').on('click',function(event){
        let valor = $('#tpsalud #conttableinfmortalidad').css('display');
        if(valor=='block'){
            $('#tpsalud #conttableinfmortalidad').hide(700);
        }
        else{
            $('#tpsalud #conttableinfmortalidad').show(700);
        }
    });

});



