<?php
// lib/EmailNotifier.php

class EmailNotifier {
    public function sendRegistrationEmail($email) {
        // Implement logic to send a registration confirmation email
        $subject = 'Registration Confirmation';
        $message = 'Thank you for registering!';
        $this->sendEmail($email, $subject, $message);
    }

    public function sendPasswordResetEmail($email) {
        // Implement logic to send a password reset email
        $subject = 'Password Reset';
        $message = 'Click the link to reset your password.';
        $this->sendEmail($email, $subject, $message);
    }

    public function sendAdStatusNotification($advertiserEmail, $adStatus) {
        // Implement logic to send email notifications to advertisers
        $subject = 'Ad Status Update';
        $message = "Your ad status is now: $adStatus";
        $this->sendEmail($advertiserEmail, $subject, $message);
    }

    private function sendEmail($to, $subject, $message) {
        // Placeholder for email sending logic
        // Replace this with your actual email sending implementation
        // For example, using PHP's mail() function or a third-party library

        // Sample mail() function usage (replace with your actual implementation)
        $headers = 'From: webmaster@example.com' . "\r\n";
        mail($to, $subject, $message, $headers);

        // Placeholder for logging email sending to a database
        $this->logEmail($to, $subject, $message);
    }

    private function logEmail($to, $subject, $message) {
        // Placeholder for logging email details to a database
        // Replace this with your actual database interaction code

        // Example SQL query for creating an email log table (adjust as needed)
        $query = "INSERT INTO email_log (recipient, subject, message, sent_at)
                  VALUES ('$to', '$subject', '$message', NOW())";
        // Execute the query using your database connection
        // Example: mysqli_query($your_db_connection, $query);
    }
}
