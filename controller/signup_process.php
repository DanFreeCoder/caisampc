<!DOCTYPE html>
<html>

<head>
    <title>CIACO Website - Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="assets/toastr/toastr.min.css" rel="stylesheet">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <style>
        /* CSS styles for the form */
        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            background-color: #000018;
            color: black;
            /* Set the color of all text except input elements */
        }

        .container {
            width: 40%;
            /* Adjust the width for landscape layout */
            padding: 16px;
            background-color: whitesmoke;
            margin: auto;
            border: 1px solid #ccc;
            border-radius: 15px;
        }

        h2 {
            text-align: center;
            color: blue;
        }

        .checkbox-container {
            display: flex;
            align-items: center;
            margin-bottom: 8px;
            border-radius: 10px;
        }

        .terms-container {
            display: flex;
            align-items: center;
            margin-bottom: 8px;
        }

        .terms-checkbox {
            margin-right: 8px;
        }

        .already-container {
            display: flex;
            align-items: center;
            margin-bottom: 8px;
        }

        .already-checkbox {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 20px;
            height: 20px;
            border: 1px solid #ccc;
            border-radius: 50%;
            margin-right: 8px;
        }

        input[type=text],
        input[type=password] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            color: black;
            /* Set the color of input text */
        }

        button {
            background-color: blue;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 15px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            opacity: 0.8;
        }

        .g-recaptcha {
            margin: 0 auto;
            width: 304px;
            text-align: center;
        }

        /* Change the color of links (anchors) */
    </style>
</head>

