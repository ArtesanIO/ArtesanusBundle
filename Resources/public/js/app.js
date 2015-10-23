$(document).ready(function(){

    $('.btn-delete').click(function(event) {

        var r = confirm("¿Estás segur@?");

        if (r != true) {
            event.preventDefault();
        }

    });


});
