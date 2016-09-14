$(document).ready(function () {

    // Fermeture automatique
    $('label.tree-toggler').parent().children('ul.tree').toggle(300);


    $('label.tree-toggler').click(function () {
        $(this).parent().children('ul.tree').toggle(300);
    });
    $(function () {
        $('.tree-toggler').parent().children('ul.tree').toggle(200);
    });
});
