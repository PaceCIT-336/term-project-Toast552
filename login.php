login.php
<?php
require_once 'config.php'; // File containing database connection settings and error handling function

// Initialize variables
$username = "";
$password = "";
$login_error = "";

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate username
    if (empty(trim($_POST["username"]))) {
        $login_error = "Please enter your username.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $login_error = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Check if there are no input errors
    if (empty($login_error)) {

        // Prepare a SELECT statement
        $sql = "SELECT id, username, password FROM users WHERE username = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {

            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = $username;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {

                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if the username exists, if yes then verify password
                if (mysqli_stmt_num_rows($stmt) == 1) {

                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if (mysqli_stmt_fetch($stmt)) {

                        // Verify password
                        if (password_verify($password, $hashed_password)) {
                            // Password is correct, start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;

                            // Redirect user to welcome page
                            header("location: welcome.php");
                        } else {
                            // Display an error message if password is not valid
                            $login_error = "Invalid username or password.";
                        }
                    }
                } else {
                    // Display an error message if username doesn't exist
                    $login_error = "Invalid username or password.";
                }
            } else {
                // Display an error message if statement execution failed
                handle_error("Failed to execute the prepared statement: " . mysqli_error($link));
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
}
?>
<?php
session_start();

if (isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}

if (isset($_POST['username']) && isset($_POST['password'])) {
    // Check username and password against the database
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (isValidUser($username, $password)) { // Implement isValidUser function in functions.php
        $_SESSION['username'] = $username;
        header('Location: index.php');
        exit();
    } else {
        $error_message = 'Invalid username or password';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <?php if (isset($error_message)) { echo "<p>$error_message</p>"; } ?>
    <form method="POST" action="login.php">
        <label>Username:</label>
        <input type="text" name="username" required><br>

        <label>Password:</label>
        <input type="password" name="password" required><br>

        <input type="submit" value="Login">
    </form>
</body>
</html>
