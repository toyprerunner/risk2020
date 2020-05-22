
<?php require('web_config.php');?>
<?php require('config.php');?>     

<?php
    require('authen_role.php');

    if($authenrole<1){
        require('authen_form.php');
    }else{        
            $uid=$_SESSION['authen']['uid'];
            $sql="SELECT
            SUM(CASE WHEN r.born_id=1  AND m.score=1 THEN 1 ELSE 0 END ) AS r1c1
            ,SUM(CASE WHEN r.born_id=2 AND m.score=2 THEN 1 ELSE 0 END ) AS r1c2
            ,SUM(CASE WHEN r.born_id=3 AND m.score=3 THEN 1 ELSE 0 END ) AS r1c3
            ,SUM(CASE WHEN r.born_id=4 AND m.score=4 THEN 1 ELSE 0 END ) AS r1c4
            ,SUM(CASE WHEN r.born_id=5 AND m.score=5 THEN 1 ELSE 0 END ) AS r1c5

            ,SUM(CASE WHEN r.born_id=1 AND m.score=2 THEN 1 ELSE 0 END ) AS r2c1
            ,SUM(CASE WHEN r.born_id=2 AND m.score=4 THEN 1 ELSE 0 END ) AS r2c2
            ,SUM(CASE WHEN r.born_id=3 AND m.score=6 THEN 1 ELSE 0 END ) AS r2c3
            ,SUM(CASE WHEN r.born_id=4 AND m.score=8 THEN 1 ELSE 0 END ) AS r2c4
            ,SUM(CASE WHEN r.born_id=5 AND m.score=10 THEN 1 ELSE 0 END ) AS r2c5

            ,SUM(CASE WHEN r.born_id=1 AND m.score=3 THEN 1 ELSE 0 END ) AS r3c1
            ,SUM(CASE WHEN r.born_id=2 AND m.score=6 THEN 1 ELSE 0 END ) AS r3c2
            ,SUM(CASE WHEN r.born_id=3 AND m.score=9 THEN 1 ELSE 0 END ) AS r3c3
            ,SUM(CASE WHEN r.born_id=4 AND m.score=12 THEN 1 ELSE 0 END ) AS r3c4
            ,SUM(CASE WHEN r.born_id=5 AND m.score=15 THEN 1 ELSE 0 END ) AS r3c5

            ,SUM(CASE WHEN r.born_id=1 AND m.score=4 THEN 1 ELSE 0 END ) AS r4c1
            ,SUM(CASE WHEN r.born_id=2 AND m.score=8 THEN 1 ELSE 0 END ) AS r4c2
            ,SUM(CASE WHEN r.born_id=3 AND m.score=12 THEN 1 ELSE 0 END ) AS r4c3
            ,SUM(CASE WHEN r.born_id=4 AND m.score=16 THEN 1 ELSE 0 END ) AS r4c4
            ,SUM(CASE WHEN r.born_id=5 AND m.score=20 THEN 1 ELSE 0 END ) AS r4c5

            ,SUM(CASE WHEN r.born_id=1 AND m.score=5 THEN 1 ELSE 0 END ) AS r5c1
            ,SUM(CASE WHEN r.born_id=2 AND m.score=10 THEN 1 ELSE 0 END ) AS r5c2
            ,SUM(CASE WHEN r.born_id=3 AND m.score=15 THEN 1 ELSE 0 END ) AS r5c3
            ,SUM(CASE WHEN r.born_id=4 AND m.score=20 THEN 1 ELSE 0 END ) AS r5c4
            ,SUM(CASE WHEN r.born_id=5 AND m.score=25 THEN 1 ELSE 0 END ) AS r5c5

        FROM risk r,matrix m,born b
        WHERE m.born_id = r.born_id and m.severity_level = r.severity_level AND r.born_id=b.born_id and r.user_id='$uid'";      
            
        require('connect.php');
        $record=mysqli_fetch_array($result);
        {
            $r1c1=$record['r1c1'];
            $r1c2=$record['r1c2'];
            $r1c3=$record['r1c3'];
            $r1c4=$record['r1c4'];
            $r1c5=$record['r1c5'];

            $r2c1=$record['r2c1'];
            $r2c2=$record['r2c2'];
            $r2c3=$record['r2c3'];
            $r2c4=$record['r2c4'];
            $r2c5=$record['r2c5'];
            
            $r3c1=$record['r3c1'];
            $r3c2=$record['r3c2'];
            $r3c3=$record['r3c3'];
            $r3c4=$record['r3c4'];
            $r3c5=$record['r3c5'];
            
            $r4c1=$record['r4c1'];
            $r4c2=$record['r4c2'];
            $r4c3=$record['r4c3'];
            $r4c4=$record['r4c4'];
            $r4c5=$record['r4c5'];

            $r5c1=$record['r5c1'];
            $r5c2=$record['r5c2'];
            $r5c3=$record['r5c3'];
            $r5c4=$record['r5c4'];
            $r5c5=$record['r5c5'];
        }
            require('unconn.php');
}
    

    $dormitory = array(); // ตัวแปรแกน x
    $id = array(); //ตัวแปรแกน y
    //sql สำหรับดึงข้อมูล จาก ฐานข้อมูล
    $sql ="select clinic_id,COUNT(risk_id) AS id1  from risk group by clinic_id";
    require('connect.php');    
    while($record=mysqli_fetch_array($result)) {
	
    //array_push คือการนำค่าที่ได้จาก sql ใส่เข้าไปตัวแปร array
    array_push($dormitory,$record['clinic_id']);
    array_push($id,$record['id1']);
    }
    require('unconn.php');
    
