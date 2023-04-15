<?php
// Start session
session_start();

// Include database connection
require_once 'db_connect.php';

// Function to log events
function logEvent($event) {
    $ip = $_SERVER['REMOTE_ADDR'];
    $timestamp = date('Y-m-d H:i:s');
    $location = getGeoLocation($ip);
    $log = "$timestamp | IP: $ip | Location: $location | Event: $event" . PHP_EOL;
    file_put_contents('event_log.txt', $log, FILE_APPEND | LOCK_EX);
}

// Function to get geolocation
function getGeoLocation($ip) {
    // Use an API or library to get geolocation data based on IP
    // Replace this with your preferred method of getting geolocation data
    // Example usage of a free IP geolocation API (ip-api.com)
    $url = "http://ip-api.com/json/$ip";
    $response = file_get_contents($url);
    $data = json_decode($response, true);
    $location = '';
    if ($data && $data['status'] === 'success') {
        $location = $data['city'] . ', ' . $data['country'];
    }
    return $location;
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize input
    $clientName = filter_input(INPUT_POST, 'client_name', FILTER_SANITIZE_STRING);
    $clientEmail = filter_input(INPUT_POST, 'client_email', FILTER_VALIDATE_EMAIL);

    // Validate client name
    if (!$clientName) {
        $_SESSION['error'] = 'Invalid client name.';
        logEvent('Invalid client name');
        header('Location: index.php');
        exit;
    }

    // Validate client email
    if (!$clientEmail) {
        $_SESSION['error'] = 'Invalid client email.';
        logEvent('Invalid client email');
        header('Location: index.php');
        exit;
    }

    // Insert client data into database
    $stmt = $pdo->prepare("INSERT INTO clients (client_name, client_email) VALUES (?, ?)");
    $stmt->execute([$clientName, $clientEmail]);
    $_SESSION['success'] = 'Client data has been added successfully.';
    logEvent('Client data added');
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Client Registration</title>
</head>
<body>
    <h1>Client Registration</h1>
    <?php if (isset($_SESSION['error'])): ?>
        <p style="color: red;"><?php echo $_SESSION['error']; ?></p>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>
    <?php if (isset($_SESSION['success'])): ?>
        <p style="color: green;"><?php echo $_SESSION['success']; ?></p>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>
    <form method="post" action="">
        <label for="client_name">Client Name:</label>
        <input type="text" id="client_name" name="client_name" required>
        <br>
        <label for="client_email">Client Email:</label>
        <input type="email" id="client_email" name="client_email" required>
        <br>
        <input type="submit" value="Register">
    </form>
</body>
</html>
