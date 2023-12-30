
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    address VARCHAR(255),
    phone_number VARCHAR(20),
    registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_login TIMESTAMP,
    is_admin BOOLEAN DEFAULT FALSE
    -- Add more user-related fields as needed
);

CREATE TABLE invoices (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    campaign_id INT,
    invoice_number VARCHAR(20) NOT NULL,
    invoice_date DATE NOT NULL,
    due_date DATE NOT NULL,
    amount_due DECIMAL(10, 2) NOT NULL,
    status ENUM('unpaid', 'paid') DEFAULT 'unpaid',
    payment_date TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (campaign_id) REFERENCES ad_campaigns(campaign_id)
    -- Add more invoice-related fields as needed
);

CREATE TABLE ads (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    image_url VARCHAR(255) NOT NULL,
    advertiser_id INT NOT NULL,
    status VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_status (status),
    INDEX idx_created_at (created_at)
);

CREATE TABLE ad_impressions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ad_id INT NOT NULL,
    user_id INT NOT NULL,
    impression_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_ad_id (ad_id),
    INDEX idx_impression_time (impression_time)
);

 CREATE TABLE clicks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ad_id INT NOT NULL,
    user_id INT NOT NULL,
    click_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_ad_id (ad_id),
    INDEX idx_click_time (click_time)
);

CREATE TABLE campaigns (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    budget DECIMAL(10, 2) NOT NULL,
    advertiser_id INT NOT NULL,
    FOREIGN KEY (advertiser_id) REFERENCES advertisers(id)
);

CREATE TABLE user_activity_log (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    action VARCHAR(255) NOT NULL,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES advertisers(id)
);



CREATE TABLE payments (
    payment_id INT PRIMARY KEY AUTO_INCREMENT,
    campaign_id INT,
    payment_date DATETIME NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    status ENUM('pending', 'completed') NOT NULL,
    FOREIGN KEY (campaign_id) REFERENCES campaigns(campaign_id)
);
INSERT INTO users (username, password, email, user_type)
VALUES ('advertiser1', 'password123', 'advertiser1@example.com', 'advertiser');
INSERT INTO ads (title, description, image_url, advertiser_id)
VALUES ('Ad Title 1', 'Description for Ad 1', 'image1.jpg', 1);
INSERT INTO campaigns (name, start_date, end_date, budget, advertiser_id)
VALUES ('Campaign 1', '2023-01-01', '2023-01-31', 1000.00, 1);
INSERT INTO ad_impressions (ad_id, user_id, impression_date)
VALUES (1, 2, '2023-01-15 12:30:00');
INSERT INTO clicks (ad_id, user_id, click_date)
VALUES (1, 2, '2023-01-15 12:35:00');
INSERT INTO payments (campaign_id, payment_date, amount, status)
VALUES (1, '2023-01-31 15:00:00', 1000.00, 'completed');

-- Create a table for A/B testing results
CREATE TABLE ab_testing_results (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ad_id INT NOT NULL,
    variant VARCHAR(255) NOT NULL,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


-- Create a table for ad performance data
CREATE TABLE ad_performance (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    ad_id INT NOT NULL,
    clicks INT NOT NULL,
    impressions INT NOT NULL,
    revenue DECIMAL(10, 2) NOT NULL,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE ad_interactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    ad_id INT NOT NULL,
    interaction_type VARCHAR(255) NOT NULL,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_user_id (user_id),
    INDEX idx_ad_id (ad_id),
    INDEX idx_interaction_type (interaction_type)
);
CREATE TABLE auction_log (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    ad_id INT NOT NULL,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_user_id (user_id),
    INDEX idx_ad_id (ad_id),
    INDEX idx_timestamp (timestamp)
);

CREATE TABLE ad_block_log (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_user_id (user_id),
    INDEX idx_timestamp (timestamp)
);

CREATE TABLE advertisers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    contact_person VARCHAR(255),
    email VARCHAR(255) NOT NULL,
    phone_number VARCHAR(20),
    company_name VARCHAR(255),
    industry VARCHAR(100),
    address VARCHAR(255),
    city VARCHAR(100),
    state VARCHAR(100),
    country VARCHAR(100),
    postal_code VARCHAR(20),
    registration_date DATE DEFAULT CURRENT_DATE
);


CREATE TABLE compliance_log (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ad_id INT NOT NULL,
    is_compliant BOOLEAN NOT NULL,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_ad_id (ad_id),
    INDEX idx_is_compliant (is_compliant),
    INDEX idx_timestamp (timestamp)
);

CREATE TABLE content_moderation_log (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ad_id INT NOT NULL,
    is_content_moderated BOOLEAN NOT NULL,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_ad_id (ad_id),
    INDEX idx_is_content_moderated (is_content_moderated),
    INDEX idx_timestamp (timestamp)
);

