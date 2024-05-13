<?php
// check who want to login
$user_type = $_GET['user_type'];
$type;
if ($user_type == 'admin') {
    $type = 1;
} elseif ($user_type == 'client') {
    $type = 2;
} else {
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>CIACO Website</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="stylesheet" href="assets/toastr/toastr.min.css">
    <style>
        /* CSS styles for the form */
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #000018;
        }

        .container {
            width: 400px;
            padding: 30px;
            background-color: #f2f2f2;
            margin: 0 auto;
            margin-top: 50px;
            margin-bottom: 150px;
            border: 1px solid #ccc;
            border-radius: 10px;
        }

        h2 {
            text-align: center;
            color: #1E1E64;

        }

        .logo {
            text-align: center;
            margin-bottom: 16px;
        }

        .logo img {
            height: 70px;
            width: 70px;
            border-radius: 50%;
        }

        input[type=text],
        input[type=password] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
            border-radius: 10px;
        }

        button {
            background-color: blue;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
            border-radius: 10px;
        }

        button:hover {
            opacity: 0.8;
        }

        .remember-me {
            display: flex;
            align-items: center;
            margin-bottom: 8px;
        }

        .forgot-password {
            text-align: center;
        }
    </style>
    <!-- <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>
        function onSubmit(token) {
            document.getElementById("login-form").submit();
        }
    </script> -->
</head>

<body>
    <div class="container">
        <div class="logo">
            <img src="ciaco.jpg" alt="Logo" height="70" width="70">
        </div>
        <!-- return client if type is not 1 else return admin -->
        <h2>Hello, <?php echo ($type != 1) ? 'Client' : 'Admin'; ?></h2>
        <input type="text" name="" id="role" value="<?php echo $type; ?>" hidden>
        <div class="form">
            <label for="username"><b>Username</b></label>
            <input type="text" placeholder="" name="username" id="username" required>

            <label for="password"><b>Password</b></label>
            <input type="password" placeholder="" name="password" id="password" required>

            <div class="remember-me">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember"> Remember me</label>
            </div>
            <div class="g-recaptcha" data-sitekey="6LfVYmUpAAAAAEMaLaiuFO1rVbu_2DGa90pW7e0-"></div>
            <button id="login">Login</button>

        </div>
        <div class="forgot-password">
            <a href="fp.php">Forgot Password?</a>
        </div>
        <?php
        // show register button if login as client
        if ($type == 2) {
            echo '<p>Don`t have an account? <a href="signup_process.php">Sign up</a></p>';
        }
        ?>

    </div>
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer>
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="assets/toastr/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    <script>
        // Login btn event handler
        $('#login').on('click', () => {
            const username = $('#username').val()
            const password = $('#password').val();
            const role = $('#role').val();
            var mydata = `username=${username}&password=${password}&role=${role}`;
            if (username != '' && password != '') { //check if fields is not empty
                // Verify reCAPTCHA
                var recaptchaResponse = grecaptcha.getResponse();
                // check if recaptcha is unchecked
                if (!recaptchaResponse) {
                    toastr.warning("reCAPTCHA is incomplete.");
                    return;
                } else {
                    mydata += `&g-recaptcha-response=${recaptchaResponse}`;
                    $.ajax({
                        type: 'POST',
                        url: 'controller/logins.php',
                        data: mydata,
                        success: function(response) {
                            if (response == 1) {
                                window.location = "controller/check_access.php";
                            } else if (response == 2) {
                                toastr.error('reCaptcha verification failed.');
                                setTimeout(() => {
                                    location.reload(true)
                                }, 2000)
                            } else {
                                toastr.error('Wrong username or password')
                            }
                        }
                    })
                }
            } else {
                toastr.error('Please fill out all fields.');
            }
        });

        //event handler bntLogin
        $('#password').keyup(function(event) {
            // enter key
            if (event.keyCode === 13) {
                $('#login').click();
            }
        });
    </script>
</body>

</html>