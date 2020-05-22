<html>
<head>
    <meta charset="UTF-8">
    <title>LinkGate</title>
</head>
<body>
    
<?php session_start(); 
header("Content-type: application/vnd.ms-excel");
// header('Content-type: application/csv'); //*** CSV ***//
header("Content-Disposition: attachment; filename=reportrisk.xls");
//https://www.thaicreate.com/php/php-application-vnd.ms-excel.html
?>
<?php
require('config.php');
require('authen_role.php');

if($authenrole<1){
        require('authen_form.php');
    }else{
?>
<?php
$stdate=$_GET['str'];
$endate=$_GET['stp'];                            
                                            if(isset($_GET['keyword'])){$keyword=$_GET['keyword'];}else{$keyword="";}
                                            if(isset($_GET['str'])){$stdate=$_GET['str'];}else{$stdate="";}
                                            if(isset($_GET['stp'])){$endate=$_GET['stp'];}else{$endate="";}
                                                                                      
                                            $sql="SELECT
                                                risk.risk_id,
                                                risk.date_stamp,
                                                risk.incident_detail,
                                                pro_risk.pro_risk_name,
                                                pro_risk_detail.pro_risk_detail_name,        
                                                clinic.clinic_name,
                                                born.born_name,
                                                source.source_name,
                                                dep.dep_name,files
                                                FROM
                                                risk
                                                LEFT OUTER JOIN pro_risk ON risk.pro_risk_id = pro_risk.pro_risk_id
                                                LEFT OUTER JOIN pro_risk_detail ON risk.pro_risk_detail_id = pro_risk_detail.pro_risk_detail_id
                                                LEFT OUTER JOIN born ON risk.born_id = born.born_id
                                                LEFT OUTER JOIN clinic ON risk.clinic_id = clinic.clinic_id
                                                LEFT OUTER JOIN source ON risk.source_id = source.source_id
                                                LEFT OUTER JOIN dep ON risk.dep_id = dep.dep_id";  

                                            

                                            //$sql.=" where risk.edit_dep_id is not null and risk.follow_id = 1 and risk.review_id=1";

                                            if($keyword !="" && $stdate !="" && $endate !=""){
                                                $sql.=" where (risk_id='$keyword' OR pro_risk_name LIKE '%$keyword%' ) AND (date_stamp BETWEEN '$stdate' AND '$endate')";
                                            }elseif($keyword !=""){
                                                $sql.=" where (risk_id='$keyword' OR pro_risk_name LIKE '%$keyword%')";
                                            }elseif($stdate !="" && $endate !=""){
                                                $sql.=" where (date_stamp BETWEEN '$stdate' AND '$endate')";
                                            }

                                            $sql.=" ORDER BY risk.date_stamp desc";    
                                         
                                            //echo $sql; exit;
                                        require('connect.php');                                       
                                       
                                    ?>
                                                                <table class="table table-bordered" cellspacing="0" cellpadding="2">
                                                            <tr class="info">
                                                                <td >เลขที่บันทึก</td>
                                                                <td >วันที่</td>
                                                                <td >รายละเอียด</td>
                                                                <td >ความเสี่ยงหลัก</td>
                                                                <td >ความเสี่ยงย่อย</td>
                                                                <td >ประเภทคลินิก</td>
                                                                <td >ลักษณะการเกิด</td>      
                                                                <td >การแก้ปัญหาเบื้องต้น</td>    
                                                                <td >หน่วยงานที่เกิด</td>    
                                                                <td >ไฟล์</td>
                                                            </tr>

                                                            <?php while($record=mysqli_fetch_array($result)){?>
                                                            <tr bgcolor="<?php if($record[9]!=""){echo "#E9967A";}?>">                                             
                                                                <td><?php echo($record[0]);?></td>
                                                                <td><?php echo date_format(date_create($record[1]),"d/m/Y");?></td>
                                                                <td><?php echo($record[2]);?></td>
                                                                <td><?php echo($record[3]);?></td>
                                                                <td><?php echo($record[4]);?></td>
                                                                <td><?php echo($record[5]);?></td>
                                                                <td><?php echo($record[6]);?></td>
                                                                <td><?php echo($record[7]);?></td>
                                                                <td><?php echo($record[8]);?></td>

                                                                <?php if($record[9] == "") { ?>
                                                                    <td>No Data</td>
                                                                <?php }else{ ?>
                                                                    <td><a href="./<?php echo($record[9]);?>" target="_blank">เอกสาร</a></td>   
                                                                <?php }
                                                                    ?>


                                                            </tr>                                                                                      

                                                        <?php } ?> 
                                                    </table>   
    <?php } ?>
</body>
</html>