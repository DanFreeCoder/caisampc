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
$pdf->setAuthor('Nicola Asuni');
$pdf->setTitle('TCPDF Example 057');
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
$pdf->setFont('helvetica', '', 5);

// add a page
$pdf->AddPage();

// Retrieve data from report.php
$query = "SELECT * FROM loan_details ORDER BY id ASC";
$stmt = $db->prepare($query);
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

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

<h2>Report Table</h2>

<table>
    <tr>
        <th>Name</th>
        <th>Gender</th>
        <th>Occupation</th>
        <th>Residential Address</th>
        <th>Amount Applied</th>
        <th>Kind of Loan</th>
        <th>Date Applied</th>
        <th>Status</th>
    </tr>';

foreach ($data as $row) {
    $html .= '
    <tr>
        <td>' . $row['name'] . '</td>
        <td>' . $row['gender'] . '</td>
        <td>' . $row['occupation'] . '</td>
        <td>' . $row['address'] . '</td>
        <td>' . $row['amount_applied'] . '</td>
        <td>' . $row['kind'] . '</td>
        <td>' . $row['date_applied'] . '</td>
        <td>' . $row['status'] . '</td>
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
$pdf->Output('loan_applicant.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>
