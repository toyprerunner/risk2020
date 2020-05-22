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
        $action="risk_user_insert.php";
        $usertitle = "เพิ่มผู้ใช้งาน";    
        $email = "";
        $username="";
        $name="";
        $password="";
        $ulevel="";

?>
    
<div class="panel-body">
<div class="panel panel-info">
<div class="panel-heading"><h4><i class="glyphicon glyphicon-list-alt"></i> Risk : <small><?php echo($usertitle)?></small></h4> </div>
<div class="panel-body">               
                        
                            <form action="<?php echo($action) ?>" method="post" enctype="multipart/form-data" name="risk_form" >                                    
                                
                                <div class="form-group">
                                <div class="row">
                                <div class="col-md-2">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                        Username :
                                        </div>    
                                        <input  class="form-control" name="username" type="text" value="<?php echo($username);?>" style="width:200px;">
                                    </div>
                                </div>
                                </div>
                                </div>
                                
                                <div class="form-group">
                                <div class="row">
                                <div class="col-md-2">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                        รหัสผ่าน :
                                        </div>    
                                        <input  class="form-control" name="password" type="text" value="<?php echo($password);?>" style="width:250px;">
                                    </div>
                                </div>
                                </div>
                                </div>
                                
                                <div class="form-group">
                                <div class="row">
                                <div class="col-md-2">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                        Email :
                                        </div>    
                                        <input  class="form-control" name="email" type="text" value="<?php echo($email);?>" style="width:300px;">
                                    </div>
                                </div>
                                </div>
                                </div>                            
                                
                                <div class="form-group">
                                <div class="row">
                                <div class="col-md-2">
                                    <div class="input-group">
                                        <div class="input-group-addon">

                                        สถานะ :
                                        </div>
                                        <select class="form-control" name="ustatus" id="ustatus" style="width:350px;">
                                            <option value="">เลือกสถานะ</option>
                                            <?php
                                            $sql="SELECT * from level";                                            
                                            require('connect.php');
                                            while($record4=mysqli_fetch_array($result))
                                            {
                                            ?>
                                            <option <?php if($ulevel==$record4["level_id"]) echo 'selected';?> value="<?php echo $record4["level_id"];?>"><?php echo $record4["level_id"]." - ".$record4["level_name"];?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
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