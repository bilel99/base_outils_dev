/**
 * Created by bilel on 12/03/2016.
 */
$(document).ready(function(){
    var lpays = $('#id_pays');
    var lville = $('#id_ville');
    var url = "http://digitheque/users/3/edit";

    // Chargement des pays sur la listes déroulante
    $.get(url, function(result){
        $.each(result.pays, function(){
            lpays.append('<option value="'+ this.id +'">'+ this.nom_fr_fr +'</option>');
        });

        $.each(result.ville_choix, function(){
            lville.append('<option id="ville_' + this.id + '" value="' + this.id + '">' + this.libelle + '</option>');
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