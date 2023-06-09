<?php
// Include the necessary PHP files for database connection and functions
include_once 'config.php'; // File containing database connection settings
include_once 'functions.php'; // File containing functions for retrieving data from the database
?>

<!DOCTYPE html>
<html>
<head>
    <title>GG Holdings Group - Clients</title>
    <!-- Add any necessary CSS and JavaScript files here -->
</head>
<body>
    <!-- Header section -->
    <header>
        <h1>Clients</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="services.php">Services</a></li>
                <li><a href="clients.php">Clients</a></li>
                <li><a href="projects.php">Projects</a></li>
                <li><a href="contact.php">Contact Us</a></li>
            </ul>
        </nav>
    </header>
    
    <!-- Main content section -->
    <main>
        <section>
            <h2>Our Clients</h2>
            <p>GG Holdings Group has had the privilege of serving a wide range of clients in various industries. Our clients include:</p>
            <ul>
                <?php
                // Retrieve clients data from the database
                $clients = getClients();
                if (!empty($clients)) { // Check if clients data is not empty
                    foreach ($clients as $client) {
                        echo '<li>' . $client['client_name'] . '</li>';
                    }
                } else {
                    echo '<li>No clients found.</li>';
                }
                ?>
            </ul>
        </section>
    </main>
    
    <!-- Footer section -->
    <footer>
        <p>Contact us: [Contact Information]</p>
        <!-- Add any additional footer content as needed -->
    </footer>
</body>
</html>
