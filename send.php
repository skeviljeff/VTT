<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = htmlspecialchars($_POST["nom"]);
    $prenom = htmlspecialchars($_POST["prenom"]);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);

    $to = "mohamedjerbi85@gmail.com";
    $subject = "Nouvelle inscription à la newsletter";
    $message = "Nouvelle inscription :\n\nNom : $nom\nPrénom : $prenom\nEmail : $email";
    $headers = "From: no-reply@endurance-extreme.fr";

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        if (mail($to, $subject, $message, $headers)) {
            echo "Merci pour votre inscription !";
        } else {
            echo "Erreur lors de l'envoi du message.";
        }
    } else {
        echo "Adresse e-mail invalide.";
    }
} else {
    echo "Méthode non autorisée.";
}
?>
