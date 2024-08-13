<?php

include '../../phpconfig/allfunction.php';

if (isset($_POST['cid'])) {
    $cid = $_POST['cid'];
    $joid = $_POST['joid'];
    $nameid = $_POST['nameid'];

    $attachment_names = array();

    // Create a new folder based on the $joid
    $folder_path = '../../assets/attachments/' . $joid;
    if (!file_exists($folder_path)) {
        mkdir($folder_path, 0777, true);
    }

    for ($i = 0; $i < count($_FILES['files']['name']); $i++) {
        $file_name = $_FILES['files']['name'][$i];
        $file_tmp = $_FILES['files']['tmp_name'][$i];
        
        if ($file_name != '') {
            // $ext = pathinfo($file_name, PATHINFO_EXTENSION);
            // $name = uniqid('attachment_') . '.' . $ext;
            $location = $folder_path . '/' . $file_name;

            // Check if the file name is already in the attachment names array
            while (in_array($location, $attachment_names)) {
                // If the file name is already in the array, regenerate the name
                // $name = uniqid('attachment_') . '.' . $ext;
                $location = $folder_path . '/' . $file_name;
            }

            move_uploaded_file($file_tmp, $location);
        }
    }

} else {
    echo "Invalid request.";
}

?>