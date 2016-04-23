/**
 * Created by bilel on 13/03/2016.
 */
/**
 * AJAX GET USERS
 */
$(document).ready(function(){
    var row = $(this).parents('tr');
    var url = "http://digitheque/actu";

    $.get(url, function(result){
        $.each(result.info, function(){
            if(this.statut == 'Archivé'){
                $('#valable_'+this.id).hide();
                $('#trash_'+this.id).hide();
                $('#valable_'+this.id).toggle();
            }else if(this.statut == 'Actif'){
                $('#valable_'+this.id).hide();
                $('#trash_'+this.id).hide();
                $('#trash_'+this.id).toggle();
            }
        });

    }).fail(function(){
        sweetAlert('Oups...', 'Une erreur est survenue', 'error');
        row.show();
    });
});




/**
 * Archive / Actif Actu
 */
$(document).ready(function(){
    $('.btn-delete').click(function(e){
        e.preventDefault();
        var row = $(this).parents('tr');
        var id = row.data('id');
        var form = $('#form-delete');
        var url = form.attr('action').replace(':ACTU_ID', id);
        var data = form.serialize();

        $.post(url, data, function(result){
            $.each(result.info, function(){

                $('#statut_'+this.id).html(
                    '<td>'+ this.statut +'</td>');

                if(this.statut == 'Archivé'){
                    $('#valable_'+this.id).hide();
                    $('#trash_'+this.id).hide();
                    $('#valable_'+this.id).toggle();
                }else if(this.statut == 'Actif'){
                    $('#valable_'+this.id).hide();
                    $('#trash_'+this.id).hide();
                    $('#trash_'+this.id).toggle();
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
        var urll = formm.attr('action').replace(':ACTU_ID', idd);
        var dataa = formm.serialize();

        $.post(urll, dataa, function(result){
            $.each(result.info, function(){
                $('#statut_'+this.id).html(
                    '<td>'+ this.statut +'</td>');

                if(this.statut == 'Archivé'){
                    $('#valable_'+this.id).hide();
                    $('#trash_'+this.id).hide();
                    $('#valable_'+this.id).toggle();
                }else if(this.statut == 'Actif'){
                    $('#valable_'+this.id).hide();
                    $('#trash_'+this.id).hide();
                    $('#trash_'+this.id).toggle();
                }
            });
        }).fail(function(){
            sweetAlert('Oups...', 'Une erreur est survenue', 'error');
            roww.show();
        });
    });
});




$(document).on('click','.pagination a', function(e){
    e.preventDefault;
    var page = $(this).attr('href').split('page=')[1];
    var url = "http://digitheque/actu";

    $.ajax({
        url: url,
        data: {page: page},
        type: 'GET',
        dataType: 'json',
        success: function(data){
            $('.actu_page').html(data.mavue);
        }
    });
    return false;
});