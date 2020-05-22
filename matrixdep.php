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
    $userdep = $_SESSION['authen']['udept'];
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
<aside class="center-side">                           
    <?php
    $uid=$_SESSION['authen']['uid'];
    $dep=$_SESSION['authen']['udept'];

    if(isset($_GET['keyword'])){$keyword=$_GET['keyword'];}else{$keyword="";}
    $sql="SELECT m.code_color as color,m.color as cname,b.born_name,r.severity_level,
                    r.date_risk,pr.pro_risk_name,prd.pro_risk_detail_name,prsd.pro_risk_sub_detail_name,
                    r.incident_detail,dep.dep_name AS dep_of_risk,r.detail_prob,f.follow_name,p. NAME AS name_report,
                    p2. NAME AS name_edit,r.follow_id as follow_id FROM risk r
                    LEFT OUTER JOIN pro_risk pr ON r.pro_risk_id = pr.pro_risk_id
                    LEFT OUTER JOIN pro_risk_detail prd ON r.pro_risk_detail_id = prd.pro_risk_detail_id
                    LEFT OUTER JOIN pro_risk_sub_detail prsd ON r.pro_risk_sub_detail_id = prsd.pro_risk_sub_detail_id
                    LEFT OUTER JOIN dep ON r.dep_id = dep.dep_id LEFT OUTER JOIN profile p ON r.user_id = p.user_id
                    LEFT OUTER JOIN profile p2 ON r.edit_user_id = p2.user_id LEFT OUTER JOIN follow f ON r.follow_id = f.follow_id
                    LEFT OUTER JOIN born b on r.born_id=b.born_id JOIN matrix m ON m.born_id = r.born_id and m.severity_level = r.severity_level ";

    if(isset($_GET['stdate'])){$stdate=$_GET['stdate'];}else{$stdate="";}
    if(isset($_GET['endate'])){$endate=$_GET['endate'];}else{$endate="";}
        
    if($stdate !="" && $endate !=""){
        $sql.=" Where (r.date_risk BETWEEN '$stdate' AND '$endate')";
    }

    $sql.="and r.dep_id=$dep ORDER BY m.score DESC";
    
?>               

<div class="panel-heading" ><h4><i class="glyphicon glyphicon-list-alt" ></i> Matrix ของหน่วยงาน </h4></div>
<div class="panel-body">
<div class="panel panel-primary" style="width:50%;" align="center">
<div class="panel-body">  
<div class="form-group">
    <form action="matrixdep.php" method="get" name="search_form" >                              
        <div class='well'>        
            <div class="input-group"> 
            <div class="input-group-addon">                                                                
                วันที่ :
            </div>
                <input class="form-control" name="stdate" type="date" style="width:200px;" value="<?php echo($stdate);?>">
                                        
                <input class="form-control" name="endate" type="date" style="width:200px;" value="<?php echo($endate);?>">

                <input class="btn btn-primary" name="submit" type="submit" value="ค้นหา">
    
        </div>
        </div>
    </form>
    
</div>
</div>     
</div>
</div>

<?php require('connect.php');?>
<div class="panel-body">
<div class="panel panel-primary" style="width:100%" align="center">
<div class="panel-body">  
                    <div class="datagrid">
                        <div class="col-lg-12">
                                    <table class="table table-bordered" style="width:100%" align="center" cellspacing="0" cellpadding="2">
                                            <tr class="info">
                                                <td align="center">Severity Level</td>
                                                <td align="center">Born Name</td>
                                                <td align="center">วันที่เกิดความเสี่ยง</td>
                                                <td align="center">โปรแกรมความเสี่ยง</td>
                                                <td align="center">หมวดย่อย</td>
                                                <td align="center">รายละเอียดความเสี่ยง</td>
                                                <td align="center">แผนกที่เกิดความเสี่ยง</td>
                                                <td align="center">วิธีการแก้ปัญหา</td>
                                                <td align="center">สถานะ</td>
                                                <td align="center">ผู้รายงานความเสี่ยง</td>
                                                <td align="center">ผู้ทบทวนความเสี่ยง</td>                                                
                                            </tr>

                                            <?php while($record=mysqli_fetch_array($result)){?>
                                            <tr>                                                                                                                                             
                                                <td bgcolor="<?php echo($record['cname']);?>" align="center"><?php echo($record['severity_level']);?></td>
                                                <td bgcolor="<?php echo($record['cname']);?>" align="center"><?php echo($record['born_name']);?></td>
                                                <td bgcolor="<?php echo($record['cname']);?>" align="center"><?php echo($record['date_risk']);?></td>
                                                <td bgcolor="<?php echo($record['cname']);?>" align="center"><?php echo($record['pro_risk_name']);?></td>                                                
                                                <td bgcolor="<?php echo($record['cname']);?>" align="center"><?php echo($record['pro_risk_detail_name']);?></td>  
                                                <td bgcolor="<?php echo($record['cname']);?>" align="center"><?php echo($record['incident_detail']);?></td>  
                                                <td bgcolor="<?php echo($record['cname']);?>" align="center"><?php echo($record['dep_of_risk']);?></td>  
                                                <td bgcolor="<?php echo($record['cname']);?>" align="center"><?php echo($record['detail_prob']);?></td>  
                                                <td bgcolor="<?php echo($record['cname']);?>" align="center"><?php echo($record['follow_name']);?></td>  
                                                <td bgcolor="<?php echo($record['cname']);?>" align="center"><?php echo($record['name_report']);?></td>  
                                                <td bgcolor="<?php echo($record['cname']);?>" align="center"><?php echo($record['name_edit']);?></td>  
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