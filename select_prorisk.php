<?php session_start();?>
<?php require('config.php');?>
<?php require('link_bootstrap.php');?>  
<?php

$categorie_id = isset($_POST['categories']) ? $_POST['categories'] : "";
$sql = "SELECT * FROM pro_risk_detail WHERE pro_risk_id='{$categorie_id}'";
//$Rows = mysqli_num_rows($Query);
//if ($Rows > 0) {
    require('connect.php');
    while ($Result1 = mysqli_fetch_array($result)) {        
        echo "<option value=\"" . $Result1['pro_risk_detail_id'] . "\">" . $Result1['pro_risk_detail_name'] . "</option>";
    }
        echo "<option value=\"\">ไม่มีข้อมูลในหมวดหมู่ที่เลือก</option>";