?>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>แผนผังประเมินความเสี่ยง</title></head>         
    <div class="container">
    <div class="panel-body">
    <div class="panel panel-info">
    <div class="panel-heading"><h4><i class="glyphicon glyphicon-list-alt"></i> Risk Assessment Matrix<small> แผนผังประเมินความเสี่ยง</small> </h4> </div>
    <div class="panel-body">   

    <table class="table table-bordered" cellspacing="0" cellpadding="2">

        <tr class="info">
  	<th class="">ระดับความรุนแรง</th>
            <td> 
                <center>1 ครั้ง/3เดือน</center>
            </td>
            <td>
                <center>2 ครั้ง/3เดือน</center>
            </td>
            <td> 
                <center>3 ครั้ง/3เดือน</center>
            </td>
            <td> 
                <center>4 ครั้ง/3เดือน</center>
            </td>
            <td> 
                <center>>5 ครั้ง/3เดือน</center>
            </td>
        </tr>

        <th class="">สูงมาก/หายนะ (I)</th>
            <td style="background-color:yellow">
                <center><a href="risk_list_matrix.php?r=1&c=5&b=yellow"><font color="red"><?php echo($r5c1);?></font></a></center>
            </td>
            <td style="background-color:#ff9900">
                <center><a href="risk_list_matrix.php?r=2&c=10&b=orange"><font color="red"><?php echo($r5c2);?></font></a></center>
            </td>
            <td style="background-color:#ff9900">
                <center><a href="risk_list_matrix.php?r=3&c=15&b=orange"><font color="red"><?php echo($r5c3);?></font></a></center>
            </td>
            <td style="background-color:red">
                <center><a href="risk_list_matrix.php?r=4&c=20&b=red"><?php echo($r5c4);?></a></center>
            </td>
            <td style="background-color:red">
            <center><a href="risk_list_matrixall.php.php?r=5&c=25&b=red"><?php echo($r5c5);?></a></center>
            </td>
        </tr>
        <tr>
  	<th class="">สูง/วิกฤต (G,H)</th>
            <td style="background-color:yellow">
                <center><a href="risk_list_matrix.php?r=1&c=4&b=yellow"><font color="red"><?php echo($r4c1);?></font></a></center>
            </td>
            <td style="background-color:yellow">
                <center><a href="risk_list_matrix.php?r=2&c=8&b=yellow"><font color="red"><?php echo($r4c2);?></font></a></center>
            </td>
            <td style="background-color:orange">
                <center><a href="risk_list_matrix.php?r=3&c=12&b=orange"><font color="red"><?php echo($r4c3);?></font></a></center>
            </td>
            <td style="background-color:orange">
                <center><a href="risk_list_matrix.php?r=4&c=16&b=orange"><font color="red"><?php echo($r4c4);?></font></a></center>
            </td>
            <td style="background-color:red">
                <center><a href="risk_list_matrix.php?r=5&c=20&b=red"><?php echo($r4c5);?></a></center>
            </td>
        </tr>
        <tr>
        <th class="">ปานกลาง (E,F)</th>
            <td style="background-color:green">
                <center><a href="risk_list_matrix.php?r=1&c=3&b=green"><font color="red"><?php echo($r3c1);?></font></a></center>
            </td>
            <td style="background-color:yellow">
                <center><a href="risk_list_matrix.php?r=2&c=6&b=yellow"><font color="red"><?php echo($r3c2);?></font></a></center>
            </td>
            <td style="background-color:yellow">
                <center><a href="risk_list_matrix.php?r=3&c=9&b=yellow"><font color="red"><?php echo($r3c3);?></font></a></center>
            </td>
            <td style="background-color:orange">
                <center><a href="risk_list_matrix.php?r=4&c=12&b=orange"><font color="red"><?php echo($r3c4);?></font></a></center>
            </td>
            <td style="background-color:orange">
                <center><a href="risk_list_matrix.php?r=5&c=15&b=orange"><font color="red"><?php echo($r3c5);?></font></a></center>
            </td>
        </tr>
        <tr>
            <th class="">ต่ำ/น้อย (C,D)</th>
            <td style="background-color:green">
                <center><a href="risk_list_matrix.php?r=1&c=2&b=green"><font color="red"><?php echo($r2c1);?></font></a></center>
            </td>
            <td style="background-color:yellow">
                <center><a href="risk_list_matrix.php?r=2&c=4&b=yellow"><font color="red"><?php echo($r2c2);?></font></a></center>
            </td>
            <td style="background-color:yellow">
                <center><a href="risk_list_matrix.php?r=3&c=6&b=yellow"><font color="red"><?php echo($r2c3);?></font></a></center>
            </td>
            <td style="background-color:yellow">
                <center><a href="risk_list_matrix.php?r=4&c=8&b=yellow"><font color="red"><?php echo($r2c4);?></font></a></center>
            </td>
            <td style="background-color:orange">
                <center><a href="risk_list_matrix.php?r=5&c=10&b=orange"><font color="red"><?php echo($r2c5);?></font></a></center>
            </td>
        </tr>
        <tr>
            <th class="">ไม่เป็นสาระสำคัญ (A,B)</th>
            <td style="background-color:green">
                <center><a href="risk_list_matrix.php?r=1&c=1&b=green"><font color="red"><?php echo($r1c1);?></font></a></center>
            </td>
            <td style="background-color:green">
                <center><a href="risk_list_matrix.php?r=2&c=2&b=green"><font color="red"><?php echo($r1c2);?></font></a></center>
            </td>
            <td style="background-color:green">
                <center><a href="risk_list_matrix.php?r=3&c=3&b=green"><font color="red"><?php echo($r1c3);?></font></a></center>
            </td>
            <td style="background-color:yellow">
                <center><a href="risk_list_matrix.php?r=4&c=4&b=yellow"><font color="red"><?php echo($r1c4);?></font></a></center>
            </td>
            <td style="background-color:yellow">
            <center><a href="risk_list_matrix.php?r=5&c=5&b=yellow"><font color="red"><?php echo($r1c5);?></font></a></center>
            </td>
        </tr>
    </table><br/>        
        <input class="btn btn-primary" type="button" name="Button" value="พิมพ์" onclick="javascript:window.print();">
 
    </div>
    </div>
    </div>
    </div>
    </body>
</html>