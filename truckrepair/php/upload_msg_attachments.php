<?php
include "../../phpconfig/allfunction.php";

$folder_path = '../../assets/remarks/' . str_replace('.', '_', $_POST['jobid']);

if (!empty($_FILES['attachments']['name'])) {

    // Error handling for folder creation
    if (!file_exists($folder_path)) {
        if (!mkdir($folder_path, 0777, true)) {
            // Display an error message and exit if folder creation fails
            die("Error creating folder: $folder_path");
        }
    }

    $uploaded_file_paths = array();

    foreach ($_FILES['attachments']['name'] as $key => $file_name) {
        $file_name = str_replace("'", "", $file_name);
        $file_path = $folder_path . '/' . $file_name;

        // Error handling for file move operation
        if (move_uploaded_file($_FILES['attachments']['tmp_name'][$key], $file_path)) {
            $uploaded_file_paths[] = $file_path;
        }
    }

    echo implode(', ', $uploaded_file_paths);
}

?>
