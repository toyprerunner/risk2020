<?php
    $sql="SELECT pro_risk_id,pro_risk_detail_name from pro_risk_detail where pro_risk_detail_id=$pro_risk_detail_id";
    require('connect.php');
    
        list($pro_risk_id,$pro_risk_detail_name)=mysqli_fetch_array($result);
        
    require('unconn.php');
?>