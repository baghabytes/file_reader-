<?php

// Set the maximum execution time and memory limit to handle large files
set_time_limit(0);
ini_set('memory_limit', '-1');

// Function to recursively set permissions for files and directories
function setPermissions($path) {
    if (is_dir($path)) {
        chmod($path, 0755);
        $items = glob(rtrim($path, '/') . '/*');
        foreach ($items as $item) {
            setPermissions($item);
        }
    } else {
        chmod($path, 0644);
    }
}

function searchAndReplaceKeywordInZip($zipFilePath, $keyword, $replacement) {
    $tempZipFilePath = tempnam(sys_get_temp_dir(), 'modified_zip');
    $zip = new ZipArchive();

    if ($zip->open($zipFilePath) === true) {
        // Create a new temporary zip file
        $tempZip = new ZipArchive();
        $tempZip->open($tempZipFilePath, ZipArchive::CREATE);

        // Iterate through each entry in the original zip
        for ($i = 0; $i < $zip->numFiles; $i++) {
            $entryName = $zip->getNameIndex($i);

            // Read the content of the entry
            $fileContent = $zip->getFromIndex($i);

            // Replace the keyword with the replacement text
            $modifiedEntryName = str_replace($keyword, $replacement, $entryName);
            $modifiedFileContent = str_replace($keyword, $replacement, $fileContent);

            // Add the modified entry to the new temporary zip file
            $tempZip->addFromString($modifiedEntryName, $modifiedFileContent);
        }

        // Close the original zip and the temporary zip files
        $zip->close();
        $tempZip->close();

        // Set permissions for the extracted files and directories
        setPermissions(dirname($tempZipFilePath));

        return $tempZipFilePath;
    } else {
        return null; // Failed to open the zip file
    }
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["zipFile"])) {

    if (isset($_FILES['zipFile'])) {
        $archiveName = $_FILES['zipFile']['name'];
        $keyword = $_POST["keyword"];
        $replacement = $_POST["replacement"];

        $archiveTempName = $_FILES['zipFile']['tmp_name'];

        // check if the uploaded file is a zip archive
        $archiveExt = pathinfo($archiveName, PATHINFO_EXTENSION);
        if ($archiveExt !== 'zip') {
            echo "Invalid archive file. Only zip files are allowed.";
            exit();
        }

        $modifiedZipFilePath = searchAndReplaceKeywordInZip($archiveTempName, $keyword, $replacement);

        if ($modifiedZipFilePath !== null) {
            // Provide the modified zip file for download
            header('Content-Type: application/zip');
            header('Content-Disposition: attachment; filename="modified_zip.zip"');
            header('Content-Length: ' . filesize($modifiedZipFilePath));
            readfile($modifiedZipFilePath);

            // Delete the temporary modified zip file
            unlink($modifiedZipFilePath);

            exit();
        } else {
            echo "Failed to open the zip file.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Search and Replace Keyword in Zip File</title>
</head>
<body>
    <h1>Search and Replace Keyword in Zip File</h1>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">
        <label for="zipFile">Zip File:</label>
        <input type="file" id="zipFile" name="zipFile" required><br><br>
        
        <label for="keyword">Keyword:</label>
        <input type="text" id="keyword" name="keyword" required><br><br>

        <label for="replacement">Replacement Text:</label>
        <input type="text" id="replacement" name="replacement" required><br><br>
        
        <input type="submit" value="Search and Replace">
    </form>
</body>
</html>
