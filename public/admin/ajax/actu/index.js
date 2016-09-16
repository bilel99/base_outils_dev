/**
 * Created by bilel on 16/09/2016.
 */
/**
 * Created by bilel on 06/09/2016.
 */
/**
 * GET INFO STATUS
 */
$(document).ready(function(){

    var row = $(this).parents('tr');
    var url = 'actu';

    $.get(url, function(result){
        $.each(result.info, function(){
            if(this.status == "0"){
                $('#innactif_'+this.id).hide();
                $('#actif_'+this.id).toggle();

            }else if(this.status == "1"){
                $('#actif_'+this.id).hide();
                $('#innactif_'+this.id).toggle();
            }
        });

    }).fail(function(){
        sweetAlert('Oups...', 'Une erreur est survenue', 'error');
        row.show();
    });

});





/**
 * Archive / Actif STATUS
 */
$(document).ready(function(){
    $('.btn_innactif').click(function(e){
        e.preventDefault();
        var row = $(this).parents('tr');
        var id = row.data('id');
        var form = $('#form-innactif');
        var url = form.attr('action').replace(':ACTU_ID', id);
        var data = form.serialize();

        $.post(url, data, function(result){
            $.each(result.info, function(){
                $('#innactif_'+this.id).hide();
                $('#actif_'+this.id).show();
            });
        }).fail(function(){
            sweetAlert('Oups...', 'Une erreur est survenue', 'error');
            row.show();
        });
    });
});




/**
 * Archive / Actif STATUS
 */
$(document).ready(function(){
    $('.btn_actif').click(function(e){
        e.preventDefault();
        var row = $(this).parents('tr');
        var id = row.data('id');
        var form = $('#form-actif');
        var url = form.attr('action').replace(':ACTU_ID', id);
        var data = form.serialize();

        $.post(url, data, function(result){
            $.each(result.info, function(){
                $('#actif_'+this.id).hide();
                $('#innactif_'+this.id).show();
            });
        }).fail(function(){
            sweetAlert('Oups...', 'Une erreur est survenue', 'error');
            row.show();
        });
    });
});




// Suppression d'un éléments params
$(document).ready(function(){
    $('.btn_del').click(function(e){
        e.preventDefault();
        var row = $(this).parents('tr');
        var id = row.data('id');
        var form = $('#form-del');
        var url = form.attr('action').replace(':ACTU_ID', id);
        var data = form.serialize();

        $.post(url, data, function(result){
            $('.paramsLinter_'+id).fadeOut();

        }).fail(function(){
            sweetAlert('Oups...', 'Une erreur est survenue', 'error');
            row.show();
        });
    });
});




