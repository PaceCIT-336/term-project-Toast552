<?php
// Include the CoinGecko PHP wrapper
require_once 'coingecko-api-php-master/coingecko-api.php';
use Coingecko\CoinGeckoClient;

// Create a new CoinGecko client
$cgClient = new CoinGeckoClient();

// Get cryptocurrency data
$btcData = $cgClient->simplePrice('bitcoin', 'usd');
$ethData = $cgClient->simplePrice('ethereum', 'usd');
$ltcData = $cgClient->simplePrice('litecoin', 'usd');
$topCryptosData = $cgClient->coinsMarkets(['vs_currency' => 'usd', 'per_page' => 5, 'page' => 1]);

// Fetch user IP address
$userIP = $_SERVER['REMOTE_ADDR'];

// Fetch user geolocation using an IP geolocation API (example)
$geoData = json_decode(file_get_contents("https://api.example.com/geolocation?ip=$userIP"), true);
$userCountry = isset($geoData['country']) ? $geoData['country'] : 'Unknown';

// Fetch current timestamp
$timestamp = time();

// Check if user is logged in
session_start();
if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}

// HTML section
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>GG Holdings Group</title>
    <link rel="stylesheet" href="us-market-data.css">
</head>
<body>

<header>
    <h1>Welcome to GG Holdings Group</h1>
    <?php 
    session_start();
    if(isset($_SESSION['username'])): 
    ?>
        <p>Hello <?php echo $_SESSION['username']; ?> | <a href="logout.php">Logout</a></p>
    <?php else: ?>
        <p>Hello guest | <a href="login.php">Login</a></p>
    <?php endif; ?>
</header>
<main>
    <section>
        <h2>Our Story</h2>
        <p>GG Holdings Group is a private equity firm specialized in cybersecurity auditing and investments in various industries. With a track record of successful acquisitions and private equity investments, we have been serving clients for 2.5 years and counting. Our team of experienced professionals is committed to delivering exceptional results with a strong focus on security.</p>
        <h2>Our Vision</h2>
        <p>At GG Holdings, our vision is to be a leader in the private equity industry, providing innovative investment solutions while prioritizing security and risk management. We aim to outperform market expectations by leveraging our deep industry expertise and investment strategies that prioritize the security of our investors' capital.</p>
        <h2>Our Team</h2>
        <p>Our team at GG Holdings Group is comprised of seasoned professionals with extensive experience in finance, private equity, risk management, and cybersecurity. We take security seriously and implement advanced measures to safeguard our investments and client data. Our team's expertise and commitment to security allow us to provide a secure and reliable investment experience for our clients.</p>
        <h2>Why Choose Us</h2>
        <ul>
            <li>Strong focus on security: As a private equity firm, we prioritize security in all aspects of our operations. We implement advanced security measures to safeguard our investments, client data, and intellectual property.</li>
            <li>Proven track record: With a successful history of acquisitions and private equity investments, we have a proven track record of delivering exceptional results for our investors.</li>
            <li>Industry expertise: Our team of experienced professionals brings deep industry expertise across various sectors, allowing us to identify and capitalize on lucrative investment opportunities.</li>
            <li>Innovative investment solutions: We are constantly exploring innovative investment strategies to deliver superior returns for our investors while mitigating risks through careful risk management practices.</li>
            <li>Robust cybersecurity measures: We have implemented robust cybersecurity measures, including firewalls, intrusion detection systems, regular security audits, and encryption protocols, to protect our systems and data from unauthorized access and cyber threats.</li>
            <li>Multi-factor authentication: We use multi-factor authentication (MFA) for all our user accounts and access points.</li>
        </ul>
    </section>
</main>
<footer>
    <?php 
    if(isset($_SESSION['username'])): 
    ?>
        <p>You are currently logged in as <?php echo $_SESSION['username']; ?></p>
    <?php endif; ?>
    <p>Data provided by CoinGecko API</p>
    <link rel="stylesheet" href="us-market-data.css">
</footer>