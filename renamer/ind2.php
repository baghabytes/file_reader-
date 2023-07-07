<?php

require_once 'vendor/autoload.php';

// use PhpOffice\PhpSpreadsheet\IOFactory;

require('vendor/a/src/PhpWord/TemplateProcessor.php');
// use setasign\Fpdi\Fpdi;

function replaceKeyword($string, $keyword, $replacement) {
    return str_ireplace($keyword, $replacement, $string);
}

// Function to replace occurrences of a keyword in a PDF file
function replaceKeywordInPDF($pdfFile, $keyword, $replacement) {
    // Create new PDF instance
    $pdf = new FPDI();

    // Set the source PDF file
    $pdf->setSourceFile($pdfFile);

    // Import the first page of the PDF
    $templateId = $pdf->importPage(1);

    // Add a new page with the imported template
    $pdf->AddPage();
    $pdf->useTemplate($templateId);

    // Replace the keyword in the imported template
    $textToReplace = '/' . $keyword . '/';
    $pdf->SetFont('Arial', '', 12);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetXY(50, 50);
    $pdf->Write(0, $replacement);

    // Output the modified PDF
    $outputFile = 'modified_pdf.pdf';
    $pdf->Output($outputFile, 'F');

    return $outputFile;
}

// Function to replace occurrences of a keyword in a Word document
function replaceKeywordInWord($wordFile, $keyword, $replacement) {
    $templateProcessor = new TemplateProcessor($wordFile);
    $templateProcessor->setValue($keyword, $replacement);

    // Save the modified Word document
    $outputFile = 'modified_word.docx';
    $templateProcessor->saveAs($outputFile);

    return $outputFile;
}

