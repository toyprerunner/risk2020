<?php session_start(); ?>
<?php require('config.php');?>
<?php
    $loginid=$_POST['loginid'];
    $loginpwd=$_POST['loginpwd'];
    $sql="SELECT COUNT(uid) from users WHERE uid='$loginid' AND upwd='$loginpwd'";
    require('connect.php');
    $record=mysqli_fetch_array($result);
    $usercount=(int)$record[0];
    require('unconn.php');

    if($usercount>0){        
        $v1=1;
        $msg="ยินดีต้อนรับเข้าสู่ระบบ";
        $_SESSION['authen']['id']=$loginid;
        $_SESSION['authen']['pwd']=$loginpwd;        
    }else{
        $v1=0;
        $msg="การเข้าใช้งานผิดพลาด";
        unset($_SESSION['authen']);        
    }
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>E-Doc</title>
</head>

<body>
<script language="javascript">
    var v1=<?php echo($v1);?>;
    alert('<?php echo($msg);?>');
    if(v1==1){
        window.location.replace("index.php");
    }else{
        window.history.back();
    }
</script>
</body>
</html>