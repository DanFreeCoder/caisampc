<?php
include '../../config/connection.php';
include '../../objects/clsDistribution.php';
include '../../objects/clsUsers.php';
$database = new Connection();
$db = $database->connect();
$distribute = new Distribute($db);
$users = new Users($db);
// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('Nicola Asuni');
$pdf->setTitle('CIACO');
$pdf->setSubject('TCPDF Tutorial');
$pdf->setKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->setHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' ', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->setHeaderMargin(PDF_MARGIN_HEADER);
$pdf->setFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->setAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// set font
$pdf->setFont('helvetica', '', 8);

// add a page
$pdf->AddPage();

$data = '';

$distribute->from = date('Y-m-d', strtotime($_GET['from2']));
$distribute->to = date('Y-m-d', strtotime($_GET['to2']));
$res3 = $distribute->report_distribution();
$res3 = $distribute->report_distribution();
while ($row3 = $res3->fetch(PDO::FETCH_ASSOC)) {
    $date_distributed = date('M-d-Y', strtotime($row3['date_added']));
    $descriptions = $row3['descriptions'];
    $dis_by = $row3['user_id'];
    $user_to_values = [];

    //get the name of the distributor
    $users->id = $dis_by;
    $res4 = $users->get_all_userby_id();
    while ($row4 = $res4->fetch(PDO::FETCH_ASSOC)) {
        $distribute_by = $row4['firstname'] . ' ' . $row4['lastname'];
    }

    // Fetch all unique user_to values for the current $row
    $distribute->dist_id = $row3['id'];
    $res5 = $distribute->get_id();
    while ($row5 = $res5->fetch(PDO::FETCH_ASSOC)) {
        $user_to_values[] = $row5['user_to'];
    }
    $unique_user_to_values = array_unique($user_to_values);

    $names = [];

    // Fetch names corresponding to unique user_to values
    foreach ($unique_user_to_values as $id) {
        $users->id = $id;
        $res_users = $users->get_all_userby_id();
        while ($row_users = $res_users->fetch(PDO::FETCH_ASSOC)) {
            $names[] = $row_users['firstname'] . ' ' . $row_users['lastname'];
        }
    }
    $name_implode = implode(', ', $names);

    $data .= '
        <tr>
            <td>' . $date_distributed . '</td>
            <td>' . $descriptions . '</td>
            <td>' . $name_implode . '</td>
            <td>' . $distribute_by . '</td>
        </tr>
    ';
}

$html = '
<html>
<head>
<style>
table {
    font-family: arial, sans-serif;
}

td, th {
    border: 1px solid #dddddd;
    text-align: center;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
</style>
</head>
<body>

<h2>Distribution Report</h2>

<table>
   <thead>
        <tr>
            <th>DATE DISTRIBUTED</th>
            <th>DESCRIPTION</th>
            <th>DISTRIBUTED TO</th>
            <th>DISTRIBUTED BY</th>
        </tr>
   </thead>
    <tbody>
    ' . $data . '
    </tbody>
</table>

</body>
</html>';

// output the HTML content
$pdf->writeHTML($html, true, 0, true, 0);

// reset pointer to the last page
$pdf->lastPage();

// Close and output PDF document
$pdf->Output('distribution_report.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
