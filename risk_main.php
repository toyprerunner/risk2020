<?php session_start(); ?>
<?php require('web_config.php');?>
<?php require('config.php');?>    
<?php
//            array_push($n, intval($d['c']));
//            array_push($na, $d['cn']);
require('authen_role.php');

if($authenrole<3){
    require('authen_form.php');
}else{
    $n = array();
    $na = array();
    $sql = "select count(*) as c,cl.clinic_name as cn  from risk r 
            join clinic cl ON r.clinic_id=cl.clinic_id 
            GROUP BY r.clinic_id";        
    
    require('connect.php');
    while ($record=mysqli_fetch_array($result)){
            $data[] = $record;            
        }
        require('unconn.php');
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Risk Assessment Matrix | Dashboard</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        
        <!-- bootstrap 3.0.2 -->
        <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="./bootstrap/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="./bootstrap/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Morris chart -->
        <link href="./bootstrap/css/morris/morris.css" rel="stylesheet" type="text/css" />
        <!-- jvectormap -->
        <link href="./bootstrap/css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <!-- fullCalendar -->
        <link href="./bootstrap/css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href="./bootstrap/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="./bootstrap/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="./bootstrap/css/AdminLTE.css" rel="stylesheet" type="text/css" />    
        
    </head>
    <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="index.php" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                Risk
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="index.php" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">                        
                        
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span>ข้อมูลผู้ใช้งาน <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="img/avatar3.png" class="img-circle" alt="User Image" />
                                    <p>
                                        สวัสดี
                                        <small></small>
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                <li class="user-body">
                                    <div class="col-xs-4 text-center">
                                        <a href="#"></a>
                                    </div>                                
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">รายละเอียด User</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="#" class="btn btn-default btn-flat">ออก</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="img/avatar3.png" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p>สวัสดี, xxx</p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="active">
                            <a href="index.php">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>                        
                        <li>
                            <a href="risk_main.php">
                                <i class="fa fa-th"></i> <span>รายงานความเสี่ยง</span>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-bar-chart-o"></i>
                                <span>จัดการความเสี่ยง</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="risk.php"><i class="fa fa-angle-double-right"></i> แก้ไขความเสี่ยง</a></li>
                                <li><a href="risk.php"><i class="fa fa-angle-double-right"></i> แก้ไขความเสี่ยงทั้งหมด</a></li>
                                <li><a href="risk.php"><i class="fa fa-angle-double-right"></i> แก้ไขความเสี่ยงทีมคร่อมสายงาน</a></li>
                                <li><a href="risk.php"><i class="fa fa-angle-double-right"></i> ลบความเสี่ยง</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-laptop"></i>
                                <span>ศูนย์รับเรื่อง</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="pages/UI/general.html"><i class="fa fa-angle-double-right"></i> ทบทวนความเสี่ยง</a></li>
                                <li><a href="pages/UI/icons.html"><i class="fa fa-angle-double-right"></i> ศูนย์รับเรื่องทบทวน</a></li>                                
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-edit"></i> <span>รายงาน</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="pages/forms/general.html"><i class="fa fa-angle-double-right"></i> จำนวนความเสี่ยงรายบุคคล/บุคคลในหน่วยงาน</a></li>
                                <li><a href="pages/forms/advanced.html"><i class="fa fa-angle-double-right"></i> จำนวนความเสี่ยงรายบุคคล/บุคคลในทีม</a></li>
                                <li><a href="pages/forms/editors.html"><i class="fa fa-angle-double-right"></i> สรุปจำนวนความเสี่ยงแยกตามหน่วยงาน</a></li>
                                <li><a href="pages/forms/editors.html"><i class="fa fa-angle-double-right"></i> สรุปจำนวนความเสี่ยงตามทีมคร่อมสายงาน</a></li>
                                <li><a href="pages/forms/editors.html"><i class="fa fa-angle-double-right"></i> รายงาน Matrix ภาพรวม</a></li>
                                <li><a href="pages/forms/editors.html"><i class="fa fa-angle-double-right"></i> รายงาน Matrix หน่วยงาน</a></li>
                                <li><a href="pages/forms/editors.html"><i class="fa fa-angle-double-right"></i> รายงานอุบัติการณ์ Miss And Near Miss</a></li>
                                <li><a href="pages/forms/editors.html"><i class="fa fa-angle-double-right"></i> รายงานอุบัติการณ์แยกระดับความรุนแรง</a></li>
                                <li><a href="pages/forms/editors.html"><i class="fa fa-angle-double-right"></i> รายงานอุบัติการณ์แยกระดับความรุนแรง น้อย ปานกลาง มาก</a></li>
                                <li><a href="pages/forms/editors.html"><i class="fa fa-angle-double-right"></i> รายงานอุบัติการ์แยกตามโปรแกรมความเสี่ยง แยกระดับความรุนแรง</a></li>
                                <li><a href="pages/forms/editors.html"><i class="fa fa-angle-double-right"></i> รายงานอุบัติการณ์แยกตามคลินิก</a></li>
                                <li><a href="pages/forms/editors.html"><i class="fa fa-angle-double-right"></i> รายงานอุบัติการณ์แยกตาม Clinic, Non Clinic</a></li>
                                <li><a href="pages/forms/editors.html"><i class="fa fa-angle-double-right"></i> รายงานอุบัติการณ์แยกตาม PSG</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-table"></i> <span>ตั้งค่าระบบ</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="pages/tables/simple.html"><i class="fa fa-angle-double-right"></i> รหัสหน่วยงาน</a></li>
                                <li><a href="pages/tables/data.html"><i class="fa fa-angle-double-right"></i> สายงาน</a></li>
                                <li><a href="pages/tables/data.html"><i class="fa fa-angle-double-right"></i> จัดการ Profile</a></li>
                                <li><a href="pages/tables/data.html"><i class="fa fa-angle-double-right"></i> จัดการโปรแกรมความเสี่ยงหลัก</a></li>
                                <li><a href="pages/tables/data.html"><i class="fa fa-angle-double-right"></i> จัดการโปรแกรมความเสี่ยงย่อย</a></li>
                                <li><a href="pages/tables/data.html"><i class="fa fa-angle-double-right"></i> จัดการระดับความรุนแรง</a></li>
                                <li><a href="pages/tables/data.html"><i class="fa fa-angle-double-right"></i> กลุ่ม หน่วยงาน</a></li>
                                <li><a href="pages/tables/data.html"><i class="fa fa-angle-double-right"></i> ที่มาของข้อมูล</a></li>
                                <li><a href="pages/tables/data.html"><i class="fa fa-angle-double-right"></i> จัดการ User</a></li>
                                <li><a href="pages/tables/data.html"><i class="fa fa-angle-double-right"></i> จัดการ PSG</a></li>
                                <li><a href="pages/tables/data.html"><i class="fa fa-angle-double-right"></i> จัดการอุบัติการณ์ในกลุ่ม PSG</a></li>
                            </ul>
                        </li>                        
                    </ul>
                </section>
                <!-- /.sidebar -->                
            </aside> 
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content"> 
                    <div class="row">
                        <div class="col-lg-4 col-xs-4">
                        <div class="box">
                        <div class="box-header">
                            <a class="btn btn-block btn-lg btn-basic glyphicon glyphicon-pencil" href="risk_form.php"> รายงานความเสี่ยง</a>
                        </div>
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 col-xs-6">
                        <div class="box">
                        <div class="box-header">
                            <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div> 
                            <table class="table" id="datatable">
                            <thead>
                            <tr>
                                <th></th>
                                <th>แยกประเภทคลินิก</th>                                                
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                foreach($data as $result_tb){
                                    echo"<tr>";
                                        echo "<td>".$result_tb['cn']."</td>";
                                        echo "<td>".$result_tb['c']."</td>";                          
                                    echo"</tr>";
                                }
                            ?>            
                            </tbody>
                            </table>
                        </div>
                        </div>
                        </div>
                    </div>
                </section>
            </aside>                      
        </div>                                 
                   
        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- jQuery UI 1.10.3 -->
        <script src="./bootstrap/js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="./bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- Morris.js charts -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="./bootstrap/js/plugins/morris/morris.min.js" type="text/javascript"></script>
        <!-- Sparkline -->
        <script src="./bootstrap/js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
        <!-- jvectormap -->
        <script src="./bootstrap/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
        <script src="./bootstrap/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
        <!-- fullCalendar -->
        <script src="./bootstrap/js/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
        <!-- jQuery Knob Chart -->
        <script src="./bootstrap/js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
        <!-- daterangepicker -->
        <script src="./bootstrap/js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="./bootstrap/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="./bootstrap/js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>

        <!-- AdminLTE App -->
        <script src="./bootstrap/js/AdminLTE/app.js" type="text/javascript"></script>
        
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="./bootstrap/js/AdminLTE/dashboard.js" type="text/javascript"></script>        
       
        <script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/data.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        
    <script>
    
    $(function () {
                
        $('#container').highcharts({
            data: {
                //กำหนดให้ ตรงกับ id ของ table ที่จะแสดงข้อมูล
                table: 'datatable'
            },
            chart: {
                type: 'bar'
            },
            title: {
                text: 'จำนวนความเสี่ยงแยกตามคลินิค'
            },
            yAxis: {
                allowDecimals: false,
                title: {
                    text: 'จำนวนความเสี่ยง'
                }
            },
            
            tooltip: {
                formatter: function () {
                    return '<b>' + this.series.name + '</b><br/>' +
                        this.point.y; + ' ' + this.point.name.toLowerCase();
                }
            }
        });
    });
    
    </script>
        
     </body>
</html>
