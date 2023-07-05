$(document).ready(function(){

    // $('#boton-flotante').on('click',function(e){
    //     debugger;
    //     $("#menu-lateral").addClass("mostrar-menu");
    // });
    // $('.ir-arriba').click(function(){
    //     $('body, html').animate({
    //         scrollTop: '0px'
    //     }, 300);
    // });

    // $(window).scroll(function(){
    //     var windowWidth = $(window).width(); // Obtener el ancho de la ventana
    //     if( windowWidth > 600 ){
    //         if( $(this).scrollTop() > 0 ){
    //             $('.ir-arriba').slideDown(300);
    //         } else {
    //             $('.ir-arriba').slideUp(300);
    //         }
    //     }
    // });

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


    

});



