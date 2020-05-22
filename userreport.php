<?php session_start(); ?>
<?php require('web_config.php');?>
<?php require('config.php');?>
<?php 
    $sql="SELECT
            COUNT(*) AS total,
            SUM(CASE WHEN (follow_id <>1 or follow_id is NULL) THEN 1 ELSE 0 END) as un
            ,SUM(CASE WHEN date_stamp=DATE(now()) THEN 1 ELSE 0 END) as date
             FROM risk";
    
        require('connect.php');
        $record=mysqli_fetch_array($result);{
            $rtotal=$record['total'];
            $run=$record['un'];
            $rdate=$record['date'];
        }
        require('unconn.php');
    ?>
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
        if($userlevel==1 or $userlevel==2 or $userlevel==3 or $userlevel==5){
            require 'navigator.php';
            $uid=$_SESSION['authen']['uid'];
            if(isset($_GET['keyword'])){$keyword=$_GET['keyword'];}else{$keyword="";}
            $sql="SELECT
                risk.risk_id,
                risk.date_risk,
                pro_risk.pro_risk_name,
                pro_risk_detail.pro_risk_detail_name,
                risk.incident_detail,
                dep.dep_name,
                risk.method,
                follow.follow_name,
                `profile`.`name`
                FROM
                risk
                LEFT OUTER JOIN pro_risk ON risk.pro_risk_id = pro_risk.pro_risk_id
                LEFT OUTER JOIN pro_risk_detail ON risk.pro_risk_detail_id = pro_risk_detail.pro_risk_detail_id AND pro_risk_detail.pro_risk_id = pro_risk.pro_risk_id
                LEFT OUTER JOIN dep ON risk.dep_id = dep.dep_id
                LEFT OUTER JOIN follow ON risk.follow_id = follow.follow_id
                LEFT OUTER JOIN `user` ON risk.user_id = `user`.id
                LEFT OUTER JOIN `profile` ON `profile`.user_id = `user`.id";
            $sql.=" where risk.user_id='$uid'";
            if(isset($_GET['keyword'])){$keyword=$_GET['keyword'];}else{$keyword="";}
            if(isset($_GET['stdate'])){$stdate=$_GET['stdate'];}else{$stdate="";}
            if(isset($_GET['endate'])){$endate=$_GET['endate'];}else{$endate="";}

            if($keyword !="" && $stdate !="" && $endate !=""){
                $sql.=" AND (risk_id='$keyword' OR pro_risk_name LIKE '%$keyword%' ) AND (date_stamp BETWEEN '$stdate' AND '$endate')";
            }elseif($keyword !=""){
                $sql.=" AND (risk_id='$keyword' OR pro_risk_name LIKE '%$keyword%' )";
            }elseif($stdate !="" && $endate !=""){
                $sql.=" AND (date_stamp BETWEEN '$stdate' AND '$endate')";
            }
            $sql.=" ORDER BY risk.date_stamp desc"; 
            ?>
            <div class="panel-body">
            <div class="panel panel-info">
            <div class="panel-heading"><h4><i class="glyphicon glyphicon-list-alt"></i> รายการความเสี่ยงจำนวนความเสี่ยงรายบุคคล </h4></div>
            <div class="panel-body">    
                <form action="userreport.php" method="get" name="search_form" >
                <input name="risk_id" type="hidden" value="<?php echo($keyword);?>">
                <div class="form-group">
                    <div class="row">
                    <div class="col-md-8">
                    <div class="input-group">                                    
                        <div class="input-group-addon">                                                                
                            ค้นหา :
                        </div>                                    
                            <input class="form-control" name="keyword" type="text" style="width:200px;" value="<?php echo($keyword);?>">

                        <div class="input-group-addon">                                                                
                            วันที่ :
                        </div>                                    
                            <input class="form-control" name="stdate" type="date" style="width:200px;" value="<?php echo($stdate);?>">

                        <div class="input-group-addon">                                                                
                            ถึง :
                        </div>                                    
                            <input class="form-control" name="endate" type="date" style="width:200px;" value="<?php echo($endate);?>">                                                 

                    </div><br/>
                        <input class="btn btn-primary" name="submit" type="submit" value="ค้นหา">
                    </div>

                    </div>
                </div>
            </form>
            <?php require('connect.php');?>

                                <div class="datagrid">                       

                                                <table class="table table-bordered" cellspacing="0" cellpadding="2">
                                                        <tr class="info">
                                                            <td >วันที่เกิดความเสี่ยง</td>
                                                            <td >โปรแกรมความเสี่ยง</td>
                                                            <td >หมวดย่อย</td>
                                                            <td >รายละเอียดความเสี่ยง</td>
                                                            <td >หน่วยงานที่เกิด</td>
                                                            <td >การแก้ปัญหา</td>
                                                            <td >สถานะ</td>      
                                                            <td >ผู้รายงาน</td>    
                                                        </tr>

                                                        <?php while($record=mysqli_fetch_array($result)){?>
                                                        <tr>
<!--                                                            <td>
                                                                <a href="risk_detail.php?risk_id=<?php echo($record[0]);?>">ดู</a>    
                                                            </td>                                                -->
                                                            <td><?php echo date_format(date_create($record[1]),"d/m/Y");?></td>                                                
                                                            <td><?php echo($record[2]);?></td>
                                                            <td><?php echo($record[3]);?></td>
                                                            <td><?php echo($record[4]);?></td>
                                                            <td><?php echo($record[5]);?></td>
                                                            <td><?php echo($record[6]);?></td>
                                                            <td><?php echo($record[7]);?></td>
                                                            <td><?php echo($record[8]);?></td>
                                                        </tr>                                                                                      

                                                    <?php } ?> 
                                                </table>     
                                </div>
            </div>
            </div>
            </div>  
                <?php
                    require 'foot.php';
                ?>  
                    <?php require('unconn.php');?> 
       <?php }else{
            require('authen_form.php');
        }       
?>    
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