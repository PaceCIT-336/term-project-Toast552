<?php
// Include the necessary PHP files for database connection and functions
include_once 'config.php'; // File containing database connection settings
include_once 'functions.php'; // File containing functions for retrieving data from the database
?>

<!DOCTYPE html>
<html>
<head>
    <title>GG Holdings Group - Services</title>
    <!-- Add any necessary CSS and JavaScript files here -->
</head>
<body>
    <!-- Header section -->
    <header>
        <h1>Our Services</h1>
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
            <h2>Our Services</h2>
            <p>At GG Holdings Group, we offer a wide range of services to cater to our clients' diverse needs. Our services include:</p>
            <ul>
                <?php
                // Retrieve services data from the database
                $services = getServices();
                
                // Loop through each service and display its information
                foreach ($services as $service) {
                    echo '<li>';
                    echo '<h4>' . $service['service_name'] . '</h4>';
                    echo '<p>Description: ' . $service['service_description'] . '</p>';
                    echo '</li>';
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
