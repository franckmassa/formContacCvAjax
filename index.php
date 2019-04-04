<!DOCTYPE html>
<html lang="fr" dir="ltr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/style.css">
        <title>Contactez moi</title>
    </head>

    <body>
        <div class="container">
            <div class="divider"></div>
            <div class="heading">
                <h2>Contactez-moi</h2>
            </div>
            <div class="row">
                <!-- Avec Offset, on aura une bordure à gauche du formulaire pour le responsive -->
                <div class="col-lg-10 col-lg-offset-1">

                    <form id="contact-form" action=" " method="post" role="form">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="firstname">Prénom<span class="blue"> *</span></label>
                                <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Votre prénom" />
                                <p class="comments"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="lastname">Nom<span class="blue"> *</span></label>
                                <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Votre nom" />
                                <p class="comments"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="email">Email<span class="blue"> *</span></label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Votre Email" />
                                <p class="comments"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="phone">Téléphone</label>
                                <input type="tel" name="phone" id="phone" class="form-control" placeholder="Votre téléphone" />
                                <p class="comments"></p>
                            </div>
                            <div class="col-md-12">
                                <label for="message">Message<span class="blue"> *</span></label>
                                <textarea id="message" name="message" class="form-control" placeholder="Votre message" rows="4"></textarea>
                                <p class="comments"></p>
                            </div>
                            <div class="col-md-12">
                                <p class="blue"><strong>Ces informations sont requises</strong></p>
                            </div>
                            <div class="col-md-12">
                                <input type="submit" class="button1" value="Envoyer"/>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="assets/js/script.js"></script>
    </body>

</html>