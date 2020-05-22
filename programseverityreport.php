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
                        
    <?php
    $uid=$_SESSION['authen']['uid'];
    $uteam=$_SESSION['authen']['uteam'];
    
    $sql="select pro_risk_id,pro_risk_name,
            sum(cA) as allA,
            sum(CB) as allB,
            sum(cC) as allC,
            sum(cD) as allD,
            sum(cE) as allE,
            sum(cF) as allF,
            sum(cG) as allG,
            sum(cH) as allH,
            sum(cI) as allI
            FROM
          (select
            pro_risk.pro_risk_id,pro_risk.pro_risk_name,
            if(risk.severity_level = 'A',1,0) as cA,
            if(risk.severity_level = 'B',1,0) as cB,
            if(risk.severity_level = 'C',1,0) as cC,
            if(risk.severity_level = 'D',1,0) as cD,
            if(risk.severity_level = 'E',1,0) as cE,
            if(risk.severity_level = 'F',1,0) as cF,
            if(risk.severity_level = 'G',1,0) as cG,
            if(risk.severity_level = 'H',1,0) as cH,
            if(risk.severity_level = 'I',1,0) as cI
          from pro_risk left OUTER JOIN risk on pro_risk.pro_risk_id = risk.pro_risk_id
          order by pro_risk.pro_risk_id) as allrisk
          GROUP BY pro_risk_name";   
    ?>               

<div class="panel-heading" ><h4><i class="glyphicon glyphicon-list-alt" ></i> รายงานอุบัติการ แยกตามโปรแกรมความเสี่ยง แยกระดับความรุนแรง </h4></div>

<?php require('connect.php');?>

<div class="panel-body">
<div class="panel panel-primary" style="width:100%" align="center">
<div class="panel-body">
    <div class="col-lg-12">

                    <div class="datagrid">
                        
                                    <table class="table table-bordered" id="datatable" style="width:100%" align="center" cellspacing="0" cellpadding="2">
                                            <tr class="info">
                                                <td align="center">#</td>
                                                <td align="center">โปรแกรมความเสี่ยงหลัก</td>
                                                <td align="center">ระดับความรุนแรง A</td>  
                                                <td align="center">ระดับความรุนแรง B</td>  
                                                <td align="center">ระดับความรุนแรง C</td>  
                                                <td align="center">ระดับความรุนแรง D</td>  
                                                <td align="center">ระดับความรุนแรง E</td>  
                                                <td align="center">ระดับความรุนแรง F</td>  
                                                <td align="center">ระดับความรุนแรง G</td>  
                                                <td align="center">ระดับความรุนแรง H</td>  
                                                <td align="center">ระดับความรุนแรง I</td>  
                                            </tr>

                                            <?php while($record=mysqli_fetch_array($result)){?>
                                            <tr>        
                                                <td><?php echo($record[0]);?></td>
                                                <td align="center"><?php echo($record[1]);?></td>
                                                <td align="center"><?php echo($record[2]);?></td>  
                                                <td align="center"><?php echo($record[3]);?></td>
                                                <td align="center"><?php echo($record[4]);?></td>
                                                <td align="center"><?php echo($record[5]);?></td>
                                                <td align="center"><?php echo($record[6]);?></td>
                                                <td align="center"><?php echo($record[7]);?></td>
                                                <td align="center"><?php echo($record[8]);?></td>
                                                <td align="center"><?php echo($record[9]);?></td>
                                                <td align="center"><?php echo($record[10]);?></td>
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