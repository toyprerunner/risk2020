
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
        $date_edit=$_POST['date_edit'];
        $edit_dep=$_POST['edit_dep'];
        $edit_team=$_POST['edit_team'];
        $uid=$_POST['uid'];
        $method_id=$_POST['method_id'];
        $docfile=$_POST['docfile'];
        
        if ($_FILES["docfile"]["error"] > 0)
        {
            echo "Error: " . $_FILES["docfile"]["error"] . "<br>";
        }
        else
        {
            echo "Upload: " . $_FILES["docfile"]["name"] . "<br>";
            echo "Type: " . $_FILES["docfile"]["type"] . "<br>";
            echo "Size: " . ($_FILES["docfile"]["size"] / 1024) . " Kb<br>";
            $size=($_FILES["docfile"]["size"] / 1024);
            // copy ลง Server
            $strname = strrev($_FILES['docfile']['name']);
            $path2="file_download/";
            $f1=time()."".strrev($strname[0].$strname[1].$strname[2].$strname[3]);
            $files=$path2.$f1;
            copy($_FILES['docfile']['tmp_name'],$files);
            echo" อัพโหลดไฟล์เรียบร้อยแล้ว";
        }
        
    $sql="UPDATE risk set 
        date_edit='$date_edit',
        edit_dep_id='$edit_dep',
        edit_team_id='$edit_team',
        edit_user_id='$uid',
        method='$method_id',files='$files'";
        
            
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
        window.location.replace("repeatlist.php");
    }else{
        window.history.back();
    }
</script>
</body>
</html>