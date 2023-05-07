<?php
// Start session
session_start();

// Include database connection
require_once 'db_connect.php';

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    $_SESSION['error'] = 'You need to log in first.';
    header('Location: login.php');
    exit;
}

// Fetch clients from database
$stmt = $pdo->query("SELECT * FROM clients");
$clients = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Handle errors
if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>MySQL Clients Page</title>
</head>
<body>
    <?php if (isset($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
    <h1>Welcome, <?php echo $_SESSION['user']; ?>!</h1>
    <p>Here are the clients currently in the database:</p>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clients as $client): ?>
                <tr>
                    <td><?php echo $client['client_name']; ?></td>
                    <td><?php echo $client['client_email']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <p>Would you like to place a private order? Click <a href="mallob.php">here</a> to proceed.</p>
</body>
</html>
