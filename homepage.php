<?php
session_start();

// Redirect if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

include('db.php');

// Fetch user details
$user_id = $_SESSION['user_id'];

// Fetch recent transactions for the logged-in user
$sql = "SELECT * FROM transactions WHERE user_id = ? ORDER BY date DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
$transactions = $result->fetch_all(MYSQLI_ASSOC);

// Fetch user information (optional, if you want to display the username)
$sql_user = "SELECT user_name FROM users WHERE id = ?";
$stmt_user = $conn->prepare($sql_user);
$stmt_user->bind_param('i', $user_id);
$stmt_user->execute();
$user_result = $stmt_user->get_result();
$user = $user_result->fetch_assoc();
$username = $user['user_name']; // Updated to 'user_name'

// Close the database connection
$stmt->close();
$stmt_user->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage - Penny Tracker</title>
    <style>
        /* Base Styles */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #FEFAE0;
            color: #333;
        }
        .transactions {
            background-color: #e6d3a5;
            align-items: center;
            color: black;
            cursor: pointer;
            border: none;
            font-size: 16px;
            text-align: center;
            display: block;
            margin: auto;
            padding: 20px;
        }

        header {
            background-color: #CCD5AE;
            padding: 20px 0;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
        }

        header h1 {
            margin: 0;
            color: #fff;
            font-size: 24px;
            text-align: center;
        }

        nav ul {
            list-style-type: none;
            padding: 0;
            display: flex;
            justify-content: center;
            margin-top: 10px;
        }

        nav ul li {
            margin: 0 15px;
        }

        nav ul li a {
            text-decoration: none;
            color: #FFF;
            font-size: 16px;
            transition: color 0.3s ease;
        }

        nav ul li a:hover {
            color: #FAEDCE;
        }

        main .recent-transactions {
            background-color: #FAEDCE;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        main .recent-transactions:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.2);
        }

        main h2 {
            font-size: 22px;
            margin-bottom: 15px;
            color: #5A5A5A;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #FFF;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #E0E5B6;
        }

        th {
            background-color: #CCD5AE;
            color: #FFF;
        }

        tr:hover {
            background-color: #E0E5B6;
            cursor: pointer;
        }

        tr:last-child td {
            border-bottom: none;
        }

        .no-transactions {
            text-align: center;
            color: #999;
        }
        .add{
            text-decoration: none;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            header h1 {
                font-size: 20px;
            }

            nav ul li {
                margin: 0 10px;
            }

            main h2 {
                font-size: 20px;
            }
        }

        @media (max-width: 480px) {
            nav ul {
                flex-direction: column;
                align-items: center;
            }

            nav ul li {
                margin-bottom: 10px;
            }

            table {
                font-size: 14px;
            }
        }
        
    </style>
</head>

<body>
    <header>
        <div class="container">
            <h1>Welcome, <?php echo htmlspecialchars($username); ?>!</h1>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <div class="container">
            <section class="recent-transactions">
                <h2>Recent Transactions</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($transactions)) : ?>
                            <?php foreach ($transactions as $transaction) : ?>
                                <tr onclick="showTransactionDetails('<?php echo htmlspecialchars(json_encode($transaction)); ?>')">
                                    <td><?php echo htmlspecialchars($transaction['date']); ?></td>
                                    <td><?php echo htmlspecialchars(number_format($transaction['amount'], 2)); ?></td>
                                    <td><?php echo htmlspecialchars($transaction['description']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="3" class="no-transactions">No transactions found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table><br>
                <button type="button" class="transactions"><a class="add" href="add_transaction.php">ADD TRANSACTIONS</a></button>
            </section>
        </div>
    </main>
    

    <script>
        function showTransactionDetails(transactionJson) {
            const transaction = JSON.parse(transactionJson);
            alert(`Transaction Details:\n\nDate: ${transaction.date}\nAmount: $${transaction.amount}\nDescription: ${transaction.description}`);
        }

        // Enhancing hover effects
        document.querySelectorAll('tr').forEach(row => {
            row.addEventListener('mouseover', () => {
                row.style.backgroundColor = '#CCD5AE';
            });

            row.addEventListener('mouseout', () => {
                row.style.backgroundColor = '';
            });
        });
    </script>
</body>
</html>
