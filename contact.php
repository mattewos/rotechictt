<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate user input
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Create an instance of PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'therapywithbini@gmail.com'; // Your Gmail address
        $mail->Password = 'kxrzcjqriqbdwqaw'; // Your App Password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Recipients
        $mail->setFrom($email, $name);
        $mail->addAddress('your-receiving-email@gmail.com'); // Your receiving email address

        // Content
        $mail->isHTML(false); // Set email format to plain text
        $mail->Subject = 'New Contact Us Message';
        $mail->Body = "Name: $name\nEmail: $email\nPhone: $phone\nMessage: $message";

        // Send email
        $mail->send();
        header("Location: contact.html?status=success");
        exit();
    } catch (Exception $e) {
        header("Location: contact.html?status=error");
        exit();
    }
} else {
    echo "Invalid request method.";
}
?>
