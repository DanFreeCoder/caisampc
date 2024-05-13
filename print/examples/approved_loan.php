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

// ---------------------------------------------------------

// set font
$pdf->setFont('helvetica', '', 9);

// add a page
$pdf->AddPage();

$data = '';

$result = $print->print_approved_loan();
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

  $data .= '
      <tr>
        <td>' . $row['fullname'] . '</td>
        <td>' . $row['occupation'] . '</td>
        <td>' . $row['kind'] . '</td>
        <td>' . $row['amount_applied'] . '</td>
        <td>' . $row['date_needed'] . '</td>
        <td>' . $row['contact'] . '</td>
        <td>' . $row['approve_date'] . '</td>
      </tr>
  ';
}


// create some HTML content
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

<h2>Approved Loan Applicant</h2>

<table>
  <thead>
    <tr>
      <th>Name</th>
      <th>Occupation</th>
      <th>Loan Kind</th>
      <th>Amount</th>
      <th>Date Needed</th>
      <th>Contact Number</th>
      <th>Date Approved</th>
    </tr>
  </thead>
  <tbody>
  ' . $data . '
  </tbody>
</table>

</body>
</html>
';

// output the HTML content
$pdf->writeHTML($html, true, 0, true, 0);

// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('approved_loan.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
