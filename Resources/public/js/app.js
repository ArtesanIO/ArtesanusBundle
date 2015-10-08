$(document).ready(function(){

    $('.btn-delete').click(function(){

        alertify.confirm("¿Seguro?",
            function(e){
                if(e){
                    alertify.success('Listo');
                }else{
                    alertify.error('Cancelado');
                }
            });

        return false;
    });

    $( 'textarea.ckeditor').each( function() {
        CKEDITOR.replace( $(this).attr('id') );

    });

});
