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

// Fetch geo data for the user accessing the website
$geoData = fetchGeoData();

// Welcome message
$welcome = '';
if (!empty($geoData['city'])) {
    $welcome = 'Welcome from ' . $geoData['city'] . ', ' . $geoData['region'] . ', ' . $geoData['country'] . '!';
} else {
    $welcome = 'Welcome to GG Holdings Group!';
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>GG Holdings Group - Home</title>
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
        <h1><?= $welcome ?></h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about_us.php">About Us</a></li>
                <li><a href="services_page.php">Services</a></li>
                <li><a href="clients_page.php">Clients</a></li>
                <li><a href="projects.php">Projects</a></li>
           
