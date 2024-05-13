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
            <a href="manage_distribution.php" class="btn btn-success mt-5"><i class="fa-solid fa-bars-progress"></i> Manage</a>
            <div class="container-fluid card p-2 mt-2">
                <nav class="navbar navbar-expand-sm bg-body-tertiary">
                    <div class="container-fluid">
                        <div class="navbar-nav">
                            <form name="form" method="post" enctype="multipart/form-data">
                                <input type="file" name="" id="upload" hidden onchange="previewImage()">
                            </form>
                            <a class="nav-link active picture" aria-current="page" href="#"><i class="fa-regular fa-image"></i> Photo |</a>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="annoucement" role="switch">
                            <label class="form-check-label" for="annoucement"><b>As Announcement</b></label>
                        </div>
                    </div>
                </nav>
                <div>
                    <center> <img src="" name="" id="imagePreview" class="img-thumbnail img-fluid rounded" style="height:400px;" /></center>
                </div>
                <div class="form-floating">
                    <textarea class="form-control" placeholder="Leave a comment here" id="description" style="height: 100px"></textarea>
                    <label for="description">Write a text ...</label>
                </div>
                <div class="footer">
                    <div class="member">
                        <div class="row">
                            <div class="col-12 m-0">
                                <select class="select2 to" multiple="multiple" style="width: 100%;" aria-label="Default select example">
                                    <option value="0" disabled>Members</option>
                                    <option value="All">All</option>
                                    <?php
                                    $users->role = 1;
                                    $res = $users->get_allValid_user();
                                    while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                                        echo '<option value="' . $row['id'] . '">' . $row['firstname'] . ' ' . $row['lastname'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-12 m-0">
                                <button class="btn btn-success btn-sm m-0 mt-2 container fs-5" id="post" style="color:white;" disabled><i class="fa-solid fa-pen-to-square"></i> Post</button>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <br>
                <hr>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="announcement-tab" data-bs-toggle="tab" data-bs-target="#announcement" type="button" role="tab" aria-controls="announcement" aria-selected="true">Announcements</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="distribution-tab" data-bs-toggle="tab" data-bs-target="#distribution" type="button" role="tab" aria-controls="distribution" aria-selected="false">Distributions</button>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active" id="announcement" role="tabpanel" aria-labelledby="announcement-tab" tabindex="0">
                        <div class="announcements-panel mt-3">
                            <?php
                            $distribute->user_id = $_SESSION['id'];
                            $distribute->type = 1;
                            $res = $distribute->distributer_byid();
                            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {

                                $user_to_values = [];

                                // Fetch all user_to values for the current $row
                                $distribute->dist_id = $row['id'];
                                $res2 = $distribute->get_id();
                                while ($row2 = $res2->fetch(PDO::FETCH_ASSOC)) {
                                    $user_to_values[] = $row2['user_to'];
                                }
                                $unique_user_to_values = array_unique($user_to_values);
                                $implode =  implode(', ', $unique_user_to_values);
                                $explode = explode(', ', $implode);
                                $names = '';

                                foreach ($explode as $ids) {
                                    $id = $ids;
                                    $users->id = $id;
                                    $res3 = $users->get_all_userby_id();
                                    while ($row3 = $res3->fetch(PDO::FETCH_ASSOC)) {
                                        $names .= '<br>' . $row3['firstname'] . ' ' . $row3['lastname'];
                                    }
                                }


                                $icons = (count($explode) > 1) ? '<i class="fa-solid fa-users"></i>' : '<i class="fa-solid fa-user"></i>';

                                $image = ($row['image'] != null) ? '<img src="../' . $row['image'] . '" width="500" height="500" class="img-thumbnail img-fluid rounded d-block" >' : '';
                                echo '
                               <div class="card col-12 position-relative mb-2 shadow-lg ">
                               <div id="autor" class="fix-top card-header mb-3">
                               <button type="button" class="btn btn-light" data-toggle="tooltip" data-html="true" data-placement="top" title="' . htmlspecialchars($names) . '">
                               ' . $icons . '
                               </button>
                               </div>
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
                    <div class="tab-pane" id="distribution" role="tabpanel" aria-labelledby="distribution-tab" tabindex="0">
                        <div class="messages mt-3">
                            <?php
                            $distribute->user_id = $_SESSION['id'];
                            $distribute->type = 2;
                            $res = $distribute->distributer_byid();
                            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {

                                $user_to_values = [];

                                // Fetch all user_to values for the current $row
                                $distribute->dist_id = $row['id'];
                                $res2 = $distribute->get_id();
                                while ($row2 = $res2->fetch(PDO::FETCH_ASSOC)) {
                                    $user_to_values[] = $row2['user_to'];
                                }
                                $unique_user_to_values = array_unique($user_to_values);
                                $implode =  implode(', ', $unique_user_to_values);
                                $explode = explode(', ', $implode);
                                $names = '';

                                foreach ($explode as $ids) {
                                    $id = $ids;
                                    $users->id = $id;
                                    $res3 = $users->get_all_userby_id();
                                    while ($row3 = $res3->fetch(PDO::FETCH_ASSOC)) {
                                        $names .= '<br>' . $row3['firstname'] . ' ' . $row3['lastname'];
                                    }
                                }


                                $icons = (count($explode) > 1) ? '<i class="fa-solid fa-users"></i>' : '<i class="fa-solid fa-user"></i>';

                                $image = ($row['image'] != null) ? '<img src="../' . $row['image'] . '" width="500" height="500" class="img-thumbnail img-fluid rounded d-block" >' : '';
                                echo '
                                <div class="card col-12 position-relative mb-2 shadow-lg ">
                                <div id="autor" class="fix-top card-header mb-3">
                                <button type="button" class="btn btn-light" data-toggle="tooltip" data-html="true" data-placement="top" title="' . htmlspecialchars($names) . '">
                                ' . $icons . '
                                </button>

                                </div>
                                <div class="content m-3 mt-0">
                                    <div class="description">
                                        <p class="text-wrap" style="text-indent: 50px;">' . $row['descriptions'] . '</p>
                                    </div>
                                    <center>' . $image . '</center>
                                </div>
                                <div class="card-footer clearfix"><span class="float-end">Date Posted: ' . date('M-d-Y', strtotime($row['date_added'])) . '</span></div>
                            </div>
                        ';
                            }

                            ?>
                        </div>
                    </div>
                </div>

            </div>
        </div> <!-- dont remove this is content-page-wrapper -->
        <?php include '../../partials/footer.php'; ?>
        <script src="js/distribution.js"></script>
</body>

</html>