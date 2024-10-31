<?php include('header.php'); ?>

<?php
include('db.php');

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT id, password FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) { // Check if the email is registered
        $stmt->bind_result($id, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $id;
            echo "Login successful!";
        } else {
            echo "Invalid email or password.";
        }
    } else {
        echo "Not registered"; // If the email doesn't exist in the database
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        /* Base Styles */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #FEFAE0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            color: #333;
        }

        /* Adjust header margin */
        .header {
            margin-bottom: 80px; /* Adjust as needed to provide space */
        }

        .login {
            background-color: #FAEDCE;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            max-width: 700px;
            width: 100%;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin: 10px auto 0; /* Adjust margin to provide space from header */
        }

        .login:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.2);
        }

        .login h2 {
            margin-bottom: 20px;
            color: #5A5A5A;
            font-size: 24px;
            text-align: center;
        }

        .input-field {
            position: relative;
            margin-bottom: 25px;
        }

        .input-field input {
            width: 100%;
            padding: 12px;
            border: 1px solid #E0E5B6;
            border-radius: 5px;
            background-color: #FFF;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        .input-field input:focus {
            border-color: #CCD5AE;
            outline: none;
        }

        .input-field label {
            position: absolute;
            top: 12px;
            left: 12px;
            font-size: 16px;
            color: #999;
            pointer-events: none;
            transition: all 0.2s ease;
        }

        .input-field input:focus + label,
        .input-field input:not(:placeholder-shown) + label {
            top: -10px;
            left: 12px;
            font-size: 12px;
            color: #CCD5AE;
        }

        .btn {
            width: 100%;
            padding: 12px;
            background-color: #CCD5AE;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        .btn:hover {
            background-color: #AABF8E;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .message {
            margin-top: 15px;
            text-align: center;
            color: #E68369;
            display: none;
        }
    </style>
</head>

<body>
    <div class="login">
        <h2>Login</h2>
        <form id="loginForm" method="POST">
            <div class="input-field">
                <input type="email" id="email" name="email" required placeholder=" ">
                <label for="email">Email</label>
            </div>
            <div class="input-field">
                <input type="password" id="password" name="password" required placeholder=" ">
                <label for="password">Password</label>
            </div>
            <button type="submit" class="btn">Login</button>
            <div class="message" id="message"></div>
        </form>
    </div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function (event) {
            event.preventDefault();

            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            // Simple front-end validation
            if (email.trim() === "" || password.trim() === "") {
                showMessage("Email and Password are required.", true);
                return;
            }

            // Simulate form submission (could be an AJAX request here)
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "login.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    if (xhr.responseText.includes("Login successful")) {
                        showMessage("Login successful!", false);
                        // Redirect to homepage.php after successful login
                        setTimeout(() => {
                            window.location.href = "homepage.php";
                        }, 1000); // Delay for user to see success message
                    } else if (xhr.responseText.includes("Not registered")) {
                        showMessage("Not registered. Please sign up.", true);
                    } else {
                        showMessage("Invalid email or password.", true);
                    }
                }
            };
            xhr.send(`email=${encodeURIComponent(email)}&password=${encodeURIComponent(password)}`);
        });

        function showMessage(message, isError) {
            const messageDiv = document.getElementById('message');
            messageDiv.textContent = message;
            messageDiv.style.color = isError ? '#E68369' : '#5A5A5A';
            messageDiv.style.display = 'block';
        }
    </script>
</body>

</html>
