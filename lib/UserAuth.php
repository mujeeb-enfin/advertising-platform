<?php
// lib/UserAuth.php

class UserAuth {
    const RESET_SUCCESS = 1;
    const RESET_TOKEN_INVALID = 2;
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function register($username, $password, $email) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Example query: INSERT INTO users (username, password, email) VALUES (?, ?, ?)
        $query = "INSERT INTO users (username, password, email) VALUES (?, ?, ?)";
        $statement = $this->db->prepare($query);
        $statement->bind_param("sss", $username, $hashedPassword, $email);
        $statement->execute();
    }

    public function login($username, $password) {
        // Implement login logic and verify hashed password
        // Example query: SELECT * FROM users WHERE username = ?
        $query = "SELECT * FROM users WHERE username = ?";
        $statement = $this->db->prepare($query);
        $statement->bind_param("s", $username);
        $statement->execute();
        $result = $statement->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                // Password is correct, set user session
                $_SESSION['user_id'] = $user['id'];
                return true;
            }
        }

        return false;
    }

    public function logout() {
        // Implement logout logic
        session_destroy();
    }

    public function enableTwoFactorAuthentication($userId) {
        // Implement logic to enable two-factor authentication for the user
        // This is a placeholder and should be replaced with actual 2FA logic
    }

    public function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }

    public function isAdministrator($userId) {
        // Implement logic to check if the user has administrator privileges
        // This is a placeholder and should be replaced with actual logic
    }

    public function sendPasswordResetEmail($email) {
        $user = $this->getUserByEmail($email);

        if (!$user) {
            return false;
        }

        $resetToken = bin2hex(random_bytes(32));
        $expirationTime = time() + 3600;
        $this->storeResetToken($user['id'], $resetToken, $expirationTime);

        $subject = 'Password Reset';
        $message = "Click on the following link to reset your password: \n\n";
        $message .= "http://your-website.com/reset-password.php?token={$resetToken}";

        $headers = 'From: webmaster@example.com';
        mail($email, $subject, $message, $headers);

        return true;
    }

    private function getUserByEmail($email) {
        $query = "SELECT * FROM users WHERE email = ?";
        $statement = $this->db->prepare($query);
        $statement->bind_param("s", $email);
        $statement->execute();
        $result = $statement->get_result();

        return $result->fetch_assoc();
    }

    public function getUserById($id) {
        $query = "SELECT * FROM users WHERE id = ?";
        $statement = $this->db->prepare($query);
        $statement->bind_param("i", $id);
        $statement->execute();
        $result = $statement->get_result();

        return $result->fetch_assoc();
    }

    private function storeResetToken($userId, $token, $expirationTime) {
        $query = "INSERT INTO password_reset_tokens (user_id, token, expiration_time) VALUES (?, ?, ?)";
        $statement = $this->db->prepare($query);
        $statement->bind_param("iss", $userId, $token, $expirationTime);
        $statement->execute();
    }

    public function resetPassword_bkp($token, $newPassword) {
        $userId = $this->getUserIdByResetToken($token);

        if (!$userId) {
            return false;
        }

        $this->updatePassword($userId, $newPassword);
        $this->clearResetToken($userId);

        return true;
    }

    private function getUserIdByResetToken($token) {
        $query = "SELECT user_id FROM password_reset_tokens WHERE token = ? AND expiration_time > ?";
        $statement = $this->db->prepare($query);
        $currentTimestamp = time();
        $statement->bind_param("si", $token, $currentTimestamp);
        $statement->execute();
        $result = $statement->get_result();

        if ($result->num_rows === 1) {
            $resetData = $result->fetch_assoc();
            return $resetData['user_id'];
        }

        return null;
    }

    private function updatePassword($userId, $newPassword) {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $query = "UPDATE users SET password = ? WHERE id = ?";
        $statement = $this->db->prepare($query);
        $statement->bind_param("si", $hashedPassword, $userId);
        $statement->execute();
    }

    private function clearResetToken($userId) {
        $query = "DELETE FROM password_reset_tokens WHERE user_id = ?";
        $statement = $this->db->prepare($query);
        $statement->bind_param("i", $userId);
        $statement->execute();
    }

    public function hasPermission($userId, $permission) {
        // Implement logic to check if the user has the specified permission
        // This is a placeholder and should be replaced with actual permission checking logic
    }

    public function isUsernameTaken($username) {
        // Implement logic to check if the username is already taken
        // Replace the following query with the actual one
        $sql = "SELECT COUNT(*) FROM users WHERE username = :username";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        return $stmt->fetchColumn() > 0;
    }

    public function isEmailTaken($email) {
        // Implement logic to check if the email is already taken
        // Replace the following query with the actual one
        $sql = "SELECT COUNT(*) FROM users WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        return $stmt->fetchColumn() > 0;
    }

    public function resetPassword($token, $newPassword) {
        // Implement logic to reset the user's password using the provided token
        // Check if the token is valid and has not expired
        $userId = $this->getUserIdByResetToken($token);

        if (!$userId) {
            // Invalid or expired token
            return self::RESET_TOKEN_INVALID;
        }

        // Update the user's password in the database
        $this->updatePassword($userId, $newPassword);

        // Clear the reset token from the database (optional, depending on your use case)
        $this->clearResetToken($userId);

        return self::RESET_SUCCESS;
    }

}