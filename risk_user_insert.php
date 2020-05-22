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
        $username=$_POST['username'];
        $password=md5($_POST['password']);  
        $email=$_POST['email'];
        $ustatus=$_POST['ustatus'];

    $sql="insert into user(username,email,password_hash,urole,uauthen,auth_key,registration_ip,created_at,updated_at,flags) values('$username','$email','$password','$ustatus','1','$password','0','0','0','0')";
    
    //echo $sql; exit;
 
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
        window.location.replace("risk_user.php");
    }else{
        window.history.back();
    }
</script>
</body>
</html>