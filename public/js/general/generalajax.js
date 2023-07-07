
var carpeta = $("#carpeta").val();
//ajax normal

function ajax_normal_combo(data,link,contenedor) {
    $(".listajax").html("");
    abrircargando();
    $.ajax({
        type    :   "POST",
        url     :   carpeta+link,
        data    :   data,
        success: function (data) {
            cerrarcargando();
            $("."+contenedor).html(data);

        },
        error: function (data) {
            cerrarcargando();
            error500(data);
        }
    });
}

function ajax_normal_section_sincrono(data,link,section,nivel=1) {
    $("."+section).html("");
    if(nivel==2){
        abrircargando2nivel();
    }
    else{
        abrircargando();
    }
    
    $.ajax({
        type    :   "POST",
        async   :   false,
        cache   :   false,
        url     :   carpeta+link,
        data    :   data,
        success: function (data) {
            cerrarcargando();
            $("."+section).html(data);

        },
        error: function (data) {
            cerrarcargando();
            error500(data);
        }
    });
}


function ajax_normal_section(data,link,section,nivel=1) {
    $("."+section).html("");
    if(nivel==2){
        abrircargando2nivel();
    }
    else{
        abrircargando();
    }
    
    $.ajax({
        type    :   "POST",
        url     :   carpeta+link,
        data    :   data,
        success: function (data) {
            cerrarcargando();
            $("."+section).html(data);

        },
        error: function (data) {
            cerrarcargando();
            error500(data);
        }
    });
}

function ajax_normal_section_alert(data,link,section,mensaje,nivel=1) {
    $("."+section).html("");
    if(nivel==2){
        abrircargando2nivel();
    }
    else{
        abrircargando();
    }
    
    $.ajax({
        type    :   "POST",
        url     :   carpeta+link,
        data    :   data,
        success: function (data) {
            cerrarcargando();
            alert(mensaje);
            $("."+section).html(data);
        },
        error: function (data) {
            cerrarcargando();
            error500(data);
        }
    });
}

function ajax_normal(data,link) {
    $(".listajax").html("");
    abrircargando();
    $.ajax({
        type    :   "POST",
        url     :   carpeta+link,
        data    :   data,
        success: function (data) {
            cerrarcargando();
            $(".listajax").html(data);

        },
        error: function (data) {
            cerrarcargando();
            error500(data);
        }
    });
}

function ajax_normal_form(data,link) {
    $(".formajax").html("");
    abrircargando();
    $.ajax({
        type    :   "POST",
        url     :   carpeta+link,
        data    :   data,
        success: function (data) {
            cerrarcargando();
            $(".formajax").html(data);

        },
        error: function (data) {
            cerrarcargando();
            error500(data);
        }
    });
}

function ajax_normal_form_alert(data,link,mensaje,click) {
    abrircargando();
    $.ajax({
        type    :   "POST",
        url     :   carpeta+link,
        data    :   data,
        success: function (data) {
            cerrarcargando();
            alertajax(mensaje);
             $( "."+click).click();
        },
        error: function (data) {
            cerrarcargando();
            error500(data);
        }
    });
}


function ajax_normal_guardar_lista(data,link,btnclick) {

    abrircargando();
    $.ajax({
        type    :   "POST",
        url     :   carpeta+link,
        data    :   data,
        success: function (data) {
            cerrarcargando();
            //console.log(data);
            $('.'+btnclick).click();
        },
        error: function (data) {
            cerrarcargando();
            error500(data);
        }
    });
}

function ajax_normal_guardar_observacion(data,link,input,observacion) {

    abrircargando();
    $.ajax({
        type    :   "POST",
        url     :   carpeta+link,
        data    :   data,
        success: function (data) {
            cerrarcargando();
            //console.log(data);
            $('.'+input).html(observacion);
            alertajax('Observacion modificado con exito');
        },
        error: function (data) {
            cerrarcargando();
            error500(data);
        }
    });
}




function ajax_modal(data,link,modal,contenedor_ajax) {

    abrircargando();

    $.ajax({
        type    :   "POST",
        url     :   carpeta+link,
        data    :   data,
        success: function (data) {
            cerrarcargando();
            $('.'+contenedor_ajax).html(data);
            $('#'+modal).niftyModal();

        },
        error: function (data) {
            cerrarcargando();
            error500(data);
        }
    });
}


//atibutos vacios
function errorvacio(atributo,texto) {
    if(atributo ==''){ alerterrorajax(texto); return false;}
}


function ajax_callback_section_alert(data,link,section,callback,mensaje='',nivel=1) {
    $("."+section).html("");
    if(nivel==2){
        abrircargando2nivel();
    }
    else{
        abrircargando();
    }
    
    $.ajax({
        type    :   "POST",
        url     :   carpeta+link,
        data    :   data,
        success: function (data) {
            cerrarcargando();
            alert(mensaje);
            $("."+section).html(data);
            callback(data);
        },
        error: function (data) {
            cerrarcargando();
            error500(data);
        }
    });
}



function ajax_normal_section_id(data,link,section,nivel=1) {
    $(section).html("");
    if(nivel==2){
        abrircargando2nivel();
    }
    else{
        abrircargando();
    }
    
    $.ajax({
        type    :   "POST",
        url     :   carpeta+link,
        data    :   data,
        success: function (data) {
            cerrarcargando();
            $(section).html(data);
        },
        error: function (data) {
            cerrarcargando();
            error500(data);
        }
    });
}

