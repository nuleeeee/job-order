<?php
include "../../phpconfig/allfunction.php";

$cashieridz = $_SESSION['login_user'];

$jobid = $_POST['jobid'];

$folder_path = '../../assets/attachments/' . str_replace('.', '_', $jobid);

// Error handling for folder creation
if (!file_exists($folder_path)) {
    if (!mkdir($folder_path, 0777, true)) {
        // Display an error message and exit if folder creation fails
        die("Error creating folder: $folder_path");
    }
}

if (!empty($_FILES['newattachment']['name'])) {
    foreach ($_FILES['newattachment']['name'] as $key => $file_name) {
        $file_name = str_replace("'", "", $file_name);
        $file_path = $folder_path . '/' . $file_name;

        // Error handling for file move operation
        if (move_uploaded_file($_FILES['newattachment']['tmp_name'][$key], $file_path)) {
            echo "Success.";
        } else {
            // Display an error message if the file move fails
            echo "Error moving file to $file_path";
        }
    }
} else {
    echo "No attachments selected.";
}

?>
