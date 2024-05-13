<?php
include '../../config/connection.php';
include '../../objects/clsPrint.php';
$database = new Connection();
$db = $database->connect();
$print = new Printer($db);

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('Your Name');
$pdf->setTitle('Distribution Report');
$pdf->setSubject('Distribution Data');
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

// set font
$pdf->setFont('helvetica', '', 5);

// add a page
$pdf->AddPage();

// Retrieve data from distribution table
$queryDistribution = "SELECT * FROM distribution ORDER BY user_id ASC";
$stmtDistribution = $db->prepare($queryDistribution);
$stmtDistribution->execute();
$dataDistribution = $stmtDistribution->fetchAll(PDO::FETCH_ASSOC);

$html = '
<html>
<head>
<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
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

<h2>Distribution Report Table</h2>

<table>
    <tr>
        <th>Name</th>
        <th>Image</th>
        <th>Descriptions</th>
        <th>Date Added</th>
    </tr>';

foreach ($dataDistribution as $rowDistribution) {
    $html .= '
    <tr>
        <td>' . $rowDistribution['user_id'] . '</td>
        <td>' . $rowDistribution['image'] . '</td>
        <td>' . $rowDistribution['descriptions'] . '</td>
        <td>' . $rowDistribution['date_added'] . '</td>
    </tr>';
}

$html .= '
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
?>
