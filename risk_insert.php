<?php session_start(); ?>
<?php require('config.php');?>
<html>
<head>
<!--<meta HTTP-EQUIV="Refresh" CONTENT="1;URL=risk.php" charset=utf-8" />-->
<title>Risk</title>
</head>
<body>
<?php
    require('authen_role.php');
    if($authenrole<1){
?>
<script language="javascript">
    alert('กรุณาลงทะเบียนเข้าสู่ระบบ');
    window.location.replace("authen_remove.php");
</script>
<?php    
    exit();
    }
?>
            
<?php
        $date_stamp=$_POST['date_stamp'];
        $incident_detail=$_POST['incident_detail'];
        $prorisk=$_POST['prorisk'];
        $proriskdetail=$_POST['proriskdetail'];      
        $clinic=$_POST['clinic'];
	$severity=$_POST['severity'];
	$date_risk = $_POST['date_risk'];
        $born=$_POST['born'];
        $source=$_POST['source'];
	$detail_prob = $_POST['detail_prob'];
        $dep=$_POST['dep'];
        $team=$_POST['team']; 
        $num =$_POST['num'];
        $uid=$_POST['uid'];
    
   
        $sql="INSERT INTO risk(date_stamp,incident_detail,pro_risk_id,pro_risk_detail_id,clinic_id,severity_level,date_risk,born_id,source_id,detail_prob,dep_id,user_id,team_id,num) 
        VALUES('$date_stamp','$incident_detail','$prorisk','$proriskdetail','$clinic','$severity','$date_risk','$born','$source','$detail_prob','$dep','$uid','$team','$num')";

        require('connect.php');
        //echo "บันทึกเรียบร้อยแล้ว !";	
       if($result==1){
            $v1=1;
            $msg="การบันทึกข้อมูลเสร็จสิ้น";
            $sql="select line_token from setup";
            require('connect.php');
            $record=mysqli_fetch_array($result);
            $linetoken = $record[0];
            define('LINE_API',"https://notify-api.line.me/api/notify");
            define('LINE_TOKEN',$linetoken);
                
                
                $txt1 = 'มีการรายงานความเสี่ยงในระบบ วันที่ : '.$date_stamp.' เนื้อหา : '.$incident_detail.' ระดับ : '.$severity.' หน่วยงาน : '.$dep.' ผู้รายงาน : '.$uid ;

                $message_send = $txt1;      //.' '.$txt2.' '.$txt3.' '.$txt4.' '.$txt5. ' '.$txt6 ;

                echo $message_send ;

                function notify_message($message){

                    $queryData = array('message' => $message);
                    $queryData = http_build_query($queryData,'','&');
                    $headerOptions = array(
                        'http'=>array(
                            'method'=>'POST',
                            'header'=> "Content-Type: application/x-www-form-urlencoded\r\n"
                                          ."Authorization: Bearer ".LINE_TOKEN."\r\n"
                                      ."Content-Length: ".strlen($queryData)."\r\n",
                            'content' => $queryData
                        )
                    );
                    $context = stream_context_create($headerOptions);
                    $result = file_get_contents(LINE_API,FALSE,$context);
                    $res = json_decode($result);
                        return $res;
                }

                $res = notify_message($message_send);
                var_dump($res);
        }else{
            $v1=0;
            $msg="การบันทึกข้อมูลผิดพลาด";
        }
            require('unconn.php'); 

?>
<script language="javascript">
    var v1=<?php echo($v1);?>;
    alert('<?php echo($msg);?>');
    if(v1==1){
        window.location.replace("risk.php");
    }else{
        window.history.back();
    }
</script>
</body>
</html>