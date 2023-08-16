<?php

/**
 * Theme filters.
 */

namespace App;

/**
 * Add "… Continued" to the excerpt.
 *
 * @return string
 */
add_filter('excerpt_more', function () {
    return sprintf(' &hellip; <a href="%s">%s</a>', get_permalink(), __('Continued', 'sage'));
});

/**
 * Activation de la prise en charge du svg
 */
add_filter('upload_mimes', function ($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
});

/**
 * Ajoute la prise en charge du formulaire de mail
 */
add_filter("Theme_sage_form_contact", function ($post) {
    if (!isset($post["FomContact"]) || !isset($post["Name"]) || !isset($post["FirstName"]) || !isset($post["Mail"]) || !isset($post["Phone"]) || !isset($post["Sujet"]) || !isset($post["Txt"]) || !isset($post["Consent"])) {
        return 2;
    }
    $name = htmlentities(trim($post["Name"]));
    $first_name = htmlentities(trim($post["FirstName"]));
    $mail = htmlentities(trim($post["Mail"]));
    $phone = htmlentities(trim($post["Phone"]));
    $sujet = htmlentities(trim($post["Sujet"]));
    $txt = $post["Txt"];

    $regex_mail = "/^(?<user>[a-zA-Z0-9.]{1,})@(?<domaine>[a-zA-Z0-9._-]{1,})\.(?<extend>[a-zA-Z]{1,})$/";
    $regex_phone = "/^(?<code>\+[0-9]{2}|0)(?<prefix>[0-9]{1})(?<number>[0-9]{8})$/";

    $mail_txt;


    // Vérification du nom, du prénom, du texte ou du sujet
        if (strlen($name) < 1 || strlen($first_name) < 1 || strlen($txt) < 1 || strlen($sujet) < 1) {
            return 2;
        }

    // Vérification du mail
        if (!preg_match($regex_mail, $mail)) {
            return 2;
        }

    // Vérification du numéro de téléphone
        if (!preg_match($regex_phone, $phone) && $phone !== "+33" && $hone !== "") {
            return 2;
        }

    // Mise en page du fichier
        $mail_txt = "Nom: " . $name . "\r\n";
        $mail_txt .= "Prénom: " . $first_name . "\r\n";
        $mail_txt .= "Mail: " . $mail . "\r\n";
        $mail_txt .= "Tél: " . $phone . "\r\n";
        $mail_txt .= "Sujet: " . $sujet . "\r\n";
        $mail_txt .= "message: \r\n" . $txt;

    // Envoie du mail
        if (!wp_mail($mail, "[test Webidea] Formulaire de contact contact", $mail_txt)) {
            return 2;
        }

    return 1;
});
