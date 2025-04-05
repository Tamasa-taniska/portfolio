<?php
// Database connection settings
$servername = "localhost";
$username = "root"; // Change this to your database username
$password = "MySQL@2025"; // Change this to your database password
$dbname = "ContactDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and sanitize inputs to prevent SQL injection
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $message = $conn->real_escape_string($_POST['message']);

    // Insert data into the table
    $sql = "INSERT INTO ContactDetails (name, email, message) VALUES ('$name', '$email', '$message')";

    if ($conn->query($sql) === TRUE) {
        // Success response as JavaScript
        echo "<script>
            alert('Message sent successfully!');
            window.history.back(); // Redirects back to the form page
        </script>";
    } else {
        echo "<script>
            alert('Error: Unable to save data. Please try again.');
            window.history.back(); // Redirects back to the form page
        </script>";
    }
}

// Close connection
$conn->close();
?>
