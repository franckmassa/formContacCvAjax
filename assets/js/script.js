$(function() {
    $("#contact-form").submit(function(e) {

        // Après avoir soumis le formulaire, la fonction preventDefault permet de renvoyer les données sur la même page
        e.preventDefault();

        // Après avoir soumis le formulaire, la fonction empty permet de vider les commentaires
        $(".comments").empty();

        // On déclare une variable qui va stocker toutes des données serialisées
        var postdata = $("#contact-form").serialize();

        // Code Ajax
        $.ajax({
            // Type d'information que l'on veut envoyer
            type: 'POST',
            // On envoie vers
            url: 'php/contact.php',
            // On selectionne la data que l'on veut envoyer au document
            data: postdata,
            // On specifie le type de data
            dataType: 'json',
            // Dans le cas ou tout s'est bien passé, on exécute la fonction
            success: function(result) {

                if (result.isSuccess) {
                    // On affiche le message de succès 
                    $("#contact-form").append("<p class='thank-you'>Votre message a bien été envoyé. Merci de m'avoir contacté :)</p>");

                    // On reset toutes les variables
                    $("#contact-form")[0].reset();
                } else {
                    // Si il y a une erreur, on l'affiche en selectionnant l'élément class comments qui suis l'id #firstname
                    $("#firstname + .comments").html(result.firstnameError);
                    $("#lastname + .comments").html(result.lastnameError);
                    $("#email + .comments").html(result.emailError);
                    $("#phone + .comments").html(result.phoneError);
                    $("#message + .comments").html(result.messageError);
                }
            }
        });

    });

});