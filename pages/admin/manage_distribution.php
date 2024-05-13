<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Distributions | CIACO</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="/" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../../css/styles.css" rel="stylesheet" />
    <!-- select2 plugins -->
    <link rel="stylesheet" href="../../assets/select2/css/select2.min.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.9.2/semantic.min.css"> -->
    <link rel="stylesheet" href="../../assets/toastr/toastr.min.css">
    <!-- font-awesome -->
    <link href="../../assets/font-awesome/css/all.css" rel="stylesheet">
</head>

<body>
    <div class="d-flex" id="wrapper">
        <?php include '../../partials/admin_sidebar.php'; ?>
        <!-- Page content-->
        <div class="container-fluid">
            <div class="container card p-2" style="width:80%; margin:auto; ">
                <nav class="navbar navbar-expand-sm bg-body-tertiary">
                    <div class="container-fluid">
                        <div class="navbar-nav">
                            <form name="form" method="post" enctype="multipart/form-data">
                                <input type="file" name="" id="upload" hidden onchange="previewImage()">
                            </form>
                            <a class="nav-link active picture" aria-current="page" href="#"><i class="fa-regular fa-image"></i> Photo |</a>
                        </div>
                    </div>
                </nav>
                <div>
                    <center> <img src="" name="" id="imagePreview" class="img-thumbnail img-fluid rounded" style="height:400px;" hidden /></center>
                </div>
                <div class="form-floating">
                    <textarea class="form-control" placeholder="Leave a comment here" id="description" style="height: 100px"></textarea>
                    <label for="description">Write a text ...</label>
                </div>
                <div class="footer">
                    <div class="member">
                        <div class="row">
                            <div class="col-12 m-0">
                                <div class="btn btn-success btn-sm m-0 mt-2 container fs-5" id="update" hidden><i class="fa-solid fa-pen-to-square"></i> UPDATE</div>
                            </div>
                        </div>
                    </div>
                </div><br>
                <hr>
                <div class="table-responsive">
                    <table class="table table-responsive Tabledata">
                        <thead>
                            <tr>
                                <th>DATE POSTED</th>
                                <th>DESCRIPTION</th>
                                <th>TYPE</th>
                                <th>STATUS</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $distribute->user_id = $_SESSION['id'];
                            $res = $distribute->distributions();
                            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                                $date_posted = date('Y-M-d', strtotime($row['date_added']));
                                $descriptions = $row['descriptions'];
                                $status = ($row['status'] != 1) ? 'Inactive' : 'Active';
                                $type = ($row['type'] != 1) ? 'Announcement' : 'Distribution';
                                echo '
                                <tr>
                                    <td>' . $date_posted . '</td>
                                    <td class="text-break">' . $descriptions . '</td>
                                    <td>' . $type . '</td>
                                    <td>' . $status . '</td>
                                    <td>
                                        <div class="btn btn-sm btn-success edit" value="' . $row['id'] . '"><i class="fa-solid fa-file-pen"></i></div>
                                        <div class="btn btn-sm btn-danger remove" value="' . $row['id'] . '"><i class="fa-solid fa-trash"></i></div>
                                    </td>
                                </tr>
                                ';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- dont remove this is content-page-wrapper -->
        <?php include '../../partials/footer.php'; ?>
        <script src="js/manage_distribution.js"></script>
</body>

</html>