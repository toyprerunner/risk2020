<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Risk | Data Tables</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="./bootstrap/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="./bootstrap/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- DATA TABLES -->
        <link href="./bootstrap/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="./bootstrap/css/AdminLTE.css" rel="stylesheet" type="text/css" />        
    </head>
<body class="skin-black">
<?php
    if(isset($_GET['keyword'])){$keyword=$_GET['keyword'];}else{$keyword="";}
    $sql="SELECT
        risk.risk_id,
        risk.date_stamp,
        risk.incident_detail,
        pro_risk.pro_risk_name,
        pro_risk_detail.pro_risk_detail_name,
        pro_risk_sub_detail.pro_risk_sub_detail_name,
        incident.incident_name,
        clinic.clinic_name,
        born.born_name,
        source.source_name,
        dep.dep_name
        FROM
        risk
        INNER JOIN pro_risk ON risk.pro_risk_id = pro_risk.pro_risk_id
        INNER JOIN pro_risk_detail ON risk.pro_risk_detail_id = pro_risk_detail.pro_risk_detail_id
        INNER JOIN pro_risk_sub_detail ON risk.pro_risk_sub_detail_id = pro_risk_sub_detail.pro_risk_sub_detail_id
        INNER JOIN incident ON risk.incident_id = incident.incident_id
        INNER JOIN born ON risk.born_id = born.born_id
        INNER JOIN clinic ON risk.clinic_id = clinic.clinic_id
        INNER JOIN source ON risk.source_id = source.source_id
        INNER JOIN dep ON risk.dep_id = dep.dep_id";
    
    if(isset($_GET['keyword'])){$keyword=$_GET['keyword'];}else{$keyword="";}
    if(isset($_GET['stdate'])){$stdate=$_GET['stdate'];}else{$stdate="";}
    if(isset($_GET['endate'])){$endate=$_GET['endate'];}else{$endate="";}
    
    if($keyword !="" && $stdate !="" && $endate !=""){
        $sql.=" AND (risk_id='$keyword' OR pro_risk_name LIKE '%$keyword%' OR incident_name LIKE '%$keyword%') AND (date_stamp BETWEEN '$stdate' AND '$endate')";
    }elseif($keyword !=""){
        $sql.=" AND (risk_id='$keyword' OR pro_risk_name LIKE '%$keyword%' OR incident_name LIKE '%$keyword%')";
    }elseif($stdate !="" && $endate !=""){
        $sql.=" AND (date_stamp BETWEEN '$stdate' AND '$endate')";
    }
    
    $sql.=" ORDER BY risk.date_stamp desc";
    
?>

<form action="risk.php" method="get" name="search_form" >
    <input name="risk_id" type="hidden" value="<?php echo($keyword);?>">
    ค้นหา : <input class="form-control" name="keyword" type="text" style="width:400px;" value="<?php echo($keyword);?>">
    วันที่ : <input class="form-control" name="stdate" type="date" style="width:200px;" value="<?php echo($stdate);?>">
    ถึง : <input class="form-control" name="endate" type="date" style="width:200px;" value="<?php echo($endate);?>"></br />
    <input class="btn btn-primary" name="submit" type="submit" value="ค้นหา">
</form>
<?php require('connect.php');?>
    <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-body table-responsive">
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>จัดการ</th>
                                                <th>เลขที่บันทึก</th>
                                                <th>วันที่</th>
                                                <th>รายละเอียด</th>
                                                <th>ความเสี่ยงหลัก</th>
                                                <th>ความเสี่ยงย่อย</th>
                                                <th>กระบวนการ</th>
                                                <th>อุบัติการณ์</th>
                                                <th>ประเภทคลินิก</th>
                                                <th>ลักษณะการเกิด</th>      
                                                <th>การแก้ปัญหาเบื้องต้น</th>    
                                                <th>หน่วยงานที่เกิด</th>    
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while($record=mysqli_fetch_array($result)){?>
                                            <tr>
                                                <td>
                                                    <a href="risk_detail.php?risk_id=<?php echo($record[0]);?>">ดู</a> <br/>           
                                                    <a href="risk_form.php?risk_id=<?php echo($record[0]);?>">แก้ไข</a><br/>
                                                    <a href="javascript:rmdoc('<?php echo($record[0]);?>');">ลบ</a>
                                                </td>                                                
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
                                                <td><?php echo($record[10]);?></td>
                                            </tr>                                                                                      
                                        </tbody>
                                        <?php } ?> 
                                    </table>
                                    
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->                          
                        </div>
                    </div>

                </section><!-- /.content -->

    <?php require('unconn.php');?>
        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="./bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- DATA TABES SCRIPT -->
        <script src="./bootstrap/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="./bootstrap/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <!-- page script -->
        <script src="./bootstrap/js/AdminLTE/app.js" type="text/javascript"></script>
        
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
            function rmdoc(v1){
                var url="risk_delete.php?risk_id=" + v1;
                var r=confirm("ยืนยันการลบข้อมูล");
                if(r==true){window.location.href=url;}
            }
        </script>

</body>
</html>