<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Home | CIACO</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="/" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../../css/styles.css" rel="stylesheet" />
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.9.2/semantic.min.css"> -->
    <link rel="stylesheet" href="../../assets/toastr/toastr.min.css">
    <!-- font-awesome -->
    <link href="../../assets/font-awesome/css/all.css" rel="stylesheet">
    <style>
        .container {
            width: 80%;
            margin: auto;
        }
    </style>
</head>

<body>
    <!-- pendingModal -->
    <?php include '../pending_prompt.php'; ?>
    <div class="d-flex" id="wrapper">
        <?php include '../../partials/staff_sidebar.php'; ?>
        <!-- Page content-->
        <div class="container-fluid">
            <div class="container-fluid clearfix">
                <br>
                <br>
                <div class="messages mt-3">
                    <?php
                    $distribute->user_to = $_SESSION['id'];
                    $res = $distribute->distributed_byid();
                    while ($row = $res->fetch(PDO::FETCH_ASSOC)) {

                        $distribute->user_id = $row['user_id'];
                        $res2 = $distribute->distributer_name();
                        while ($row2 = $res2->fetch(PDO::FETCH_ASSOC)) {
                            $distributer_name = $row2['fullname'];
                        }
                        $type = ($row['type'] != 2) ? 'Announcement' : $distributer_name;
                        $image = ($row['image'] != '') ? '<img src="../' . $row['image'] . '" width="500" height="500" class="img-thumbnail img-fluid rounded mx-auto d-block" />' : '';
                        echo '
                        <div class="card col-12 position-relative mb-2 shadow-lg ">
                        <div id="autor" class="fix-top card-header mb-3"><i class="fa-solid fa-pencil"></i> ' . $type . '</div>
                        <div class="content m-3 mt-0">
                            <div class="description">
                                <p class="text-wrap" style="text-indent: 50px;">' . $row['descriptions'] . '</p>
                            </div>
                            ' . $image . '
                        </div>
                        <div class="card-footer clearfix"><span class="float-end">Date Posted: ' . date('M-d-Y', strtotime($row['date_added'])) . '</span></div>
                    </div>
                        ';
                    }
                    ?>
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
        <script src="js/loan.js"></script>
</body>

</html>