<?php session_start(); ?>
<?php require('config.php');?>
<?php require('web_config.php');?>
<?php require('link_bootstrap.php');?>  
<html>
<script language="javascript" src="js/jquery-ui-1.10.3.min.js"></script>  
<script type="text/javascript">  

<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script>
// just for the demos, avoids form submit
jQuery.validator.setDefaults({
  debug: true,
  success: "valid"
});
$( "#myform" ).validate({
  rules: {
    field: {
      required: true
    }
  }
});
</script>

<head>        
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Risk Assessment | Add Risk</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        
        <script type="text/javascript">
            $(document).ready(function() {
                $('#prorisk').change(function() {
                    $.ajax({
                        type: 'POST',
                        data: {categories: $(this).val()},
                        url: 'select_prorisk.php',
                        success: function(data) {
                            $('#proriskdetail').html(data);
                        }
                    });
                    return false;
                });
            });
        </script>
        
        <script type="text/javascript">
            $(document).ready(function() {
                $('#clinic').change(function() {
                    $.ajax({
                        type: 'POST',
                        data: {categories: $(this).val()},
                        url: 'select_level.php',
                        success: function(data) {
                            $('#severity').html(data);
                        }
                    });
                    return false;
                });
            });
        </script>
        
</head>


<?php 
require('authen_role.php');
if($authenrole<1){
        require('authen_form.php');
}else{
    $userlevel = $_SESSION['authen']['ulevel'];
    
    require('authen_role.php');

    if($authenrole<1){
        require('authen_form.php');
    }else{
        if($userlevel==1 or $userlevel==2 or $userlevel==3 or $userlevel==5){
            require 'navigator.php';
            if($userlevel==1 or $userlevel==2 or $userlevel==3 or $userlevel==5){
                if(isset($_GET['risk_id'])){
                    $action="risk_update.php";
                    $risktitle = "แก้ไขความเสี่ยง";
                    $risk_id=$_GET['risk_id'];             
                    require('risk_select.php');  
                }else{
                    $action="risk_insert.php";      
                    $risktitle = "บันทึกความเสี่ยงใหม่";
                    $date_stamp=date("Y-m-d");
                    $incident_detail="";
                    $prorisk="";
                    $proriskdetail="";        
                    $clinic="";
                    $severity="";
                    $date_risk = date("Y-m-d");
                    $born="";
                    $source="";
                    $detail_prob = "";
                    $dep="";
                    $team="";        
                    $num ="1";
                    $uid=$_SESSION['authen']['uid'];
                }?>
                    <div class="panel-body">
                    <div class="panel panel-info">
                    <div class="panel-heading"><h4><i class="glyphicon glyphicon-list-alt"></i> Risk Assessment <small> <?php echo $risktitle; ?></small></h4> </div>
                    <div class="panel-body">                
                                            <div class="box-header">          
                                                <div class="panel panel-danger">
                                                <div class="panel-heading"><h4><i class="glyphicon glyphicon-list-alt"></i> ส่วนรายงานเหตุการณ์</h4></div>
                                                <div class="panel-body">  
                                                <form action="<?php echo($action);?>" method="post" id="myform" enctype="multipart/form-data" name="risk_form" >  

                                                    <input name="uid" type="hidden" value="<?php echo($_SESSION['authen']['uid'])?>">                                                  
                                                    

                                                    <div class="form-group">
                                                    <div class="row">
                                                    <div class="col-md-2">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">
                                                            วันที่บันทึก :
                                                            </div>
                                                            <input  class="form-control" name="date_stamp" type="date" value="<?php echo($date_stamp);?>" style="width:170px;" readonly="true">
                                                        </div>
                                                    </div>
                                                    </div>
                                                    </div>

                                                    <div class="form-group">
                                                    <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="input-group">                                    
                                                            <div class="input-group-addon">                                                                
                                                                รายละเอียดเหตุการณ์ :
                                                            </div>                                    
                                                            <textarea class="form-control" name="incident_detail" required="required" id="incident_detail" cols="20" rows="2" style="width:600px;"><?php echo($incident_detail);?></textarea>
                                                        </div>
                                                    </div>
                                                    </div>
                                                    </div>

                                                    <div class="form-group">
                                                    <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">
                                                            โปรแกรมความเสี่ยงหลัก :
                                                            </div>
                                                            <select class="form-control" name="prorisk" id="prorisk" required="required" style="width:350px;">
                                                                <option value="">เลือกความเสี่ยงหลัก</option>
                                                                <?php
                                                                $sql="SELECT * from pro_risk";
                                                                require('connect.php');
                                                                while($record=mysqli_fetch_array($result))
                                                                {
                                                                ?>
                                                                <option value="<?php echo $record["pro_risk_id"];?>"><?php echo $record["pro_risk_id"]." - ".$record["pro_risk_name"];?></option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select>
                                                            <div class="input-group-addon">                                                                
                                                                โปรแกรมความเสี่ยงย่อย :
                                                            </div>     
                                                                <select class="form-control" name="proriskdetail" required="required" id="proriskdetail" style="width:350px;">
                                                                    <option value="">เลือกความเสี่ยงย่อย</option>
                                                                </select>
                                                        </div>
                                                    </div>                                                                                                        
                                                    </div>
                                                    </div>                               

                                                    <div class="form-group">
                                                    <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">
                                                            ประเภทของคลินิก :
                                                            </div>
                                                            <select class="form-control" name="clinic" id="clinic" required="required" style="width:350px;">
                                                                <option value="">เลือกคลินิก</option>
                                                                <?php
                                                                $sql="SELECT * from clinic";
                                                                require('connect.php');
                                                                while($record=mysqli_fetch_array($result))
                                                                {
                                                                ?>
                                                                <option value="<?php echo $record["clinic_id"];?>"><?php echo $record["clinic_id"]." - ".$record["clinic_name"];?></option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select>                                        


                                                            <div class="input-group-addon">                                                                
                                                                ระดับความรุนแรง :
                                                            </div>     
                                                                <select class="form-control" name="severity" id="severity" required="required" style="width:350px;">    
                                                                    <option value="">เลือกระดับความรุนแรง</option>
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
                                                            วันที่เกิดความเสี่ยง :
                                                            </div>
                                                            <input  class="form-control" name="date_risk" type="date" required="required" value="<?php echo($date_risk);?>" style="width:170px;" >

                                                            <div class="input-group-addon">
                                                            ลักษณะการเกิด :
                                                            </div>
                                                            <select class="form-control" name="born" required="required" id="born" style="width:350px;">
                                                                <option value="">เลือกลักษณะการเกิด</option>
                                                                <?php
                                                                $sql="SELECT * from born";
                                                                require('connect.php');
                                                                while($record=mysqli_fetch_array($result))
                                                                {
                                                                ?>
                                                                <option value="<?php echo $record["born_id"];?>"><?php echo $record["born_id"]." - ".$record["born_name"];?></option>
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
                                                    <div class="col-md-4">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">
                                                            แหล่งที่ทำให้ทราบถึงความเสี่ยง :
                                                            </div>
                                                            <select class="form-control" required="required" name="source" id="source" style="width:350px;">
                                                                <option value="">เลือกแหล่งที่มาของข้อมูล</option>
                                                                <?php
                                                                $sql="SELECT * from source";
                                                                require('connect.php');
                                                                while($record=mysqli_fetch_array($result))
                                                                {
                                                                ?>
                                                                <option value="<?php echo $record["source_id"];?>"><?php echo $record["source_id"]." - ".$record["source_name"];?></option>
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
                                                    <div class="col-md-8">
                                                        <div class="input-group">                                    
                                                            <div class="input-group-addon">                                                                
                                                                รายละเอียดการแก้ปัญหาเบื้องต้น :
                                                            </div>                                    
                                                            <textarea class="form-control" required="required" name="detail_prob" cols="20" rows="2" style="width:400px;"><?php echo($detail_prob);?></textarea>
                                                        </div>
                                                    </div>
                                                    </div>
                                                    </div>

                                                    <div class="form-group">
                                                    <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="input-group">
<!--                                                            <div class="input-group-addon">
                                                            หน่วยงานที่เกิดความเสี่ยง :
                                                            </div>
                                                            <select class="form-control" required="required" name="dep" id="dep" style="width:250px;">
                                                                <option value="">เลือกหน่วยงาน</option>
                                                                <?php
                                                                $sql="SELECT * from dep";
                                                                require('connect.php');
                                                                while($record=mysqli_fetch_array($result))
                                                                {
                                                                ?>
                                                                <option value="<?php echo $record["dep_id"];?>"><?php echo $record["dep_id"]." - ".$record["dep_name"];?></option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select>     -->
                                                            <input name="dep" type="hidden" value="<?php echo($_SESSION['authen']['udept'])?>">
                                                            
                                                            <div class="input-group-addon">
                                                            ที่มคร่อมสายงานที่เกิดความเสี่ยง :
                                                            </div>
                                                            <select class="form-control" required="required" name="team" id="team" style="width:300px;">
                                                                <option value="">เลือกทีมคร่อมสายงานที่เกิดความเสี่ยง</option>
                                                                <?php
                                                                $sql="SELECT * from team";
                                                                require('connect.php');
                                                                while($record=mysqli_fetch_array($result))
                                                                {
                                                                ?>
                                                                <option value="<?php echo $record["team_id"];?>"><?php echo $record["team_id"]." - ".$record["team_name"];?></option>
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
                                                    <div class="col-md-4">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">
                                                            จำนวนครั้งที่เกิดความเสี่ยงต่อการรายงาน :
                                                            </div>
                                                            <input  class="form-control" required="required" name="num" type="text" value="<?php echo($num);?>" style="width:100px;">
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
                                            <?php require 'foot.php'; ?>  
                    </div>
                    </div>
                    </div>
          <?php  }
        }else{
            require('authen_form.php');
        }        
    
    //$oldid=$risk_id;<input name="oldid" type="hidden" value="<?php echo($oldid);?
    } 
?>

<?php }?>  
        
        <script language="javascript">
        function logout(){
            var url="authen_remove.php";
            var r=confirm("ยืนยันการออกจากระบบข้อมูล");
            if(r==true){window.location.href=url;}
            }
        </script>
        
        
        
    </body>
</html>
