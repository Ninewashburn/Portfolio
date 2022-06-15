<?php

$VotreAdresseMail = "cenarius63@hotmail.fr";
if (isset($_POST['envoyer'])) {
    if (empty($_POST['mail'])) {
        echo "Le champ mail est vide";
    } else {
        if (!preg_match("#^[a-z0-9_-]+((\.[a-z0-9_-]+){1,})?@[a-z0-9_-]+((\.[a-z0-9_-]+){1,})?\.[a-z]{2,}$#i", $_POST['mail'])) {
            echo "L'adresse mail entrée est incorrecte";
            echo '<br><a href="index.html">Revenir au formulaire</a><br>';
        } else {
            if (empty($_POST['nom'])) {
                echo "Le champ nom est vide";
            } else {
                if (empty($_POST['message'])) {
                    echo "Le champ message est vide";
                } else {
                    $Entetes = "MIME-Version: 1.0\r\n";
                    $Entetes .= "Content-type: text/html; charset=UTF-8\r\n";
                    $Entetes .= "From: Meynadier-Renaud Portfolio <" . $_POST['mail'] . ">\r\n";
                    $Entetes .= "Reply-To: Meynadier-Renaud Portfolio <" . $_POST['mail'] . ">\r\n";
                    $Mail = $_POST['mail'];
                    $Nom = '=?UTF-8?B?' . base64_encode($_POST['nom']) . '?=';
                    $Message = htmlentities($_POST['message'], ENT_QUOTES, "UTF-8");
                    if (mail($VotreAdresseMail, $Nom, nl2br($Message), $Entetes)) {
                        header("location: index.html");
                    } else {
                        echo "Une erreur est survenue, le mail n'a pas été envoyé";
                    }
                }
            }
        }
    }
}
