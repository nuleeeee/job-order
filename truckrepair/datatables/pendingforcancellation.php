<?php

include '../../phpconfig/allfunction.php';

$brlogin = $_SESSION["branch"];
$cashieridz = $_SESSION['login_user'];

$display = "<table class='table table-hover text-nowrap' id='pendingcancellation_datatable' style='font-size: 12px;'>
                <thead class='thd_item' style='background-color: #434EA0; color: white;'>
                    <tr>
                        <th style='text-align:center;'>JOB ORDER ID</th>
                        <th style='text-align:center;'>BRANCH</th>
                        <th style='text-align:center;'>TYPE</th>
                        <th style='text-align:center;'>PLATE NO</th>
                        <th style='text-align:center;'>MODEL</th>
                        <th style='text-align:center;'>YEAR</th>
                        <th style='text-align:center;'>BRAND</th>
                        <th style='text-align:center;'>ODO</th>
                        <th style='text-align:center;'>REQUESTED BY</th>
                        <th style='text-align:center;'>ATTACHMENTS</th>
                        <th style='text-align:center;'>REQUESTED DATE</th>
                        <th style='text-align:center;'>LEAD TIME</th>
                        <th style='text-align:center;'>SUPPLIER</th>
                        <th style='text-align:center;'>DETAILS</th>
                        <th style='text-align:center;'>ACTION</th>
                        <th class='d-none'>OVERVIEW</th>
                    </tr>
                </thead>
                <tbody>";

        $sql = "SELECT  joborderidz, tbl_repair.joborderidxx, IFNULL(vbrand, '-') as vbrand, IFNULL(vmodel, '-') as vmodel,
                        IFNULL(vyear, '-') as vyear, IFNULL(vplateno, '-') as vplateno, IFNULL(vodo, '-') as vodo,
                        overview, vname, request_date,
                        SUM(CASE WHEN datacount = 1 AND price != 0 THEN price
                                 WHEN datacount = 2 AND price != 0 THEN price
                                 WHEN datacount = 3 AND price != 0 THEN price
                            ELSE null END) as price, datacount, status,
                        supplier, position, brname, tbl_repair.nameidz, cancelledreason,
                        CASE
                            WHEN approvaldate IS NOT NULL THEN CONCAT(DATEDIFF(approvaldate, DATE(cv.tsz)), ' DAY(S)')
                            WHEN approvaldate IS NULL THEN CONCAT(DATEDIFF(DATE(cancellationrequested), DATE(cv.tsz)), ' DAY(S)')
                        END AS lead_time, attachments,
                        typename as repairtype, convo_status
                FROM vlookup_mcore.vrepaircanvass cv
                LEFT OUTER JOIN
                (
                    SELECT  joborderidxx, nameidz, vbrand, vmodel, vyear, vplateno, vodo, overview,
                            DATE(tsz) as request_date, repairtype, status, cancelledreason
                    FROM vlookup_mcore.vtruckrepair
                    WHERE status = 3
                ) as tbl_repair on tbl_repair.joborderidxx = cv.joborderidz
                LEFT OUTER JOIN
                (
                    SELECT nameidxx, CONCAT(lastname, ', ', firstname) as vname, bridz, positionidz FROM vlookup_mcore.vnamenew
                ) as tbl_vname on tbl_vname.nameidxx = tbl_repair.nameidz
                LEFT OUTER JOIN vlookup_mcore.vbranch tbl_branch on tbl_branch.branchidxx = tbl_vname.bridz
                LEFT OUTER JOIN vlookup_mcore.vemployeeposition showpos ON showpos.positionidxx = tbl_vname.positionidz
                LEFT OUTER JOIN vlookup_mcore.joborder_type JO_Type ON JO_Type.idxx = tbl_repair.repairtype
                LEFT OUTER JOIN
                (
                    SELECT vc.joborderidzz, convo_status FROM vlookup_mcore.joborder_convo vc
                    JOIN (SELECT MAX(convoidxx) AS max_convoidxx, joborderidzz FROM vlookup_mcore.joborder_convo GROUP BY joborderidzz) AS max_convo
                    ON vc.joborderidzz = max_convo.joborderidzz AND vc.convoidxx = max_convo.max_convoidxx
                ) as convo ON convo.joborderidzz = cv.joborderidz
                WHERE approvalstatus = 3 AND tbl_repair.joborderidxx IS NOT NULL AND
                CASE
		            WHEN $cashieridz IN ('38274017') THEN repairtype IN (7,21)
                    WHEN $cashieridz IN ('1480', '759') THEN repairtype IN (1,12,14)
                    WHEN $cashieridz IN ('38275267') THEN repairtype = 2
                    WHEN $cashieridz IN ('38274148') THEN repairtype IN (1,3,4,5,13,17)
                    WHEN $cashieridz IN ('2128', '2808', '38274135') THEN repairtype = 6
                    WHEN $cashieridz IN ('3648', '38274500') THEN repairtype IN (7,18,21)
                    WHEN $cashieridz IN ('3972', '2313', '38275444') THEN repairtype IN (8,9)
                    WHEN $cashieridz IN ('38275794', '406', '38274500') THEN repairtype IN (1,15)
                    WHEN $cashieridz IN ('3942', '38273841', '38275711') THEN repairtype IN (10,11,16,19,20)
                    WHEN $cashieridz IN ('3882') THEN repairtype = 22
                    WHEN $cashieridz IN ('2585', '38275476', '132', '38275377','38275376') THEN repairtype IN (1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23)
                END
                GROUP BY joborderidz
                ORDER BY COALESCE(approvaldate, cv.tsz) DESC";


    $result = mysqli_query($db,$sql);
    $counter = 1;
    while($row = $result->fetch_array())
    {
        $transfer = 'transfer' . $counter;

        $folder_path = "../../assets/attachments/" . $row["joborderidxx"];

        if ($row["convo_status"] == 1) {
            $message_status = "";
        } else {
            $message_status = "d-none";
        }

        $display .= "<tr>
                        <td class='table-light'>
                            <button class='btn btn-sm btn-link position-relative' type='button' title='View Details' onclick=\"viewConvo('".$row["joborderidxx"]."', '2', 'FOR CANCELLATION ORDER');\">
                                " . $row["joborderidxx"] . "
                                <span id='message_status' class='position-absolute top-30 start-95 translate-middle p-2 bg-danger border border-light rounded-circle ".$message_status."'>
                                </span>
                            </button>
                        </td>
                        <td class='table-light'>" . $row["brname"] . "</td>
                        <td class='table-light'>" . $row["repairtype"] . "</td>
                        <td class='table-light'>" . $row["vplateno"] . "</td>
                        <td class='table-light'>" . $row["vmodel"] . "</td>
                        <td class='table-light'>" . $row["vyear"] . "</td>
                        <td class='table-light'>" . $row["vbrand"] . "</td>
                        <td class='table-light'>" . $row["vodo"] . "</td>
                        <td class='table-light'>" . $row["vname"] . "</td>
                        <td class='table-light text-center'>";

                        if ($row["attachments"] == "" && !file_exists($folder_path)) {
                            $display .= "<button type='button' class='btn btn-sm btn-link text-decoration-none' style='font-size:10px; color:gray;'>
                                            NO ATTACHMENTS
                                        </button>";
                        } else {
                            $display .= "<button type='button' class='btn btn-sm btn-link' style='font-size:10px' onclick=\"viewAttachment('".$row["joborderidz"]."', '".$row["nameidz"]."')\">
                                            ATTACHMENTS
                                        </button>";
                        }

            $display .= "</td>
                        <td class='table-light'>" . $row["request_date"] . "</td>
                        <td class='table-light'>" . $row["lead_time"] . "</td>
                        <td class='table-light'>" . $row["supplier"] . "</td>
                        <td class='table-light'>
                            <button class='btn btn-sm btn-outline-secondary' onclick=\"viewReason('".$row["joborderidz"]."', '".$row["nameidz"]."', '".$row["vname"]."', '".$row["brname"]."', '".$row["position"]."', '".$row["cancelledreason"]."')\">
                                View Reason
                            </button>
                        </td>
                        <td class='table-light'>
                            <button type='button' class='btn btn-sm btn-primary' onclick=\"approveRequestedCancellation('".$row["joborderidz"]."', '".$row["nameidz"]."', 'pending_for_cancellation')\">
                                Approve
                            </button>
                            <span style='margin-left:2px; margin-right: 2px;'></span>
                            <button type='button' class='btn btn-sm btn-warning' id=".$transfer." onclick=\"transferJO('".$row["joborderidz"]."', '".$row["nameidz"]."', '".$row["repairtype"]."')\">Transfer</button>
                        </td>
                        <td class='d-none'>" . $row["overview"] . "</td>
                    </tr>";

        $counter = $counter + 1;
    }


$display .= "    </tbody>
            </table>

<script>

$(document).ready(function() {
    var empDataTable = $('#pendingcancellation_datatable').DataTable({
        'order': [],
        aLengthMenu: [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, 'ALL']
        ]
    });
});

</script>";

echo $display;

?>