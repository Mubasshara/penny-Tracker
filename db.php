<?php
$servername = "localhost";
$username = "root"; // default XAMPP username
$password = "Rimsha@1234"; // default XAMPP password
$dbname = "penny_tracker";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
