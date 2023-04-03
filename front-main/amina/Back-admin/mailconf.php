<?php

    include "C:/xampp/htdocs/Crudx/core/commandecore.php";

    include "PHPMailer/src/PHPMailer.php";
    include "PHPMailer/src/Exception.php";
    include "PHPMailer/src/SMTP.php";
    if (isset($_POST['email']))
    {
$mail = new \PHPMailer\PHPMailer\PHPMailer();
$mail->isSMTP(true); // Paramétrer le Mailer pour utiliser SMTP
$mail->Host = 'smtp.gmail.com'; // Spécifier le serveur SMTP
$mail->Port = '465';
$mail->SMTPAuth = true;// Activer authentication SMTP
$mail->SMTPSecure = 'ssl'; // Accepter SSL
$mail->isHTML(true);
$mail->Username = 'mailenvoi00@gmail.com'; // Votre adresse email d'envoi
$mail->Password = 'Esprit2020'; // Le mot de passe de cette adresse email
$mail->SetFrom('agro@gmail.com', 'AgrO'); // Personnaliser l'envoyeur
$mail->addAddress($_POST['email']); // Paramétrer le format des emails en HTML ou non
$mail->Subject = 'Mail de confirmation';
$mail->Body = '<h1 align=center>Votre commande a été effectuée avec succès</h1><br>';
if(!$mail->send()) {
    echo 'Erreur! Mail non envoyé !';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
    }
else {
    echo 'Le mail a bien été envoyé !';
     }

}

    header('Location: index.php');
?>