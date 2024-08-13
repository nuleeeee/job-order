<?php
include "session.php";

function optionlst($db, $sqlcommand, $flddsplay, $fldvalue)
{
    $display = "";

    $resultx = mysqli_query($db, $sqlcommand);
    if (mysqli_error($db) != "") {
        return mysqli_error($db);
    }
    $count = mysqli_num_rows($resultx);
    if ($count == 0) {
        $display .= "<option value=0>NO DATA</option>";
    } else {
        $display .= "<option value=0 selected>Please Select</option>";
        while ($rowx = $resultx->fetch_array()) {
            $display .= "<option value=" . $rowx[$fldvalue] . ">" . $rowx[$flddsplay] . "</option>";
        }
    }
    return $display;
}

function getnewId($db, $schema, $table, $field, $formidz, $branchid) {
    $ip = $_SERVER['REMOTE_ADDR'];
    $lstIp = substr(strrchr($ip, '.'), 1);
    $lstIp = sprintf('%03d', $lstIp);

    $sql = "SELECT max($field) as maxfld FROM $schema.$table";
    $newId = 0;
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);

    if ($count == 1
    ) {
        $newId = (int) $row["maxfld"] + 1 + sprintf('%0.3f', ((int) $branchid / 1000)) + sprintf('%0.6f', ((int) $lstIp / 1000000)) + sprintf('%0.8f', ((int) $formidz / 100000000));
        return sprintf('%0.8f', $newId);
    } else {
        $newId = 1 + sprintf('%0.3f', ((int) $branchid / 1000))  + sprintf('%0.6f',
                ((int) $lstIp / 1000000)
            ) + sprintf('%0.8f', ((int) $formidz / 100000000));
        return sprintf('%0.8f', $newId);
    }
}


function getAppId($db, $schema, $table, $field) {
    $ip = $_SERVER['REMOTE_ADDR'];
    $lstIp = substr(strrchr($ip, '.'), 1);
    $lstIp = sprintf('%03d', $lstIp);

    $sql = "SELECT max($field) as maxfld FROM $schema.$table";
    $newId = 0;
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);

    if ($count == 1) 
    {
        $newId = (int) $row["maxfld"] + 1 + sprintf('%0.3f', ((int) $lstIp / 1000));
        return sprintf('%0.3f', $newId);
    } else {
        $newId = 1 + sprintf('%0.3f', ((int) $lstIp / 1000));
        return sprintf('%0.3f', $newId);
    }
}


function BaseID($db, $schema, $table, $field) {
    $ip = $_SERVER['REMOTE_ADDR'];
    $lstIp = substr(strrchr($ip, '.'), 1);
    $lstIp = sprintf('%03d', $lstIp);

    $sql = "SELECT max($field) as maxfld FROM $schema.$table";
    $newId = 0;
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);

    if ($count == 1) 
    {
        $newId = (int) $row["maxfld"] + 1 + sprintf('%0.3f', ((int) $lstIp / 1000));
        return sprintf('%0.3f', $newId);
    } else {
        $newId = 1 + sprintf('%0.3f', ((int) $lstIp / 1000));
        return sprintf('%0.3f', $newId);
    }
}

?>