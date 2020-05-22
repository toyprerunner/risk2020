<?php session_start(); ?>
<?php require('web_config.php');?>
<?php require('config.php');?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Risk | Data Tables</title>     
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
<?php $sql="SELECT * from `group`";
    require('connect.php');
?>
    
<div class="panel-body">
<div class="panel panel-info">
<div class="panel-heading"><h4><i class="glyphicon glyphicon-list-alt"></i> กลุ่มงาน </h4> </div>
<div class="panel-body">   
    <div>
        <a class="btn btn-primary" href="risk_depmain_form.php" role="button">เพิ่ม</a>
    </div>
    
                    <div class="panel-body"> 
                        <div class="row">
                                    <table class="table table-bordered" cellspacing="0" cellpadding="2">
                                            <tr class="info">
                                                <th>จัดการ</th>
                                                <th>รหัสกลุ่มงาน</th>  
                                                <th>ชื่อกลุ่มงาน</th>  
                                            </tr>
                                        <tbody>
                                            <?php while($record=mysqli_fetch_array($result)){?>
                                            <tr>
                                                <td>       
                                                    <a href="risk_depmain_form.php?group_id=<?php echo($record[0]);?>">แก้ไข</a>                                                    
                                                </td>                                                
                                                <td><?php echo($record[0]);?></td>
                                                <td><?php echo($record[1]);?></td>
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