CREATE TABLE conversion_log (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ad_id INT NOT NULL,
    conversion_data TEXT NOT NULL,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_ad_id (ad_id),
    INDEX idx_timestamp (timestamp)
);

CREATE TABLE copy_test_results (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ad_id INT NOT NULL,
    test_data TEXT NOT NULL,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_ad_id (ad_id),
    INDEX idx_timestamp (timestamp)
);

CREATE TABLE ad_exchange_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    additional_ads TEXT NOT NULL,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_user_id (user_id),
    INDEX idx_timestamp (timestamp)
);

CREATE TABLE fraud_detection_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ad_id INT NOT NULL,
    is_fraudulent BOOLEAN NOT NULL,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_ad_id (ad_id),
    INDEX idx_is_fraudulent (is_fraudulent),
    INDEX idx_timestamp (timestamp)
);

CREATE TABLE inventory_forecast_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    forecast_date DATE NOT NULL,
    forecasted_inventory INT NOT NULL,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_forecast_date (forecast_date),
    INDEX idx_timestamp (timestamp)
);

CREATE TABLE inventory_heatmap_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    heatmap_date DATE NOT NULL,
    heatmap_data TEXT NOT NULL,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_heatmap_date (heatmap_date),
    INDEX idx_timestamp (timestamp)
);

