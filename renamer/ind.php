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
            // Replace file name if it contains the keyword and the filter is enabled
            if ($filterFileName) {
                $fileName = $file->getPathname();
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
                $fileName = $file->getPathname();
                $fileContent = file_get_contents($fileName);
                $newFileContent = replaceKeyword($fileContent, $keyword, $fileContentReplacement);
                if ($newFileContent !== $fileContent) {
                    file_put_contents($fileName, $newFileContent);
                    chmod($fileName, 0777); // Set permissions for the modified file
                }
            }
        }
    }
    echo '<a href="download.php?fn212='.$tempDir.'">Download File</a>';

    
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
