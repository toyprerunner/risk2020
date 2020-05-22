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
    
    $sql="select
            sum(countab) as nearmiss,
            sum(countci) as miss
            FROM
            (select
            if(severity_level BETWEEN 'A' and 'D',1,0) as countab,
            if(severity_level BETWEEN 'E' and 'I',1,0) as countci
          from risk) as allrisk";   
?>               

<div class="panel-heading" ><h4><i class="glyphicon glyphicon-list-alt" ></i> รายงานอุบัติการ Miss and Near Miss </h4></div>

<?php require('connect.php');?>

<div class="panel-body">
<div class="panel panel-primary" style="width:100%" align="center">
<div class="panel-body">
    <div class="col-lg-12">
    <div id="container" style="width:80%"></div>
                    <div class="datagrid">
                        
                                    <table class="table table-bordered" id="datatable" style="width:80%" align="center" cellspacing="0" cellpadding="2">
                                            <tr class="info">
                                                <td align="center">#</td>
                                                <td align="center">เกือบพลาด (NearMiss)</td>
                                                <td align="center">พลาด (Miss)</td>                                                  
                                            </tr>

                                            <?php while($record=mysqli_fetch_array($result)){?>
                                            <tr>        
                                                <td align="center">#</td>
                                                <td align="center"><?php echo($record[0]);?></td>
                                                <td align="center"><?php echo($record[1]);?></td>                                                  
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
        
        <script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/data.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        
    <script>
    
    $(function () {
                
        $('#container').highcharts({
            data: {
                //กำหนดให้ ตรงกับ id ของ table ที่จะแสดงข้อมูล
                table: 'datatable'
            },
            chart: {
                type: 'column'
            },
            title: {
                text: 'อุบัติการณ์'
            },
            yAxis: {
                allowDecimals: false,
                title: {
                    text: 'จำนวนอุบัติการณ์'
                }
            },
            tooltip: {
                formatter: function () {
                    return '<b>' + this.series.name + '</b><br/>' +
                        this.point.y; + ' ' + this.point.name.toLowerCase();
                }
            }
        });
    });
    
    </script>
        
    </body>
</html>