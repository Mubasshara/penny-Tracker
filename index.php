<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penny Tracker</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }

        .hero {
            background-color: #FEFAE0;
            padding: 40px 0;
            text-align: center;
        }

        .hero h1 {
            color: #333;
            margin-bottom: 10px;
        }

        .hero p {
            color: #333;
            margin-bottom: 20px;
        }

        .cta-btn {
            display: inline-block;
            padding: 15px 25px;
            background-color: #E0E5B6;
            color: #333;
            text-decoration: none;
            border-radius: 8px;
            font-size: 18px;
            transition: background-color 0.3s ease;
        }

        .cta-btn:hover {
            background-color: #CCD5AE;
        }

        .hero-images {
            display: flex;
            justify-content: center;
            gap: 20px; 
            margin-top: 20px;
        }

        .hero-images img {
            border-radius: 8px;
        }
        .welcome{
            color:black;
        }
    </style>
</head>
<body>
    <?php include('header.php'); ?>

    <main>
        <!-- Hero Section -->
        <section class="hero">
            <div class="container">
                <h1>Welcome to Penny Tracker</h1>
                <p>Your ultimate tool for tracking finances efficiently.</p>
                <a href="register.php" class="cta-btn"><h2>Get Started</h2></a>
                <div class="hero-images">
                    <img src="images/financeGraph.png" alt="Finance Image 1" width="400px">
                    <img src="images/image-2.jpg" alt="Finance Image 2" width="400px">
                </div>
            </div>
        </section>
    </main>

    <?php include('footer.php'); ?>
</body>
</html>
