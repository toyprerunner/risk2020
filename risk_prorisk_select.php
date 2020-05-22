<?php
    $sql="SELECT pro_risk_name from pro_risk where pro_risk_id=$pro_risk_id";
    require('connect.php');

        list($pro_risk_name)=mysqli_fetch_array($result);
        
    require('unconn.php');
?>