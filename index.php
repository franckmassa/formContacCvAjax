<?php
// On initialise les variables à vide pour la première fois
$firstname = $lastname = $email = $phone = $message = '';

// On initialise les variables à vide pour la première fois pour les messages d'erreurs
$firstnameError = $lastnameError = $emailError = $phoneError = $messageError = '';

// On initialise la variable isSuccess correspondant au message d'envoi du formulaire à false
$isSuccess = false;

// On
$emailTo = 'massafranck@gmail.com';

// VALIDATION DES DONNÉES:
// Si l'on a soumis le formulaire, on stocke les données dans les variables
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // On utilise la fonction verifyInput() pour nettoyer et protéger les champs contre les failles de sécurité
    $firstname = verifyInput($_POST['firstname']);
    $lastname = verifyInput($_POST['lastname']);
    $email = verifyInput($_POST['email']);
    $phone = verifyInput($_POST['phone']);
    $message = verifyInput($_POST['message']);
    // On affiche le message d'envoi du formulaire
    $isSuccess = true;
    // On initialise la variable emailText à vide
    $emailText = '';

    // Lorsque l'on soumet le formulaire avec le champ vide, on affiche les messages d'erreur et on n'affiche
    // pas le message d'envoi du formulaire
    if (empty($firstname)) {
        $firstnameError = 'Merci d\'indiquer votre prénom';
        $isSuccess = false;
    } else {
        $emailText .= 'Firstname: $firstname\n';
    }
    if (empty($lastname)) {
        $lastnameError = 'Merci d\'indiquer votre nom';
        $isSuccess = false;
    } else {
        $emailText .= 'Lastname: $lastname\n';
    }
    if (empty($message)) {
        $messageError = 'Merci d\'écrire votre message';
        $isSuccess = false;
    } else {
        $emailText .= 'Message: $message\n';
    }

// On utilise la fonction isEmail
    if (!isEmail($email)) {
        $emailError = 'Merci de respecter le format email';
        $isSuccess = false;
    } else {
        $emailText .= 'Email: $email\n';
    }

// On utilise la fonction isPhone
    if (!isPhone($phone)) {
        $phoneError = 'Seuls les chiffres et les espaces sont autorisés';
        $isSuccess = false;
    } else {
        $emailText .= 'Phone: $phone\n';
    }

    //
    if ($isSuccess) {
        // On envoi l'email
        $headers = 'From: $firstname $lastname <$email>\rnReply-To: $email';
        mail($emailTo, 'Un message de votre site', $emailText, $headers);
        // On réinitialise les variable à vide après l'envoi de l'email. On vide les champs
        $firstname = $lastname = $email = $phone = $message = '';
    }
}

// On crée la fonction isEmail() pour vérifier l'email
function isEmail($var) {
    // On compare le filtre à la variable
    return filter_var($var, FILTER_VALIDATE_EMAIL);
}

// On crée la fonction isPhone() pour vérifier le numéro de téléphone
function isPhone($var) {
    // On compare l'expression régulière à la variable
    // Tous les chiffre de 0 à 9 et les espaces peuvent être utilisés plusieurs fois
    return preg_match('/^[0-9 ]*$/', $var);
}

// On crée une fonction pour vérifier la sécurité des Input avec comme paramètre $var
function verifyInput($var) {
    // Supprime les espaces en début et fin de chaîne
    $var = trim($var);
    // Supprime les antislashs d'une chaîne
    $var = stripslashes($var);
    //  Convertit les caractères spéciaux en entités HTML, contre les faille xss
    $var = htmlspecialchars($var);

    return $var;
}
?>
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
                    <!-- On utilise la super global $_SERVER pour renvoyer les données sur la page acuelle -->
                    <form id="contact-form" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?> " method="post" role="form">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="firstname">Prénom<span class="blue"> *</span></label>

                                <!-- On utilise l'attribut value pour afficher la valeur entrée dans le champ prénom.
                                     On utilise required pour la validation du coté client (message d'alerte) -->
                                <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Votre prénom" value="<?= $firstname ?>">
                                <p class="comments"><?= $firstnameError ?></p>
                            </div>
                            <div class="col-md-6">
                                <label for="lastname">Nom<span class="blue"> *</span></label>
                                <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Votre nom" value="<?= $lastname ?>">
                                <p class="comments"><?= $lastnameError ?></p>
                            </div>
                            <div class="col-md-6">
                                <label for="email">Email<span class="blue"> *</span></label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Votre Email" value="<?= $email ?>"/>
                                <p class="comments"><?= $emailError ?></p>
                            </div>
                            <div class="col-md-6">
                                <label for="phone">Téléphone</label>
                                <input type="tel" name="phone" id="phone" class="form-control" placeholder="Votre téléphone" value="<?= $phone ?>">
                                <p class="comments"><?= $phoneError ?></p>
                            </div>
                            <div class="col-md-12">
                                <label for="message">Message<span class="blue"> *</span></label>
                                <textarea id="message" name="message" class="form-control" placeholder="Votre message" rows="4"><?= $message ?></textarea>
                                <p class="comments"><?= $messageError ?></p>
                            </div>
                            <div class="col-md-12">
                                <p class="blue"><strong>Ces informations sont requises</strong></p>
                            </div>
                            <div class="col-md-12">
                                <input type="submit" class="button1" value="Envoyer"/>
                            </div>
                        </div>
                        <!-- Si le formulaire est soumis avec succès, on affiche block sinon on affiche none -->
                        <p class="thank-you" style="display:
                           <?php
                           if ($isSuccess) {
                               echo 'block';
                           } else {
                               echo 'none';
                           }
                           ?>">Votre message a bien été envoyé. Merci de m'avoir contacté :)
                        </p>
                    </form>
                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="assets/js/script.js"></script>
    </body>

</html>