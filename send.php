<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = htmlspecialchars($_POST["nom"]);
    $prenom = htmlspecialchars($_POST["prenom"]);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Adresse e-mail invalide.";
        exit;
    }

    $mail = new PHPMailer(true);

    try {
        // Paramètres SMTP (à remplacer par vos informations)
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'votre@gmail.com'; // Votre adresse Gmail
        $mail->Password = 'votreMotDePasse'; // Votre mot de passe ou mot de passe d'application
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Destinataires
        $mail->setFrom('no-reply@endurance-extreme.fr', 'Newsletter');
        $mail->addAddress('mohamedjerbi85@gmail.com');

        // Contenu
        $mail->isHTML(false);
        $mail->Subject = 'Nouvelle inscription à la newsletter';
        $mail->Body = "Nouvelle inscription :\n\nNom : $nom\nPrénom : $prenom\nEmail : $email";

        $mail->send();
        echo 'Merci pour votre inscription !';
    } catch (Exception $e) {
        echo "L'envoi a échoué. Erreur : {$mail->ErrorInfo}";
    }
} else {
    echo "Méthode non autorisée.";
}
?>
