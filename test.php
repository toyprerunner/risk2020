<?php require('config.php');?>
<?php require('web_config.php');?>
<?php require('link_bootstrap.php');?>  

<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript">
    
$(function(){
 $("select#prorisk").change(function(){
  var datalist2 = $.ajax({ // รับค่าจาก ajax เก็บไว้ที่ตัวแปร datalist2
     url: "prorisk.php", // ไฟล์สำหรับการกำหนดเงื่อนไข
     data:"proriskid="+$(this).val(), // ส่งตัวแปร GET ชื่อ province ให้มีค่าเท่ากับ ค่าของ province
     async: false
  }).responseText;  
  $("select#proriskdetail").html(datalist2); // นำค่า datalist2 มาแสดงใน listbox ที่ 2 ที่ชื่อ amphur
  // ชื่อตัวแปร และ element ต่างๆ สามารถเปลี่ยนไปตามการกำหนด
 });
});
$(function(){
 $("select#proriskdetail").change(function(){
  var datalist3 = $.ajax({ // รับค่าจาก ajax เก็บไว้ที่ตัวแปร datalist3
     url: "proriskdetail.php", // ไฟล์สำหรับการกำหนดเงื่อนไข
     data:"proriskdetailid="+$(this).val(), // ส่งตัวแปร GET ชื่อ amphur ให้มีค่าเท่ากับ ค่าของ amphur
     async: false
  }).responseText;  
  $("select#prorisksubdetail").html(datalist3); // นำค่า datalist2 มาแสดงใน listbox ที่ 3 ที่ชื่อ tambol
  // ชื่อตัวแปร และ element ต่างๆ สามารถเปลี่ยนไปตามการกำหนด
 });
});

<table width="100%">
<?php   
   ?>
              <td align="right">จังหวัด</td>
              <td><select name="prorisk" id="prorisk">
               <option value="0">-- เลือกจังหวัด --</option>
                    <?php
                                            $sql="SELECT * FROM pro_risk ORDER BY pro_risk_id";                                            
                                            require('connect.php');
                                            while($record=mysqli_fetch_array($result))
                                            {
                                            ?>
                                            <option value="<?php echo $record["pro_risk_id"];?>"><?php echo $record["pro_risk_id"]." - ".$record["pro_risk_name"];?></option>
                                            <?php
                                            }
                                            ?>
              </select></td>
            </tr>
            
</table>

</script>