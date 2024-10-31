<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Transaction</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #FEFAE0;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #FAEDCE;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #E0E5B6;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #CCD5AE;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #E0E5B6;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .btn-group {
            text-align: center;
            margin-top: 20px;
        }

        .btn-submit, .btn-back {
            display: inline-block;
            padding: 15px 25px;
            border-radius: 8px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            border: none;
            margin: 5px;
        }

        .btn-submit {
            background-color: #E0E5B6;
            color: #333;
        }

        .btn-submit:hover {
            background-color: #CCD5AE;
        }

        .btn-back {
            background-color: #CCD5AE;
            color: #333;
        }

        .btn-back:hover {
            background-color: #E0E5B6;
        }

        #error-message {
            color: red;
            margin-top: 10px;
            text-align: center;
        }

        #success-message {
            color: green;
            margin-top: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Submit Transaction</h1>
        <form id="transactionForm" method="POST">
            <div class="form-group">
                <label for="amount">Amount</label>
                <input type="number" id="amount" name="amount" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" id="description" name="description" required>
            </div>
            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" id="date" name="date" required>
            </div>
            <div class="btn-group">
                <button type="submit" class="btn-submit">Submit</button>
                <button type="button" class="btn-back" onclick="window.location.href='homepage.php'">Back</button>
            </div>
            <div id="error-message"></div>
            <div id="success-message"></div>
        </form>
    </div>
    <script>
        document.getElementById('transactionForm').addEventListener('submit', function(event) {
            const amount = document.getElementById('amount').value;
            const description = document.getElementById('description').value;
            const date = document.getElementById('date').value;
            const errorMessage = document.getElementById('error-message');
            const successMessage = document.getElementById('success-message');

            errorMessage.textContent = '';
            successMessage.textContent = '';

            // Validate form inputs
            if (!amount || !description || !date) {
                errorMessage.textContent = 'Please fill in all required fields.';
                event.preventDefault();
                return;
            }
        });
    </script>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Database connection parameters
        $servername = "******";
        $username = "*****"; // default XAMPP username
        $password = "******"; // default XAMPP password
        $dbname = "penny_tracker";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Get form data
        $amount = $_POST['amount'];
        $description = $_POST['description'];
        $date = $_POST['date'];
        $user_id = 1; // Replace with the actual user ID if available

        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO transactions (user_id, amount, description, date) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("idss", $user_id, $amount, $description, $date);

        // Execute the query
        if ($stmt->execute()) {
            echo "<script>
                    document.getElementById('success-message').textContent = 'Transaction submitted successfully.';
                    document.getElementById('transactionForm').reset();
                  </script>";
        } else {
            echo "<script>
                    document.getElementById('error-message').textContent = 'Error: " . $stmt->error . "';
                  </script>";
        }

        // Close connection
        $stmt->close();
        $conn->close();
    }
    ?>
</body>
</html>
