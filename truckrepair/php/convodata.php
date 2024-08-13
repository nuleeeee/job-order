<?php
date_default_timezone_set("Asia/Manila");
include "../../phpconfig/allfunction.php";
$cashieridz = $_SESSION['login_user'];
$brlogin = $_SESSION['branch'];

$jobid = $_POST['jobid'];

$display = "<div class='conversation-container'>";

$qry = "SELECT 	vtr.joborderidxx, nameidz, CONCAT(vnn.firstname, ' ', vnn.lastname) as reqname, repairtype, typename, overview as workdetails,
				vtr.tsz as daterequested, CONCAT(UPPER(SUBSTRING(vnn.firstname, 1, 1)), UPPER(SUBSTRING(vnn.lastname, 1, 1))) as req_initials,
				GROUP_CONCAT(attachments SEPARATOR ', ') as attachments
		FROM vlookup_mcore.vtruckrepair vtr
		LEFT OUTER JOIN vlookup_mcore.vrepaircanvass canvass ON canvass.joborderidz = vtr.joborderidxx
		LEFT OUTER JOIN vlookup_mcore.vnamenew vnn ON vnn.nameidxx = vtr.nameidz
		LEFT OUTER JOIN vlookup_mcore.joborder_type typ ON typ.idxx = vtr.repairtype
		WHERE vtr.joborderidxx = '$jobid'
		GROUP BY vtr.joborderidxx";

$resqry = mysqli_query($db, $qry);
while ($rowqry = mysqli_fetch_assoc($resqry)) {
	$title = $rowqry["typename"];
	$attachment = $rowqry["attachments"];

	$datecreated = date_create($rowqry["daterequested"]);
    $curdate = date_create('now');
    $agingInterval = date_diff($datecreated, $curdate);
    $aging_days = $agingInterval->format('%a');
    if ($aging_days == 0) {
        $hoursAgo = $agingInterval->format('%h');
        if ($hoursAgo == 0) {
            $minutesAgo = $agingInterval->format('%i');
            $aging = $minutesAgo <= 1 ? 'Just now' : $minutesAgo . ' minutes ago';
        } else {
            $aging = $hoursAgo == 1 ? '1 hour ago' : $hoursAgo . ' hours ago';
        }
    } elseif ($aging_days == 1) {
        $aging = '1 day ago';
    } else {
        $aging = $aging_days . ' days ago';
    }

    // Concern Details
    $profileImage = "<div class='userimage-div mt-2'>
    					<span class='userimage fw-bold text-light text-center text-bg-secondary'>".$rowqry["req_initials"]."</span>
    				</div>";
    $senderInfo = "<div class='sender-info'>
                      	<div class='sender-name'>" . $rowqry["reqname"] . "</div>
                      	<div class='message-content'>
	                  		<span class='span-msg-branch'>" . $rowqry["workdetails"] . "</span>
	                  	</div>
                   </div>";
    $timeInfo = "<div class='message-time text-center'>" . $aging . "</div>";
    $display .= "<div class='message-container'>
                    $profileImage
                    $senderInfo
                    $timeInfo
                 </div>";

	$sql = "SELECT 	convoidxx, joborderidzz,
				   	nameidz, nameidz_message, nameidz_date, CONCAT(vname_branch.firstname, ' ', vname_branch.lastname) as User_Branch,
               	   	vc.cashieridz, cashieridz_message, cashieridz_date, CONCAT(vname_ho.firstname, ' ', vname_ho.lastname) as User_HO,
               	   	convo_attachments,
               	   	CONCAT(
				        UPPER(SUBSTRING(vname_branch.firstname, 1, 1)),
				        UPPER(SUBSTRING(vname_branch.lastname, 1, 1))
				    ) as branch_initials,
				    CONCAT(
				        UPPER(SUBSTRING(vname_ho.firstname, 1, 1)),
				        UPPER(SUBSTRING(vname_ho.lastname, 1, 1))
				    ) as ho_initials
	        FROM vlookup_mcore.joborder_convo vc
	        LEFT OUTER JOIN vlookup_mcore.vnamenew vname_branch ON vname_branch.nameidxx = vc.nameidz
	        LEFT OUTER JOIN vlookup_mcore.vnamenew vname_ho ON vname_ho.nameidxx = vc.cashieridz
	        WHERE joborderidzz = '$jobid'";

	$result = mysqli_query($db, $sql);

	while ($row = mysqli_fetch_assoc($result)) {
	    $branch_username = $row['User_Branch'];
	    $branchMessage = $row['nameidz_message'];
	    $ho_username = $row['User_HO'];
	    $hoMessage = $row['cashieridz_message'];

	    // Display head office message if not empty
	    if (!empty($hoMessage)) {
	    	$hodate = date_create($row["cashieridz_date"]);
		    $hocur = date_create('now');
		    $hoaging = date_diff($hodate, $hocur);
		    $hodays = $hoaging->format('%a');
		    if ($hodays == 0) {
		        $hohoursago = $hoaging->format('%h');
		        if ($hohoursago == 0) {
		            $hominsago = $hoaging->format('%i');
		            $aging_ho = $hominsago <= 1 ? 'Just now' : $hominsago . ' minutes ago';
		        } else {
		            $aging_ho = $hohoursago == 1 ? '1 hour ago' : $hohoursago . ' hours ago';
		        }
		    } elseif ($hodays == 1) {
		        $aging_ho = '1 day ago';
		    } else {
		        $aging_ho = $hodays . ' days ago';
		    }

		    $file_paths = explode(', ', $row["convo_attachments"]);

	        $profileImage = "<div class='userimage-div mt-2'>
	        					<span class='userimage fw-bold text-light text-center mbd-bg-color'>".$row["ho_initials"]."</span>
	        				</div>";
		    $senderInfo = "<div class='sender-info'>
		                      	<div class='sender-name'>" . $ho_username . "</div>
		                      	<div class='message-content'>
		                      		<span class='span-msg-ho'>$hoMessage</span>
		                      	</div>";
		        if ($row["convo_attachments"] != "") {
			        foreach ($file_paths as $file_path) {
					    $file_path = str_replace("../../", "", $file_path);
					    $senderInfo .= "<a href='$file_path' target='_blank'>
					                        <img src='$file_path' class='btn mt-2' height='100' width='100'>
					                    </a>";
					}
				} else {
					$senderInfo .= "";
				}
            $senderInfo .= "</div>";
		    $timeInfo = "<div class='message-time text-center text-nowrap'>" . $aging_ho . "</div>";
		    $display .= "<div class='message-container'>
		                    $profileImage
		                    $senderInfo
		                    $timeInfo
		                 </div>";
	    }

	    // Display branch message if not empty
	    if (!empty($branchMessage)) {
	    	$brdate = date_create($row["nameidz_date"]);
		    $brcur = date_create('now');
		    $braging = date_diff($brdate, $brcur);
		    $brdays = $braging->format('%a');
		    if ($brdays == 0) {
		        $brhoursago = $braging->format('%h');
		        if ($brhoursago == 0) {
		            $brminsago = $braging->format('%i');
		            $aging_br = $brminsago <= 1 ? 'Just now' : $brminsago . ' minutes ago';
		        } else {
		            $aging_br = $brhoursago == 1 ? '1 hour ago' : $brhoursago . ' hours ago';
		        }
		    } elseif ($brdays == 1) {
		        $aging_br = '1 day ago';
		    } else {
		        $aging_br = $brdays . ' days ago';
		    }

		    $file_paths = explode(', ', $row["convo_attachments"]);

	        $profileImage = "<div class='userimage-div mt-2'>
	        					<span class='userimage fw-bold text-light text-center text-bg-secondary'>".$row["branch_initials"]."</span>
	        				</div>";
		    $senderInfo = "<div class='sender-info'>
		                      	<div class='sender-name'>" . $branch_username . "</div>
		                      	<div class='message-content'>
		                      		<span class='span-msg-branch'>$branchMessage</span>
		                      	</div>";
		        if ($row["convo_attachments"] != "") {
			        foreach ($file_paths as $file_path) {
					    $file_path = str_replace("../../", "", $file_path);
					    $senderInfo .= "<a href='$file_path' target='_blank'>
					                        <img src='$file_path' class='btn mt-2' height='100' width='100'>
					                    </a>";
					}
				} else {
					$senderInfo .= "";
				}
            $senderInfo .= "</div>";
		    $timeInfo = "<div class='message-time text-center text-nowrap'>" . $aging_br . "</div>";
		    $display .= "<div class='message-container'>
		                    $profileImage
		                    $senderInfo
		                    $timeInfo
		                 </div>";
	    }
	}

}

