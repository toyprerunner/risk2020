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
        $user_id=$_POST['id'];
        $email=$_POST['email'];
        $name=$_POST['name'];
        $dep_id=$_POST['depid'];  
        $level_id=$_POST['ustatus'];
        

        $sql = "SELECT * FROM profile WHERE user_id = '".trim($user_id)."'";

	require('connect.php');
        $record55=mysqli_fetch_array($result);
        
	if($record55>0)
	{            
            $sql="update profile set name='$name',public_email='$email',gravatar_email='$email',dep_id='$dep_id',level_id='$level_id' where user_id='$user_id'";
            require('connect.php');
            $sql="update user set urole='$level_id' where id='$user_id'";            
            require('connect.php');
	}
	else
	{	            
            $sql="insert into profile(user_id,name,public_email,gravatar_email,gravatar_id,location,website,bio,dep_id,team_id,level_id) values('$user_id','$name','$email','$email','$email','Trakan','http://www.trakanhospital.org','A','$dep_id','0','0')";
            require('connect.php');
	}        
    
    //echo $sql; exit;
    
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