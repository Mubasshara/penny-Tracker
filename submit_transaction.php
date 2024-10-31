<?php
session_start();

// Redirect if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form data
    $amount = $conn->real_escape_string($_POST['amount']);
    $description = $conn->real_escape_string($_POST['description']);
    $date = $conn->real_escape_string($_POST['date']);
    $user_id = $_SESSION['user_id'];

    // Validate the data
    if (empty($amount) || empty($description) || empty($date)) {
        echo "Please fill in all required fields.";
        exit;
    }

    // Insert data into the database
    $sql = "INSERT INTO transactions (user_id, amount, description, date) VALUES ('$user_id', '$amount', '$description', '$date')";

    if ($conn->query($sql) === TRUE) {
        header('Location: homepage.php'); // Redirect to homepage after success
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