$folder_path = "../../assets/attachments/" . str_replace('.', '_', $jobid);
if (!empty($attachment)) {
	$file_paths = explode(', ', $attachment);
	$imageUrls = array();
	$imgs = "";

	foreach ($file_paths as $index => $file_path) {
        $file = "." . $file_path;
        if ($file_path != '.' && $file_path != '..') {
            $imageUrls[$file_path] = $file_path;
        }
    }

    foreach ($imageUrls as $filename => $image_url) {
        $url = str_replace("../../", "", $image_url);
        $imgs .= "<a href='" . $url . "' target='_blank'>";
        $imgs .= "<img src='" . $url . "' class='d-block w-100 btn' alt='' title='Click to enlarge'>";
        $imgs .= "</a>";
    }

    $imgs .= "<div class='d-flex justify-content-center pointer mt-4 mb-4 ho_part' title='Click to add another image.'>";
    $imgs .= "<input id='up_attachments' type='image' src='assets/icons/add-new-img.png' height='80' onclick='addAttachments($jobid)'>";
    $imgs .= "</div>";
} else if (is_dir($folder_path)) {
	$files = scandir($folder_path);
	$imageUrls = array();
	$imgs = "";

	foreach ($files as $index => $file) {
	    if ($file != '.' && $file != '..') {
	        $imageUrls[$file] = $folder_path . "/" . $file;
	    }
	}

	foreach ($imageUrls as $filename => $image_url) {
        $url = str_replace("../../", "", $image_url);
        $imgs .= "<a href='" . $url . "' target='_blank'>";
        $imgs .= "<img src='" . $url . "' class='d-block w-100 btn' alt='' title='Click to enlarge'>";
        $imgs .= "</a>";
	}

    $imgs .= "<div class='d-flex justify-content-center pointer mt-4 mb-4 ho_part' title='Click to add another image.'>";
    $imgs .= "<input id='up_attachments' type='image' src='assets/icons/add-new-img.png' height='80' onclick='addAttachments($jobid)'>";
    $imgs .= "</div>";

} else {
	$imgs = "";
    $imgs .= "<p class='text-secondary text-center'>No images attached</p>";
    $imgs .= "<div class='d-flex justify-content-center pointer ho_part' title='Click to upload images.'>";
    $imgs .= "<input id='up_attachments' type='image' src='assets/icons/add-image.png' height='250' onclick='addAttachments($jobid)'>";
    $imgs .= "</div>";
}

$display .= "</div>
<script>
$('#JobOrderID').html('$jobid');
$('#JobOrderCategory').html('$title');
$('#ConvoAttachment').html(\"$imgs\");
</script>";

echo $display;

?>