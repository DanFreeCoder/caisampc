<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="icon" href="C:\wamp64\www\ciaco2.0\ciaco.jpg" type="image/jpg">
    <!-- Add Font Awesome CSS link from CDN -->


    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #000018;
        }

        .top-header {
            background-color: #333;
            padding: 10px;
            text-align: center;
            color: #fff;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        p {
            font-size: 20px;
            font-weight: bold;
            text-align: center;
            color: #32343B;

            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }

        .choice-container {
            display: flex;
            justify-content: center;
            border: 4px solid #ccc;
            border-radius: 10px;
            padding: 30px 80px;
            background-color: #f9f9f9;
            /* Change the background color */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            align-items: center;
            flex-direction: column;
        }

        .choice {
            cursor: pointer;
            text-align: center;
            transition: transform 0.3s ease;
            margin: 20px;
        }

        .choice:hover {
            transform: scale(1.1);
        }

        .choice:hover i {
            transform: scale(1.5);
        }

        .choice-heading {
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            font-size: 36px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
            color: #09093E;
            /* Change the heading color */
        }

        .choice-line {
            display: none;
            /* Hide the horizontal line by default */
            width: 100%;
            margin: 10px 0;
            border: 1px solid #ccc;
        }

        .choice.active .choice-line {
            display: block;
            /* Show the horizontal line when the choice is active */
        }
    </style>

</head>

<body>
    <div class="container">
        <div class="choice-container">
            <h2 class="choice-heading">Choose an Option</h2>
            <hr class="choice-line">
            <div class="choice" id="adminChoice">
                <i class="fas fa-user-shield fa-5x" style="color:#1f9842 !important"></i>
                <p>ADMIN</p>
                <hr class="choice-line"> <!-- Horizontal line added for the "ADMIN" choice -->
            </div>
            <div class="choice" id="clientChoice">
                <i class="fas fa-users fa-5x " style="color:#1f9842 !important"></i>

                <p>CLIENT</p>
                <hr class="choice-line"> <!-- Horizontal line added for the "CLIENT" choice -->
            </div>

            <?php
            // Display error message if login fails (for demonstration purposes)
            if (isset($errorMessage)) {
                echo '<p style="color: red;">' . $errorMessage . '</p>';
            }
            ?>
        </div>
    </div>
    <!-- Add Font Awesome JS link from CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
    <script>
        // Add click event listeners to the admin and client choices
        const adminChoice = document.getElementById('adminChoice');
        const clientChoice = document.getElementById('clientChoice');

        adminChoice.addEventListener('click', function() {
            // Set the username field value to 'admin' and submit the form
            const form = document.createElement('form');
            window.location = 'login.php?user_type=admin'; // Pass user_type=admin as a URL parameter
        });

        clientChoice.addEventListener('click', function() {
            // Set the username field value to 'client' and submit the form
            const form = document.createElement('form');
            window.location = 'login.php?user_type=client'; // Pass user_type=client as a URL parameter
        });
    </script>
</body>

</html>