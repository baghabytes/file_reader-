<?php
require_once('vendor/autoload.php');

use setasign\Fpdi\Fpdi;

// Create new FPDI instance
$pdf = new Fpdi();

// Set PDF file to be modified (replace with your file path)
$file = 'C:/Users/Dell/Desktop/testing/User.pdf';

// Get the total number of pages in the PDF
$pageCount = $pdf->setSourceFile($file);

// Loop through each page
for ($page = 1; $page <= $pageCount; $page++) {
    // Add a new page
    $pdf->AddPage();

    // Set font and size
    $pdf->SetFont('Helvetica', '', 12);

    // Import the page from the source PDF
    $templateId = $pdf->importPage($page);
    $pdf->useTemplate($templateId);

    // Set the content
    $pdf->SetTextColor(0, 0, 0); // black color
    $pdf->SetXY(10, 10); // position of text
    $pdf->Cell(0, 10, 'This is added text.', 0, 1);
}

// Output the modified PDF
$pdf->Output('modified_file.pdf', 'D');
?>
