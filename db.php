<?php
$host = "localhost";      // XAMPP default
$dbname = "prisha_software";
$username = "root";       // XAMPP default
$password = "";           // XAMPP default has no password

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);
die("Connection failed: " . $conn);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>