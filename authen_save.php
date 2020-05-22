<?php session_start(); ?>
<?php require('config.php');?>
<?php require('web_config.php');?>
<?php
    $loginid=$_POST['loginid'];
    $loginpwd=md5($_POST['loginpwd']);
    $sql="SELECT COUNT(username),urole,dep_id,user.id,profile.name,profile.team_id from user ";
    $sql.= " inner join profile on profile.user_id = user.id";
    $sql.= " WHERE username='$loginid' AND password_hash='$loginpwd' and uauthen=1";  
    //echo $sql; exit;
    require('connect.php');
    $record=mysqli_fetch_array($result);
    $usercount=(int)$record[0];
    $userlevel=(int)$record[1];
    $userdept=(int)$record[2];
    $userid=$record[3];
    $username=$record[4];
    $userteam=$record[5];
    require('unconn.php');
    if($usercount>0){
//        if($userlevel==1){
            $_SESSION['authen']['id']=$loginid;
            $_SESSION['authen']['pwd']=$loginpwd;  
            $_SESSION['authen']['ulevel']=$userlevel;  
            $_SESSION['authen']['udept']=$userdept;  
            $_SESSION['authen']['uid']=$userid;
            $_SESSION['authen']['uname']=$username;
            $_SESSION['authen']['uteam']=$userteam;
            header("location:index.php");       
//        }else if($userlevel==3){
//            $_SESSION['authen']['id']=$loginid;
//            $_SESSION['authen']['pwd']=$loginpwd;  
//            $_SESSION['authen']['ulevel']=$userlevel;  
//            $_SESSION['authen']['udept']=$userdept;   
//            $_SESSION['authen']['uid']=$userid;
//            $_SESSION['authen']['uname']=$username;
//            $_SESSION['authen']['uteam']=$userteam;
//            header("location:index.php");
//        }
    }
    
    if($usercount==0){?>
        <div class="panel-body">  		
         <?php echo 'ไม่พบชื่อผู้ใช้และรหัสผ่านนี้'; ?>
        </div>  
        <div class="panel-body">  		
            <a class="btn btn-primary" href="javascript:window.history.back();">กลับ</a>
        </div>  
    <?php } ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>E-Doc</title>
</head>

<body>
</body>
</html>