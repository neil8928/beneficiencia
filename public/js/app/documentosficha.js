$(document).ready(function(){

    var carpeta = $("#carpeta").val();
    //------------------------------------------------------------------------------------------------------
    // INICIO SECCION #frmdocumentosficha
    const MAXIMO_TAMANIO_BYTES = 5000000; // 1MB = 1 millón de bytes
    const $miInput = document.querySelector("#frmdocumentosficha #file");

    $miInput.addEventListener("change", function () {
        // debugger;
        // alerterrorajax('ssdasd');
        // si no hay archivos, regresamos
        if (this.files.length <= 0) return;

        // Validamos el primer archivo únicamente
        const archivo = this.files[0];
        if (archivo.size > MAXIMO_TAMANIO_BYTES) {
            const tamanioEnMb = MAXIMO_TAMANIO_BYTES / 1000000;
            alert(`El tamaño máximo es ${tamanioEnMb} MB`);
            // Limpiar
            $miInput.value = "";
        } else {
            // Validación pasada. Envía el formulario o haz lo que tengas que hacer
        }
    });

    $('#frmdocumentosficha').on('click','#btnagregarregistro',function(e){
        debugger;
    
        var _token              =   $('#token').val();
        let idficha             =   $(this).attr('data_id');
        let idregistro          =   $('#idregistro').val();

        


        let files   =   $('#frmdocumentosficha #file').val();
        if(files.length<=0){
            alerterrorajax("Ingrese Archivos a Cargar");
            $('#frmdocumentosficha #files').focus();
            return false;
        }
        debugger;
        //=========================================================
        // alerterrorajax(data);
        // ajax_normal_section(data,"/ajax-tab-documentos-ficha-agregar",'ajaxtablaifdocumentosficha');
        //debugger;
        // $('#frmdocumentosficha #familiar').val('').trigger('change');
        // $('#frmdocumentosficha #frecuenciaactividad').val('').trigger('change');
        
        return true;

    });

    

    $('#frmdocumentosficha').on('click','.btneliminarregistro',function(e){

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
        ajax_normal_section(data,"/ajax-tab-documentos-ficha-eliminar",'ajaxtablaifdocumentosficha');
        //debugger;
        return false;
    });


    $('#frmdocumentosficha #btnocultartif').on('click',function(event){
        $('#frmdocumentosficha #conttableinffam').hide(700);
    });


    $('#frmdocumentosficha #btnmostrartif').on('click',function(event){
        let valor = $('#frmdocumentosficha #conttableinffam').css('display');
        if(valor=='block'){
            $('#frmdocumentosficha #conttableinffam').hide(700);
        }
        else{
            $('#frmdocumentosficha #conttableinffam').show(700);
        }
    });


    
    $('#frmdocumentosficha').on('click','#btnagregar',function(e){
    // $(".ficha").on('click','.icoobservacion', function() {
        debugger;
        var _token                  =   $('#token').val();
        // let observacion             =   $(this).attr('data_observacion');
        let ficha_id                =   $(this).attr('data_ficha');
        // let tab                     =   $(this).attr('data_tab');
        let idopcion                =   $(this).attr('data_opcion');
        // let data_descripcion        =   $(this).attr('data_descripcion');

        data                        =   {
                                            _token                  : _token,

                                            ficha_id                : ficha_id,
                                            idopcion                : idopcion,
                                            // data_descripcion        : data_descripcion,
                                        };
        debugger;

        ajax_modal(data,"/ajax-modal-documentos-ficha",
                  "modal-documentos-ficha","modal-documentos-ficha-container");

        debugger;
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



