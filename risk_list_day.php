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
            $sql="SELECT
            COUNT(*) AS total,
            SUM(CASE WHEN (follow_id is null or follow_id in('2','3')) THEN 1 ELSE 0 END) as un
            ,SUM(CASE WHEN date_stamp=DATE(now()) THEN 1 ELSE 0 END) as date
             FROM risk";
    
        require('connect.php');
        $record=mysqli_fetch_array($result);{
            $rtotal=$record['total'];
            $run=$record['un'];
            $rdate=$record['date'];
        }
        require('unconn.php');
        }else{
            require 'navigator.php';
            $uid=$_SESSION['authen']['uid'];
            $sql="SELECT
            COUNT(*) AS total,
            SUM(CASE WHEN (follow_id <>1 or follow_id is NULL) THEN 1 ELSE 0 END) as un
            ,SUM(CASE WHEN date_stamp=DATE(now()) THEN 1 ELSE 0 END) as date
             FROM risk where user_id='$uid'";

        require('connect.php');
        $record=mysqli_fetch_array($result);{
            $rtotal=$record['total'];
            $run=$record['un'];
            $rdate=$record['date'];
        }
        require('unconn.php');
        }
        
?>    
            <aside class="center-side">                
            <div class="panel-body">
            <div class="panel panel-primary">
            <div class="panel-body">             
                <section class="content">                    
                    <div class="row">
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>
                                        <?=$rtotal;?>
                                    </h3>
                                    <p>
                                        ความเสี่ยงทั้งหมด
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="risk_list_day.php" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>
                                        <?=$rdate;?>
                                    </h3>
                                    <p>
                                        ความเสี่ยงในวัน
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-ios7-alarm-outline"></i>
                                </div>
                                <a href="risk_list_inday.php" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3>
                                        <?=$run;?>
                                    </h3>
                                    <p>
                                        ความเสี่ยงที่ไม่ได้แก้ไข
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-ios7-pricetag-outline"></i>
                                </div>
                                <a href="risk_list_not.php" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                    </div>
                </section>  
            </div>
            </div>
            </div>
            
    <?php
    if($userlevel==3 or $userlevel==5){
    $uid=$_SESSION['authen']['uid'];
    if(isset($_GET['keyword'])){$keyword=$_GET['keyword'];}else{$keyword="";}
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
        INNER JOIN dep ON risk.dep_id = dep.dep_id";
  //  $sql.=" where risk.user_id='$uid'";
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
    //echo $sql; exit;
    }else{
        $uid=$_SESSION['authen']['uid'];
        if(isset($_GET['keyword'])){$keyword=$_GET['keyword'];}else{$keyword="";}
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
            INNER JOIN dep ON risk.dep_id = dep.dep_id";
      //  $sql.=" where risk.user_id='$uid'";
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
            $sql.=" AND risk.user_id='$uid'";
            $sql.=" ORDER BY risk.date_stamp desc"; 
        //    echo $sql; exit;
    }
?>               
                
<div class="panel-body">
<div class="panel panel-info">
<div class="panel-heading"><h4><i class="glyphicon glyphicon-list-alt"></i> รายการความเสี่ยง </h4></div>
<div class="panel-body">    
    <form action="risk_list_day.php" method="get" name="search_form" >
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
                
        </div>
        </div>
            <input class="btn btn-primary" name="submit" type="submit" value="ค้นหา">
        </div>
    </div>
</form>
<?php require('connect.php');?>
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
                                                <td><?php echo($record[0]);?></td>
                                                <td><?php echo date_format(date_create($record[1]),"d/m/Y");?></td>
                                                <td><?php echo($record[2]);?></td>
                                                <td><?php echo($record[3]);?></td>
                                                <td><?php echo($record[4]);?></td>
                                                <td><?php echo($record[5]);?></td>
                                                <td><?php echo($record[6]);?></td>
                                                <td><?php echo($record[7]);?></td>
                                                <td><?php echo($record[8]);?></td>
                                                <td><?php echo($record[9]);?></td>
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