<?php
echo 'YOUR DOWNLOAD WILL START SOON';

echo '<a href="index5.php">Return </a>';

$x = $_GET['fn212'];

function addFileToZip($zip, $filePath, $relativePath) {
    if (is_file($filePath)) {
        $zip->addFile($filePath, $relativePath);
    } elseif (is_dir($filePath)) {
        $files = scandir($filePath);
        foreach ($files as $file) {
            if ($file !== '.' && $file !== '..') {
                addFileToZip($zip, $filePath . '/' . $file, $relativePath . '/' . $file);
            }
        }
    }
}

function zipFolder($folderPath) {
    $zip = new ZipArchive();
    $zipFileName = 'folder.zip'; // Name for the ZIP file
    if ($zip->open($zipFileName, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
        addFileToZip($zip, $folderPath, basename($folderPath));
        $zip->close();

        // Set appropriate headers for the download
        header('Content-Type: application/zip');
        header('Content-disposition: attachment; filename=' . $zipFileName);
        header('Content-Length: ' . filesize($zipFileName));
        ob_clean();
        flush();
        readfile($zipFileName);

        // Delete the temporary ZIP file
        unlink($zipFileName);

        // Exit the script after sending the file
        exit();
    }
}

zipFolder($x);
?>
