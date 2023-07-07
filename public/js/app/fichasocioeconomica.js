$(document).ready(function(){

    // alerterrorajax('sss');
    $('#btnocultartif').on('click',function(event){
        $('#conttableinffam').hide(700);
    });


    $('#btnmostrartif').on('click',function(event){
        let valor = $('#conttableinffam').css('display');
        if(valor=='block'){
            $('#conttableinffam').hide(700);
        }
        else{
            $('#conttableinffam').show(700);
        }
    });

    $('#btnmostrartifotro').on('click',function(event){
        let valor = $('#conttableinffam').css('display');
        if(valor=='block'){
            $('#conttableinffam').hide(700);
        }
        else{
            $('#conttableinffam').show(700);
        }
    });

    $('#mtpsalud').on('click',function(event){
        debugger;
        let idficha = $('#idficha').val();
        llenarComboFamiliares(idficha,'#tsaotros #combofamiliaresof');
        return true;
    });

    $('#mtpsituacioneconomica').on('click',function(event){
        debugger;
        let idficha = $('#idficha').val();
        llenarComboFamiliares(idficha,'#frmactividadeseconomicas #combofamiliaresse');
        return true;
    });
    
    $('#mtpbeneficios').on('click',function(event){
        debugger;
        let idficha = $('#idficha').val();
        llenarComboFamiliares(idficha,'#tpbeneficios #combofamiliaresbe');
        return true;
    });
    

    
    function llenarComboFamiliares(idficha,divcombo)
    {
        debugger;
        // alerterrorajax('registro es: '+ idficha);
        var _token              =   $('#token').val();
        data = {
                _token              :   _token, 
                idficha             :   idficha
            }
        debugger;
        var datacombofamiliar = $(divcombo).html();
        $(divcombo).html('');
        $.ajax({
                type    :   "POST",
                url     :   carpeta+"/ajax-get-combo-informacion-familiar",
                data    :   data,
                success: function (data) {
                    debugger;
                    $(divcombo).html(data);
                },
                error: function (data) {
                    error500(data);
                    $(divcombo).html(datacombofamiliar);
                }
        });
        return true;
    }
    

    // function llenarComboFamiliares(idficha,combo)
    // {
    //     debugger;
    //     // alerterrorajax('registro es: '+ idficha);
    //     var _token              =   $('#token').val();
    //     data = {
    //             _token              :   _token, 
    //             idficha             :   idficha
    //         }

    //     debugger;
    //     var datacombofamiliar = $("#tsaotros .combofamiliares").html();
    //     $("#tsaotros #combofamiliaresof").html('');
    //     $("#frmactividadeseconomicas #combofamiliaresse").html('');
    //     $("#tpbeneficios #combofamiliaresbe").html('');
    //     $.ajax({
    //             type    :   "POST",
    //             url     :   carpeta+"/ajax-get-combo-informacion-familiar",
    //             data    :   data,
    //             success: function (data) {
    //                 // datacombofamiliar=data;
    //                 $("#tsaotros #combofamiliaresof").html(data);
    //                 $("#frmactividadeseconomicas #combofamiliaresse").html(data);
    //                 $("#tpbeneficios #combofamiliaresbe").html(data);
    //             },
    //             error: function (data) {
    //                 error500(data);
    //                 $("#tsaotros #combofamiliaresof").html(datacombofamiliar);
    //                 $("#frmactividadeseconomicas #combofamiliaresse").html(datacombofamiliar);
    //                 $("#tpbeneficios #combofamiliaresbe").html(datacombofamiliar);

    //             }
    //     });
    //     debugger;
    // }

});



