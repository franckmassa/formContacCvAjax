<?php

// On initialise les variables pour la première fois dans un seul objet
$array = array('firstname' => '', 'lastname' => '', 'email' => '', 'phone' => '', 'message' => '', 'firstnameError' => '',
    'lastnameError' => '', 'emailError' => '', 'phoneError' => '', 'messageErrorr' => '', 'isSuccess' => false);

// On déclare l'adresse email du destinataire
$emailTo = 'massafranck@gmail.com';

// VALIDATION DES DONNÉES:
// Si l'on a soumis le formulaire, on stocke les données dans les variables
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // On utilise la fonction verifyInput() pour nettoyer et protéger les champs contre les failles de sécurité
    $array['firstname'] = verifyInput($_POST['firstname']);
    $array['lastname'] = verifyInput($_POST['lastname']);
    $array['email'] = verifyInput($_POST['email']);
    $array['phone'] = verifyInput($_POST['phone']);
    $array['message'] = verifyInput($_POST['message']);
    // On affiche le message d'envoi du formulaire
    $array['isSuccess'] = true;
    // On initialise la variable emailText à vide
    $emailText = '';

    // Lorsque l'on soumet le formulaire avec le champ vide, on affiche les messages d'erreur et on n'affiche
    // pas le message d'envoi du formulaire
    if (empty($array['firstname'])) {
        $array['firstnameError'] = 'Merci d\'indiquer votre prénom';
        $array['isSuccess'] = false;
    } else {
        // On met des accolades pour spécifier que c'est une variable
        $emailText .= "Firstname: {$array['firstname']}\n";
    }
    if (empty($array['lastname'])) {
        $array['lastnameError'] = 'Merci d\'indiquer votre nom';
        $array['isSuccess'] = false;
    } else {
        $emailText .= "Lastname: {$array['lastname']}\n";
    }

// On utilise la fonction isEmail
    if (!isEmail($array['email'])) {
        $array['emailError'] = 'Merci de respecter le format email';
        $array['isSuccess'] = false;
    } else {
        $emailText .= "Email: {$array['email']}\n";
    }

// On utilise la fonction isPhone
    if (!isPhone($array['phone'])) {
        $array['phoneError'] = 'Seuls les chiffres et les espaces sont autorisés';
        $array['isSuccess'] = false;
    } else {
        $emailText .= "Phone: {$array['phone']}\n";
    }

    if (empty($array['message'])) {
        $array['messageError'] = 'Merci d\'écrire votre message';
        $array['isSuccess'] = false;
    } else {
        $emailText .= "Message: {$array['message']}\n";
    }

    // Si il ny a pas d'erreur, on envoie l'email
    if ($array['isSuccess']) {
        // On envoi l'email
        $headers = "From: {$array['firstname']} {$array['lastname']} <{$array['email']}>\rnReply-To: {$array['email']}";
        mail($emailTo, 'Un message de votre site', $emailText, $headers);
    }

    // Encode en objet json le array qui contient tout le resultat du travail de php
} echo json_encode($array);

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
