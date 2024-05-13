<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard | CIACO</title>
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
    <div class="d-flex" id="wrapper">
        <?php include '../../partials/admin_sidebar.php'; ?>
        <!-- Page content-->
        <div class="container-fluid">
            <div class="main-card">
                <div style="width: 90%; margin:auto;">
                    <div class="row mt-3">
                        <div class="col-md-6 p-3">
                            <div class="card shadow p-4 border border-secondary-subtle">
                                <div class="row m-2">
                                    <div class="col-10">
                                        <h5 class="text-primary">Cooperative Members</h5>
                                    </div>
                                    <div class="col-2">
                                        <h1 class="text-success"><i class="fas fa-users"></i></h1>
                                    </div>
                                    <h5 class="text-primary font-weight-bold">
                                        <?php
                                        // get the total of approved cooperative member
                                        $get = $users->count_member();
                                        while ($row = $get->fetch(PDO::FETCH_ASSOC)) {
                                            echo $row['count'];
                                        }
                                        ?>
                                    </h5>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 p-3">
                            <div class="card shadow p-4 border border-secondary-subtle">
                                <div class="row m-2">
                                    <div class="col-10">
                                        <h5 class="text-primary">Total Approved Loan Applicants</h5>
                                    </div>
                                    <div class="col-2">
                                        <h1 class="text-success"><i class="fas fa-users"></i></h1>
                                    </div>
                                    <h5 class="text-primary font-weight-bold">
                                        <?php
                                        // get the total of approved loan applicant
                                        $get = $loan->count_loan();
                                        while ($row = $get->fetch(PDO::FETCH_ASSOC)) {
                                            echo $row['count'];
                                        }
                                        ?>
                                    </h5>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="chart card shadow p-4" style="height: 300px;width: 100%">
                                <div id="chartContainer" style="width: 100%; height:230px;">
                                    <?php
                                    // get the total of coop member per month
                                    $data = $users->count_user_by_month();
                                    $monthCounts = [];

                                    while ($row2 = $data->fetch(PDO::FETCH_ASSOC)) {
                                        $month = $row2['month'];
                                        $count = $row2['count'];
                                        $monthCounts[$month] = $count;
                                    }

                                    $monthNames = [
                                        1 => "January",
                                        2 => "February",
                                        3 => "March",
                                        4 => "April",
                                        5 => "May",
                                        6 => "June",
                                        7 => "July",
                                        8 => "August",
                                        9 => "September",
                                        10 => "October",
                                        11 => "November",
                                        12 => "December",
                                    ];

                                    $dataPoints = [];

                                    foreach ($monthNames as $monthNumber => $monthName) {
                                        $count = isset($monthCounts[$monthNumber]) ? $monthCounts[$monthNumber] : 0;
                                        $dataPoints[] = ["y" => $count, "label" => $monthName];
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="chart card shadow p-4" style="height: 300px;">
                                <div id="pieChart" style="width: 100%; height:230px;">
                                    <?php
                                    // get the total of active member which status = 1
                                    $res = $users->count_active();
                                    while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                                        $active = $row['active'];
                                    }
                                    // get the total of inactive member which status = 0
                                    $res2 = $users->count_inactive();
                                    while ($row2 = $res2->fetch(PDO::FETCH_ASSOC)) {
                                        $inactive = $row2['inactive'];
                                    }
                                    $dataPoints2 = array(
                                        array("label" => "Active", "symbol" => "Active", "y" => $active),
                                        array("label" => "Deactivated", "symbol" => "Deactivated", "y" => $inactive)
                                    );

                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- dont remove this is content-page-wrapper -->


    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <?php include '../../partials/footer.php' ?>

    <script>
        window.onload = function() {

            var chart = new CanvasJS.Chart("chartContainer", {
                theme: "light2",
                animationEnabled: true,
                title: {
                    text: "Cooperative Members"
                },
                axisY: {
                    title: "Number of member per month"
                },
                data: [{
                    type: "spline",
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();
        }
    </script>
     <script>
        var chart2 = new CanvasJS.Chart("pieChart", {
            theme: "light3",
            animationEnabled: true,
            title: {
                text: "Active and Deactivated Members"
            },
            data: [{
                type: "doughnut",
                indexLabel: "{symbol} - {y}",
                showInLegend: true,
                legendText: "{label} : {y}",
                dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart2.render();
    </script>
</body>

</html>