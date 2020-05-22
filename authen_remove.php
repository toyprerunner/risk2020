<?php session_start(); ?>
<?php require('config.php');?>
<?php unset($_SESSION['authen']);?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>E-Doc</title>
</head>

<body>
<script language="javascript">
        window.location.replace("index.php");
</script>
</body>
</html>