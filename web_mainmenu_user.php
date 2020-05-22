<?php require('link_bootstrap.php');?>  
<div>
<?php if($authenrole>0){?>
    <a class="btn btn-primary" href="indexuser.php" role="button"><i class="glyphicon glyphicon-home"></i> หน้าแรก</a>
    <a class="btn btn-primary" href="indexuser.php?doccate=0" role="button"><i class="glyphicon glyphicon-log-in"></i> เอกสารเข้า</a>
    <a class="btn btn-primary" href="indexuser.php?doccate=1" role="button"><i class="glyphicon glyphicon-log-out"></i> เอกสารออก</a>    
    <a class="btn btn-primary" href="javascript:logout();" role="button"><i class="glyphicon glyphicon-off"></i> ออกจากระบบ</a>
<?php }else{?>
    <a class="btn btn-primary" href="index.php" role="button">Log In</a>
<?php }?>
</div>
<script language="javascript">
    function logout(){
        var url="authen_remove.php";
        var r=confirm("ยืนยันการออกจากระบบข้อมูล");
        if(r==true){window.location.href=url;}
    }
</script>