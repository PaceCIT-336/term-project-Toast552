<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if user is logged in or in guest mode
$isLoggedIn = false; // Replace with actual code to check if user is logged in
$isGuest = true; // Replace with actual code to check if user is in guest mode

// Only allow access to website if user is logged in or in guest mode
if (!$isLoggedIn && !$isGuest) {
    // Redirect user to login page
    header('Location: login.php');
    exit;
}

// Get current timestamp
$timestamp = date('Y-m-d H:i:s');

// Validate and sanitize input data
$inputData = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
$missionStatement = $inputData['mission_statement'] ?? '';
$equityInvestments = $inputData['equity_investments'] ?? '';
$bitcoinMining = $inputData['bitcoin_mining'] ?? '';

// Fetch spot prices of BTC, ETH, LTC, and top 10 cryptocurrencies from Yahoo Finance API
$apiUrl = 'https://query1.finance.yahoo.com/v7/finance/quote'; // Yahoo Finance API URL
$cryptoList = ['BTC-USD', 'ETH-USD', 'LTC-USD']; // List of cryptocurrencies to fetch
$cryptos = fetchCryptocurrencyPrices($apiUrl, $cryptoList); // Function to fetch cryptocurrency prices from the API

if ($cryptos === false) { // Check if there was an error fetching the cryptocurrency prices
    // Try fetching from Barron's website as a backup
    $apiUrl = 'https://www.barrons.com/mdc/public/page/9_3020-cryptocurrency.html';
    $cryptos = fetchCryptocurrencyPrices($apiUrl, $cryptoList);
    if ($cryptos === false) {
        echo '<p>Error fetching cryptocurrency prices from the API or backup source. Please try again later.</p>';
    }
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
    // Try fetching from CNN's business section as a backup
    $apiUrl = 'https://www.cnn.com/business';
    $marketData = fetchMarketData($apiUrl, $params);
    if ($marketData === false) {
        echo '<p>Error fetching market data from the API or backup source. Please try again later.</p>';
    }
}

// Welcome message
$welcome = "Welcome to GG Holdings Group!";
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
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            background-color: #fff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        nav ul {
            display: flex;
            gap: 1rem;
            list-style: none;
        }
        nav ul li a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }
        nav ul li a:hover {
            color: navy;
        }
        h2 {
            margin-top: 2rem;
            color: navy;
        }
        ul {
            margin-top: 1rem;
            list-style: disc;
            color: #333;
        }
        li {
            margin-bottom: 0.5rem;
        }
        li strong {
            color: navy;
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
            </ul>
        </nav>
    </header>
    <!-- Main section -->
    <main>
        <h2>Why Choose Us!?</h2>
        <ul>
            <li><strong>Strong focus on security:</strong> As a private equity firm, security is a top priority in all aspects of our operations. We implement advanced security measures to safeguard our investments, client data, and intellectual property.</li>
            <li><strong>Proven track record:</strong> With a history of successful acquisitions and private equity investments, we have a proven track record of delivering exceptional results for our investors.</li>
            <li><strong>Industry expertise:</strong> Our team brings deep industry expertise across various sectors, allowing us to identify and capitalize on lucrative investment opportunities.</li>
            <li><strong>Innovative investment solutions:</strong> We are constantly exploring innovative investment strategies to deliver superior returns for our investors while mitigating risks through careful risk management practices.</li>
            <li><strong>Robust cybersecurity measures:</strong> We have implemented robust cybersecurity measures, including firewalls, intrusion detection systems, regular security audits, and encryption protocols, to protect our systems and data from unauthorized access and cyber threats.</li>
            <li><strong>Multi-factor authentication:</strong> We use multi-factor authentication (MFA) for all our user accounts and access points.</li>
        </ul>
    </main>
</body>
</html>