<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Risk | Dashboard</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
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
  <body class="skin-blue layout-top-nav">
  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
            <a href="index.php" class="navbar-brand"><b>Risk</b></a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbar-collapse">
        <ul class="nav navbar-nav">   
            <li><a href="index.php">Dashboard</a></li>
            <li><a href="risk_form.php">รายงานความเสี่ยง</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">ทวนสอบรายงานความเสี่ยง<span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                  <li><a href="risk.php">แก้ไขรายละเอียดความเสี่ยงบุคคล</a></li>
                <li><a href="risk_team.php">แก้ไขรายละเอียดความเสี่ยงคร่อมสายงาน</a></li>                
              </ul>
            </li>
        </ul>
            
        <ul class="nav navbar-nav">               
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">รายงาน<span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                  <li><a href="userreport.php"><i class="fa fa-angle-double-right"></i> จำนวนความเสี่ยงรายบุคคล</a></li>
                  <!--<li><a href="depreport.php"><i class="fa fa-angle-double-right"></i> จำนวนความเสี่ยงบุคคลในหน่วยงาน</a></li>-->
                  <li><a href="sumdep.php"><i class="fa fa-angle-double-right"></i> สรุปจำนวนความเสี่ยงแยกตามหน่วยงาน</a></li>
                  <li><a href="sumteam.php"><i class="fa fa-angle-double-right"></i> สรุปจำนวนความเสี่ยงตามทีมคร่อมสายงาน</a></li> 
                  <li><a href="matrixdep.php"><i class="fa fa-angle-double-right"></i> รายงาน Matrix หน่วยงาน</a></li>
                  <li><a href="missandnearreport.php"><i class="fa fa-angle-double-right"></i> รายงานอุบัติการณ์ Miss And Near Miss</a></li>
                  <li><a href="incidentaireport.php"><i class="fa fa-angle-double-right"></i> รายงานอุบัติการณ์แยกระดับความรุนแรง</a></li>
                  <li><a href="smlreport.php"><i class="fa fa-angle-double-right"></i> รายงานอุบัติการณ์แยกระดับความรุนแรง น้อย ปานกลาง มาก</a></li>
                  <li><a href="programseverityreport.php"><i class="fa fa-angle-double-right"></i> รายงานอุบัติการ์แยกตามโปรแกรมความเสี่ยง แยกระดับความรุนแรง</a></li>
                  <li><a href="allclinicreport.php"><i class="fa fa-angle-double-right"></i> รายงานอุบัติการณ์แยกตามคลินิก</a></li>                                
              </ul>
            </li>
        </ul>           
            
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
                                        สวัสดี,<?php echo($_SESSION['authen']['uname'])?>
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
                                        <a href="javascript:logout();" class="btn btn-default btn-flat">ออก</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>         
        </div>
        <!-- /.navbar-collapse -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
</body>
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

        <script language="javascript">
        function logout(){
            var url="authen_remove.php";
            var r=confirm("ยืนยันการออกจากระบบข้อมูล");
            if(r==true){window.location.href=url;}
            }
        </script>
        
    </body>
</html>