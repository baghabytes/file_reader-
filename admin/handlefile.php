<?php


require_once '../config.php';

function readAndStoreFile($file, $parent,$conn)
{
        

    
$fileName = basename($file);
$fileContent = file_get_contents($file);
$fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);


if ($_POST['level']=="level1"){
    $sql = "INSERT INTO file (filename, parent, contents, file_extension,cat_id) VALUES (?, ?, ?, ?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $fileName, $parent, $fileContent, $fileExtension,$_POST['id']);
    $stmt->execute();
}
elseif ($_POST['level']=="level2"){
    $sql = "INSERT INTO file (filename, parent, contents, file_extension,sub_id) VALUES (?, ?, ?, ?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $fileName, $parent, $fileContent, $fileExtension,$_POST['id']);
    $stmt->execute();
}
elseif ($_POST['level']=="level3"){
    $sql = "INSERT INTO file (filename, parent, contents, file_extension,child_id) VALUES (?, ?, ?, ?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $fileName, $parent, $fileContent, $fileExtension,$_POST['id']);
    $stmt->execute();
}


   
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['folder'])) {
        $archiveName = $_FILES['folder']['name'];
        $archiveTempName = $_FILES['folder']['tmp_name'];

        // check if the uploaded file is a zip or tar archive
        $archiveExt = pathinfo($archiveName, PATHINFO_EXTENSION);
        if (!in_array($archiveExt, ['zip', 'tar', 'gz'])) {
            echo "Invalid archive file. Only zip and tar files are allowed.";
            header("location:index.php");

            exit();
        }
        else{
            $extractFolder = 'uploads/'.$archiveName .'_' .uniqid() . '_' . time();
            $extractPath = __DIR__ . DIRECTORY_SEPARATOR . $extractFolder;
            if ($archiveExt === 'zip') {
                $zip = new ZipArchive;
                if ($zip->open($archiveTempName) === TRUE) {
                    $zip->extractTo($extractPath);
                    $zip->close();
                } else {
                    echo "Failed to extract the zip archive.";
                    exit();
                }
            } else {
                $phar = new PharData($archiveTempName);
                $phar->extractTo($extractPath);
            }

            readAndStoreFolder($extractPath,$conn);
            echo '<script>alert("Folder Added")</script>';
            header("location:index.php");

            // removeDirectory($extractPath);
    
        }
    }
}

function readAndStoreFolder($folderPath,$conn) {
    $files = scandir($folderPath);
    $folderName = basename($folderPath);

    foreach($files as $file) {
        if ($file == "." || $file == "..") {
            continue;
        }

        $fullPath = $folderPath . DIRECTORY_SEPARATOR . $file;

        if (is_dir($fullPath)) {
            // recursively call the function for subfolders
            readAndStoreFolder($fullPath,$conn);
        } else {
            readAndStoreFile($fullPath,$folderName,$conn);
        }
    }
}

// function to remove a directory and its contents
function removeDirectory($dir) {
    if (is_dir($dir)) {
        $objects = scandir($dir);
        foreach ($objects as $object) {
            if ($object != "." && $object != "..") {
                $path = $dir . DIRECTORY_SEPARATOR . $object;
                if (is_dir($path)) {
                    removeDirectory($path);
                } else {
                    unlink($path);
                }
            }
        }
        rmdir($dir);
    }
}

?>
