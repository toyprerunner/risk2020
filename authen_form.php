<!--<div class="container" style="padding-top:100px">
<div class="row">
<div class="col-md-4"></div>
<div class="col-md-4" style="background-color:#f4f4f4">
    <h3 align="center">
    <span class="glyphicon glyphicon-lock"></span> Login </h3>
        <form action="authen_save.php" method="post" name="LoginForm" class="form-horizontal">
            <div class="form-group">
            <div class="col-sm-12">
                Username : <input class="form-control" name="loginid" type="text" placeholder="Login ID"><br />
                </div>
            </div>
            <div class="form-group">
            <div class="col-sm-12">
                Password : <input class="form-control" name="loginpwd" type="password" placeholder="Password"><br />
                </div>
            </div>
            <div class="form-group">
            <div class="col-sm-12">
                <button type="submit" class="btn btn-primary" id="btn">
            <span class="glyphicon glyphicon-log-in"> </span> Login </button>
                </div>
            </div>
        </form>
</div>
</div>
</div>    -->
<!DOCTYPE html>
<html class="bg-blue">
    <head>
        <meta charset="UTF-8">
        <title>Risk | Log in</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="./bootstrap/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="./bootstrap/css/AdminLTE.css" rel="stylesheet" type="text/css" />

    </head>
    <body class="bg-warning">

        <div class="form-box" id="login-box">
            <div class="header">ระบบบริหารความเสี่ยง <br/>โรงพยาบาลสว่างวีระวงศ์</div>
            <form action="authen_save.php" method="post" name="LoginForm">
                <div class="body bg-gray">
                    <div class="form-group">
                        <input type="text" name="loginid" class="form-control" placeholder="User ID"/>
                    </div>
                    <div class="form-group">
                        <input type="password" name="loginpwd" class="form-control" placeholder="Password"/>
                    </div>          
                    <div class="form-group">
                        <input type="checkbox" name="remember_me"/> Remember me
                    </div>
                </div>
                <div class="footer">                                                               
                    <button type="submit" class="btn bg-olive btn-block">ตกลง</button>  
                </div>
            </form>
        </div>


        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="./bootstrap/js/bootstrap.min.js" type="text/javascript"></script>        
        
    </body>
</html>
