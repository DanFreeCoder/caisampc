<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Profile | CIACO</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="/" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../../css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="../../assets/toastr/toastr.min.css">
    <!-- font-awesome -->
    <link href="../../assets/font-awesome/css/all.css" rel="stylesheet">
</head>

<body>
    <div class="d-flex" id="wrapper">
        <?php include '../../partials/admin_sidebar.php'; ?>
        <!-- Page content-->
        <div class="container-fluid">
            <?php
            // get the details of logined user
            $users->id = $_SESSION['id'];
            $res = $users->get_all_userby_id();
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                $id = $row['id'];
                $firstname = $row['firstname'];
                $middle_name = $row['middle_name'];
                $lastname = $row['lastname'];
                // $email = $row['email'];
                $username = $row['username'];
                $contact_no = $row['contact_no'];
                $image = $row['image'];
            }
            ?>
            <div class="container mt-5">
                <div class="row">
                    <div class="col-6">
                        <div class="banner" style="width: 100%;">
                            <h1>Personal Information</h1>
                            <div class="profile mb-3 mt-3">
                                <img class="rounded-circle" src="../<?php echo $image; ?>" alt="No image profile" style="width:100px; height:100px;">
                            </div>
                        </div>
                    </div>
                    <div class="col-6 d-flex justify-content-end" style="height:50px;">
                        <div class="btn btn-success rounded-pill" id="edit_info" style="font-size:large;">Edit Information</div>
                        <div class="btn btn-success rounded-pill" id="update_info" style="font-size:large;" hidden>Update</div>
                    </div>
                </div>
                <div class="card p-3">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="firstname" class="form-label">First Name</label>
                                <input type="text" class="form-control inputs" name="id" id="upd-id" value="<?php echo $id ?>" hidden>
                                <input type="text" class="form-control inputs" name="firstname" id="upd-firstname" value="<?php echo $firstname ?>" disabled>
                            </div>
                            <div class="mb-3">
                                <div for="" class="form-label">Middle Name</div>
                                <input type="text" class="form-control inputs" name="middle_name" id="upd-middle_name" value="<?php echo $middle_name ?>" disabled>
                            </div>
                            <div class="mb-3">
                                <div for="" class="form-label">Last Name</div>
                                <input type="text" class="form-control inputs" name="lastname" id="upd-lastname" value="<?php echo $lastname ?>" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <div for="" class="form-label">Username</div>
                                <input type="text" class="form-control inputs" name="username" id="upd-username" value="<?php echo $username ?>" disabled>
                            </div>
                            <div class="mb-3">
                                <div for="upd-password" class="form-label">Password</div>
                                <input type="password" class="form-control inputs" name="password" id="upd-password" placeholder="Leave it blank if you won't change the password." disabled>
                            </div>
                            <div class="mb-3">
                                <div for="" class="form-label">Contact Number</div>
                                <input type="text" class="form-control inputs" name="contact_num" id="upd-contact_num" value="<?php echo $contact_no ?>" disabled>
                            </div>
                            <label class="form-label" for="upload">Update Image Profile</label>
                            <form name="form" method="post" enctype="multipart/form-data">
                                <input type="file" class="form-control inputs" id="upload" disabled />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- dont remove this is content-page-wrapper -->
    </div>
    <?php include '../../partials/footer.php'; ?>
    <script src="js/profile.js"></script>
</body>

</html>