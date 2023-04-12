<?php
// Include the necessary PHP files for database connection and functions
include_once 'config.php'; // File containing database connection settings
include_once 'functions.php'; // File containing functions for retrieving data from the database
?>

<!DOCTYPE html>
<html>
<head>
    <title>GG Holdings Group</title>
    <!-- Add any necessary CSS and JavaScript files here -->
</head>
<body>
    <!-- Header section -->
    <header>
        <h1>Welcome to GG Holdings Group</h1>
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
            <h2>Welcome to GG Holdings Group</h2>
            <p>Here, we showcase our portfolio of successful projects and highlight our expertise in providing top-notch services to our clients.</p>
            <!-- Display list of clients and their successful projects -->
            <h3>Our Clients</h3>
            <ul>
                <?php
                // Retrieve clients data from the database
                $clients = getClients();
                
                // Loop through each client and display their information
                foreach ($clients as $client) {
                    echo '<li>';
                    echo '<h4>' . $client['client_name'] . '</h4>';
                    echo '<p>Contact: ' . $client['contact_information'] . '</p>';
                    echo '<p>Projects: ' . $client['successful_projects'] . '</p>';
                    echo '</li>';
                }
                ?>
            </ul>
            
            <!-- Display list of projects -->
            <h3>Our Projects</h3>
            <ul>
                <?php
                // Retrieve projects data from the database
                $projects = getProjects();
                
                // Loop through each project and display its information
                foreach ($projects as $project) {
                    echo '<li>';
                    echo '<h4>' . $project['project_name'] . '</h4>';
                    echo '<p>Description: ' . $project['project_description'] . '</p>';
                    echo '<p>Status: ' . $project['project_status'] . '</p>';
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
