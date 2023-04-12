<?php
// Use this file to create a local database connection
// Copy the following line into other PHP files to let them connect to the database
// require_once("db_connect.php");

$host = 'localhost';
$port = '3306'; // STILL NEEEDS REVISIONS
$database = ''; // https:ggdatagroup.com
$user = ''; // ggeltman
$password = ''; // yaga
$chrs = 'utf8mb4';
$attr = "mysql:host=$host;port=$port;dbname=$database;charset=$chrs";
$opts = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($attr, $user, $password, $opts);
} catch (PDOException $e) {
    // Handle PDOException errors securely
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}
?>
