<?php
// Include the necessary PHP files for database connection and functions
require_once 'config.php'; // File containing database connection settings
require_once 'functions.php'; // File containing functions for retrieving data from the database

// Retrieve clients data from the database
$clients = getClients();

// Fetch spot prices of BTC, ETH, LTC, and top 10 cryptocurrencies from Yahoo Finance API
$apiUrl = 'https://query1.finance.yahoo.com/v7/finance/quote'; // Yahoo Finance API URL
$cryptoList = array('BTC-USD', 'ETH-USD', 'LTC-USD'); // List of cryptocurrencies to fetch
$cryptos = fetchCryptocurrencyPrices($apiUrl, $cryptoList); // Function to fetch cryptocurrency prices from the API

if ($cryptos === false) { // Check if there was an error fetching the cryptocurrency prices
    echo '<p>Error fetching cryptocurrency prices from the API. Please try again later.</p>';
}

// Fetch market data for the top cryptocurrencies from Yahoo Finance API
$yahooURL = 'https://query1.finance.yahoo.com/v7/finance/quote?'; // Yahoo Finance API URL
$topCryptos = array('BTC', 'ETH', 'LTC'); // Top cryptocurrencies to display
$symbols = implode(',', $topCryptos); // Comma-separated list of symbols
$params = array(
    'symbols' => $symbols,
    'fields' => 'regularMarketPrice,regularMarketChangePercent,regularMarketVolume',
);
$marketData = fetchMarketData($yahooURL, $params); // Function to fetch market data from Yahoo Finance API

if ($marketData === false) { // Check if there was an error fetching the market data
    echo '<p>Error fetching market data from the API. Please try again later.</p>';
}

// Sanitize market data
foreach ($marketData as &$marketDatum) {
    foreach ($marketDatum as &$datum) {
        $datum = filter_var($datum, FILTER_SANITIZE_STRING);
    }
}

// Display error message if market data is not available
if (empty($marketData)) {
    echo '<p>Market data is not available at the moment. Please try again later.</p>';
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>GG Holdings Group - Clients</title>
    <!-- Add any necessary CSS and JavaScript files here -->
    <style>
        body {
            background-color: navy; /* Set the background color to navy blue */
            cursor: url('cursor.png'), auto; /* Set custom cursor with cursor.png */
        }
    </style>
</head>
<body>
    <!-- Header section -->
    <header>
        <h1>Clients</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="services.php">Services</a></li>
                <li><a href="clients.php">Clients</a></li>
                <li><a href="projects.php">Projects</a></li>
                <li><a href="contact.php">Contact Us</a></li>
            </ul>
        </nav>
    </header>
    <!-- Main content section -->
<main>
    <section>
        <h2>Our Clients</h2>
        <p>GG Holdings Group has had the privilege of serving a wide range of small to midsize companies in various industries. Our clients include businesses in tech, finance, retail, healthcare, and more. We are proud to have earned their trust and to have played a role in their growth and success.</p>
        <ul>
            <?php if (!empty($clients)) { // Use empty() function
<div class="data-container">
<?php foreach ($clients as $client): ?>
    <div><?= $client['name'] ?> - <?= $client['industry'] ?></div>
<?php endforeach; ?>
</div>

// Include the GeoIP2 PHP API
require_once 'vendor/autoload.php';

use GeoIp2\Database\Reader;

// Function to fetch geo data for the user accessing the website
function fetchGeoData() {
    // Initialize the GeoIP2 database reader with the path to the GeoLite2-City.mmdb file
    $reader = new Reader('path/to/GeoLite2-City.mmdb');

    // Get the IP address of the user accessing the website
    $ipAddress = $_SERVER['REMOTE_ADDR'];

    // Fetch the geo data for the user's IP address
    try {
        $record = $reader->city($ipAddress);
    } catch (\Exception $e) {
        // If an error occurs, return false
        return false;
    }

    // Return the geo data as an array
    return array(
        'country' => $record->country->name,
        'region' => $record->mostSpecificSubdivision->name,
        'city' => $record->city->name,
        'latitude' => $record->location->latitude,
        'longitude' => $record->location->longitude,
    );
}
