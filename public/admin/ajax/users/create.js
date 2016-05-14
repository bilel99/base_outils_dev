/**
 * Created by bilel on 12/03/2016.
 */
function generer_password(password) {
    var ok = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789:;=+-_&|^$*£%';
    var pass = '';
    longueur = 14;
    for(i=0;i<longueur;i++){
        var wpos = Math.round(Math.random() * ok.length);
        pass+=ok.substring(wpos,wpos+1);
    }
    document.getElementById(password).value = pass;
}


$(document).ready(function(){
    // Si role -> admin alors fonctionnalité ci dessous sinon c'est pas la peine
    $('#id_role').on('change', function(){

        if($('#id_role').val() != 2){
            $('#iciPays').fadeOut();
            $('#iciVille').fadeOut();
            $('#password').fadeOut();

        }else{
            $('#iciPays').fadeIn();
            $('#iciVille').fadeIn();
            $('#password').fadeIn();

        }
    });


    var lpays = $('#id_pays');
    var lville = $('#id_ville');
    var url = window.location.href;

    // Chargement des pays sur la listes déroulante
    $.get(url, function(result){
        $.each(result.pays, function(){
            lpays.append('<option value="'+ this.id +'">'+ this.nom_fr_fr +'</option>');
        });

    }).fail(function(){
        sweetAlert('Oups...', 'Une erreur est survenue', 'error');
    });



    // Chargement des villes selon le pays séléctionnée
    $('#id_pays').change(function(){
        var v =  $("#id_pays option:selected").val();
        var t =  $("#id_pays option:selected").text();

        $('#id_ville').change(function(){
            var contentVille = $("#id_ville option:selected").text();

            if(contentVille == ''){
                lville.append('<option value="">Aucune ville disponible pour le moment</option>');
            }
        });

        $.get(url, function(data){
            lville.empty();
            $.each(data.villes, function(){
                if(v == ''){
                    lville.empty();
                }else if(this.pays.id == v) {
                    lville.append('<option id="ville_' + this.id + '" value="' + this.id + '">' + this.libelle + '</option>');
                }
            });
            $('#id_ville').trigger("change");
        }).fail(function(){
            sweetAlert('Oups...', 'Une erreur est survenue', 'error');
        });
    });

});