<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// Include the necessary PHP files for database connection and functions
include_once 'config.php'; // File containing database connection settings
include_once 'functions.php'; // File containing functions for retrieving data from the database
include_once 'event_log.php'; // File containing event_log data 

// Initialize variables
$error_message = '';
$geolocation_data = array();

// Check if the user is authenticated
if (isset($_COOKIE['session_id']) && isValidSession($_COOKIE['session_id'])) {
    // Set a cookie with a random value for added security
    $cookie_name = "session_id";
    $cookie_value = bin2hex(random_bytes(16)); // Generate a random value for the cookie
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // Cookie will expire after 30 days

    // Get user's geolocation data
    $ip_address = $_SERVER['REMOTE_ADDR']; // Get user's IP address
    $geolocation_data = json_decode(@file_get_contents("http://ip-api.com/json/$ip_address"), true); // Fetch geolocation data from IP address

    if (!$geolocation_data || $geolocation_data['status'] != 'success') {
        // Error fetching geolocation data
        $error_message = 'Error fetching geolocation data.';
    }
} else {
    // User is not authenticated, allow as guest
    $geolocation_data['country'] = 'Guest';
}

// Get current timestamp
$current_timestamp = time();
?>

<!DOCTYPE html>
<html>
<head>
    <title>GG Holdings Group - Services</title>
    <!-- Add any necessary CSS and JavaScript files here -->
    <style>
        body {
            background-color: #f8f8f8; /* Set desired background color */
            font-family: 'Arial', sans-serif; /* Add desired font family */
        }

        /* Add custom CSS styles for the box containing crypto prices */
        .crypto-box {
            position: fixed;
            bottom: 10px;
            right: 10px;
            width: 200px;
            height: 200px;
            padding: 10px;
            background-color: #ffffff;
            border: 1px solid #000000;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            cursor: pointer;
            /* Add additional styles for fancy look */
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            text-align: center;
            font-weight: bold;
            font-family: 'Arial Black', sans-serif; /* Add fancy font */
        }
    </style>
</header>
<h2>Why Choose Us!?</h2>
<ul>
    <li><strong>Strong focus on security:</strong> As a private equity firm, security is a top priority in all aspects of our operations. We implement advanced security measures to safeguard our investments, client data, and intellectual property.</li>
    <li><strong>Proven track record:</strong> With a history of successful acquisitions and private equity investments, we have a proven track record of delivering exceptional results for our investors.</li>
    <li><strong>Industry expertise:</strong> Our team brings deep industry expertise across various sectors, allowing us to identify and capitalize on lucrative investment opportunities.</li>
    <li><strong>Innovative investment solutions:</strong> We are constantly exploring innovative investment strategies to deliver superior returns for our investors while mitigating risks through careful risk management practices.</li>
    <li><strong>Robust cybersecurity measures:</strong> We have implemented robust cybersecurity measures, including firewalls, intrusion detection systems, regular security audits, and encryption protocols, to protect our systems and data from unauthorized access and cyber threats.</li>
    <li><strong>Multi-factor authentication:</strong> We use multi-factor authentication (MFA) for all our user accounts and access points.</li>
<nav>
<body>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="about_us.php">About Us</a></li>
            <li><a href="services_page.php">Services</a></li>
            <li><a href="clients_page.php">Clients</a></li>
            <li><a href="projects.php">Projects</a></li>
            <li><a href="contact_us.php">Contact Us</a></li>
            <li><a href="logout.php">Logout</a></li> <!-- Add logout button -->
        </ul>
   

