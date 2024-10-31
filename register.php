<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('header.php'); // Include the header
include('db.php'); // Ensure this file has the $conn variable for the database connection

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_name = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Check if the email or username already exists
    $sql_check = "SELECT id FROM users WHERE email = ? OR user_name = ?";
    $stmt_check = $conn->prepare($sql_check);
    
    if ($stmt_check === false) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt_check->bind_param("ss", $email, $user_name);
    $stmt_check->execute();
    $stmt_check->store_result();

    if ($stmt_check->num_rows > 0) {
        $message = "Email or Username already registered.";
    } else {
        // Insert new user if email and username are unique
        $sql_insert = "INSERT INTO users (user_name, email, password) VALUES (?, ?, ?)";
        $stmt_insert = $conn->prepare($sql_insert);
        
        if ($stmt_insert === false) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt_insert->bind_param("sss", $user_name, $email, $password);

        if ($stmt_insert->execute()) {
            $message = "Registration successful!";
            header("Refresh:2; url=login.php"); // Redirect after 2 seconds to allow user to see the message
        } else {
            $message = "Error: " . $stmt_insert->error;
        }

        $stmt_insert->close();
    }

    $stmt_check->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        /* Base Styles */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #FEFAE0;
            color: #333;
            display: flex;
            flex-direction: column;
        }

        .header {
            background-color: #FAEDCE;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        main {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            width: 100%;
            max-width: 1000px;
            margin: 0 auto;
            background-color: #1f2937;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            padding: 20px;
        }

        .register {
            padding: 40px;
            width: 50%;
            background-color: #2e3a46;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .register h2 {
            margin-bottom: 20px;
            color: #E0E0E0;
            font-size: 28px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #E0E5B6;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
            background-color: #FFF;
        }

        input:focus {
            border-color: #CCD5AE;
            outline: none;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #CCD5AE;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #AABF8E;
        }

        .image {
            width: 50%;
            background-size: cover;
            background-position: center;
        }

        .message {
            margin-top: 15px;
            color: #E68369;
        }

        @media (max-width: 768px) {
            main {
                flex-direction: column;
                align-items: center;
                padding: 20px;
            }

            .register, .image {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <main>
        <div class="register">
            <h2>Registration Form</h2>
            <form id="registerForm" action="register.php" method="POST">
                <input type="text" name="username" placeholder="Username" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">REGISTER</button>
                <?php if (!empty($message)): ?>
                    <div class="message"><?php echo htmlspecialchars($message); ?></div>
                <?php endif; ?>
            </form>
        </div>
        <div><img src="images\registration.png" width=500px height=450px></div>
    </main>
    <script>
        document.getElementById('registerForm').addEventListener('submit', function(event) {
            const username = document.querySelector('input[name="username"]').value;
            const email = document.querySelector('input[name="email"]').value;
            const password = document.querySelector('input[name="password"]').value;

            if (username.length < 3) {
                alert("Username must be at least 3 characters long.");
                event.preventDefault();
            }

            if (password.length < 6) {
                alert("Password must be at least 6 characters long.");
                event.preventDefault();
            }
        });
    </script>
</body>
</html>
