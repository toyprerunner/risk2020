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
        if($userlevel==3){
            require 'navigator.php';
        }else{
            require 'navigator.php';
        }
        if(isset($_GET['linetoken'])){
        $action="risk_lineupdate.php";
        $linetitle = "แก้ไข Line Token";
        $linetoken=$_GET['linetoken'];             
        require('risk_lineselect.php');  
    }else{
        $action="risk_lineinsert.php";
        $linetitle = "เพิ่ม Line Token";
        $linetoken="";
    }
?>
    
<div class="panel-body">
<div class="panel panel-info">
<div class="panel-heading"><h4><i class="glyphicon glyphicon-list-alt"></i> Risk Line Token <small><?php echo($linetitle)?></small></h4> </div>
<div class="panel-body">               
                        
                            <form action="<?php echo($action) ?>" method="post" enctype="multipart/form-data" name="risk_form" >                                     
                                
                                <div class="form-group">
                                <div class="row">
                                <div class="col-md-2">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                        Line Token :
                                        </div>    
                                        <input  class="form-control" name="linetoken" type="text" value="<?php echo($linetoken);?>" style="width:500px;">
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