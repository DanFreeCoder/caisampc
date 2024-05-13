<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Users | CIACO</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="/" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../../css/styles.css" rel="stylesheet" />
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.9.2/semantic.min.css"> -->
    <link rel="stylesheet" href="../../assets/toastr/toastr.min.css">
    <!-- sweetAlert -->
    <link rel="stylesheet" href="../../assets/sweetAlert/sweetalert2.min.css">
    <!-- font-awesome -->
    <link href="../../assets/font-awesome/css/all.css" rel="stylesheet">
</head>

<body>
    <div class="d-flex" id="wrapper">
        <?php include '../../partials/admin_sidebar.php'; ?>
        <!-- Page content-->
        <div class="container-fluid">
            <div class="container mt-5">
                <div class="btn btn-success mb-3 text-light" id="add_user">Add User</div>
                <div class="card p-3">
                    <div class="table-responsive">
                        <table class="table table-responsive table-striped table-hover TableData">
                            <thead>
                                <tr>
                                    <th>First Name</th>
                                    <th>Middle Name</th>
                                    <th>Last Name</th>
                                    <th>Username</th>
                                    <th>Date Join</th>
                                    <th>Contact No.</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // get all the users who register
                                $users->role = 0;
                                $user = $users->get_all_user();
                                while ($row = $user->fetch(PDO::FETCH_ASSOC)) {
                                    $createDate = new DateTime($row['added_at']);
                                    $date = $createDate->format('Y-m-d');
                                    $role = ($row['role'] != 2) ? 'Admin' : 'Client'; //return admin if role is not = 2 else return client
                                    echo '
                                    <tr>
                                        <td>' . $row['firstname'] . '</td>
                                        <td>' . $row['middle_name'] . '</td>
                                        <td>' . $row['lastname'] . '</td>
                                        <td>' . $row['username'] . '</td>
                                        <td>' . $date . '</td>
                                        <td>' . $row['contact_no'] . '</td>
                                        <td>' . $role . '</td>
                                        <td><div class="btn btn-success btn-sm edit" value="' . $row['id'] . '">Edit</div> | <div class="btn btn-danger btn-sm remove" value="' . $row['id'] . '">Remove</div></td>
                                    </tr>
                                ';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Add User Modal -->
            <div class="modal fade" id="new_userModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">New User</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form">
                                <div class="form-floating mb-3">
                                    <input type="text" name="" id="firstname" class="form-control" placeholder="First Name">
                                    <label for="firstname">First Name</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" name="" id="middle_name" class="form-control" placeholder="Enter Middle Name">
                                    <label for="middle_name">Middle Name</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" name="" id="lastname" class="form-control" placeholder="Last Name">
                                    <label for="lastname">Last Name</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" name="" id="username" class="form-control" placeholder="Username">
                                    <label for="username">Username</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="password" name="" id="password" class="form-control" placeholder="Password">
                                    <label for="password">Password</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" name="" id="cnum" class="form-control" placeholder="Contact Number">
                                    <label for="cnum">Contact Number</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <select name="" id="role" class="select form-control">
                                        <option value="2">Client</option>
                                        <option value="1">Admin</option>
                                    </select>
                                    <label for="role">Role</label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="btnAdd">Add User</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit user Modal -->
            <div class="modal fade" id="edit_userModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit User</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" id="edit_body">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="btnUpdate">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- dont remove this is content-page-wrapper -->

        <?php include '../../partials/footer.php'; ?>
        <script src="js/user.js"></script>
</body>

</html>