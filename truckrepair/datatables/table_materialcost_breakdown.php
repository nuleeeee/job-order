<?php

include '../../phpconfig/allfunction.php';

$display = "<table class='table table-bordered table-sm text-nowrap' id='materialcost_breakdown' style='font-size: 12px; border: 1px solid #dee2e6; width: 100%; margin-bottom: 1rem; border-collapse: collapse; white-space:nowrap; table-layout: fixed;'>
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

    $sql = "SELECT  joborderidz, joborderidxx, vbrand, vmodel, vyear, vplateno, vodo, overview, vname, request_date, brname, position, 
                    typeofcost, material_supplier, material_things, material_price, material_qty, amount
            FROM
            (
                SELECT  joborderidz, joborderidxx, vbrand, vmodel, vyear, vplateno, vodo, overview, vname, request_date,
                        brname, position, typeofcost, 
                        CASE WHEN typeofcost = 'material' THEN supplier END AS material_supplier,
                        CASE WHEN typeofcost = 'material' THEN material END AS material_things,
                        CASE WHEN typeofcost = 'material' THEN price END AS material_price,
                        CASE WHEN typeofcost = 'material' THEN qty END AS material_qty,
                        (CASE WHEN typeofcost = 'material' THEN qty END*CASE WHEN typeofcost = 'material' THEN price END) as amount
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
                WHERE joborderidz = '$job_order_id' AND datacount = '$datacount' AND typeofcost = 'material'
            ) as final ";
            
    $result = mysqli_query($db,$sql);
    $total_amount = 0;
    while($row = $result->fetch_array())
    {
        $total_amount += $row["amount"];
        $amount = $row["amount"];
        
        $display .= "<tr>
                        <td style='background-color: #f8f9fa; color: #212529; text-align:center; white-space: pre-wrap;'>" . $row["material_supplier"] . "</td>
                        <td style='background-color: #f8f9fa; color: #212529; text-align:center; white-space: pre-wrap;'>" . $row["material_things"] . "</td>   
                        <td style='background-color: #f8f9fa; color: #212529; text-align:center;'>" . $row["material_qty"] . "</td>
                        <td style='background-color: #f8f9fa; color: #212529; text-align:center;'>₱ " . number_format($row["material_price"], 2, '.', ',') . "</td>
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