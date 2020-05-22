<?php require('config.php');?>
<?php require('web_config.php');?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Risk</title>
</head>
<body>
<?php
    $risk_id=$_GET['risk_id'];
    require('risk_select.php');    
?> 
<div class="panel-body">
<div class="panel panel-primary">
<div class="panel-heading"><h4><i class="glyphicon glyphicon-list-alt"></i> รายละเอียดความเสี่ยง รหัส <?php echo $risk_id?></h4></div>
<div class="panel-body">  

    <table class="table table-bordered" >
        <tr class="info">
            <td>
                วันที่บันทึก :
            </td>
            <td>
                ความเสี่ยงหลัก :
            </td>
            <td>
                ความเสี่ยงย่อย :
            </td>
        </tr>        
        <tr >
            <td><?php echo($date_stamp);?></td>
            <td><?php echo($pro_risk_name);?></td>
            <td><?php echo($pro_risk_detail_name);?></td>
        </tr>    
        
    </table> 
        
    <table class="table table-bordered" >
        <tr class="info">
            <td>
                ประเภทคลินิก :
            </td>
            <td>
                ลักษณะการเกิด :
            </td>
            <td>
                การแก้ปัญหาเบื้องต้น :
            </td>
            <td>
                หน่วยงานที่เกิด :
            </td>
                
        </tr>
        <tr>
            <td><?php echo($clinic_name);?></td>
            <td><?php echo($born_name);?></td>
            <td><?php echo($source_name);?></td>
            <td><?php echo($dep_name);?></td>
        </tr>
    </table> 
    <table class="table table-bordered" >
        <tr class="info">
            <td>
                รายละเอียดเหตุการณ์ :
            </td>
        </tr>
        
        <tr>
            <td><?php echo($incident_detail);?></td>
        </tr>
    </table>   
<a class="btn btn-primary" href="risk_form.php?risk_id=<?php echo($risk_id);?>" role="button">แก้ไข</a>
<a class="btn btn-primary" href="javascript:rmdoc('<?php echo($risk_id);?>');">ลบ</a>
<a class="btn btn-primary" href="javascript:window.history.back();">กลับ</a>
<input class="btn btn-primary" type="button" name="Button" value="พิมพ์" onclick="javascript:window.print();">
<script language="javascript">
    function rmdoc(v1){
        var url="risk_delete.php?risk_id=" + v1;
        var r=confirm("ยืนยันการลบข้อมูล");
        if(r==true){window.location.href=url;}
    }
</script>
</div>
</div>
</div>
    <?php
        require 'foot.php';
    ?>  
</body>
</html>