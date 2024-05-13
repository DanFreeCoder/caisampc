<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Message | CIACO</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="/" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../../css/styles.css" rel="stylesheet" />
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.9.2/semantic.min.css"> -->
    <link rel="stylesheet" href="../../assets/toastr/toastr.min.css">
    <!-- font-awesome -->
    <link href="../../assets/font-awesome/css/all.css" rel="stylesheet">
    <link href="../../assets/select2/css/select2.min.css" rel="stylesheet">
    <style>
        textarea {
            resize: none;
        }

        .textarea:hover {
            border: 2px solid #CAD3C8;
            cursor: pointer;
        }

        .to {
            background-color: #00a8ff;
            padding: 3px;
            width: fit-content;
        }

        .from {
            background-color: #dcdde1;
            padding: 3px;
            width: fit-content;
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
            <div class="container mt-5">
                <div class="row">
                    <div class="col-6">
                        <input type="text" id="user_from" value="<?php echo $_SESSION['id']; ?>" hidden>
                        <div class="banner" style="width: 100%;">
                            <h1>Messages</h1>
                        </div>
                        <form class="d-flex" role="search">
                            <input class="form-control me-2" type="text" id="search" placeholder="Search Messages" aria-label="Search">
                        </form>
                    </div>
                    <div class="col-6 d-flex justify-content-end" style="height:50px;">
                        <div class="btn btn-success rounded-pill" id="creatNew" style="font-size:large;"><i class="fa-solid fa-plus"></i> New Message</div>
                    </div>
                </div>
                <br>
                <input type="text" id="reciver_id" value="<?php echo $_SESSION['id']; ?>" hidden />
                <div id="messageList">

                </div>
            </div>
            <!-- End Main -->

            <!-- Modal -->
            <div class="modal fade" id="new_messageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">New Message</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form">
                                <div class="form-group">
                                    <textarea name="" rows="5" class="textarea form-control message" placeholder="Write a message"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="" class="form-label">To:</label>
                                    <select name="" id="user_to" class="select2 form-control" style="width: 100%;">
                                        <option value="0" selected disabled>SEND TO</option>
                                        <?php
                                        $users->role = 2;
                                        $res = $users->get_all_user();
                                        while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                                            echo '
                                                    <option value="' . $row['id'] . '">' . $row['firstname'] . '' . $row['lastname'] . '</option>
                                                    ';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="send">Send</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- view Message modal -->
            <div class="modal" id="convoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="name"></h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" id="messageBody">

                        </div>
                        <div class="modal-footer">
                            <div class="row" style="width: 100%;">
                                <div class="col-10">
                                    <textarea name="msg" id="msg" rows="1" class="form-control"></textarea>
                                </div>
                                <div class="col-2">
                                    <button type="button" class="btn btn-primary" id="send_new_msg" style="width:fit-content;">Reply</button>
                                </div>
                            </div>
                        </div>
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