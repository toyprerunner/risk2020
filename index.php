<?php session_start(); ?>
<?php require('web_config.php');?>
<?php require('config.php');?>
<?php 

    ?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Risk Assessment Matrix | Dashboard</title>
    </head>
<body>
<?php

    require('authen_role.php');

    if($authenrole<1){
        require('authen_form.php');
    }else{
        if($userlevel==3 or $userlevel==5){
            require 'navigator.php';
            $sql="SELECT
            COUNT(*) AS total,
            SUM(CASE WHEN (follow_id is null or follow_id in('2','3')) THEN 1 ELSE 0 END) as un
            ,SUM(CASE WHEN date_stamp=DATE(now()) THEN 1 ELSE 0 END) as date
             FROM risk";
    
        require('connect.php');
        $record=mysqli_fetch_array($result);{
            $rtotal=$record['total'];
            $run=$record['un'];
            $rdate=$record['date'];
}?>
    <div class="container">
    <div class="content">
            <div class="panel panel-primary">
            <div class="panel-body">             
                           
                    <div class="row">
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>
                                        <?=$rtotal;?>
                                    </h3>
                                    <p>
                                        ความเสี่ยงทั้งหมด
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="risk_list_day.php" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>
                                        <?=$rdate;?>
                                    </h3>
                                    <p>
                                        ความเสี่ยงในวัน
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-ios7-alarm-outline"></i>
                                </div>
                                <a href="risk_list_inday.php" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3>
                                        <?=$run;?>
                                    </h3>
                                    <p>
                                        ความเสี่ยงที่ไม่ได้แก้ไข
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-ios7-pricetag-outline"></i>
                                </div>
                                <a href="risk_list_not.php" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                    </div>
         
            </div>
            </div>
            </div>
            </div>
        <?php
            require 'showindex.php';
        }else{
            require 'navigator.php';
            $uid=$_SESSION['authen']['uid'];
            $sql="SELECT
            COUNT(*) AS total,
            SUM(CASE WHEN (follow_id <>1 or follow_id is NULL) THEN 1 ELSE 0 END) as un
            ,SUM(CASE WHEN date_stamp=DATE(now()) THEN 1 ELSE 0 END) as date
             FROM risk where user_id='$uid'";

        require('connect.php');
        $record=mysqli_fetch_array($result);{
            $rtotal=$record['total'];
            $run=$record['un'];
            $rdate=$record['date'];
        }
        require('unconn.php');
        ?>
    
        <div class="container">
            <div class="panel panel-primary">
            <div class="panel-body">             
                 
                    <div class="row">
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>
                                        <?=$rtotal;?>
                                    </h3>
                                    <p>
                                        ความเสี่ยงทั้งหมด
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="risk_list_day.php" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>
                                        <?=$rdate;?>
                                    </h3>
                                    <p>
                                        ความเสี่ยงในวัน
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-ios7-alarm-outline"></i>
                                </div>
                                <a href="risk_list_inday.php" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3>
                                        <?=$run;?>
                                    </h3>
                                    <p>
                                        ความเสี่ยงที่ไม่ได้แก้ไข
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-ios7-pricetag-outline"></i>
                                </div>
                                <a href="risk_list_not.php" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                    </div>

            </div>
            </div>
            </div>          
        <?php
            require 'showindex1.php';
    }}?>               

    <?php
        require 'foot.php';
    ?>  
</body>
</html>