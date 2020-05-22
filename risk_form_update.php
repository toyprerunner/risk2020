<?php session_start(); ?>
<?php require('config.php');?>
<?php require('web_config.php');?>
<?php require('link_bootstrap.php');?>  
<html>
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
        if($userlevel==1 or $userlevel==3 or $userlevel==5){
            require 'navigator.php';
            if($userlevel==1 or $userlevel==3 or $userlevel==5){
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
                } ?>
                    <div class="panel-body">
                    <div class="panel panel-info">
                    <div class="panel-heading"><h4><i class="glyphicon glyphicon-list-alt"></i> Risk Assessment <small> <?php echo $risktitle; ?></small></h4> </div>
                    <div class="panel-body">                     
                                            <div class="box-header">                            
                                                <div class="panel panel-danger">
                                                <div class="panel-heading"><h4><i class="glyphicon glyphicon-list-alt"></i> ส่วนรายงานเหตุการณ์</h4></div>
                                                <div class="panel-body">  
                                                <form action="<?php echo($action);?>" method="post" enctype="multipart/form-data" name="risk_form" >  

                                                    <input name="riskid" type="hidden" value="<?php echo $risk_id?>">

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
                                                            <textarea class="form-control" name="incident_detail" cols="20" rows="5" style="width:885px;"><?php echo($incident_detail);?></textarea>
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
                                                            <select class="form-control" name="prorisk" id="prorisk" style="width:350px;">
                                                                <option value="">เลือกความเสี่ยงหลัก</option>
                                                                <?php
                                                                $sql="SELECT * from pro_risk";
                                                                require('connect.php');
                                                                while($record=mysqli_fetch_array($result))
                                                                {                                                
                                                                ?>                                        
                                                                <option <?php if($pro_risk_id==$record["pro_risk_id"]) echo 'selected';?> value="<?php echo $record["pro_risk_id"];?>"><?php echo $record["pro_risk_name"];?></option>
                                                                <?php 
                                                                }
                                                                ?>
                                                            </select>
                                                            <div class="input-group-addon">                                                                
                                                                โปรแกรมความเสี่ยงย่อย :
                                                            </div>     
                                                                <select class="form-control" name="proriskdetail" id="proriskdetail" style="width:350px;">
                                                                    <option value="">เลือกความเสี่ยงย่อย</option>
                                                                    <?php
                                                                    $sql="SELECT * from pro_risk_detail where pro_risk_id='$pro_risk_id'";
                                                                    require('connect.php');
                                                                    while($record1=mysqli_fetch_array($result))
                                                                    {                                                
                                                                    ?>
                                                                    <option <?php if($pro_risk_detail_id==$record1["pro_risk_detail_id"]) echo 'selected';?> value="<?php echo $record1["pro_risk_detail_id"];?>"><?php echo $record1["pro_risk_detail_name"];?></option>
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
                                                            ประเภทของคลินิก :
                                                            </div>
                                                            <select class="form-control" name="clinic" id="clinic" style="width:350px;">
                                                                <option value="">เลือกคลินิก</option>
                                                                <?php
                                                                $sql="SELECT * from clinic";
                                                                require('connect.php');
                                                                while($record2=mysqli_fetch_array($result))
                                                                {
                                                                ?>
                                                                <option <?php if($clinic_id==$record2["clinic_id"]) echo 'selected';?> value="<?php echo $record2["clinic_id"];?>"><?php echo $record2["clinic_id"]." - ".$record2["clinic_name"];?></option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select>                                        


                                                            <div class="input-group-addon">                                                                
                                                                ระดับความรุนแรง :
                                                            </div>     
                                                                <select class="form-control" name="severity" id="severity" style="width:350px;">    
                                                                    <option value="">เลือกระดับความรุนแรง</option>
                                                                    <?php
                                                                    $sql="SELECT * from severity where clinic_id='$clinic_id'";
                                                                    require('connect.php');
                                                                    while($record3=mysqli_fetch_array($result))
                                                                    {                                                
                                                                    ?>
                                                                    <option <?php if($severity_level==$record3["severity_text"]) echo 'selected';?> value="<?php echo $record3["severity_text"];?>"><?php echo $record3["severity_text"]." - ".$record3["severity_name"];?></option>                                                
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
                                                            วันที่เกิดความเสี่ยง :
                                                            </div>
                                                            <input  class="form-control" name="date_risk" type="date" value="<?php echo($date_risk);?>" style="width:170px;" >

                                                            <div class="input-group-addon">
                                                            ลักษณะการเกิด :
                                                            </div>
                                                            <select class="form-control" name="born" id="born" style="width:350px;">
                                                                <option value="">เลือกลักษณะการเกิด</option>
                                                                <?php
                                                                $sql="SELECT * from born";
                                                                require('connect.php');
                                                                while($record4=mysqli_fetch_array($result))
                                                                {
                                                                ?>
                                                                <option <?php if($born_id==$record4["born_id"]) echo 'selected';?> value="<?php echo $record4["born_id"];?>"><?php echo $record4["born_id"]." - ".$record4["born_name"];?></option>
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
                                                            <select class="form-control" name="source" id="source" style="width:350px;">
                                                                <option value="">เลือกแหล่งที่มาของข้อมูล</option>
                                                                <?php
                                                                $sql="SELECT * from source";
                                                                require('connect.php');
                                                                while($record5=mysqli_fetch_array($result))
                                                                {
                                                                ?>
                                                                <option <?php if($source_id==$record5["source_id"]) echo 'selected';?> value="<?php echo $record5["source_id"];?>"><?php echo $record5["source_id"]." - ".$record5["source_name"];?></option>
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
                                                            <textarea class="form-control" name="detail_prob" cols="20" rows="2" style="width:400px;"><?php echo($detail_prob);?></textarea>
                                                        </div>
                                                    </div>
                                                    </div>
                                                    </div>

                                                    <div class="form-group">
                                                    <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="input-group">
                    <!--                                        <div class="input-group-addon">
                                                            หน่วยงานที่เกิดความเสี่ยง :
                                                            </div>
                                                            <select class="form-control" name="dep" id="dep" style="width:250px;">
                                                                <option value="">เลือกหน่วยงาน</option>
                                                                <?php
                                                                $sql="SELECT * from dep";
                                                                require('connect.php');
                                                                while($record6=mysqli_fetch_array($result))
                                                                {
                                                                ?>
                                                                <option <?php if($dep_id==$record6["dep_id"]) echo 'selected';?> value="<?php echo $record6["dep_id"];?>"><?php echo $record6["dep_id"]." - ".$record6["dep_name"];?></option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select>     -->
                                                            <input name="dep" type="hidden" value="<?php echo($_SESSION['authen']['udept'])?>">

                                                            <div class="input-group-addon">
                                                            ที่มคร่อมสายงานที่เกิดความเสี่ยง :
                                                            </div>
                                                            <select class="form-control" name="team" id="team" style="width:300px;">
                                                                <option value="">เลือกทีมคร่อมสายงานที่เกิดความเสี่ยง</option>
                                                                <?php
                                                                $sql="SELECT * from team";
                                                                require('connect.php');
                                                                while($record7=mysqli_fetch_array($result))
                                                                {
                                                                ?>
                                                                <option <?php if($team_id==$record7["team_id"]) echo 'selected';?> value="<?php echo $record7["team_id"];?>"><?php echo $record7["team_id"]." - ".$record7["team_name"];?></option>
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
                                                            <input  class="form-control" name="num" type="text" value="<?php echo($num);?>" style="width:100px;">
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
                                    <?php
                            require 'foot.php';
                        ?>  
                    </div>
                    </div>
                    </div>
            <?php }
        }else{
            require('authen_form.php');
        }
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
