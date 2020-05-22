
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
        $review_date=$_POST['review_date'];
        $review_id=$_POST['review_id'];
        $follow_id=$_POST['follow_id'];        
        $review_detail=$_POST['review_detail'];
        
    $sql="UPDATE risk set 
        review_date='$review_date',
        review_id='$review_id',
        follow_id='$follow_id',        
        review_detail='$review_detail'";
        
            
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
        window.location.replace("risk_review.php");
    }else{
        window.history.back();
    }
</script>
</body>
</html>