<?php
// lib/AdTagGenerator.php

class AdTagGenerator {
    // Database connection (replace with your actual database connection code)
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function generateAdTag($adId, $publisherId) {
        // Implement logic to generate ad tags for publishers
        // This is a placeholder and should be replaced with actual ad tag generation logic

        // For simplicity, let's assume fetching ad details from the database
        $adDetails = $this->getAdDetails($adId);

        if ($adDetails) {
            $adTag = $this->buildAdTag($adDetails, $publisherId);
            return $adTag;
        }

        return false; // Unable to generate ad tag
    }

    private function getAdDetails($adId) {
        // Implement logic to retrieve ad details based on ad ID
        // This is a placeholder and should be replaced with actual database queries

        // For simplicity, let's assume fetching ad details from the database
        $query = "SELECT id, title, description, image_url FROM ads WHERE id = :ad_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':ad_id', $adId);
        $stmt->execute();
        $adDetails = $stmt->fetch(PDO::FETCH_ASSOC);

        return $adDetails;
    }

    private function buildAdTag($adDetails, $publisherId) {
        // Implement dynamic and secure ad tag generation logic
    
        // Escape data for HTML output
        $escapedTitle = htmlspecialchars($adDetails['title']);
        $escapedDescription = htmlspecialchars($adDetails['description']);
    
        // Use a dynamic approach for HTML/JavaScript generation
        $adTag = '<div class="ad-container">';
        $adTag .= '<h2>' . $escapedTitle . '</h2>';
        $adTag .= '<p>' . $escapedDescription . '</p>';
        
        // Include width and height attributes for the ad image // width="300" height="250"
        $adTag .= '<img src="' . $adDetails['image_url'] . '" alt="'.$escapedTitle.'" >';
        
        $adTag .= '<p>Published by Publisher ID: ' . $publisherId . '</p>';
        $adTag .= '</div>';
    
        return $adTag;
    }
    
}
