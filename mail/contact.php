<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Recipient email address
        $recipient_email = "munyangesamsonj@gmail.com";

        // Sender email address (use the user's email address from the form)
        $sender_email = sanitize_email($_POST["email"]);

        // Subject and message
        $subject = sanitize_text_field($_POST["subject"]);
        $message = sanitize_text_field($_POST["message"]);

        // Set up email headers
        $email_headers = "From: $sender_email\r\n";
        $email_headers .= "Reply-To: $sender_email\r\n";
        $email_headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

        // Send the email
        if (wp_mail($recipient_email, $subject, $message, $email_headers)) {
            echo "success";
        } else {
            echo "error";
        }
    } else {
        echo "error";
    }

    // Sanitize email and text field inputs
    function sanitize_email($field) {
        return filter_var(trim($field), FILTER_SANITIZE_EMAIL);
    }

    function sanitize_text_field($field) {
        return filter_var(trim($field), FILTER_SANITIZE_STRING);
    }
?>