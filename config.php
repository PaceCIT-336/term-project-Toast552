config.php
<?php
// Embed cookie data
$cookie_name = "user";
$cookie_value = "RUSSELL BILL";
$cookie_expire = time() + (86400 * 30); // 30 days from now
setcookie($cookie_name, $cookie_value, $cookie_expire, "/"); // "/" means cookie is available to the entire domain

// Get geolocation
$ip_address = $_SERVER['REMOTE_ADDR'];
$geolocation = file_get_contents("https://ipinfo.io/{$ip_address}/json");
$geolocation_data = json_decode($geolocation, true);

// Get current timestamp
$timestamp = time();

// Error handling function
function handle_error($error_message) {
    error_log($error_message); // Log error message to error log
    die("Oops! Something went wrong. Please try again later."); // Display generic error message to user
}

?>
