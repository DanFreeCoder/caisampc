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
            <div class="header mt-5 mb-5">
                <h1>Change Password</h1>
            </div>
        </center>
        <div class="container mt-2">
            <div class="mb-4">
                <input type="password" class="form-control" id="password" style="font-size:x-large;" placeholder="New Password">
            </div>
            <div class="mb-4">
                <input type="password" class="form-control" id="re_pass" style="font-size:x-large;" placeholder="Re-type Password">
            </div>
            <div class="mb-4">
                <input type="text" class="form-control" id="email" style="font-size:x-large;" placeholder="Enter verification code">
            </div>
            <center>
                <div class="btn btn-primary rounded-pill" id="submit">Change Password</div>
            </center>
        </div>

        <?php include 'partials/footer.php'; ?>

        <script>
            $(document).ready(() => {
                $('#submit').on('click', () => {
                    const password = $('#password').val();
                    const re_pass = $('#re_pass').val();

                    if (password != re_pass) {
                        toastr.error('Password is not match.')
                    } else {
                        toastr.success('Match')
                    }
                })
            });
        </script>
</body>

</html>