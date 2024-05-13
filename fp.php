<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Forgot Password</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/toastr/toastr.min.css">
  <style>
    body {
      font-family: Arial, Helvetica, sans-serif;
      background-color: #000018;
    }

    .container {
      width: 50%;
      margin: auto;
    }

    .banner {
      width: 80%;
      margin: auto;
      font-size: 1rem;
      border: 1px solid gray;
    }

    #reset {
      font-size: x-large;
    }
  </style>
</head>

<body>
  <div class="container-fluid card mt-4" style="width: 80%; margin:auto; height:90vh;">
    <center>
      <div class="header mt-5">
        <h1>Forgot Password ?</h1>
      </div>
    </center>
    <div class="banner p-3 mt-4">
      <p>Please enter your registered contact number in the system for password reset to receive a verification code to reset and change your password.</p>
    </div>
    <div class="container mt-4" id="reset_pass">
      <div class="mb-4">
        <input type="text" class="form-control" id="contact" style="font-size:x-large;" placeholder="Enter your registered contact number">
      </div>
      <center>
        <div class="btn btn-primary rounded-pill form-control" id="reset">Reset my password</div>
      </center>
    </div>
    <div class="container mt-4" id="codes" hidden>
      <div class="mb-4">
        <input type="text" class="form-control" id="code" style="font-size:x-large;" placeholder="Enter verification code">
      </div>
      <center>
        <div class="btn btn-primary rounded-pill form-control" id="verify_code">Verify</div>
        <a href="#" style="text-decoration: none;" id="timer" onclick="resend()"></a>
      </center>
    </div>
    <div class="container mt-4" id="change_pass" hidden>
      <div class="mb-4">
        <input type="password" class="form-control" id="password" style="font-size:x-large;" placeholder="Change Password">
        <br>
        <input type="password" class="form-control" id="re-password" style="font-size:x-large;" placeholder="Re-Type Password">
      </div>
      <span class="text-success" id="success" hidden>Password match!</span>
      <span class="text-danger" id="error" hidden>Password doesn`t match!</span>
      <center>
        <div class="btn btn-primary rounded-pill form-control" onclick="update_password()">Update</div>
      </center>
    </div>
  </div>


 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <script>
    $('#reset').on('click', () => {
      const number = $('#contact').val();
      const mycode = generateVerificationCode(number);

      const mydata = `number=${number}&veri_code=${mycode}`;
      if (number != '') {
        if (number.length < 11) {
          toastr.error('Incorrect Contact Number!')
        } else {
          $.ajax({
            type: 'POST',
            url: 'controller/verify_number.php',
            data: mydata,
            dataType: 'json',
            success: function(data) {
              var code = data[0];
              var user_number = data[1];
              var message = `CIACO: Your password reset verification code is: ${code}. Use this code to reset your password. Do not share this code with anyone. Thank you.`
              // SMS
              $.ajax({
                type: 'POST',
                url: 'controller/send_sms.php',
                data: {
                  code: code,
                  user_number: user_number,
                  message: message,
                },
                success: function(response) {
                  if (response > 0) {
                    $('#reset_pass').hide();
                    $('#codes').attr('hidden', false)
                    start_timer(number)
                  }
                }
              })

            },
            error: function() {
              toastr.error('Number not found')
            }
          })
        }
      } else {
        toastr.warning('Please enter your registered number');
      }
    });

    function resend() {
      const number = $('#contact').val();
      const mycode = generateVerificationCode(number);

      const mydata = `number=${number}&veri_code=${mycode}`;
      if (number != '') {
        if (number.length < 11) {
          toastr.error('Incorrect Contact Number!')
        } else {
          $.ajax({
            type: 'POST',
            url: 'controller/verify_number.php',
            data: mydata,
            dataType: 'json',
            success: function(data) {
              var code = data[0];
              var user_number = data[1];
              var message = `CIACO: Your password reset verification code is: ${code}. Use this code to reset your password. Do not share this code with anyone. Thank you.`
              // SMS
              $.ajax({
                type: 'POST',
                url: 'controller/send_sms.php',
                data: {
                  code: code,
                  user_number: user_number,
                  message: message,
                },
                success: function(response) {
                  if (response > 0) {
                    $('#reset_pass').hide();
                    $('#codes').attr('hidden', false)
                    start_timer(number)
                  }
                }
              })

            },
            error: function() {
              toastr.error('Number not found')
            }
          })
        }
      } else {
        toastr.warning('Please enter your registered number');
      }
    }


    function generateVerificationCode(number) {
      var code = '';
      var max = number.length - 1;

      // Define the length of the verification code
      var length = 6;
      for (var i = 0; i < length; i++) {
        // Generate a random index within the valid range (0 to max)
        var randomIndex = Math.floor(Math.random() * (max + 1));
        // Append the character at the randomly chosen index to the code
        code += number.charAt(randomIndex);
      }
      return code;
    }


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

    //verify code
    $('#verify_code').on('click', () => {
      const code = $('#code').val();
      const number = $('#contact').val();
      const mydata = `code=${code}&number=${number}`;

      $.ajax({
        type: 'POST',
        url: 'controller/verify_code.php',
        data: mydata,
        success: function(response) {
          if (response > 0) {
            $('#codes').hide();
            $('#change_pass').attr('hidden', false)
          } else {
            toastr.error('Code is invalid')
          }
        }
      })

    });

    //password restriction
    $('#re-password').on('input', () => {
      var pass = $('#password').val();
      var re_pass = $('#re-password').val();
      if (re_pass != pass) {
        $('#error').attr('hidden', false);
        $('#success').attr('hidden', true);
      } else {
        $('#error').attr('hidden', true);
        $('#success').attr('hidden', false);
      }
    })

    //update password
    function update_password() {
      var code = $('#code').val();
      var pass = $('#password').val();
      var re_pass = $('#re-password').val();

      var mydata = `code=${code}&password=${pass}`;

      $.ajax({
        type: 'POST',
        url: 'controller/reset_password.php',
        data: mydata,
        success: function(response) {
          if (response > 0) {
            toastr.success('Password successfully changed.');
            setTimeout(() => {
              window.location = 'login.php'
            }, 2000)
          }
        }
      })

    }

    // contact number restriction
    $('#contact').on('input', function(e) {
      var len = $(this).val();
      if (len.length > 11) {
        toastr.error('The contact number has a limit of 11 digits!')
        len = len.slice(0, 11);
        $(this).val(len)
      }
    });
  </script>
</body>

</html>