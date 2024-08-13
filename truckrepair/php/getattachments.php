<?php

include '../../phpconfig/allfunction.php';

$indicators = "";
$carouselItems = "";

if (isset($_POST['var_jobid'])) {

    $jobid = $_POST['var_jobid'];
    $nameid = $_POST['var_nameid'];

    $folder_path = "../../assets/attachments/" . $jobid;

    if (file_exists($folder_path)) {

        $files = scandir($folder_path);

        $imageUrls = array();

        foreach ($files as $index => $file) {
            if ($file != '.' && $file != '..') {
                $imageUrls[$file] = $folder_path . "/" . $file; // Store image URL in the array
            }
        }

        foreach ($imageUrls as $filename => $image_url) {
                $target = array_search($filename, array_keys($imageUrls)); // Change target for each file
                $slide = $target + 1; // Change slide for each file

                $url = str_replace("../.", "", $image_url);

                $indicators .= "<button type='button' data-bs-target='#carouselExampleIndicators' data-bs-slide-to='".$target."'";
                if ($target == 0) {
                    $indicators .= " class='active' aria-current='true'";
                }
                $indicators .= " aria-label='Slide ".$slide."'></button>";

                $carouselItems .= "<div class='carousel-item";
                if ($target == 0) {
                    $carouselItems .= " active";
                }
                $carouselItems .= "'>
                                     <img src='".$url."' class='d-block w-100' alt=''>
                                   </div>";
        }

        // Add the carousel controls (prev and next buttons)
        $carouselControls = "<button class='carousel-control-prev' type='button' data-bs-target='#carouselExampleIndicators' data-bs-slide='prev'>
                                <span class='carousel-control-prev-icon' aria-hidden='true'></span>
                                <span class='visually-hidden'>Previous</span>
                            </button>
                            <button class='carousel-control-next' type='button' data-bs-target='#carouselExampleIndicators' data-bs-slide='next'>
                                <span class='carousel-control-next-icon' aria-hidden='true'></span>
                                <span class='visually-hidden'>Next</span>
                            </button>";

        $carouselIndicators = "<div class='carousel-indicators'>".$indicators."</div>";
        $carouselInner = "<div class='carousel-inner'>".$carouselItems."</div>";

        $display = $carouselIndicators.$carouselInner.$carouselControls;

        echo $display;

    } else {

        $sql = "SELECT cv.joborderidz, attachments, cashieridz, 
                       (@target:=@target + 1) - 1 as target, 
                       (@slide:=@slide + 1) as slide
                FROM vlookup_mcore.vrepaircanvass cv
                CROSS JOIN
                (
                    SELECT @target := 0
                ) as r
                CROSS JOIN
                (
                    SELECT @slide := 0
                ) as s
                WHERE cv.joborderidz = '$jobid' AND cashieridz = '$nameid' 
                AND attachments IS NOT NULL AND attachments <> '' ";

        $result = mysqli_query($db, $sql);

        while($row = $result->fetch_array()) {

            $indicators .= "<button type='button' data-bs-target='#carouselExampleIndicators' data-bs-slide-to='".$row["target"]."'";
            if ($row["target"] == 0) {
                $indicators .= " class='active' aria-current='true'";
            }
            $indicators .= " aria-label='Slide ".$row["slide"]."'></button>";

            $carouselItems .= "<div class='carousel-item";
            if ($row["target"] == 0) {
                $carouselItems .= " active";
            }
            $carouselItems .= "'>
                                 <img src='".$row["attachments"]."' class='d-block w-100'>
                               </div>";
        }

        // Add the carousel controls (prev and next buttons)
        $carouselControls = "<button class='carousel-control-prev' type='button' data-bs-target='#carouselExampleIndicators' data-bs-slide='prev'>
                                <span class='carousel-control-prev-icon' aria-hidden='true'></span>
                                <span class='visually-hidden'>Previous</span>
                            </button>
                            <button class='carousel-control-next' type='button' data-bs-target='#carouselExampleIndicators' data-bs-slide='next'>
                                <span class='carousel-control-next-icon' aria-hidden='true'></span>
                                <span class='visually-hidden'>Next</span>
                            </button>";

        $carouselIndicators = "<div class='carousel-indicators'>".$indicators."</div>";
        $carouselInner = "<div class='carousel-inner'>".$carouselItems."</div>";

        $display = $carouselIndicators.$carouselInner.$carouselControls;

        echo $display; 

    }

}  

?>
