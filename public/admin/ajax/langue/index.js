$(document).ready(function(){

    var row = $(this).parents('tr');
    var url = 'langues';

    $.get(url, function(result){
        $.each(result.info, function(){
                $('#trash_'+this.id).toggle();

                // Affichage du message avec notiJs
                if(result.message != null) {
                    $('#message_info').append(notie.alert(1, result.message, 5));
                }
        });

    }).fail(function(){
        sweetAlert('Oups...', 'Une erreur est survenue', 'error');
        row.show();
    });
});




$(document).ready(function(){
    $('.btn-delete').click(function(e){
        e.preventDefault();
        var row = $(this).parents('tr');
        var id = row.data('id');
        var form = $('#form-delete');
        var url = form.attr('action').replace(':LANGUE_ID', id);
        var data = form.serialize();

        $.post(url, data, function(result){
            $('#delete_row'+result.id).fadeOut();

            // Affichage du message avec notiJs
            if(result.message != null) {
                $('#message_info').append(notie.alert(1, result.message, 5));
            }

        }).fail(function(){
            sweetAlert('Oups...', 'Une erreur est survenue', 'error');
            row.show();
        });
    });
});