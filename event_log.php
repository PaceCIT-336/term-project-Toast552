event_log.php
<?php
// Function to log events to a file with additional security measures
function logEvent($event, $logFile)
{
    // Get the current date and time
    $dateTime = date('Y-m-d H:i:s');

    // Format the log entry
    $logEntry = $dateTime . ' - ' . $event . PHP_EOL;

    // Append the log entry to the log file
    file_put_contents($logFile, $logEntry, FILE_APPEND | LOCK_EX);

    // Set appropriate file permissions to restrict access
    chmod($logFile, 0600); // 0600 - Only the owner can read and write the file

    // Log IP address and user agent for additional security
    $ipAddress = $_SERVER['REMOTE_ADDR'];
    $userAgent = $_SERVER['HTTP_USER_AGENT'];
    $logEntry = $dateTime . ' - IP: ' . $ipAddress . ' - User Agent: ' . $userAgent . ' - ' . $event . PHP_EOL;
    file_put_contents($logFile, $logEntry, FILE_APPEND | LOCK_EX);
}

// Example usage:
$event = 'Some event occurred'; // Replace with the actual event description
$logFile = 'event_log.txt'; // Replace with the desired log file name

// Call the logEvent function with the event and log file name
logEvent($event, $logFile);

// Example output: "2023-04-12 14:30:00 - IP: 192.168.0.2 - User Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36 - Some event occurred" logged to "event_log.txt" file with restricted file permissions and additional information such as IP address and user agent.
?>
