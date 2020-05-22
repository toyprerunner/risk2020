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
        if($userlevel==1 or $userlevel==2 or $userlevel==3 or $userlevel==5){
            require 'navigator.php';
            $uid=$_SESSION['authen']['uid'];
            if(isset($_GET['keyword'])){$keyword=$_GET['keyword'];}else{$keyword="";}
            $sql="SELECT
                dep.dep_name,
                COUNT(risk.risk_id) AS n,
                COUNT(
                        IF (risk.follow_id = '1', 1, NULL)
                ) AS fix,
                COUNT(
                        IF (risk.follow_id <> '1' or risk.follow_id is NULL, 1, NULL)
                ) AS nofix
                FROM
                        risk
                LEFT OUTER JOIN dep ON risk.dep_id = dep.dep_id ";

            if(isset($_GET['stdate'])){$stdate=$_GET['stdate'];}else{$stdate="";}
            if(isset($_GET['endate'])){$endate=$_GET['endate'];}else{$endate="";}

            if($stdate !="" && $endate !=""){
                $sql.=" where (date_stamp BETWEEN '$stdate' AND '$endate')";
            }
            $sql.=" GROUP BY dep.dep_name";
            $sql.=" ORDER BY risk.date_stamp desc";
            //echo $sql; exit;?>
            <?php require('connect.php');?>

            <html>
              <head>
                <meta charset="utf-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1">    
                <title>Claim</title>
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
              </head>
              <body>

                      <div class="panel-body">
                        <div class="panel panel-info">
                        <div class="panel-heading"><h4><i class="glyphicon glyphicon-list-alt"></i> รายงานความเสี่ยงแยกตามหน่วยงาน <small> </small></h4> </div>
                        <div class="panel-body"> 
                            <form class="form-inline" action="sumdep.php" method="get" name="search_form" >                    
                                วันที่ : <input class="form-control" name="stdate" type="date" style="width:200px;" value="<?php echo($stdate);?>">
                                ถึง : <input class="form-control" name="endate" type="date" style="width:200px;" value="<?php echo($endate);?>">
                                <input class="btn btn-primary" name="submit" type="submit" value="ค้นหา">
                            </form>
                        </div>    
                            <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                            <div class="table-responsive">
                            <table class="table table-sm table-hover" id="datatable">
                                    <thead>
                                            <tr>
                                                    <th>หน่วยงาน</th>
                                                    <th>จำนวนความเสี่ยงทั้งหมด</th>
                                                    <th>ความเสี่ยงที่แก้ไขแล้ว</th>
                                                    <th>ยังไม่ได้แก้ไข</th>
                                            </tr>
                                    </thead>
                                    <?php
                                        while($record = mysqli_fetch_array($result)){
                                    ?>
                                    <tbody>
                                            <tr>
                                                    <th><?php echo $record["dep_name"];?></th>
                                                    <td><?php echo $record["n"];?></td>
                                                    <td><?php echo $record["fix"];?></td>
                                                    <td><?php echo $record["nofix"];?></td>
                                            </tr>
                                    </tbody>
                                        <?php } ?>
                            </table>
                            </div>
                  </div>
                  </div>
                    <script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>
                    <script src="https://code.highcharts.com/highcharts.js"></script>
                    <script src="https://code.highcharts.com/modules/data.js"></script>
                    <script src="https://code.highcharts.com/modules/exporting.js"></script>

                    <script>

                    $(function () {

                            $('#container').highcharts({
                                    data: {
                                            table: 'datatable'
                                    },
                                    chart: {
                                            type: 'column'
                                    },
                                    title: {
                                            text: 'กราฟแสดงรายงานความเสี่ยงแยกตามหน่วยงาน'
                                    },
                                    yAxis: {
                                            allowDecimals: false,
                                            title: {
                                                    text: 'จำนวน(ราย)'
                                            }
                                    },

                                    tooltip: {
                                            formatter: function () {
                                                    return '<b>' + this.series.name + '</b><br/>' +
                                                            this.point.y + ' ' + this.point.name.toLowerCase();
                                            }
                                    }
                            });
                    });

                    </script>

              </body>
                    <?php
                        require 'foot.php';
                    ?>
    <?php    }else{
            require('authen_form.php');
        }
        
?>    
    <?php } ?>
</html>