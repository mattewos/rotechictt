<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect the form data sent from the original website
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Email details
    $to = "recipient@example.com"; // Replace with the target email
    $subject = "Message from " . $name;
    $body = "Name: $name\nEmail: $email\n\nMessage:\n$message";

    // Headers
    $headers = "From: $email" . "\r\n" .
               "Reply-To: $email" . "\r\n" .
               "X-Mailer: PHP/" . phpversion();

    // Send email
    if (mail($to, $subject, $body, $headers)) {
        echo "Message sent successfully!";
    } else {
        echo "Error: Message not sent.";
    }
} else {
    echo "Invalid request.";
}
?>
