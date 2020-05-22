<?php session_start(); ?>
<?php require('config.php');?>   
<?php require('link_bootstrap.php');?>  
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Risk</title>
</head>
<body>
<?php
    require('authen_role.php');
    if($authenrole<1){
?>
<script language="javascript">
    alert('กรุณาลงทะเบียนเข้าสู่ระบบ');
    window.location.replace("authen_remove.php");
</script>
<?php    
    exit();
    }
?>
<?php
        $risk_id=$_POST['riskid'];
        $date_stamp=$_POST['date_stamp'];
        $incident_detail=$_POST['incident_detail'];
        $prorisk=$_POST['prorisk'];
        $proriskdetail=$_POST['proriskdetail'];      
        $clinic=$_POST['clinic'];
	$severity=$_POST['severity'];
	$date_risk = $_POST['date_risk'];
        $born=$_POST['born'];
        $source=$_POST['source'];
	$detail_prob = $_POST['detail_prob'];
        $dep=$_POST['dep'];
        $team=$_POST['team']; 
        $num =$_POST['num'];

    $sql="UPDATE risk set 
        date_stamp='$date_stamp',
        incident_detail='$incident_detail',
        pro_risk_id='$prorisk',
        pro_risk_detail_id='$proriskdetail',
        clinic_id='$clinic',
        severity_level='$severity',
        date_risk='$date_risk',
        born_id='$born',
        source_id='$source',
        detail_prob='$detail_prob',
        dep_id='$dep',        
        team_id='$team',
        num='$num'";
            
    $sql.=" where risk_id='$risk_id'";
 
    require('connect.php');
    if($result==1){
        $v1=1;
        $msg="การบันทึกข้อมูลเสร็จสิ้น";
    }else{
        $v1=0;
        $msg="การบันทึกข้อมูลผิดพลาด";
    }
    require('unconn.php');
?>
<script language="javascript">
    var v1=<?php echo($v1);?>;
    alert('<?php echo($msg);?>');
    if(v1==1){
        window.location.replace("risk.php");
    }else{
        window.history.back();
    }
</script>
</body>
</html>