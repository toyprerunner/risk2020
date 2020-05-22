<?php session_start(); ?>
<?php require('config.php');?>
    
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Risk</title>
</head>

<body>

<?php
    if(isset($_GET['risk_id'])){$risk_id=$_GET['risk_id'];}else{$risk_id="";}
    $sql="SELECT * from risk where risk_id='$risk_id'";
    require('connect.php');
    $record=mysqli_fetch_array($result);
    $risk_id=$record[0];
    $uid=$_SESSION['authen']['uid'];
    $date_delete=date("Y-m-d");
    require('unconn.php');

    $sql="insert into log_delete(risk_id,user_id,date_delete) values('$risk_id','$uid','$date_delete')";

    require('connect.php'); 

    $sql="DELETE FROM risk where risk_id='$risk_id'";
    require('connect.php');
    if($result==1){
        $v1=1;
        $msg="การลบข้อมูลเสร็จสิ้น";
        $sql="select line_token from setup";
            require('connect.php');
            $record=mysqli_fetch_array($result);
            $linetoken = $record[0];
            define('LINE_API',"https://notify-api.line.me/api/notify");
            define('LINE_TOKEN',$linetoken);
                
                
                $txt1 = 'มีการลบรายงานความเสี่ยงในระบบ วันที่ : '.$date_delete.' รหัส : '.$risk_id.' รหัสผู้ใช้ที่ลบ : '.$uid ;

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
        $msg="การลบข้อมูลผิดพลาด";
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

