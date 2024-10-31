<?php include('header.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <style>
        /* Base Styles */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #FEFAE0;
            color: #333;
        }

        .contact-container {
            max-width: 900px;
            margin: 80px auto; /* Space between header and form */
            padding: 40px;
            background-color: #FAEDCE;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .contact-container h2 {
            margin-bottom: 20px;
            color: #5A5A5A;
            font-size: 24px;
            text-align: center;
        }

        .input-field {
            position: relative;
            margin-bottom: 20px;
        }

        .input-field input,
        .input-field textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #E0E5B6;
            border-radius: 5px;
            background-color: #FFF;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        .input-field input:focus,
        .input-field textarea:focus {
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
        .input-field input:not(:placeholder-shown) + label,
        .input-field textarea:focus + label,
        .input-field textarea:not(:placeholder-shown) + label {
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
        }
    </style>
</head>

<body>
    <div class="contact-container">
        <h2>Contact Us</h2>
        <form id="contactForm" method="POST" action="process_contact.php">
            <div class="input-field">
                <input type="text" id="name" name="name" required placeholder=" ">
                <label for="name">Name</label>
            </div>
            <div class="input-field">
                <input type="email" id="email" name="email" required placeholder=" ">
                <label for="email">Email</label>
            </div>
            <div class="input-field">
                <input type="text" id="subject" name="subject" required placeholder=" ">
                <label for="subject">Subject</label>
            </div>
            <div class="input-field">
                <textarea id="message" name="message" rows="5" required placeholder=" "></textarea>
                <label for="message">Message</label>
            </div>
            <button type="submit" class="btn">Send Message</button>
            <div class="message" id="responseMessage"></div>
        </form>
    </div>

    <script>
        document.getElementById('contactForm').addEventListener('submit', function (event) {
            event.preventDefault();

            const form = document.getElementById('contactForm');
            const formData = new FormData(form);

            // Simple front-end validation
            for (let field of formData.entries()) {
                if (field[1].trim() === "") {
                    showMessage("All fields are required.", true);
                    return;
                }
            }

            // Send form data to server
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "process_contact.php", true);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    const response = xhr.responseText;
                    if (response.includes("Message sent successfully")) {
                        showMessage("Message sent successfully!", false);
                        form.reset(); // Reset the form fields after successful submission
                    } else {
                        showMessage(response, true);
                    }
                } else {
                    showMessage("An error occurred while sending your message.", true);
                }
            };
            xhr.send(formData);
        });

        function showMessage(message, isError) {
            const messageDiv = document.getElementById('responseMessage');
            messageDiv.textContent = message;
            messageDiv.style.color = isError ? '#E68369' : '#5A5A5A';
            messageDiv.style.display = 'block';
        }
    </script>
</body>

</html>
