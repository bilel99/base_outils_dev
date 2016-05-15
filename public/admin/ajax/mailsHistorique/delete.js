/**
 * Created by bilel on 29/04/2016.
 */

/**
 * Affichage ou non des infos en temps réel
 */
$(document).ready(function(){

    var row = $(this).parents('tr');
    var url = 'mailsHistorique';

    $.get(url, function(result){
        var rowCount = $("#tblCustomers td").closest("tr").length;
        if(rowCount != 0){
            $.each(result.info, function(){
                $('#btn_delete').fadeIn();
            });
        }else{
            $('#btn_delete').fadeOut();

            // Affichage du message avec notiJs
            $('#message_info').append(notie.alert(1, result.message, 5));
        }
    }).fail(function(){
        sweetAlert('Oups...', 'Une erreur est survenue', 'error');
        row.show();
    });
});


/**
 * Suppression des notifications
 */
$(document).ready(function(){
    $('.btn-delete').click(function(e) {
        e.preventDefault();

        var row = $(this).parents('tr');
        var form = $('#form-delete');
        var url = 'delete_historiqueMails';
        var data = form.serialize();

        $.post(url, data, function (result) {
            // vider la liste et retirer la pagination
            $('#paginate_show').fadeOut();
            $('#content_show').fadeOut();

            // Affichage du message avec notiJs
            $('#message_info').append(notie.alert(1, result.message, 5));

        }).fail(function () {
            sweetAlert('Oups...', 'Une erreur est survenue', 'error');
            row.show();
        });
    });
});




$(document).ready(function(){

    var row = $(this).parents('tr');
    var url = 'mailsHistorique';

    $.get(url, function(result){
        var rowCount = $("#tblCustomers td").closest("tr").length;
        $.each(result.info, function(){
            $('#trash_'+this.id).fadeIn();

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



/**
 * Archive / Actif
 */
$(document).ready(function(){
    $('.btn-delete2').click(function(e){
        e.preventDefault();
        var row = $(this).parents('tr');
        var id = row.data('id');
        var form = $('#form-delete2');
        var url = form.attr('action').replace(':MAILSHISTORIQUE_ID', id);
        var data = form.serialize();

        $.post(url, data, function(result){
            $('#trashTr_'+result.id).fadeOut();

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