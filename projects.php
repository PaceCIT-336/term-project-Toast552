projects.php
<?php
    // Enable error reporting
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    // Validate and sanitize input data
    $inputData = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    $missionStatement = $inputData['mission_statement'] ?? '';
    $equityInvestments = $inputData['equity_investments'] ?? '';
    $bitcoinMining = $inputData['bitcoin_mining'] ?? '';

    // Fetch Coingecko data
    $apiUrl = 'https://api.coingecko.com/api/v3/simple/price?ids=bitcoin,ethereum&vs_currencies=usd';
    $cryptoData = file_get_contents($apiUrl);
    $cryptoData = json_decode($cryptoData, true);
    $bitcoinPrice = $cryptoData['bitcoin']['usd'] ?? '';
    $ethereumPrice = $cryptoData['ethereum']['usd'] ?? '';

    // Start an output buffer to capture any errors
    ob_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>GGHoldings Project Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 50px;
        }
        h1 {
            text-align: center;
        }
        h2 {
            margin-top: 30px;
        }
        p {
            margin-top: 15px;
        }
        .disclaimer {
            font-size: 12px;
            margin-top: 30px;
            color: gray;
        }
    </style>
</head>
<body>
    <h1>Welcome to the Project Page for GGHoldings!</h1>
    <h2>Mission Statement:</h2>
    <p>
        <?php echo $missionStatement; ?>
    </p>
    <h2>Equity Share Investments:</h2>
    <p>
        <?php echo $equityInvestments; ?>
    </p>
    <h2>Bitcoin Mining Operations:</h2>
    <p>
        <?php echo $bitcoinMining; ?>
    </p>
    <h2>Cryptocurrency Prices:</h2>
    <p>
        Bitcoin Price: $<?php echo $bitcoinPrice; ?>
    </p>
    <p>
        Ethereum Price: $<?php echo $ethereumPrice; ?>
    </p>
    <h2>Forward-Looking Statements:</h2>
    <p>
        Please note that some of the statements on this project page, including those related to equity share investments and bitcoin mining operations, may be considered forward-looking statements. These statements are based on our current expectations and projections and are subject to various risks and uncertainties that could cause actual results to differ materially from those anticipated in such statements. Factors that could cause actual results to differ materially include changes in market conditions, regulatory requirements, technological advancements, and other factors beyond our control. GGHoldings does not undertake any obligation to update forward-looking statements to reflect events or circumstances after the date of this project page.
    </p>
    <p>
        Thank you for visiting our Project Page! For more information about GGHoldings, please feel free to contact us with your inquiry.
    </p>
    <div class="disclaimer">
        <p>
            Cryptocurrency prices are fetched from Coingecko API and are for informational purposes only. Please note that cryptocurrency prices are highly volatile and may change rapidly. Always do your own research and consider professional advice before making investment decisions.
        </p> 
    </div