<body>
    <!-- Button trigger modal -->
    <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Launch demo modal
    </button> -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Enter your One-Time-Password(OTP)</h1>
                </div>
                <div class="modal-body">
                    <div class="row" style="display:flex;">
                        <div class="col-2">
                            <input type="text" name="" id="" hidden>
                        </div>
                        <div class="col-2">
                            <input type="text" class="otpnum" name="" id="n1">
                        </div>
                        <div class="col-2">
                            <input type="text" class="otpnum" name="" id="n2">
                        </div>
                        <div class="col-2">
                            <input type="text" class="otpnum" name="" id="n3">
                        </div>
                        <div class="col-2">
                            <input type="text" class="otpnum" name="" id="n4">
                        </div>
                        <div class="col-2">
                            <input type="text" name="" id="" hidden>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" style="text-decoration: none;" id="timer" onclick="resend()"></a>
                    <button type="button" class="btn btn-primary" id="submit_otp">Submit</button>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <h2>Sign Up</h2>
        <form id="signup-form" action="signup_process.php" method="POST">
            <label for="firstname"><b>First Name</b></label>
            <input type="text" placeholder="" class="textOnly" name="fname" id="fname" required>
            <label for="middlename"><b>Middle Name</b></label>
            <input type="text" placeholder="" class="textOnly" name="mname" id="mname" required>
            <label for="lastname"><b>Last Name</b></label>
            <input type="text" placeholder="" class="textOnly" name="lname" id="lname" required>
            <!-- <label for="email"><b>Email</b></label>
            <input type="text" placeholder="" name="email" id="email" required> -->
            <label for="username"><b>Username</b></label>
            <input type="text" placeholder="" name="username" id="username" required>
            <label for="password"><b>Password</b></label>
            <input type="password" placeholder="" name="password" id="password" required>
            <span class="text-danger" id="errPass"></span><br>
            <label for="cnum"><b>Contact Number</b></label>
            <input type="text" placeholder="" value="09" name="cnum" id="cnum" required>
            <div class="terms-container">
                <input type="checkbox" id="terms-checkbox" class="terms-checkbox" required>
                <label for="terms-checkbox">I've read and agree to the <a href="#">terms & conditions</a></label>
            </div>
            <div class="g-recaptcha" data-sitekey="6Le7VhspAAAAAIrzZVg1eLQSf2JY4tO0b4HN2Whl"></div>
            <div class="already-container">
                <input type="checkbox" id="already-input" style="display: none;">
            </div>
            <button type="button" id="create">Create Account</button>
            <label for="already-input">Already have an account? <a href="login.php">Login here</a></label>
        </form>
    </div>

    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer>
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="assets/toastr/toastr.min.js"></script>

    <script>
        $('.textOnly').on('input', function() {
            var node = $(this);
            node.val(node.val().replace(/[^a-zA-Z\s]/g, ''));
        });

        $('#cnum').on('input', function() {
            var inputValue = $(this).val();
            if (inputValue.length > 11) {
                // Filter non-digits from input value.
                var filteredValue = inputValue.replace(/\D/g, '');
                // Truncate the value to 10 digits after filtering.
                $(this).val(filteredValue.substring(0, 10));
                toastr.warning('Phone number contain 11 digits only')
            }
        })
    </script>
    <!-- checkbox function -->
    <script>
        var isGoodPass = false;
        var isGoodnum = false;
        $('#password').on('input', function() {
            const pass = $(this).val();
            if (pass.length < 8) {
                $('#errPass').text('Password must be at least 8 characters long')
                isGoodPass = false;
            } else if (!/[a-z]/.test(pass)) {
                $('#errPass').text('Password must contain at least one lowercase letter');
                isGoodPass = false;
            } else if (!/[A-Z]/.test(pass)) {
                $('#errPass').text('Password must contain at least one uppercase letter');
                isGoodPass = false;
            } else if (!/\d/.test(pass)) {
                $('#errPass').text('Password must contain at least one number');
                isGoodPass = false;
            } else {
                $('#errPass').text('');
                isGoodPass = true;
            }
        })

        $(document).ready(() => {
            $('#create').hide();

        });

        // hide button if unchecked terms & conditon
        $('#terms-checkbox').on('change', () => {
            var check = $('input[type=checkbox]').prop('checked');
            if (check) {
                $('#create').show();
            } else {
                $('#create').hide();
            }
        })
    </script>
    <!-- Register User -->

    <script>
        var code = '';
        $('#create').on('click', () => {
            const cnum = $('#cnum').val();
            code = generateVerificationCode(cnum);
            const firstname = $('#fname').val();
            const middleName = $('#mname').val();
            const lastname = $('#lname').val();
            const username = $('#username').val();
            const password = $('#password').val();
            const role = 2; //for user
            var mydata = `firstname=${firstname}&middle_name=${middleName}&lastname=${lastname}&username=${username}&password=${password}&cnum=${cnum}&role=${role}&mycode=${code}`;

            if (firstname != '' && lastname != '' && username != '' && password != '') {
                // check fullname if exist
                $.ajax({
                    type: 'POST',
                    url: 'controller/check_fullname_exist.php',
                    data: mydata,
                    success: function(response1) {
                        if (response1 > 0) {
                            toastr.warning('Full name already exist');
                        } else {
                            //check username exist
                            $.ajax({
                                type: 'POST',
                                url: 'controller/check_username_exist.php',
                                data: {
                                    username: username
                                },
                                success: function(res2) {
                                    if (res2 > 0) {
                                        toastr.error('Username is already taken.')
                                    } else {
                                        if (cnum.length == 11) {
                                            if (isGoodPass) {
                                                // Verify reCAPTCHA
                                                var recaptchaResponse = grecaptcha.getResponse();
                                                // if recaptcha is not checked
                                                if (!recaptchaResponse) {
                                                    toastr.warning("reCAPTCHA is incomplete.");
                                                    return;
                                                } else {

                                                    mydata += `&g-recaptcha-response=${recaptchaResponse}`;
                                                    $.ajax({
                                                        type: 'POST',
                                                        url: 'controller/register.php',
                                                        data: mydata,
                                                        success: function(response) {
                                                            if (response == 5) {
                                                                toastr.error('The contact number is already taken.')
                                                            } else {
                                                                if (response == 1) {
                                                                    //reset code to zero
                                                                    $.ajax({
                                                                        type: 'POST',
                                                                        url: 'controller/reset_code.php',
                                                                        data: {
                                                                            number: 0
                                                                        },
                                                                        success: function(response) {
                                                                            if (response > 0) console.log('reset code')
                                                                            var message = `Your OTP for verification is: ${code}`;
                                                                            var user_data = `user_number=${cnum}&message=${message}`;
                                                                            $.ajax({
                                                                                type: 'POST',
                                                                                url: 'controller/send_sms.php',
                                                                                data: user_data,
                                                                                success: function(response) {
                                                                                    if (response > 0) {
                                                                                        start_timer(cnum)
                                                                                    }
                                                                                }
                                                                            })
                                                                        }
                                                                    })

                                                                    $('#exampleModal').modal('show'); //open otp modal
                                                                    $('#exampleModal').on('shown.bs.modal', function() {
                                                                        $('.otpnum:first').focus();
                                                                    });
                                                                } else if (response == 2) {
                                                                    toastr.error('reCaptcha verification failed.');
                                                                } else {
                                                                    toastr.error('Failed to register');
                                                                }
                                                            }
                                                        }
                                                    });
                                                }

                                            } else {
                                                toastr.error('Please pass the password requirements');
                                            }
                                        } else {
                                            toastr.warning('Number must contain 11 digit below');
                                        }
                                    }
                                }
                            })

                        }
                    }
                })

            } else {
                toastr.error('Please fill out all fields.');
            }
        })
    </script>

    <script>
        $('#submit_otp').on('click', function() {
            var number = $('#cnum').val();
            var n1 = $('#n1').val();
            var n2 = $('#n2').val();
            var n3 = $('#n3').val();
            var n4 = $('#n4').val();

            var con_otp = `${n1}${n2}${n3}${n4}`;
            if (n1 != '' && n2 != '' && n3 != '' && n4 != '') {
                $.ajax({
                    type: 'GET',
                    url: 'controller/last_id.php',
                    dataType: 'json',
                    success: function(data) {
                        var code = data[0];
                        var id = data[1]
                        if (con_otp == code) {
                            $.ajax({
                                type: 'POST',
                                url: 'controller/upd_stat.php',
                                data: {
                                    id: id
                                },
                                success: function(response) {
                                    if (response > 0) {
                                        toastr.success('You are successfully registered');
                                        $('#exampleModal').modal('hide'); //open otp modal
                                        //reset code to zero
                                        $.ajax({
                                            type: 'POST',
                                            url: 'controller/reset_code.php',
                                            data: {
                                                number: number
                                            },
                                            success: function(response) {
                                                if (response > 0) console.log('reset code')
                                                setTimeout(() => {
                                                    window.location = 'signup_process.php';
                                                }, 2000)
                                            }
                                        })

                                    }
                                }
                            })

                        } else {
                            toastr.error('Incorrect OTP')
                        }
                    }
                })
            } else {
                toastr.warning('Please input OTP code');
            }
        })
    </script>
    <script>
        function start_timer(number) {
            // timer
            var countdown = 120; // Set the countdown duration in seconds
            var timerDisplay = $('#timer');

            function updateTimer() {
                timerDisplay.text(countdown + ' seconds remaining');
                timerDisplay.css('pointer-events', 'none').css('text-decoration', 'none'); //disabled to click
                countdown--;
                if (countdown < 0) {
                    clearInterval(timerInterval);
                    //reset code to zero
                    $.ajax({
                        type: 'POST',
                        url: 'controller/reset_code.php',
                        data: {
                            number: number
                        },
                        success: function(response) {
                            if (response > 0) console.log('reset code')
                        }
                    })
                    timerDisplay.text('Resend').css('text-decoration', 'underline').css('cursor', 'pointer').css('pointer-events', 'auto');
                }
            }

            updateTimer(); // Initial display
            var timerInterval = setInterval(updateTimer, 1000); // Update the timer every 1 second (1000 milliseconds)
        }

        function resend() {
            var cnum = $('#cnum').val();
            var code = generateVerificationCode(cnum)
            var mydata = `mycode=${code}&number=${cnum}`;
            $.ajax({
                type: 'POST',
                url: 'controller/upd_code.php',
                data: mydata,
                success: function(response) {
                    if (response > 0) {
                        var message = `Your OTP for verification is: ${code}`;
                        var user_data = `user_number=${cnum}&message=${message}`;
                        $.ajax({
                            type: 'POST',
                            url: 'controller/send_sms.php',
                            data: user_data,
                            success: function(response) {
                                if (response > 0) {
                                    start_timer(cnum)
                                }
                            }
                        })
                    }
                }
            })
        }
    </script>

    <script>
        function generateVerificationCode(number) {
            var code = '';
            var max = number.length - 1;

            // Define the length of the verification code
            var length = 4;
            for (var i = 0; i < length; i++) {
                // Generate a random index within the valid range (0 to max)
                var randomIndex = Math.floor(Math.random() * (max + 1));
                // Append the character at the randomly chosen index to the code
                code += number.charAt(randomIndex);
            }
            return code;
        }
    </script>

    <script>
        $('.otpnum').on('input', function() {
            var inputValue = $(this).val();
            if (/\D/g.test(this.value)) {
                // Filter non-digits from input value.
                this.value = this.value.replace(/\D/g, '');
            }

            if (inputValue.length > 0) {
                // Filter non-digits from input value.
                var filteredValue = inputValue.replace(/\D/g, '');
                // Truncate the value to 1 digit after filtering.
                $(this).val(filteredValue.substring(0, 1));

                // Find all elements with the class .otpnum
                var otpInputs = $('.otpnum');

                // Find the index of the current input
                var currentIndex = otpInputs.index(this);

                // Focus on the next input
                if (currentIndex < otpInputs.length - 1) {
                    otpInputs.eq(currentIndex + 1).focus();
                }
            } else {
                // Find all elements with the class .otpnum
                var otpInputs = $('.otpnum');
                if ($('.otpnum:first').val() == '') {
                    $('.otpnum:first').focus();
                } else {
                    // Find the index of the current input
                    var currentIndex = otpInputs.index(this);
                    otpInputs.eq(currentIndex - 1).focus();
                }

            }
        });
    </script>
</body>

</html>