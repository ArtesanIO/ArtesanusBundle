$(document).ready(function(){

    $('.add-collection').on('click', function(){

        divParent = $(this).parent();
        formParent = divParent.parent();

        ordenesColeccion = formParent.find($('table tbody.collections'));

        ordenesColeccion.data('index', ordenesColeccion.find(':input').length);

        addOrdenForm(ordenesColeccion);
    });

    function addOrdenForm(ordenesColeccion){
          var prototype = ordenesColeccion.data('prototype');

          var index = ordenesColeccion.data('index');
          var nuevaOrden = prototype.replace(/__name__/g, index);
          ordenesColeccion.data('index', index + 1);

          var nuevaOrdenTR = $(ordenesColeccion).append(nuevaOrden);
    }

    $('.delete-collection').click(function(){

        deleteCollection($(this));

    });

    $(document).on('click', '.delete-collection', function(){
        deleteCollection($(this));

    });

    function deleteCollection(e){
        event.preventDefault();
        var son = e.parent();
        var parent = son.parent();

        parent.fadeOut(300, function(){
            parent.remove();
        });
    }
});
