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
    if ($stmt->execute([$clientName, $clientEmail])) {
        $_SESSION['success'] = 'Client data has been added successfully.';
        logEvent('Client data added');
        header('Location: index.php');
        exit;
    } else {
        $_SESSION['error'] = 'Failed to insert client data into database.';
        logEvent('Failed to insert client data into database');
        header('Location: index.php');
        exit;
    }
} else {
    // Check if session has expired
    $lastEventTime = $_SESSION['last_event_time'] ?? 0;
    $currentTime = time();
    $timeElapsed = $currentTime - $lastEventTime;
    if ($timeElapsed > 300) { // 300 seconds (5 minutes) threshold
        session_unset();
        session_destroy();
    }
    $_SESSION['last_event_time'] = $currentTime;

    // Check if user is banned
    $isBanned = $_SESSION['is_banned'] ?? false;
    if ($isBanned) {
        // Redirect user to a banned page
        header('Location: banned.php');
        exit;
    }
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
        <p style="color: red"><?php echo $_SESSION['error']; ?></p>
        <?
