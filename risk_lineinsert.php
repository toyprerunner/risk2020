<?php session_start(); ?>
<?php require('config.php');?>
<html>
<head>
<!--<meta HTTP-EQUIV="Refresh" CONTENT="1;URL=risk.php" charset=utf-8" />-->
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
        $linetoken=$_POST['linetoken'];
    
   
        $sql="INSERT INTO setup(line_token) 
        VALUES('$linetoken')";

        require('connect.php');
        //echo "บันทึกเรียบร้อยแล้ว !";	
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
        window.location.replace("risk_line.php");
    }else{
        window.history.back();
    }
</script>
</body>
</html>