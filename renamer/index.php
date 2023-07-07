<?php

function searchKeywordInZip($zipFilePath, $keyword) {
    $zip = new ZipArchive();
    if ($zip->open($zipFilePath) === true) {
        $highlightedFolders = [];
        $highlightedFiles = [];
        
        for ($i = 0; $i < $zip->numFiles; $i++) {
            $entryName = $zip->getNameIndex($i);
            
            // Check if the folder name contains the keyword
            if (stripos($entryName, $keyword) !== false && substr($entryName, -1) === '/') {
                $highlightedFolders[] = $entryName;
            }
            
            // Check if the file name contains the keyword
            if (stripos($entryName, $keyword) !== false && substr($entryName, -1) !== '/') {
                $highlightedFiles[] = $entryName;
            }
            
            // Check if the file contains the keyword
            $fileContent = $zip->getFromIndex($i);
            if (stripos($fileContent, $keyword) !== false) {
                $highlightedFiles[] = $entryName;
            }
        }
        
        $zip->close();
        
        return [
            'highlightedFolders' => $highlightedFolders,
            'highlightedFiles' => $highlightedFiles
        ];
    } else {
        return null; // Failed to open the zip file
    }
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["zipFile"])) {

    if (isset($_FILES['zipFile'])) {
        $archiveName = $_FILES['zipFile']['name'];
        $keyword = $_POST["keyword"];


        $archiveTempName = $_FILES['zipFile']['tmp_name'];

        // check if the uploaded file is a zip or tar archive
        $archiveExt = pathinfo($archiveName, PATHINFO_EXTENSION);
        if (!in_array($archiveExt, ['zip', 'tar', 'gz'])) {
            echo "Invalid archive file. Only zip and tar files are allowed.";
            header("location:index.php");

            exit();
        }

        $result = searchKeywordInZip($archiveTempName, $keyword);

        if ($result !== null) {
            echo "Highlighted folders:\n";
            foreach ($result['highlightedFolders'] as $folder) {
                echo $folder . "\n";
                echo '\n';
            }

     

            echo "\nHighlighted files:\n";
            foreach ($result['highlightedFiles'] as $file) {
                echo $file . "\n";
            }
   
        } else {
            echo "Failed to open the zip file.";
        }


}
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Search Keyword in Zip File</title>
</head>
<body>
    <h1>Search Keyword in Zip File</h1>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">
        <label for="zipFile">Zip File:</label>
        <input type="file" id="zipFile" name="zipFile" required><br><br>
        
        <label for="keyword">Keyword:</label>
        <input type="text" id="keyword" name="keyword" required><br><br>
        
        <input type="submit" value="Search">
    </form>
</body>
</html>
