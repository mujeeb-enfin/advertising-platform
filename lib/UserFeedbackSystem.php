<?php
// lib/UserFeedbackSystem.php

class UserFeedbackSystem {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function collectFeedback($userId, $adId, $rating, $comment = null) {
        // Implement logic to collect user feedback on ads
        // Example query: INSERT INTO ad_feedback (user_id, ad_id, rating, comment) VALUES (?, ?, ?, ?)
        $query = "INSERT INTO ad_feedback (user_id, ad_id, rating, comment) VALUES (?, ?, ?, ?)";
        $statement = $this->db->prepare($query);
        $statement->bind_param("iiis", $userId, $adId, $rating, $comment);
        $statement->execute();
    }

    public function getAverageRating($adId) {
        // Implement logic to calculate the average rating for a specific ad
        // Example query: SELECT AVG(rating) AS average_rating FROM ad_feedback WHERE ad_id = ?
        $query = "SELECT AVG(rating) AS average_rating FROM ad_feedback WHERE ad_id = ?";
        $statement = $this->db->prepare($query);
        $statement->bind_param("i", $adId);
        $statement->execute();
        $result = $statement->get_result();
        $averageRating = $result->fetch_assoc()['average_rating'];

        return $averageRating;
    }

    public function getFeedbackComments($adId) {
        // Implement logic to retrieve user comments for a specific ad
        // Example query: SELECT user_id, comment FROM ad_feedback WHERE ad_id = ?
        $query = "SELECT user_id, comment FROM ad_feedback WHERE ad_id = ?";
        $statement = $this->db->prepare($query);
        $statement->bind_param("i", $adId);
        $statement->execute();
        $result = $statement->get_result();
        $comments = [];

        while ($row = $result->fetch_assoc()) {
            $comments[] = [
                'user_id' => $row['user_id'],
                'comment' => $row['comment'],
            ];
        }

        return $comments;
    }
}
