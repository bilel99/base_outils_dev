/**
 * Created by bilel on 16/09/2016.
 */
    var url = 'register';
    affichage();

    // Lancement de la fonction toutes les 4 secondes
    setInterval(refreshActu, 4000);


    function affichage(){
        $.get(url, function(result){
            //console.log(result.actu[0]['id']);
            $.each(result.actu, function(){
                // Ajout de l'image
                $('.image').html('<img src="'+this.image+'" alt="'+this.libelle+'" class="img-responsive img-circle" width="300">');

                // Ajout du titre
                $('.titre').html('<h3><b>'+this.libelle+'</b></h3>');

                // Ajout de la description
                $('.description').html('<h4><i>'+this.description+'</i></h4>');
            });
        }).fail(function(){
            sweetAlert('Oups...', 'Une erreur est survenue', 'error');
            row.show();
        });
    }

    function refreshActu(){
        $.get(url, function(result){
            //console.log(result.actu[0]['id']);
            $.each(result.actu, function(){
                // Ajout de l'image
                $('.image').html('<img src="'+this.image+'" alt="'+this.libelle+'" class="img-responsive img-circle" width="300">');

                // Ajout du titre
                $('.titre').html('<h3><b>'+this.libelle+'</b></h3>');

                // Ajout de la description
                $('.description').html('<h4><i>'+this.description+'</i></h4>');
            });
        }).fail(function(){
            sweetAlert('Oups...', 'Une erreur est survenue', 'error');
            row.show();
        });
    }