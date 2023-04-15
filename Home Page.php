<?php
// Include the necessary PHP files for database connection and functions
require_once 'config.php'; // File containing database connection settings
require_once 'functions.php'; // File containing functions for retrieving data from the database

// Retrieve clients data from the database
$clients = getClients();

// Fetch spot prices of BTC, ETH, LTC, and top 10 cryptocurrencies from an API
$apiUrl = 'https://api.example.com/prices'; // Replace with the actual API URL
$cryptoList = array('BTC', 'ETH', 'LTC'); // List of cryptocurrencies to fetch
$topCryptos = array('BTC', 'ETH', 'LTC'); // Top cryptocurrencies to display
$cryptos = fetchCryptocurrencyPrices($apiUrl, $cryptoList); // Function to fetch cryptocurrency prices from the API
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
            <p>GG Holdings Group has had the privilege of serving a wide range of clients in various industries. Our clients include:</p>
            <ul>
                <?php if (!empty($clients)) { // Use empty() function to check if $clients is not empty
                    foreach ($clients as $client) {
                        echo '<li>' . $client['client_name'] . '</li>';
                    }
                } else {
                    echo '<li>No clients found.</li>';
                }
                ?>
            </ul>
        </section>
        
        <section>
            <h2>Cryptocurrency Prices</h2>
            <table>
                <tr>
                    <th>Cryptocurrency</th>
                    <th>Price (USD)</th>
                </tr>
                <?php
                foreach ($topCryptos as $crypto) {
                    if (isset($cryptos[$crypto])) { // Use isset() function to check if $cryptos[$crypto] is set
                        echo '<tr>';
                        echo '<td>' . $crypto . '</td>';
                        echo '<td>' . $cryptos[$crypto] . '</td>';
                        echo '</tr>';
                    }
                }
                <section>
    <h2>Cryptocurrency Prices</h2>
    <table>
        <tr>
            <th>Cryptocurrency</th>
            <th>Price (USD)</th>
            <th>US Market Data</th>
        </tr>
        <?php
        foreach ($topCryptosWithUSMarket as $crypto) {
            echo '<tr>';
            echo '<td>' . $crypto . '</td>';
            echo '<td>' . $cryptos[$crypto] . '</td>';
            // Fetch and display US market data for the cryptocurrency
            $usMarketData = fetchUSMarketData($usMarketUrl, $crypto); // Function to fetch US market data from the API
            echo '<td>' . $usMarketData . '</td>';
            echo '</tr>';
        }
        ?>
    </table>
</section>

<section>
    <h2>US Market Data</h2>
    <div class="us-market-box">
        <h3>QQQ</h3>
        <?php
        // Fetch and display QQQ data
        $qqqData = fetchUSMarketData($usMarketUrl, 'QQQ'); // Function to fetch US market data for QQQ from the API
        echo '<p>' . $qqqData . '</p>';
        ?>
    </div>
    <div class="us-market-box">
        <h3>SPY</h3>
        <?php
        // Fetch and display SPY data
        $spyData = fetchUSMarketData($usMarketUrl, 'SPY'); // Function to fetch US market data for SPY from the API
        echo '<p>' . $spyData . '</p>';
        ?>
    </div>
    <div class="us-market-box">
        <h3>IWM</h3>
        <?php
        // Fetch and display IWM data
        $iwmData = fetchUSMarketData($usMarketUrl, 'IWM'); // Function to fetch US market data for IWM from the API
        echo '<p>' . $iwmData . '</p>';
        ?>
    </div>
</section>

                ?>
            </table>
        </section>
    </main>
    
    <!-- Footer section -->
    <footer>
        <p>Contact us: ggeltman@ggdatagroup.com </p>
        <!-- Add any additional footer content as needed -->
        <ul class="social-media">
            <li><a href="https://www.facebook.com/ggholdings" target="_blank"><i class="fab fa-facebook"></i></a
