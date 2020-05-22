<?php
    $sql="SELECT
        risk.risk_id,
        risk.date_stamp,
        risk.incident_detail,
        pro_risk.pro_risk_name,
        pro_risk_detail.pro_risk_detail_name,
        clinic.clinic_name,
        born.born_name,
        source.source_name,
        dep.dep_name,
        risk.detail_prob,
        risk.num,
        risk.pro_risk_id,
        risk.pro_risk_detail_id,
        risk.clinic_id,
        risk.severity_level,
        risk.born_id,
        risk.source_id,
        risk.dep_id,
        risk.team_id,
        risk.date_risk,
        risk.method,
        risk.date_edit,
        risk.edit_dep_id,
        risk.edit_team_id,
        risk.review_id,
        risk.follow_id,
        risk.review_detail,
        risk.files
        FROM
        risk
        INNER JOIN pro_risk ON risk.pro_risk_id = pro_risk.pro_risk_id
        INNER JOIN pro_risk_detail ON risk.pro_risk_detail_id = pro_risk_detail.pro_risk_detail_id
        INNER JOIN born ON risk.born_id = born.born_id
        INNER JOIN clinic ON risk.clinic_id = clinic.clinic_id
        INNER JOIN source ON risk.source_id = source.source_id
        INNER JOIN dep ON risk.dep_id = dep.dep_id where risk_id='$risk_id'";
    require('connect.php');
    
        list($risk_id,$date_stamp,$incident_detail,$pro_risk_name,$pro_risk_detail_name,$clinic_name,$born_name,$source_name,$dep_name,$detail_prob,$num,$pro_risk_id,$pro_risk_detail_id,$clinic_id,$severity_level,$born_id,$source_id,$dep_id,$team_id,$date_risk,$method_id,$date_edit,$edit_dep_id,$edit_team_id,$review_id,$follow_id,$review_detail,$files)=mysqli_fetch_array($result);
        
    require('unconn.php');
?>
