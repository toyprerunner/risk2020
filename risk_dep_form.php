<?php session_start(); ?>
<?php require('web_config.php');?>
<?php require('config.php');?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Risk Assessment Matrix | Dashboard</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
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
        if(isset($_GET['dep_id'])){
        $action="risk_dep_update.php";
        $deptitle = "แก้ไข หน่วยงาน";
        $dep_id=$_GET['dep_id'];             
        require('risk_dep_select.php');  
        
    }else{
        $action="risk_dep_insert.php";
        $deptitle = "เพิ่มหน่วยงาน";    
        $dep_name = "";
        $group_id = "";
    }
?>
    
<div class="panel-body">
<div class="panel panel-info">
<div class="panel-heading"><h4><i class="glyphicon glyphicon-list-alt"></i> Risk : <small><?php echo($deptitle)?></small></h4> </div>
<div class="panel-body">               
                        
                            <form action="<?php echo($action) ?>" method="post" enctype="multipart/form-data" name="risk_form" >     
                                
                                <input name="depid" type="hidden" value="<?php echo($dep_id)?>">
                                
                                <div class="form-group">
                                <div class="row">
                                <div class="col-md-2">
                                    <div class="input-group">
                                        <div class="input-group-addon">

                                        กลุ่มงาน :
                                        </div>
                                        <select class="form-control" name="groupid" id="groupid" style="width:350px;">
                                            <option value="">เลือกกลุ่มงาน</option>
                                            <?php
                                            $sql="SELECT * from `group`";                                            
                                            require('connect.php');
                                            while($record4=mysqli_fetch_array($result))
                                            {
                                            ?>
                                            <option <?php if($group_id==$record4["group_id"]) echo 'selected';?> value="<?php echo $record4["group_id"];?>"><?php echo $record4["group_id"]." - ".$record4["group_name"];?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    
                                </div>
                                </div>
                                </div>   
                                
                                <div class="form-group">
                                <div class="row">
                                <div class="col-md-2">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                        ชื่อหน่วยงาน :
                                        </div>    
                                        <input  class="form-control" name="depname" type="text" value="<?php echo($dep_name);?>" style="width:500px;">
                                    </div>
                                </div>
                                </div>
                                </div>
                                <input class="btn btn-primary" name="submit" type="submit" value="บันทึก">
                                <input class="btn btn-primary" name="reset" type="reset" value="ยกเลิก">
                                <a class="btn btn-primary" href="javascript:window.history.back();" role="button">กลับ</a>     
                            </form>
</div>
</div>
</div>
    <?php }?>  
</html>