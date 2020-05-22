<?php session_start(); ?>
<?php require('web_config.php');?>
<?php require('config.php');?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Risk Assessment</title>
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
        if(isset($_GET['pro_risk_id'])){
        $action="risk_prorisk_update.php";
        $prorisktitle = "แก้ไข โปรแกรมความเสี่ยงหลัก";
        $pro_risk_id=$_GET['pro_risk_id'];             
        require('risk_prorisk_select.php');  
        
    }else{
        $action="risk_prorisk_insert.php";
        $prorisktitle = "เพิ่มโปรแกรมความเสี่ยงหลัก";    
        $pro_risk_name = "";        
    }
?>
    
<div class="panel-body">
<div class="panel panel-info">
<div class="panel-heading"><h4><i class="glyphicon glyphicon-list-alt"></i> Risk : <small><?php echo($prorisktitle)?></small></h4> </div>
<div class="panel-body">               
                        
                            <form action="<?php echo($action) ?>" method="post" enctype="multipart/form-data" name="risk_form" >                                   
                                
                                <input name="proriskid" type="hidden" value="<?php echo($pro_risk_id)?>">
                                
                                <div class="form-group">
                                <div class="row">
                                <div class="col-md-2">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                        ชื่อโปรแกรมความเสี่ยงหลัก :
                                        </div>    
                                        <input  class="form-control" name="proriskname" type="text" value="<?php echo($pro_risk_name);?>" style="width:500px;">
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