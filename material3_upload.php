<?php
    if($_FILES["material3_fileInput"]["name"] != '')
    {
        $test = explode('.', $_FILES["material3_fileInput"]["name"]);
        $ext = end($test);
        $name = reset($test) . '.' . $ext;
        $location = './assets/attachments/' . $name;

        // Check if the file with the same name already exists
        $counter = 1;
        while (file_exists($location)) {
            // If the file exists, append a counter to the name
            $name = reset($test) . '_' . $counter . '.' . $ext;
            $location = './assets/attachments/' . $name;
            $counter++;
        }

        move_uploaded_file($_FILES["material3_fileInput"]["tmp_name"], $location);

        echo $location;
    }
?>