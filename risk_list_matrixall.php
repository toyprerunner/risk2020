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

    //$userlevel = $_SESSION['authen']['ulevel'];

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
    <?php
    if($userlevel==3 or $userlevel==5){
    $uid=$_SESSION['authen']['uid'];
    $r1=$_GET['r'];
    $c1=$_GET['c'];
    $b1=$_GET['b'];
    
    $sql="SELECT
        risk.risk_id,
        risk.date_stamp,
        risk.incident_detail,
        pro_risk.pro_risk_name,
        pro_risk_detail.pro_risk_detail_name,        
        clinic.clinic_name,
        born.born_name,
        source.source_name,
        dep.dep_name,
        profile.name as pname
        FROM
        risk
        LEFT OUTER JOIN pro_risk ON risk.pro_risk_id = pro_risk.pro_risk_id
        LEFT OUTER JOIN pro_risk_detail ON risk.pro_risk_detail_id = pro_risk_detail.pro_risk_detail_id
        LEFT OUTER JOIN born ON risk.born_id = born.born_id
        LEFT OUTER JOIN clinic ON risk.clinic_id = clinic.clinic_id
        LEFT OUTER JOIN source ON risk.source_id = source.source_id
        LEFT OUTER JOIN profile on profile.user_id = risk.user_id
        LEFT OUTER JOIN dep ON risk.dep_id = dep.dep_id
        LEFT OUTER JOIN matrix m on m.born_id = risk.born_id and m.severity_level = risk.severity_level
        LEFT OUTER JOIN born b on risk.born_id=b.born_id";
    $sql.=" WHERE risk.born_id in('$r1','6') AND m.score='$c1'";
        //echo $sql; exit;
    }else{
        $uid=$_SESSION['authen']['uid'];
        $r1=$_GET['r'];
        $c1=$_GET['c'];
        $b1=$_GET['b'];
        $sql="SELECT
            risk.risk_id,
            risk.date_stamp,
            risk.incident_detail,
            pro_risk.pro_risk_name,
            pro_risk_detail.pro_risk_detail_name,        
            clinic.clinic_name,
            born.born_name,
            source.source_name,
            dep.dep_name,
            profile.name as pname
            FROM
            risk
            LEFT OUTER JOIN pro_risk ON risk.pro_risk_id = pro_risk.pro_risk_id
            LEFT OUTER JOIN pro_risk_detail ON risk.pro_risk_detail_id = pro_risk_detail.pro_risk_detail_id
            LEFT OUTER JOIN born ON risk.born_id = born.born_id
            LEFT OUTER JOIN clinic ON risk.clinic_id = clinic.clinic_id
            LEFT OUTER JOIN source ON risk.source_id = source.source_id
            LEFT OUTER JOIN profile on profile.user_id = risk.user_id
            LEFT OUTER JOIN dep ON risk.dep_id = dep.dep_id
            LEFT OUTER JOIN matrix m on m.born_id = risk.born_id and m.severity_level = risk.severity_level
            LEFT OUTER JOIN born b on risk.born_id=b.born_id";
        $sql.=" WHERE risk.born_id in('$r1','6') AND m.score='$c1'";
        //$sql.=" AND risk.user_id='$uid'";
        $sql.=" ORDER BY risk.date_stamp desc"; 
    }
?>               
<?php require('connect.php'); $sumtotal = mysqli_num_rows($result); ?>                
<div class="panel-body">
<div class="panel panel-info">
<div class="panel-heading"><h4><i class="glyphicon glyphicon-list-alt"></i> รายการความเสี่ยงจำนวน <?php echo $sumtotal?>  รายการ</h4></div>
<div class="panel-body">    
 

    
<div class="panel-body"> 
                    <div class="row">
                                    <table class="table table-bordered" cellspacing="0" cellpadding="2">
                                            <tr class="info">
<!--                                                <td >จัดการ</td>-->
                                                <td >เลขที่บันทึก</td>
                                                <td >วันที่</td>
                                                <td >รายละเอียด</td>
                                                <td >ความเสี่ยงหลัก</td>
                                                <td >ความเสี่ยงย่อย</td>
                                                <td >ประเภทคลินิก</td>
                                                <td >ลักษณะการเกิด</td>      
                                                <td >การแก้ปัญหาเบื้องต้น</td>    
                                                <td >หน่วยงานที่เกิด</td> 
                                                <td >ผู้รายงาน</td>   
                                            </tr>

                                            <?php while($record=mysqli_fetch_array($result)){?>
                                            <tr>
<!--                                                <td>
                                                    <a class="glyphicon glyphicon-eye-open" href="risk_detail.php?risk_id=<?php echo($record[0]);?>"></a>    
                                                    <a class="glyphicon glyphicon-edit" href="risk_form_update.php?risk_id=<?php echo($record[0]);?>"></a>
                                                    <a class="glyphicon glyphicon-trash" href="javascript:rmdoc('<?php echo($record[0]);?>');"></a>
                                                </td>                                                -->
                                                <td style="background-color:<?php echo $b1?>">
                                                    <?php echo($record[0]);?>
                                                </td>
                                                <td style="background-color:<?php echo $b1?>">
                                                    <?php echo date_format(date_create($record[1]),"d/m/Y");?>
                                                </td>
                                                <td style="background-color:<?php echo $b1?>">
                                                    <?php echo($record[2]);?>
                                                </td>
                                                <td style="background-color:<?php echo $b1?>">
                                                    <?php echo($record[3]);?>
                                                </td>
                                                <td style="background-color:<?php echo $b1?>">
                                                    <?php echo($record[4]);?>
                                                </td>
                                                <td style="background-color:<?php echo $b1?>">
                                                    <?php echo($record[5]);?>
                                                </td>
                                                <td style="background-color:<?php echo $b1?>">
                                                    <?php echo($record[6]);?>
                                                </td>
                                                <td style="background-color:<?php echo $b1?>">
                                                    <?php echo($record[7]);?>
                                                </td>
                                                <td style="background-color:<?php echo $b1?>">
                                                    <?php echo($record[8]);?>
                                                </td>
                                                <td style="background-color:<?php echo $b1?>">
                                                    <?php echo($record[9]);?>
                                                </td>
                                            </tr>                                                                                      

                                        <?php } ?> 
                                    </table>                                                       
                    </div>
</div>
</div>
</div>
</div>
    <?php
        require 'foot.php';
    ?>  
        <?php require('unconn.php');?> 
        </aside>
        <?php }?>  
        
        
        <script type="text/javascript">
            $(function() {
                $('#example2').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": false
                });
            });
        </script> 

        <script language="javascript">
        function logout(){
            var url="authen_remove.php";
            var r=confirm("ยืนยันการออกจากระบบข้อมูล");
            if(r==true){window.location.href=url;}
            }
        </script>
        
        <script language="javascript">
            function rmdoc(v1){
                var url="risk_delete.php?risk_id=" + v1;
                var r=confirm("ยืนยันการลบข้อมูล");
                if(r==true){window.location.href=url;}
            }
        </script>
    </body>
</html>