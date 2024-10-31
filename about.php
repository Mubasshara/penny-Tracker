<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Penny Tracker</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #FEFAE0;
            color: #131842;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #FAEDCE;
            padding: 20px;
            color: #131842;
        }

        header .container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h1 {
            margin: 0;
        }

        nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        nav li {
            margin-left: 20px;
        }

        nav a {
            text-decoration: none;
            color: #E68369;
        }

        main {
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .about-section, .features-section {
            margin-bottom: 40px;
        }

        .about-section {
            text-align: center;
        }

        .about-section img {
            max-width: 100%;
            height: auto;
            margin-top: 20px;
        }

        .features-section {
            text-align: center;
        }

        .features-section h2 {
            margin-bottom: 20px;
        }

        .features-wrapper {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .feature {
            flex: 1;
            max-width: 30%;
            margin: 10px;
            box-sizing: border-box;
            position: relative;
            overflow: hidden;
            text-align: center;
        }

        .feature img {
            width: 100%;
            height: auto;
            border-radius: 8px;
            transition: opacity 0.3s;
            max-height: 400px; /* Ensure consistent height */
        }

        .feature p {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #fff;
            background-color: rgba(0, 0, 0, 0.7);
            padding: 10px;
            border-radius: 8px;
            width: 80%;
            text-align: center;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .feature:hover img {
            opacity: 0.7;
        }

        .feature:hover p {
            opacity: 1;
        }

        /* Animation triggers */
        .show {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <h1>About Penny Tracker</h1>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>
    
    <main>
        <div class="container">
            <section class="about-section">
                <h2>Our Mission</h2>
                <p>Penny Tracker is designed to help you manage your finances effectively and efficiently. Our goal is to provide you with the tools you need to track your spending, manage your budget, and achieve your financial goals.</p>
                
            </section>
            
            <section class="features-section">
                <h2>Features</h2>
                <div class="features-wrapper">
                    <div class="feature">
                        <img src="images/feature1.png">
                        <p>Monitor and control your budget with ease using our intuitive tracking tools.</p>
                        <h3>Budget Tracking</h3>
                    </div>
                    <div class="feature">
                        <img src="images/feature2.png">
                        <p>Effortlessly manage and categorize your transactions to keep track of your spending.</p>
                        <h3>Transaction Management</h3>
                    </div>
                    <div class="feature">
                        <img src="images/feature3.png">
                        <p>Generate detailed reports and gain insights into your financial habits.</p>
                        <h3>Reports and Insights</h3>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <script>
        // Function to handle scroll animations
        function handleScroll() {
            const elements = document.querySelectorAll('.feature');
            const windowHeight = window.innerHeight;

            elements.forEach(element => {
                const rect = element.getBoundingClientRect();
                if (rect.top < windowHeight - 100) {
                    element.classList.add('show');
                }
            });
        }

        // Handle scroll event
        window.addEventListener('scroll', handleScroll);

        // Initial check to show features on load if already in view
        handleScroll();
    </script>
</body>
</html>