CREATE TABLE load_balancer_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    balanced_ads TEXT NOT NULL,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_timestamp (timestamp)
);
CREATE TABLE ad_bids (
    bid_id INT PRIMARY KEY AUTO_INCREMENT,
    ad_id INT,
    bid_amount DECIMAL(10, 2),
    user_id INT,
    bid_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (ad_id) REFERENCES ads(ad_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

-- SQL Query to create ad_pricing table
CREATE TABLE ad_pricing (
    id INT PRIMARY KEY AUTO_INCREMENT,
    ad_id INT NOT NULL,
    base_price DECIMAL(10, 2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (ad_id) REFERENCES ads(id)
);

CREATE TABLE fraud_detection_data (
    id INT PRIMARY KEY AUTO_INCREMENT,
    ad_id INT NOT NULL,
    detection_timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    detection_data TEXT,
    -- Add other relevant columns as needed
    FOREIGN KEY (ad_id) REFERENCES ads(id)
);
INSERT INTO fraud_detection_data (ad_id, detection_data)
VALUES
    (1, '{"source": "anomaly_detection", "score": 0.85, "reason": "Unusual Click Patterns"}'),
    (2, '{"source": "behavioral_analysis", "score": 0.92, "reason": "Abnormal User Behavior"}'),
    (3, '{"source": "anomaly_detection", "score": 0.78, "reason": "Unusual Click Patterns"}'),
    (4, '{"source": "click_time_analysis", "score": 0.65, "reason": "Suspicious Click Timing"}'),
    (5, '{"source": "anomaly_detection", "score": 0.91, "reason": "Unusual Click Patterns"}'),
    (6, '{"source": "behavioral_analysis", "score": 0.88, "reason": "Abnormal User Behavior"}'),
    (7, '{"source": "anomaly_detection", "score": 0.72, "reason": "Unusual Click Patterns"}'),
    (8, '{"source": "click_time_analysis", "score": 0.68, "reason": "Suspicious Click Timing"}'),
    (9, '{"source": "anomaly_detection", "score": 0.89, "reason": "Unusual Click Patterns"}'),
    (10, '{"source": "behavioral_analysis", "score": 0.94, "reason": "Abnormal User Behavior"}');

CREATE TABLE advanced_analytics_data (
    id INT PRIMARY KEY AUTO_INCREMENT,
    ad_id INT NOT NULL,
    analytics_timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    analytics_data TEXT,
    -- Add other relevant columns as needed
    FOREIGN KEY (ad_id) REFERENCES ads(id)
);

INSERT INTO advanced_analytics_data (ad_id, analytics_data)
VALUES
    (1, '{"clicks": 1200, "impressions": 50000, "conversion_rate": 2.5, "revenue": 1500.25}'),
    (2, '{"clicks": 800, "impressions": 40000, "conversion_rate": 1.8, "revenue": 1200.50}'),
    (3, '{"clicks": 1500, "impressions": 60000, "conversion_rate": 3.0, "revenue": 1800.75}'),
    (4, '{"clicks": 600, "impressions": 30000, "conversion_rate": 1.2, "revenue": 900.80}'),
    (5, '{"clicks": 1800, "impressions": 75000, "conversion_rate": 2.8, "revenue": 2000.10}');


-- Create a table to store user consents
CREATE TABLE user_consents (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    consent_status VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_user_id FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Insert a sample record (optional)
INSERT INTO user_consents (user_id, consent_status) VALUES (1, 'consented');


-- Create a table to store currency exchange rates
CREATE TABLE currency_exchange_rates (
    id INT AUTO_INCREMENT PRIMARY KEY,
    from_currency VARCHAR(3) NOT NULL,
    to_currency VARCHAR(3) NOT NULL,
    exchange_rate DECIMAL(10, 4) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Insert sample exchange rates (optional)
INSERT INTO currency_exchange_rates (from_currency, to_currency, exchange_rate) VALUES
    ('USD', 'EUR', 0.85),
    ('EUR', 'USD', 1.18),
    -- Add more exchange rates as needed
;
CREATE TABLE backup_table_name (
    id INT PRIMARY KEY,
    column1 VARCHAR(255),
    column2 INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table for storing product information
CREATE TABLE products (
    id INT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    quantity INT NOT NULL
);

-- Table for storing order information
CREATE TABLE orders (
    id INT PRIMARY KEY,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    total_amount DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (product_id) REFERENCES products(id)
);

-- Table for storing email logs
CREATE TABLE email_log (
    id INT PRIMARY KEY AUTO_INCREMENT,
    recipient VARCHAR(255) NOT NULL,
    subject VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    sent_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table for storing user feedback
CREATE TABLE feedback (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    feedback TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table for storing survey responses
CREATE TABLE feedback_survey_response (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    response TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table for storing user points
CREATE TABLE user_points (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    points INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE payments (
    id INT PRIMARY KEY AUTO_INCREMENT,
    amount DECIMAL(10, 2) NOT NULL,
    status VARCHAR(20) NOT NULL
);

CREATE TABLE performance_logs (
    id INT PRIMARY KEY AUTO_INCREMENT,
    operation VARCHAR(255) NOT NULL,
    execution_time DOUBLE NOT NULL,
    log_timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE pricing_rules (
    id INT PRIMARY KEY AUTO_INCREMENT,
    product_id INT NOT NULL,
    min_quantity INT NOT NULL,
    discount_percentage DECIMAL(5, 2) NOT NULL,
    UNIQUE KEY unique_rule (product_id, min_quantity)
);

CREATE TABLE ad_revenue (
    id INT PRIMARY KEY AUTO_INCREMENT,
    publisher_id INT NOT NULL,
    ad_id INT NOT NULL,
    revenue_amount DECIMAL(10, 2) NOT NULL,
    report_date DATE NOT NULL,
    UNIQUE KEY unique_report (publisher_id, ad_id, report_date)
);

CREATE TABLE api_rate_limit (
    id INT PRIMARY KEY AUTO_INCREMENT,
    api_key VARCHAR(255) NOT NULL,
    usage_count INT NOT NULL DEFAULT 0,
    last_access_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY unique_api_key (api_key)
);

CREATE TABLE advertiser_ratings (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    advertiser_id INT NOT NULL,
    rating INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY unique_user_advertiser_rating (user_id, advertiser_id)
);

CREATE TABLE publisher_ratings (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    publisher_id INT NOT NULL,
    rating INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY unique_user_publisher_rating (user_id, publisher_id)
);

CREATE TABLE ad_auctions (
    id INT PRIMARY KEY AUTO_INCREMENT,
    advertiser_id INT NOT NULL,
    bid_amount DECIMAL(10, 2) NOT NULL,
    ad_type VARCHAR(255) NOT NULL,
    targeting_criteria TEXT,
    auction_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE campaign_performance (
    id INT PRIMARY KEY AUTO_INCREMENT,
    advertiser_id INT NOT NULL,
    campaign_id INT NOT NULL,
    impressions INT NOT NULL,
    clicks INT NOT NULL,
    conversion_rate DECIMAL(5, 2) NOT NULL,
    -- Add more fields as needed
    FOREIGN KEY (advertiser_id) REFERENCES advertisers(id),
    FOREIGN KEY (campaign_id) REFERENCES campaigns(id)
);

CREATE TABLE revenue_share (
    id INT PRIMARY KEY AUTO_INCREMENT,
    advertiser_id INT NOT NULL,
    publisher_id INT NOT NULL,
    revenue_share_amount DECIMAL(10, 2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    -- Add more fields as needed
    FOREIGN KEY (advertiser_id) REFERENCES advertisers(id),
    FOREIGN KEY (publisher_id) REFERENCES publishers(id)
);

CREATE TABLE security_audit (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    audit_result INT NOT NULL,
    audit_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    -- Add more fields as needed
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE social_media_data (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    platform VARCHAR(50) NOT NULL,
    content TEXT,
    integration_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    -- Add more fields as needed
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE subscription_plans (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    -- Add more fields as needed
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE password_reset_tokens (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    token VARCHAR(255) NOT NULL,
    expiration_time INT,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE ad_feedback (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    ad_id INT NOT NULL,
    rating INT NOT NULL,
    comment TEXT,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (ad_id) REFERENCES ads(id) ON DELETE CASCADE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE user_activity (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    activity_type VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE purchases (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);