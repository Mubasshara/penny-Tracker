<!-- header.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penny Tracker</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.10.4/gsap.min.js"></script>
    <script src="script.js" defer></script>
    <style>
        .header {
            background-color: #FAEDCE;
            padding: 20px 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .header .logo {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px; /* Space between logo and navigation */
        }

        .header .logo h1 {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .header .nav ul {
            list-style: none;
            display: flex;
            gap: 20px;
            justify-content: center;
        }

        .header .nav ul li {
            display: inline;
        }

        .header .nav ul li a {
            text-decoration: none;
            color: #333;
        }

        .header .cta-btn {
            padding: 10px 20px;
            background-color: #CCD5AE;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="logo">
            <h1><img src="images/logo.png" width="50px" alt="Penny Tracker Logo"/>Penny Tracker</h1>
        </div>
        <nav class="nav">
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="login.php">Log In</a></li>
            </ul>
        </nav>
    </header>
</body>
</html>
