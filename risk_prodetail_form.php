<?php session_start(); ?>
<?php require('web_config.php');?>
<?php require('config.php');?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Risk</title>
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
        if(isset($_GET['pro_risk_detail_id'])){
        $action="risk_prodetail_update.php";
        $proriskdetailtitle = "แก้ไข โปรแกรมความเสี่ยงย่อย";
        $pro_risk_detail_id=$_GET['pro_risk_detail_id'];             
        require('risk_prodetail_select.php');  
        
    }else{
        $action="risk_prodetail_insert.php";
        $proriskdetailtitle = "เพิ่มโปรแกรมความเสี่ยงย่อย";    
        $pro_risk_detail_name = "";
        $pro_risk_id = "";
    }
?>
    
<div class="panel-body">
<div class="panel panel-info">
<div class="panel-heading"><h4><i class="glyphicon glyphicon-list-alt"></i> Risk : <small><?php echo($proriskdetailtitle)?></small></h4> </div>
<div class="panel-body">               
                        
                            <form action="<?php echo($action) ?>" method="post" enctype="multipart/form-data" name="risk_form" >     
                                
                                <input name="proriskdetail_id" type="hidden" value="<?php echo($pro_risk_detail_id)?>">
                                
                                <div class="form-group">
                                <div class="row">
                                <div class="col-md-2">
                                    <div class="input-group">
                                        <div class="input-group-addon">

                                        โปรแกรมความเสี่ยงหลัก :
                                        </div>
                                        <select class="form-control" name="proriskid" id="proriskid" style="width:350px;">
                                            <option value="">เลือกกลุ่มงาน</option>
                                            <?php
                                            $sql="SELECT * from pro_risk";                                            
                                            require('connect.php');
                                            while($record4=mysqli_fetch_array($result))
                                            {
                                            ?>
                                            <option <?php if($pro_risk_id==$record4["pro_risk_id"]) echo 'selected';?> value="<?php echo $record4["pro_risk_id"];?>"><?php echo $record4["pro_risk_id"]." - ".$record4["pro_risk_name"];?></option>
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
                                        ชื่อโปรแกรมความเสี่ยงย่อย :
                                        </div>    
                                        <input  class="form-control" name="prodetailname" type="text" value="<?php echo($pro_risk_detail_name);?>" style="width:500px;">
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