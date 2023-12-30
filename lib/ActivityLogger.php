<?php
// lib/ActivityLogger.php

class ActivityLogger {
    // Database connection (replace with your actual database connection code)
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function logActivity($userId, $action) {
        // Insert user activity data into the database
        $query = "INSERT INTO user_activity_log (user_id, action, timestamp) VALUES (:user_id, :action, NOW())";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':action', $action);

        if ($stmt->execute()) {
            // User activity successfully logged
            return true;
        } else {
            // Logging user activity failed
            return false;
        }
    }
}
