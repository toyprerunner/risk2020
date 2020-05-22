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
    if(isset($_GET['keyword'])){$keyword=$_GET['keyword'];}else{$keyword="";}
    $sql="SELECT b.born_name,COUNT(r.risk_id) as n,
            COUNT(if(r.severity_level='A',1,NULL)) as a,
            COUNT(if(r.severity_level='B',1,NULL)) as b,
            COUNT(if(r.severity_level='C',1,NULL)) as c,
            COUNT(if(r.severity_level='D',1,NULL)) as d,
            COUNT(if(r.severity_level='E',1,NULL)) as e,
            COUNT(if(r.severity_level='F',1,NULL)) as f,
            COUNT(if(r.severity_level='G',1,NULL)) as g,
            COUNT(if(r.severity_level='H',1,NULL)) as h,
            COUNT(if(r.severity_level='I',1,NULL)) as i,
            COUNT(if(r.severity_level='',1,NULL)) as o
            FROM risk r                    
            LEFT OUTER JOIN born b on r.born_id=b.born_id
             ";

    if(isset($_GET['stdate'])){$stdate=$_GET['stdate'];}else{$stdate="";}
    if(isset($_GET['endate'])){$endate=$_GET['endate'];}else{$endate="";}
        
    if($stdate !="" && $endate !=""){
        $sql.=" where (date_stamp BETWEEN '$stdate' AND '$endate')";
    }
    $sql.=" GROUP BY b.born_name";
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
            <div class="panel-heading"><h4><i class="glyphicon glyphicon-list-alt"></i> รายงานความเสี่ยงแยกตามลักษณะการเกิด <small> </small></h4> </div>
            <div class="panel-body"> 
                <form class="form-inline" action="reportlevelall.php" method="get" name="search_form" >                    
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
					<th>ลักษณะการเกิด</th>
					<th>จำนวนทั้งหมด</th>
					<th>A</th>
                                        <th>B</th>
                                        <th>C</th>
                                        <th>D</th>
                                        <th>E</th>
                                        <th>F</th>
                                        <th>G</th>
                                        <th>H</th>
                                        <th>I</th>
				</tr>
			</thead>
                        <?php
                            while($record = mysqli_fetch_array($result)){
                        ?>
			<tbody>
				<tr>
					<th><?php echo $record["born_name"];?></th>
                                        <td><?php echo $record["n"];?></td>
					<td><?php echo $record["a"];?></td>
					<td><?php echo $record["b"];?></td>
                                        <td><?php echo $record["c"];?></td>
                                        <td><?php echo $record["d"];?></td>
                                        <td><?php echo $record["e"];?></td>
                                        <td><?php echo $record["f"];?></td>
                                        <td><?php echo $record["g"];?></td>
                                        <td><?php echo $record["h"];?></td>
                                        <td><?php echo $record["i"];?></td>
				</tr>
			</tbody>
                            <?php } ?>
		</table>
                </div>
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
				text: 'กราฟแสดงรายงานความเสี่ยงแยกตามลักษณะการเกิด'
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