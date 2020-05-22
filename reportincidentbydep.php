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
        if($userlevel==1 or $userlevel==3 or $userlevel==5){
            require 'navigator.php';
            ?>
            <?php
    $sql = "select dep_name from dep where dep_id='$userdep'";
    require('connect.php');
    $record=mysqli_fetch_array($result);
    $depname=$record[0];
    
    if($userlevel==1 or $userlevel==3){
        $uid=$_SESSION['authen']['uid'];
        $dep_name=$depname;
    if(isset($_GET['keyword'])){$keyword=$_GET['keyword'];}else{$keyword="";}
    $uid=$_SESSION['authen']['uid'];
    $uteam=$_SESSION['authen']['uteam'];
    
    $sql="select l_level.severity_level,count(risk.severity_level) as numx
            from l_level LEFT outer JOIN risk on  risk.severity_level = l_level.severity_level";
    $sql.=" where risk.dep_id='$userdep'";

    if(isset($_GET['stdate'])){$stdate=$_GET['stdate'];}else{$stdate="";}
    if(isset($_GET['endate'])){$endate=$_GET['endate'];}else{$endate="";}
        
    if($stdate !="" && $endate !=""){
        $sql.=" and (risk.date_stamp BETWEEN '$stdate' AND '$endate')";
    }
    $sql.=" GROUP BY l_level.severity_level";
    }elseif($userlevel==5){
        $uid=$_SESSION['authen']['uid'];
        $dep_name = 'ผู้ดูแลระบบ';
    if(isset($_GET['keyword'])){$keyword=$_GET['keyword'];}else{$keyword="";}
    $uid=$_SESSION['authen']['uid'];
    $uteam=$_SESSION['authen']['uteam'];
    
    $sql="select l_level.severity_level,count(risk.severity_level) as numx
            from l_level LEFT outer JOIN risk on  risk.severity_level = l_level.severity_level"; 

    if(isset($_GET['stdate'])){$stdate=$_GET['stdate'];}else{$stdate="";}
    if(isset($_GET['endate'])){$endate=$_GET['endate'];}else{$endate="";}
        
    if($stdate !="" && $endate !=""){
        $sql.=" where (risk.date_stamp BETWEEN '$stdate' AND '$endate')";
    }
    $sql.=" GROUP BY l_level.severity_level";
    }else{
        require('authen_form.php');
    }        

    //echo $sql; exit;
?>               
<?php require('connect.php');?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <title>Claim</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  </head>
  <body>
      <div class="container">
          <div class="panel-body">
            <div class="panel panel-info">
                <div class="panel-heading"><h4><i class="glyphicon glyphicon-list-alt"></i> รายงานความเสี่ยงแยกตามระดับความรุนแรง กลุ่มงาน <?php echo $dep_name; ?> <small> </small></h4> </div>
            <div class="panel-body"> 
                <form class="form-inline" action="reportincidentbydep.php" method="get" name="search_form" >                    
                    วันที่ : <input class="form-control" name="stdate" type="date" style="width:200px;" value="<?php echo($stdate);?>">
                    ถึง : <input class="form-control" name="endate" type="date" style="width:200px;" value="<?php echo($endate);?>">
                    <input class="btn btn-primary" name="submit" type="submit" value="ค้นหา">
                </form>
            </div>    
		<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                <div class="table-responsive">
		<table class="table table-bordered" id="datatable" style="width:80%" align="center" cellspacing="0" cellpadding="2">
                                            <tr class="info">
                                                <td align="center">ระดับความรุนแรง</td>
                                                <td align="center">จำนวนความรุนแรง</td>                                                
                                            </tr>

                                            <?php while($record=mysqli_fetch_array($result)){?>
                                            <tr>                                                                                                                                             
                                                <td align="center"><?php echo($record[0]);?></td>
                                                <td align="center"><?php echo($record[1]);?></td>                                                
                                            </tr>                                                                                      

                                        <?php } ?> 
                                    </table>     
                </div>
      </div>
          </div>
      </div>
    <?php }else{
            require 'navigator.php';
        }
        
?>    
                     
    
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
				text: 'กราฟแสดงรายงานความเสี่ยงแยกตามระดับความรุนแรง'
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
    <?php } ?>
</html>