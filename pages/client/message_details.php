<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Simple Sidebar - Start Bootstrap Template</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="/" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../../css/styles.css" rel="stylesheet" />
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.9.2/semantic.min.css"> -->
    <link rel="stylesheet" href="../../assets/toastr/toastr.min.css">
    <!-- font-awesome -->
    <link href="../../assets/font-awesome/css/all.css" rel="stylesheet">

</head>

<body>
    <!-- pendingModal -->
    <?php include '../pending_prompt.php'; ?>
    <div class="d-flex" id="wrapper">
        <?php include '../../partials/staff_sidebar.php'; ?>
        <!-- Page content-->
        <div class="container-fluid">
            <div class="container">
                <div class="content m-5">
                    <h4><b>Danilo Medallo Jr</b></h4>
                    <br>
                    <div class="message d-flex flex-row-reverse mb-3">
                        <span class="text-light bg-secondary p-2 rounded" style="width:fit-content;">Hello there</span>
                    </div>
                    <div class="message">
                        <span class="text-light bg-primary p-2 rounded" style="width:fit-content;">Hello there</span>
                    </div>
                </div>
            </div>

            <!-- forms -->
            <?php
            if ($_SESSION['status'] == 1) {
                include '../forms.php';
            }
            ?>
        </div> <!-- dont remove this is content-page-wrapper -->
        <?php include '../../partials/footer.php'; ?>
        <script src="js/message.js"></script>
</body>

</html>