// Function to replace occurrences of a keyword in an Excel document
function replaceKeywordInExcel($excelFile, $keyword, $replacement) {
    // Load the Excel file
    $spreadsheet = IOFactory::load($excelFile);

    // Get the active sheet
    $sheet = $spreadsheet->getActiveSheet();

    // Search and replace the keyword in each cell
    $cellIterator = $sheet->getCellIterator();
    $cellIterator->setIterateOnlyExistingCells(false);
    foreach ($cellIterator as $cell) {
        $cellValue = $cell->getValue();
        if (strpos($cellValue, $keyword) !== false) {
            $cellValue = str_replace($keyword, $replacement, $cellValue);
            $cell->setValue($cellValue);
        }
    }

    // Save the modified Excel file
    $outputFile = 'modified_excel.xlsx';
    $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
    $writer->save($outputFile);

    return $outputFile;
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the uploaded zip file
    $zipFile = $_FILES['zip_file']['tmp_name'];

    // Get the keyword, folder name replacement, file content replacement, and file name replacement
    $keyword = $_POST['keyword'];
    $folderNameReplacement = $_POST['folder_name_replacement'];
    $fileContentReplacement = $_POST['file_content_replacement'];
    $fileNameReplacement = $_POST['file_name_replacement'];

    // Get the filter options
    $filterFileName = isset($_POST['filter_file_name']);
    $filterFileContent = isset($_POST['filter_file_content']);
    $filterFolder = isset($_POST['filter_folder']);

    // Create a temporary directory to extract the zip file
    $tempDir = 'temp_dir_' . uniqid();
    mkdir($tempDir);
    chmod($tempDir, 0777);

    // Extract the zip file
    $zip = new ZipArchive();
    $zip->open($zipFile);
    $zip->extractTo($tempDir);
    $zip->close();

    // Iterate through the extracted files and apply the selected filters
    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($tempDir));
    foreach ($iterator as $file) {
        if ($file->isDir()) {
            // Replace folder name if it contains the keyword and the filter is enabled
            if ($filterFolder) {
                $folderName = $file->getPathname();
                $newFolderName = replaceKeyword($folderName, $keyword, $folderNameReplacement);
                if ($newFolderName !== $folderName) {
                    if (rename($folderName, $newFolderName)) {
                        if (file_exists($newFolderName)) {
                            chmod($newFolderName, 0777); // Set permissions for the new folder
                        } else {
                            // echo "Failed to set permissions for folder: $newFolderName";
                        }
                    } else {
                        // echo "Failed to rename folder: $folderName";
                        continue;
                    }
                }
            }
        } else {
            $fileName = $file->getPathname();
            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            // Replace file name if it contains the keyword and the filter is enabled
            if ($filterFileName) {
                $newFileName = replaceKeyword($fileName, $keyword, $fileNameReplacement);
                if ($newFileName !== $fileName) {
                    if (file_exists($fileName)) {
                        chmod($fileName, 0777); // Set permissions for the original file
                        if (rename($fileName, $newFileName)) {
                            if (file_exists($newFileName)) {
                                chmod($newFileName, 0777); // Set permissions for the new file
                                $fileName = $newFileName;
                            } else {
                                // echo "Failed to set permissions for file: $newFileName";
                                continue;
                            }
                        } else {
                            // echo "Failed to rename file: $fileName";
                            continue;
                        }
                    } else {
                        // echo "File not found: $fileName";
                        continue;
                    }
                }
            }

            // Replace file content if it contains the keyword and the filter is enabled
            if ($filterFileContent) {
                $fileContent = file_get_contents($fileName);
                $newFileContent = replaceKeyword($fileContent, $keyword, $fileContentReplacement);

                switch ($fileExtension) {
                    case 'pdf':
                        $fileName = replaceKeywordInPDF($fileName, $keyword, $fileContentReplacement);
                        break;
                    case 'docx':
                        $fileName = replaceKeywordInWord($fileName, $keyword, $fileContentReplacement);
                        break;
                    case 'xlsx':
                        $fileName = replaceKeywordInExcel($fileName, $keyword, $fileContentReplacement);
                        break;
                    default:
                        file_put_contents($fileName, $newFileContent);
                        chmod($fileName, 0777); // Set permissions for the modified file
                        break;
                }
            }
        }
    }

    // Create a new zip file with the modified files
    $outputZipFile = 'modified_files.zip';
    $zipArchive = new ZipArchive();
    $zipArchive->open($outputZipFile, ZipArchive::CREATE | ZipArchive::OVERWRITE);

    $files = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($tempDir),
        RecursiveIteratorIterator::LEAVES_ONLY
    );

    foreach ($files as $name => $file) {
        if (!$file->isDir()) {
            $filePath = $file->getRealPath();
            $relativePath = substr($filePath, strlen($tempDir) + 1);

            $zipArchive->addFile($filePath, $relativePath);
        }
    }

    $zipArchive->close();

    // Remove the temporary directory
    // removeDirectory($tempDir);

    // Prompt the user to download the modified zip file
    header("Content-type: application/zip");
    header("Content-Disposition: attachment; filename=$outputZipFile");
    header("Content-length: " . filesize($outputZipFile));
    header("Pragma: no-cache");
    header("Expires: 0");
    readfile("$outputZipFile");
    exit;
}

// Helper function to remove a directory and its contents
function removeDirectory($dir) {
    if (is_dir($dir)) {
        $objects = scandir($dir);
        foreach ($objects as $object) {
            if ($object != '.' && $object != '..') {
                if (is_dir($dir . '/' . $object)) {
                    removeDirectory($dir . '/' . $object);
                } else {
                    unlink($dir . '/' . $object);
                }
            }
        }
        rmdir($dir);
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Zip File Modification</title>
</head>
<body>
    <form method="post" enctype="multipart/form-data">
        <label>Zip File:</label>
        <input type="file" name="zip_file" required><br><br>
        <label>Keyword:</label>
        <input type="text" name="keyword" required><br><br>
        <label>Folder Name Replacement:</label>
        <input type="text" name="folder_name_replacement" ><br><br>
        <label>File Content Replacement:</label>
        <input type="text" name="file_content_replacement" ><br><br>
        <label>File Name Replacement:</label>
        <input type="text" name="file_name_replacement" ><br><br>
        <label>Filter:</label>
        <input type="checkbox" name="filter_folder">Folder
        <input type="checkbox" name="filter_file_content">File Content
        <input type="checkbox" name="filter_file_name">File Name<br><br>
        <button type="submit">Submit</button>
    </form>
</body>
</html>
