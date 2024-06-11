<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

require 'vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Honeypot check
    if (!empty($_POST['honeypot'])) {
        $_SESSION['errors'] = ['honeypot' => 'Spam detected!'];
        header('Location: index.php');
        exit;
    }

    // Sanitize and validate input
    $name = htmlspecialchars(trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS)));
    $lastname = htmlspecialchars(trim(filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS)));
    $gender = htmlspecialchars(trim(filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_FULL_SPECIAL_CHARS)));
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $country = htmlspecialchars(trim(filter_input(INPUT_POST, 'country', FILTER_SANITIZE_FULL_SPECIAL_CHARS)));
    $subject = htmlspecialchars(trim(filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_FULL_SPECIAL_CHARS)));
    $message = htmlspecialchars(trim(filter_input(INPUT_POST, 'message', FILTER_SANITIZE_FULL_SPECIAL_CHARS)));

    $errors = [];

    if (!$name) {
        $errors['name'] = "Firstname required";
    }

    if (!$lastname) {
        $errors['lastname'] = "Lastname required";
    }

    if (!$gender || !in_array($gender, ['male', 'female', 'other'])) {
        $errors['gender'] = "Invalid gender";
    }

    if (!$email) {
        $errors['email'] = "Invalid email";
    }

    if (!$country) {
        $errors['country'] = "Invalid country";
    }

    if (!$message) {
        $errors['message'] = "Message required";
    }

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['form_data'] = $_POST;
        header('Location: index.php');
        exit;
    }

    $mail = new PHPMailer(true);
    $mail->SetLanguage("fr", "phpmailer/language");
    $mail->CharSet = 'UTF-8';
    $mail->Encoding = 'quoted-printable';

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.office365.com';
        $mail->SMTPAuth = true;
        $mail->Username = $_ENV['SMTP_USERNAME'];
        $mail->Password = $_ENV['SMTP_PASSWORD'];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;


        // Recipients
        $mail->setFrom($_ENV['SMTP_USERNAME'], 'Hackers Poulette Support');
        $mail->addAddress('justine0912@gmail.com');
        $mail->addReplyTo($email, "$name $lastname");

        // Content
        $mail->isHTML(false);
        $mail->Subject = "Contact Form: " . $subject;
        $mail->Body = "Nom: $name\nPrénom: $lastname\nGenre: $gender\nEmail: $email\nPays: $country\n\nMessage:\n$message";

        $mail->send();
        echo 'E-mail successfully sent.';
    } catch (Exception $e) {
        $_SESSION['error'] = "E-mail failed to be sent. Mailer Error: {$mail->ErrorInfo}";
        header('Location: index.php');
    }

    exit;
}
