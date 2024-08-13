<?php

include '../../phpconfig/allfunction.php';
$cashieridz = $_SESSION['login_user'];
$position = $_SESSION['user_position'];
$brlogin = $_SESSION['branch'];

$display = "<table class='table table-hover text-nowrap' id='job_order_datatable' style='font-size: 12px;'>
                <thead class='thd_item' style='background-color: #434EA0; color: white; table-layout: fixed;'>
                    <tr>
                        <th class='text-center'>JOB ORDER ID</th>
                        <th class='text-center'>DATE</th>
                        <th class='text-center'>TYPE</th>
                        <th class='text-center'>NO. OF CANVASS</th>
                        <th class='text-center'>AMOUNT</th>
                        <th class='text-center'>ATTACHMENTS</th>
                        <th class='text-center'>APPROVER</th>
                        <th class='text-center'>AGING</th>
                        <th class='text-center'>LEAD TIME</th>
                        <th class='text-center text-wrap lh-1' style='width: 120px;'>REQUEST CANCELLATION</th>
                        <th class='text-center' style='width: 120px;'>PRINT DETAILS</th>
                        <th class='d-none'>OVERVIEW</th>
                    </tr>
                </thead>
                <tbody>";


	$sql = "SELECT  vtr.nameidz, DATE(vtr.tsz) as tszdate, canvassidxx, vtr.joborderidxx,  IFNULL(modeoffunds, '-') as modeoffunds,
                    IF(notapproved_approvalstatus=0, 'PENDING', IF(vtr.status=2, 'CANCELLED', IF(vtr.status=3, 'FOR CANCELLATION', tbl1.supplier))) as supplier, DATE(approvaldate) as approvaldate, amount, vtr.status, approvalstatus, brname, position,
                    CONCAT(tbl_vname.lastname, ', ', tbl_vname.firstname) as vname, overview,
                    IFNULL(vdriver, '-') as vdriver, IFNULL(vbrand, '-') as vbrand, IFNULL(vmodel, '-') as vmodel,
                    IFNULL(vplateno, '-') as vplateno, IFNULL(vyear, '-') as vyear, IFNULL(vodo, '-') as vodo, datacount, numofcanvass,
                    IFNULL(CONCAT(tbl_approver.lastname, ', ', tbl_approver.firstname), '-') as vapprover,
                    IF(approvaldate IS NULL, CONCAT(DATEDIFF(CURDATE(), DATE(vtr.tsz)), ' DAYS'), '-') AS aging,
                    IFNULL(CONCAT(DATEDIFF(approvaldate, DATE(vtr.tsz)), ' DAY(S)'), '-') AS lead_time,
                    COALESCE(attachments, notapproved_attachments) as attachments,
                    typename as repairtype, aid_recipient, convo_status
            FROM vlookup_mcore.vtruckrepair vtr
            LEFT OUTER JOIN
            (
                SELECT  canvassidxx, joborderidz, supplier,
                        SUM(qty*price) as amount, approver, approvaldate, approvalstatus, datacount, attachments
                FROM vlookup_mcore.vrepaircanvass
                WHERE approvalstatus  = 1
                GROUP BY joborderidz
            ) as tbl1 on tbl1.joborderidz = vtr.joborderidxx
            LEFT OUTER JOIN
            (
                SELECT  canvassidxx as notapproved_canvassidxx, joborderidz, supplier as notapproved_supplier,
                        SUM(qty*price) as notapproved_amount, approver as notapproved_approver, approvaldate as notapproved_approvaldate,
                        approvalstatus as notapproved_approvalstatus, datacount as notapproved_datacount,
                        attachments as notapproved_attachments
                FROM vlookup_mcore.vrepaircanvass
                WHERE approvalstatus IN (0,2,3)
                GROUP BY joborderidz
            ) as tbl1v2 on tbl1v2.joborderidz = vtr.joborderidxx
            LEFT OUTER JOIN
            (
                SELECT joborderidz, MAX(datacount) as numofcanvass FROM vlookup_mcore.vrepaircanvass
                GROUP BY joborderidz
            ) tbl2 on tbl2.joborderidz = vtr.joborderidxx
            LEFT OUTER JOIN vlookup_mcore.vnamenew tbl_vname on tbl_vname.nameidxx = vtr.nameidz
            LEFT OUTER JOIN vlookup_mcore.vnamenew tbl_approver on tbl_approver.nameidxx = tbl1.approver
            LEFT OUTER JOIN vlookup_mcore.vbranch tbl_branch ON tbl_branch.branchidxx = tbl_vname.bridz
            LEFT OUTER JOIN vlookup_mcore.vemployeeposition ON vlookup_mcore.vemployeeposition.positionidxx = tbl_vname.positionidz
            LEFT OUTER JOIN vlookup_mcore.vemployeeconcess ON vlookup_mcore.vemployeeconcess.concessposidxx = tbl_vname.concessposidz
            LEFT OUTER JOIN
            (
                SELECT financialidxx, joborderidz as job_aidz, nameidz, CONCAT(vrecepient.lastname, ', ', vrecepient.firstname) as aid_recipient
                FROM vlookup_mcore.vfinancialaid aid
                LEFT OUTER JOIN vlookup_mcore.vnamenew vrecepient ON vrecepient.nameidxx = aid.nameidz
            ) AS vaid ON vaid.job_aidz = vtr.joborderidxx
            LEFT OUTER JOIN vlookup_mcore.joborder_type JO_Type ON JO_Type.idxx = vtr.repairtype
            LEFT OUTER JOIN
            (
                SELECT vc.joborderidzz, convo_status FROM vlookup_mcore.joborder_convo vc
                JOIN (SELECT MAX(convoidxx) AS max_convoidxx, joborderidzz FROM vlookup_mcore.joborder_convo GROUP BY joborderidzz) AS max_convo
                ON vc.joborderidzz = max_convo.joborderidzz AND vc.convoidxx = max_convo.max_convoidxx
            ) as convo ON convo.joborderidzz = vtr.joborderidxx
            WHERE
            (
                ? IN ('GENERAL MANAGER', 'STORE MANAGER', 'ASSOCIATE STORE MANAGER 1', 'ASSOCIATE STORE MANAGER 2', 'ASSOCIATE STORE MANAGER 3', 'DEPARTMENT MANAGER - HUMAN RESOURCE', 'SENIOR HR ADMIN ASSISTANT')
                  AND tbl_vname.bridz = ?
            )
            OR
            (
                ? NOT IN ('GENERAL MANAGER', 'STORE MANAGER', 'ASSOCIATE STORE MANAGER 1', 'ASSOCIATE STORE MANAGER 2', 'ASSOCIATE STORE MANAGER 3', 'DEPARTMENT MANAGER - HUMAN RESOURCE', 'SENIOR HR ADMIN ASSISTANT')
                  AND tbl_vname.bridz = ?
                  AND vtr.nameidz = ?
            )
            ORDER BY COALESCE(approvaldate, vtr.tsz) DESC";

        $stmt = $db->prepare($sql);
        $stmt->bind_param("sssss", $position, $brlogin, $position, $brlogin, $cashieridz);
        $stmt->execute();

        $result = $stmt->get_result();
        $counter = 1;
        while($row = $result->fetch_array())
        {
            $request = "request{$counter}";
            $radio_name = "radioname{$counter}";

            if ($row["status"] == 0 && $row["approvalstatus"] != 1) {
                $amount = "<span class='text-danger'>PENDING</span>";
                $temp_amount = "₱ 0.00";
            } else if ($row["status"] == 2) {
                $amount = "<span class='text-secondary'>CANCELLED</span>";
                $temp_amount = "₱ 0.00";
            } else if ($row["status"] == 3) {
                $amount = "<span class='text-secondary'>FOR CANCELLATION</span>";
                $temp_amount = "₱ 0.00";
            } else {
                $amount = "<span class='text-primary'>₱ ".number_format($row["amount"], 2, '.', ',')."</span>";
                $temp_amount = "₱ ".number_format($row["amount"], 2, '.', ',');
            }

            $plateno = ($row["vplateno"] == "N/A") ? "-" : $row["vplateno"];

            $disabled_attr = '';
            if (strpos($amount, 'CANCELLED') !== false) {
                $disabled_attr = 'disabled';
            } else if (strpos($amount, 'FOR CANCELLATION') !== false) {
                $disabled_attr = 'disabled';
            }


            // this is to check that if approved, will only display the approved cost breakdown
            $datacount = ($row["datacount"] == 1) ? $row["datacount"] : $row["numofcanvass"];

            $folder_path = "../../assets/attachments/" . $row["joborderidxx"];

            $message_status = ($row["convo_status"] == 2) ? "" : "d-none";


            $display .= "<tr>
                            <td class='table-light'>
                                <button class='btn btn-sm btn-link position-relative' type='button' title='View Details' onclick=\"viewConvo('".$row["joborderidxx"]."', '1');\">
                                    " . $row["joborderidxx"] . "
                                    <span id='message_status' class='position-absolute top-30 start-95 translate-middle p-2 bg-danger border border-light rounded-circle ".$message_status."'>
                                    </span>
                                </button>
                            </td>
                            <td class='table-light'>" . $row["tszdate"] . "</td>
                            <td class='table-light'>" . $row["repairtype"] . "</td>
                            <td class='table-light text-center'>" . $row["numofcanvass"] . "</td>
                            <td class='table-light amount-cell'>" . $amount . "</td>
                            <td class='table-light text-center'>";

                    if ($row["attachments"] == "" && $row["supplier"] == "PENDING" && !file_exists($folder_path)) {
                        $display .= "<button type='button' class='btn btn-sm btn-link text-danger' style='font-size:10px;' onclick=\"uploadAttachments('".$row["canvassidxx"]."','".$row["joborderidxx"]."','".$row["nameidz"]."', 'upload_attachments')\">
                                        UPLOAD ATTACHMENTS
                                    </button>";
                    } else if ($row["attachments"] == "" && !file_exists($folder_path)) {
                        $display .= "<button type='button' class='btn btn-sm btn-link text-decoration-none' style='font-size:10px;  color:gray;' >
                                        NO ATTACHMENTS
                                    </button>";
                    } else {
                        $display .= "<button type='button' class='btn btn-sm btn-link' style='font-size:10px;' onclick=\"viewAttachments('".$row["joborderidxx"]."', '".$row["nameidz"]."')\">
                                        ATTACHMENTS
                                    </button>";
                    }

                            $display .= "</td>
                            </td>
                            <td class='table-light text-center'>" . $row["vapprover"] . "</td>
                            <td class='table-light text-center'>" . $row["aging"] . "</td>
                            <td class='table-light text-center'>" . $row["lead_time"] . "</td>
                            <td class='table-light'>
                                <button type='button' class='btn btn-sm btn-danger w-100' id=".$request." name=".$radio_name." onclick=\"requestCancellation('".$row["joborderidxx"]."', '".$row["nameidz"]."', '".$row["brname"]."', '".$row["vname"]."', '".$row["position"]."', '".$row["overview"]."', '".$row["vdriver"]."', '".$row["vbrand"]."', '".$row["vmodel"]."', '".$row["vyear"]."', '".$row["vplateno"]."', '".$row["vodo"]."', '".$row["supplier"]."', '".$temp_amount."', '".$request."')\" ".$disabled_attr.">
                                    REQUEST
                                </button>
                            </td>
                            <td class='table-light'>
                                <button type='button' class='btn btn-sm custom-btn w-100' onclick=\"printSupplier('".$row["joborderidxx"]."','".$row["nameidz"]."', '".$row["brname"]."', '".$row["vname"]."', '".$row["position"]."', '".$row["overview"]."', '".$row["vdriver"]."', '".$row["vbrand"]."', '".$row["vmodel"]."', '".$row["vyear"]."', '".$row["vplateno"]."', '".$row["vodo"]."', '".$row["joborderidxx"]."', '".$datacount."', '".$row["supplier"]."', '".$temp_amount."', '".$row["vapprover"]."', '".$row["approvaldate"]."', '".$row["modeoffunds"]."', '".$row["aid_recipient"]."', '".$row["repairtype"]."')\">
                                    View Details
                                </button>
                            <td class='d-none'>" . $row["overview"] . "</td>
                        </tr>";

            $counter++;

        }



	$display .= "    </tbody>
	            </table>

    <script>
        $(document).ready(function() {
            $('#job_order_datatable').DataTable().destroy();

            $('#job_order_datatable').DataTable({
                'order': [],
                scrollX: true,
                scrollY: 400,
                scrollCollapse: true,
                aLengthMenu: [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, 'ALL']
                ]
            });
        });
    </script>";

echo $display;

$stmt->close();
$db->close();