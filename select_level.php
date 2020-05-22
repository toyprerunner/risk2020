<?php session_start();?>
<?php require('config.php');?>
<?php require('link_bootstrap.php');?>  
<?php

$categorie_id = isset($_POST['categories']) ? $_POST['categories'] : "";
$sql = "SELECT * FROM severity WHERE clinic_id='{$categorie_id}' Order By severity_text";
//$Rows = mysqli_num_rows($Query);
//if ($Rows > 0) {
    require('connect.php');
    while ($Result1 = mysqli_fetch_array($result)) {        
        echo "<option value=\"" . $Result1['severity_text'] . "\">" . $Result1['severity_text'].'  '.$Result1['severity_name'] . "</option>";
    }
        echo "<option value=\"\">ไม่มีข้อมูลในหมวดหมู่ที่เลือก</option>";