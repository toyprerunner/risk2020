<?php session_start(); ?>
<?php require('web_config.php');?>
<?php require('config.php');?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Risk</title>     
    </head>

<?php
    $userlevel = $_SESSION['authen']['ulevel'];

    require('authen_role.php');

    if($authenrole<1){
        require('authen_form.php');
    }else{
        if($userlevel==3 or $userlevel==5){
            require 'navigator.php';
        }else{
            require 'navigator.php';
        }
?> 
<?php $sql="SELECT user.id,user.username,profile.name,user.email,dep.dep_name,level.level_name as ulevel from user LEFT OUTER JOIN profile on profile.user_id = user.id LEFT OUTER JOIN dep on dep.dep_id = profile.dep_id left outer join level on user.urole = level.level_id";
    require('connect.php');
?>
    
<div class="panel-body">
<div class="panel panel-info">
<div class="panel-heading"><h4><i class="glyphicon glyphicon-list-alt"></i> ผู้ใช้งาน </h4> </div>
<div class="panel-body">   
    <div>
        <a class="btn btn-primary" href="risk_user_form_add.php" role="button">เพิ่ม</a>
    </div>
    
                    <div class="panel-body"> 
                        <div class="row">
                                    <table class="table table-bordered" cellspacing="0" cellpadding="2">
                                            <tr class="info">
                                                <th>จัดการ</th>
                                                <th>ชื่อผู้ใช้</th> 
                                                <th>ชื่อ - สกุล</th> 
                                                <th>email</th> 
                                                <th>หน่วยงาน</th> 
                                                <th>สถานะ</th> 
                                            </tr>
                                        <tbody>
                                            <?php while($record=mysqli_fetch_array($result)){?>
                                            <tr>
                                                <td>       
                                                    <a href="risk_user_form.php?id=<?php echo($record[0]);?>">แก้ไข</a>                                                    
                                                </td>                                                
                                                <td><?php echo($record[1]);?></td>
                                                <td><?php echo($record[2]);?></td>
                                                <td><?php echo($record[3]);?></td>
                                                <td><?php echo($record[4]);?></td>
                                                <td><?php echo($record[5]);?></td>
                                            </tr>                                                                                      
                                        </tbody>
                                        <?php } ?> 
                                    </table>
               
                        </div>
                    </div>

</div>
</div>
</div>
<?php }
?>
    <?php require('unconn.php');?>       
              
        <script language="javascript">
            function rmdoc(v1){
                var url="risk_delete.php?risk_id=" + v1;
                var r=confirm("ยืนยันการลบข้อมูล");
                if(r==true){window.location.href=url;}
            }
        </script>

</body>
</html>