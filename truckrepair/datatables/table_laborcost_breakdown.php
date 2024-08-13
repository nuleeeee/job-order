<?php

include '../../phpconfig/allfunction.php';

$display = "<table class='table table-bordered table-sm text-nowrap' id='laborcost_breakdown' style='font-size: 12px; border: 1px solid #dee2e6; width: 100%; margin-bottom: 1rem; border-collapse: collapse; white-space:nowrap; table-layout: fixed;'>
                <thead>
                    <tr>
                        <th style='text-align:center;'>SUPPLIER</th>
                        <th style='text-align:center;'>MATERIAL</th>
                        <th style='text-align:center;'>QTY</th>
                        <th style='text-align:center;'>PRICE</th>
                        <th style='text-align:center;'>AMOUNT</th>
                    </tr>
                </thead>
                <tbody>";

if (isset($_POST["job_order_id"])) {

    $job_order_id = $_POST["job_order_id"];
    $datacount = $_POST["datacount"];

    $sql = "SELECT  canvassidxx, joborderidz, joborderidxx, vbrand, vmodel, vyear, vplateno, vodo, overview, vname, request_date, brname,
                    position, typeofcost, labor_supplier, labor_things, labor_price, labor_qty, amount
            FROM
            (
                SELECT  canvassidxx, joborderidz, joborderidxx, vbrand, vmodel, vyear, vplateno, vodo, overview, vname, request_date,
                        IFNULL(brname, '') as brname, position, typeofcost, 
                        CASE WHEN typeofcost = 'labor' THEN supplier END AS labor_supplier,
                        CASE WHEN typeofcost = 'labor' THEN material END AS labor_things,
                        CASE WHEN typeofcost = 'labor' THEN price END AS labor_price,
                        CASE WHEN typeofcost = 'labor' THEN qty END AS labor_qty,
                        (CASE WHEN typeofcost = 'labor' THEN qty END*CASE WHEN typeofcost = 'labor' THEN price END) as amount
                FROM vlookup_mcore.vrepaircanvass cv
                LEFT OUTER JOIN
                (
                    SELECT  joborderidxx, nameidz, vbrand, vmodel, vyear, vplateno, vodo, overview, 
                            DATE(tsz) as request_date
                    FROM vlookup_mcore.vtruckrepair
                ) as tbl_repair on tbl_repair.joborderidxx = cv.joborderidz
                LEFT OUTER JOIN
                (
                    SELECT nameidxx, CONCAT(lastname, ', ', firstname) as vname, bridz FROM vlookup_mcore.vnamenew
                ) as tbl_vname on tbl_vname.nameidxx = tbl_repair.nameidz
                LEFT OUTER JOIN
                (
                    SELECT branchidxx, brname FROM vlookup_mcore.vbranch
                ) as tbl_branch on tbl_branch.branchidxx = tbl_vname.bridz
                LEFT OUTER JOIN
                (
                    SELECT COALESCE(vlookup_mcore.vemployeeposition.position, IF(vproduct_mcore.category.catz IS NOT NULL, vproduct_mcore.category.catz, oldpos.position)) as position, nameidxx as nameidz, lvlidz
                    FROM vlookup_mcore.vnamenew
                    LEFT OUTER JOIN
                    (
                        SELECT GROUP_CONCAT(catz SEPARATOR ', ') as position,nameidz FROM
                        (
                            SELECT dtr_mcore.brpos.*,catz FROM dtr_mcore.brpos
                            INNER JOIN
                            (
                                SELECT MAX(posidxx) as posidxx FROM dtr_mcore.brpos GROUP BY nameidz,catidz
                            )as tbl ON tbl.posidxx = dtr_mcore.brpos.posidxx
                            INNER JOIN vproduct_mcore.category ON vproduct_mcore.category.catidxx = dtr_mcore.brpos.catidz
                            WHERE status = 0 AND trstatus = 0
                        )as tbsub1
                        GROUP BY nameidz
                    )as oldpos ON oldpos.nameidz = vlookup_mcore.vnamenew.nameidxx
                    LEFT OUTER JOIN vlookup_mcore.vemployeeposition ON vlookup_mcore.vemployeeposition.positionidxx = vlookup_mcore.vnamenew.positionidz
                    LEFT OUTER JOIN vproduct_mcore.category ON vproduct_mcore.category.catidxx = vlookup_mcore.vnamenew.positionidz
                ) as showpos ON showpos.nameidz = tbl_vname.nameidxx
                WHERE joborderidz = '$job_order_id' AND datacount = '$datacount' AND typeofcost = 'labor'
            ) as final ";
            
    $result = mysqli_query($db,$sql);
    $total_amount = 0;
    while($row = $result->fetch_array())
    {
        $total_amount += $row["amount"];

        $display .= "<tr data-row-id='" . $row["canvassidxx"] . "'>
                        <td style='background-color: #f8f9fa; color: #212529; text-align:center; white-space: pre-wrap;'>" . $row["labor_supplier"] . "</td>
                        <td style='background-color: #f8f9fa; color: #212529; text-align:center; white-space: pre-wrap;'>" . $row["labor_things"] . "</td>	
                        <td style='background-color: #f8f9fa; color: #212529; text-align:center;'>" . $row["labor_qty"] . "</td>
                        <td style='background-color: #f8f9fa; color: #212529; text-align:center;'>₱ " . number_format($row["labor_price"], 2, '.', ',') . "</td>
                        <td style='background-color: #f8f9fa; color: #212529; text-align:center;'>₱ " . number_format($row["amount"], 2, '.', ',') . "</td>
                    </tr>";
    }


$display .= "   </tbody>
                <tfoot>
                    <tr>
                        <td colspan='4' style='background-color: #f8f9fa; color: #212529; text-align:right;'>
                            Total Amount:
                        </td>
                        <td style='background-color: #f8f9fa; color: #212529; text-align:center;'>
                            ₱ " . number_format($total_amount, 2, '.', ',') . "</td>
                        </td>
                    </tr>
                </tfoot>
            </table>";

}

echo $display;

?>