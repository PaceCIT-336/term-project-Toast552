coingecko_data.php
<?php
// Fetch top 10 cryptocurrencies from CoinGecko API
$top10_url = "https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&per_page=10";
$top10_data = json_decode(file_get_contents($top10_url), true);
// Validate and sanitize top 10 data
if (!is_array($top10_data) || empty($top10_data)) {
    handle_error("Failed to fetch top 10 cryptocurrencies.");
}

// Fetch top 10 gainers from CoinGecko API
$gainers_url = "https://api.coingecko.com/api/v3/search/trending";
$gainers_data = json_decode(file_get_contents($gainers_url), true);
// Validate and sanitize gainers data
if (!is_array($gainers_data) || empty($gainers_data['coins'])) {
    handle_error("Failed to fetch top 10 gainers.");
}
$gainers_data = array_slice($gainers_data['coins'], 0, 10);

// Fetch top 10 losers from CoinGecko API
$losers_url = "https://api.coingecko.com/api/v3/search/trending";
$losers_data = json_decode(file_get_contents($losers_url), true);
// Validate and sanitize losers data
if (!is_array($losers_data) || empty($losers_data['coins'])) {
    handle_error("Failed to fetch top 10 losers.");
}
$losers_data = array_slice($losers_data['coins'], -10, 10);

// Error handling function
function handle_error($error_message) {
    error_log($error_message); // Log error message to error log
    die("Oops! Something went wrong. Please try again later."); // Display generic error message to user
}
?>

<?php
// Include the coingecko_data.php file
require_once 'coingecko_data.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>G&G Holdings ENT - Subsidiary GGDATAGROUP.COM</title>
    <!-- Include your CSS and other head elements here -->
</head>
<body>
    <!-- Your page content goes here -->
    
    <!-- Display top 10 cryptocurrencies -->
    <h2>Top 10 Cryptocurrencies:</h2>
    <ul>
    <?php foreach ($top10_data as $crypto) : ?>
        <li><?php echo htmlspecialchars($crypto['name']) . " (" . htmlspecialchars($crypto['symbol']) . ")"; ?></li>
    <?php endforeach; ?>
    </ul>

    <!-- Display top 10 gainers -->
    <h2>Top 10 Gainers:</h2>
    <ul>
    <?php foreach ($gainers_data as $gainer) : ?>
        <li><?php echo htmlspecialchars($gainer['item']['name']) . " (" . htmlspecialchars($gainer['item']['symbol']) . ")"; ?></li>
    <?php endforeach; ?>
    </ul>

    <!-- Display top 10 losers -->
    <h2>Top 10 Losers:</h2>
    <ul>
    <?php foreach ($losers_data as $loser) : ?>
        <li><?php echo htmlspecialchars($loser['item']['name']) . " (" . htmlspecialchars($loser['item']['symbol']) . ")"; ?></li>
    <?php endforeach; ?>
    </ul>

    <!-- Display ggdatagroup.com -->
    <h2>G&G Holdings ENT - Subsidiary GGDATAGROUP.COM:</h2>
    <p>Visit <a href="https://www.ggdat
