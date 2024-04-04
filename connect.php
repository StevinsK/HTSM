<?php
// Database connection
$servername = "localhost"; // Change this to your MySQL server name
$username = "root"; // Change this to your MySQL username
$password = ""; // Change this to your MySQL password
$dbname = "health_tracking_system"; // Change this to your MySQL database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection. This checks if the connection to the database was successful. If there's an error, it stops the script execution
//and displays the error message
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $othernames = $_POST["othernames"];
    $email = $_POST["email"];
    $dateOfBirth = $_POST["dateOfBirth"];
    $countyOfResidence = $_POST["countyOfResidence"];
    $phoneNumber = $_POST["phoneNumber"];

    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO users (fname, lname, othernames, email, dateOfBirth, countyOfResidence, phoneNumber) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $fname, $lname, $othernames, $email, $dateOfBirth, $countyOfResidence, $phoneNumber);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
