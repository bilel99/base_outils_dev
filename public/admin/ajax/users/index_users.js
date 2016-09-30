/**
 * Created by bilel on 13/03/2016.
 */


/**
 * AJAX GET USERS
 */

$(document).ready(function(){

    var row = $(this).parents('tr');
    var url = 'users';

    $.get(url, function(result){
        $.each(result.info, function(){
            if(this.statut == 'Archivé'){
                $('#valable_'+this.id).hide();
                $('#trash_'+this.id).hide();
                $('#valable_'+this.id).toggle();

                // Affichage du message avec notiJs
                if(result.message != null) {
                    $('#message_info').append(notie.alert(1, result.message, 5));
                }
            }else if(this.statut == 'Actif'){
                $('#valable_'+this.id).hide();
                $('#trash_'+this.id).hide();
                $('#trash_'+this.id).toggle();

                // Affichage du message avec notiJs
                if(result.message != null) {
                    $('#message_info').append(notie.alert(1, result.message, 5));
                }
            }
        });

    }).fail(function(){
        sweetAlert('Oups...', 'Une erreur est survenue', 'error');
        row.show();
    });
});



/**
 * Archive / Actif Users
 */
$(document).ready(function(){
    $('.btn-delete').click(function(e){
        e.preventDefault();
        var row = $(this).parents('tr');
        var id = row.data('id');
        var form = $('#form-delete');
        var url = form.attr('action').replace(':USERS_ID', id);
        var data = form.serialize();

        $.post(url, data, function(result){
            $.each(result.info, function(){
                $('#statut_'+this.id).html(
                    '<td>'+ this.statut +'</td>');

                if(this.statut == 'Archivé'){
                    $('#valable_'+this.id).hide();
                    $('#trash_'+this.id).hide();
                    $('#valable_'+this.id).toggle();

                    // Affichage du message avec notiJs
                    $('#message_info').append(notie.alert(1, result.message, 5));
                }else if(this.statut == 'Actif'){
                    $('#valable_'+this.id).hide();
                    $('#trash_'+this.id).hide();
                    $('#trash_'+this.id).toggle();

                    // Affichage du message avec notiJs
                    if(result.message != null) {
                        $('#message_info').append(notie.alert(1, result.message, 5));
                    }
                }

            });


        }).fail(function(){
            sweetAlert('Oups...', 'Une erreur est survenue', 'error');
            row.show();
        });
    });
});



$(document).ready(function(){
    $('.btn-actif').click(function(e){
        e.preventDefault();
        var roww = $(this).parents('tr');
        var idd = roww.data('id');
        var formm = $('#form-actif');
        var urll = formm.attr('action').replace(':USERS_ID', idd);
        var dataa = formm.serialize();


        $.post(urll, dataa, function(result){
            $.each(result.info, function(){
                $('#statut_'+this.id).html(
                    '<td>'+ this.statut +'</td>');

                if(this.statut == 'Archivé'){
                    $('#valable_'+this.id).hide();
                    $('#trash_'+this.id).hide();
                    $('#valable_'+this.id).toggle();

                    // Affichage du message avec notiJs
                    $('#message_info').append(notie.alert(1, result.message, 5));
                }else if(this.statut == 'Actif'){
                    $('#valable_'+this.id).hide();
                    $('#trash_'+this.id).hide();
                    $('#trash_'+this.id).toggle();

                    // Affichage du message avec notiJs
                    if(result.message != null) {
                        $('#message_info').append(notie.alert(1, result.message, 5));
                    }
                }

            });


        }).fail(function(){
            sweetAlert('Oups...', 'Une erreur est survenue', 'error');
            roww.show();
        });
    });
});




/**
 * FIN
 */