<?php

include "../../phpconfig/allfunction.php";

$cashieridz = $_SESSION['login_user'];

$status_report = $_POST['status_report'];

$display = "<table class='table table-hover table-bordered border text-nowrap' id='tbl_history' style='font-size: 14px; table-layout: fixed; width: 100%;'>
                <thead class='thd'>
                    <tr>
                        <th class='text-center'>Date</th>
                        <th class='text-center'>Branch</th>
                        <th class='text-center'>Type</th>
                        <th class='text-center'>Plate Number</th>
                        <th class='text-center'>Cost</th>
                        <th class='text-center'>Job Order ID</th>
                        <th class='text-center'>Status</th>
                        <th class='text-center'>Scope of Work</th>
                        <th class='text-center'>Service</th>
                        <th class='text-center'>Replace Part</th>
                        <th class='text-center'>Actions</th>
                        <th class='text-center'>Mark</th>
                    </tr>
                </thead>
                <tbody>";

    if (in_array($cashieridz, ['2585', '38275377', '1480', '38275444'])) {
        $sql = "SELECT joborderidxx, vtr.nameidz, vmodel, vplateno, overview, (vtr.tsz) as datereq, brname, approvalstatus,
                       CASE
                            WHEN approvalstatus = 1 THEN amount
                       END as cost,
                       service, replacepart, accomplish_status, COALESCE(accomplish_status, approvalstatus) as status
                FROM vlookup_mcore.vtruckrepair vtr
                LEFT OUTER JOIN
                (
                    SELECT joborderidz, approvalstatus, SUM(qty*price) as amount, datacount
                    FROM vlookup_mcore.vrepaircanvass
                    GROUP BY joborderidz,datacount
                ) AS canvass ON canvass.joborderidz = vtr.joborderidxx
                LEFT OUTER JOIN vlookup_mcore.vnamenew vname ON vname.nameidxx = vtr.nameidz
                LEFT OUTER JOIN vlookup_mcore.vbranch vbranch ON vbranch.branchidxx = vname.bridz
                LEFT OUTER JOIN vlookup_mcore.vtruckrepairaccomplished accomplished ON accomplished.jo_id = vtr.joborderidxx
                WHERE repairtype = 1 AND
                CASE
                    WHEN '$status_report' = 0 THEN COALESCE(accomplish_status, approvalstatus) = 0
                    WHEN '$status_report' = 1 THEN COALESCE(accomplish_status, approvalstatus) = 1
                    WHEN '$status_report' = 2 THEN COALESCE(accomplish_status, approvalstatus) = 2
                    WHEN '$status_report' = 3 THEN COALESCE(accomplish_status, approvalstatus) = 3
                    WHEN '$status_report' = 99 THEN COALESCE(accomplish_status, approvalstatus) IN (0,1,2,3)
                END
                GROUP BY joborderidxx";
    } else {
        $sql = "SELECT joborderidxx, vtr.nameidz, vmodel, vplateno, overview, (vtr.tsz) as datereq, brname, approvalstatus,
                       CASE
                            WHEN approvalstatus = 1 THEN amount
                       END as cost,
                       service, replacepart, accomplish_status, COALESCE(accomplish_status, approvalstatus) as status
                FROM vlookup_mcore.vtruckrepair vtr
                LEFT OUTER JOIN
                (
                    SELECT joborderidz, approvalstatus, SUM(qty*price) as amount, datacount
                    FROM vlookup_mcore.vrepaircanvass
                    GROUP BY joborderidz,datacount
                ) AS canvass ON canvass.joborderidz = vtr.joborderidxx
                LEFT OUTER JOIN vlookup_mcore.vnamenew vname ON vname.nameidxx = vtr.nameidz
                LEFT OUTER JOIN vlookup_mcore.vbranch vbranch ON vbranch.branchidxx = vname.bridz
                LEFT OUTER JOIN vlookup_mcore.vtruckrepairaccomplished accomplished ON accomplished.jo_id = vtr.joborderidxx
                WHERE repairtype = 1 AND nameidz = '$cashieridz' AND
                CASE
                    WHEN '$status_report' = 0 THEN COALESCE(accomplish_status, approvalstatus) = 0
                    WHEN '$status_report' = 1 THEN COALESCE(accomplish_status, approvalstatus) = 1
                    WHEN '$status_report' = 2 THEN COALESCE(accomplish_status, approvalstatus) = 2
                    WHEN '$status_report' = 3 THEN COALESCE(accomplish_status, approvalstatus) = 3
                    WHEN '$status_report' = 99 THEN COALESCE(accomplish_status, approvalstatus) IN (0,1,2,3)
                END
                GROUP BY joborderidxx";
    }

    $result = mysqli_query($db, $sql);
    $counter = 1;
    $repairstatus = "";
    while($row = $result->fetch_array())
    {

        $service = 'service' . $counter;
        $replacepart = 'replacepart' . $counter;

        if ($row["status"] == 0) {
            $repairstatus = "<span class='text-danger'>For Approval</span>";
        } else if ($row["status"] == 1) {
            $repairstatus = "<span class='text-primary'>Pending Repair</span>";
        } else if ($row["status"] == 2) {
            $repairstatus = "<span class='text-secondary'>Cancelled Job Order</span>";
        } else if ($row["status"] == 3) {
            $repairstatus = "<span class='text-success'>Accomplished</span>";
        }

        $display .= "<tr>
                        <td class='table-light border align-text-top'>" . $row["datereq"] .  "</td>
                        <td class='table-light border align-text-top'>" . $row["brname"] .  "</td>
                        <td class='table-light border align-text-top'>" . $row["vmodel"] .  "</td>
                        <td class='table-light border align-text-top'>" . $row["vplateno"] .  "</td>
                        <td class='table-light border align-text-top'>" . number_format($row["cost"],2) .  "</td>
                        <td class='table-light border align-text-top'>" . $row["joborderidxx"] .  "</td>
                        <td class='table-light border align-text-top'>" . $repairstatus . "</td>
                        <td class='table-light border align-text-top text-wrap'>" . $row["overview"] .  "</td>";

                        if (!empty($row["service"])) {
                            $display .= "<td class='table-light border align-text-top text-wrap'>";
                            $display .= "<div style='width: 250px;'>" . $row["service"] . " </div>";
                            $display .= "</td>";
                        } else {
                            $display .= "<td class='table-light border text-wrap'>";
                            $display .= "<textarea id='".$service."' rows='2' style='width: 250px;' class='form-control'></textarea>";
                            $display .= "</td>";
                        }


                        if (!empty($row["replacepart"])) {
                            $display .= "<td class='table-light border align-text-top text-wrap'>";
                            $display .= "<div style='width: 250px;'>" . $row["replacepart"] . " </div>";
                            $display .= "</td>";
                        } else {
                            $display .= "<td class='table-light border text-wrap'>";
                            $display .= "<textarea id='".$replacepart."' rows='2' style='width: 250px;' class='form-control'></textarea>";
                            $display .= "</td>";
                        }


                        if (!empty($row["service"]) && !empty($row["replacepart"])) {
                            $display .= "<td class='table-light border text-center'>-</td>";
                        } else {
                            $display .= "<td class='table-light border'>
                                            <button type='button' class='btn text-nowrap btn-success' onclick=\"saveText('".$row["joborderidxx"]."', $('#".$service."').val(), $('#".$replacepart."').val())\">
                                                Save
                                            </button>
                                        </td>";
                        }


                        if ($row["status"] == 3) {
                            $display .= "<td class='table-light border text-center'>-</td>";
                        } else if (empty($row["service"]) || empty($row["replacepart"]) || $row["status"] != 1) {
                            $display .= "<td class='table-light border text-wrap'>
                                            <button type='button' class='btn text-nowrap custom-btn' disabled>
                                                Mark as Accomplished
                                            </button>
                                        </td>";
                        } else {
                            $display .= "<td class='table-light border text-wrap'>
                                            <button type='button' class='btn text-nowrap custom-btn' onclick=\"markAccomplished('".$row["joborderidxx"]."')\">
                                                Mark as Accomplished
                                            </button>
                                        </td>";
                        }


            $display .= "</tr>";

        $counter = $counter + 1;

    }



$display .= "   </tbody>
            </table>

<script>
    $(document).ready(function(){
        $('#tbl_history').DataTable().destroy();

        $('#tbl_history').DataTable({
            'order': [],
            aLengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, 'ALL']
            ],
            scrollX: 400,
            scrollY: 400
        });
    });
</script>";



echo $display;

?>