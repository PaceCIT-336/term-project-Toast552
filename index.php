<?php
// Include the necessary PHP files for database connection and functions
include_once 'config.php'; // File containing database connection settings
include_once 'functions.php'; // File containing functions for retrieving data from the database

// Set a cookie with a random value for added security
$cookie_name = "session_id";
$cookie_value = bin2hex(random_bytes(16)); // Generate a random value for the cookie
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // Cookie will expire after 30 days

// Get user's geolocation data
$ip_address = $_SERVER['REMOTE_ADDR']; // Get user's IP address
$geolocation_data = json_decode(file_get_contents("http://ip-api.com/json/$ip_address"), true); // Fetch geolocation data from IP address

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
</head>
<body>
    <!-- Header section -->
    <header>
        <h1>Our Services</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about_us.php">About Us</a></li>
                <li><a href="services_page.php">Services</a></li>
                <li><a href="clients_page.php">Clients</a></li>
                <li><a href="projects.php">Projects</a></li>
                <li><a href="contact_us.php">Contact Us</a></li>
            </ul>
        </nav>
    </header>
    <!-- Main content section -->
    <main>
        <section>
            <h2>Our Services</h2>
            <p>At GG Holdings Group, we offer a wide range of services to cater to our clients' diverse needs. Our services include:</p>
            <ul>
                <?php
                // Retrieve services data from the database
                $services = getServices();

                // Check if services data is not empty before looping through and displaying
                if (!empty($services)) {
                    foreach ($services as $service) {
                        echo '<li>';
                        echo '<h4>' . htmlspecialchars($service['service_name']) . '</h4>'; // Use htmlspecialchars to prevent XSS
                        echo '<p>' . htmlspecialchars($service['service_description']) . '</p>';
                        echo '</li>';
