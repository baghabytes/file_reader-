<?php
// Function to replace occurrences of a keyword in a string
function replaceKeyword($string, $keyword, $replacement) {
    return str_ireplace($keyword, $replacement, $string);
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

    // Create a temporary directory to extract the zip file
    $tempDir = 'temp_dir_' . uniqid();
    mkdir($tempDir);
    chmod($tempDir, 0777);

    $zip = new ZipArchive();
    $zip->open($zipFile);
    $zip->extractTo($tempDir);
    $zip->close();

    // Iterate through the extracted files and replace the keyword
    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($tempDir));
    foreach ($iterator as $file) {
        if ($file->isDir()) {
            // Replace folder name if it contains the keyword
            $folderName = $file->getPathname();
            $newFolderName = replaceKeyword($folderName, $keyword, $folderNameReplacement);
            if ($newFolderName !== $folderName) {
                rename($folderName, $newFolderName);
                chmod($newFolderName, 0777);
            }
        } else {
            // Replace file name if it contains the keyword
            $fileName = $file->getPathname();
            $newFileName = replaceKeyword($fileName, $keyword, $fileNameReplacement);
            if ($newFileName !== $fileName) {
                rename($fileName, $newFileName);
                chmod($newFileName, 0777);
                $fileName = $newFileName;
            }

            // Replace file content if it contains the keyword
            $fileContent = file_get_contents($fileName);
            $newFileContent = replaceKeyword($fileContent, $keyword, $fileContentReplacement);
            if ($newFileContent !== $fileContent) {
                file_put_contents($fileName, $newFileContent);
            }
        }
    }

    $zipFile = 'modified_files.zip';
    $zip = new ZipArchive();

    if ($zip->open($zipFile, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($tempDir));
        foreach ($files as $name => $file) {
            if (!$file->isDir()) {
                $filePath = $file->getPathname();
                $relativePath = substr($filePath, strlen($tempDir) + 1);
                $zip->addFile($filePath, $relativePath);
            }
        }
        $zip->close();
    } else {
        echo "Failed to create the zip file.";
        exit;
    }

    header('Content-Type: application/zip');
    header('Content-Disposition: attachment; filename="' . $zipFile . '"');
    header('Content-Length: ' . filesize($zipFile));

    readfile($zipFile);

    unlink($zipFile);

    // Clean up the temporary directory
    deleteDirectory($tempDir);
}

// Function to recursively delete a directory
function deleteDirectory($dir) {
    if (!file_exists($dir)) {
        return true;
    }
    if (!is_dir($dir)) {
        return unlink($dir);
    }
    foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..') {
            continue;
        }
        if (!deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
            return false;
        }
    }
    return rmdir($dir);
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
        <input type="text" name="folder_name_replacement" required><br><br>
        <label>File Content Replacement:</label>
        <input type="text" name="file_content_replacement" required><br><br>
        <label>File Name Replacement:</label>
        <input type="text" name="file_name_replacement" required><br><br>
        <button type="submit">Submit</button>
    </form>
</body>
</html>
