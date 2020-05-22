<?php
    $sql="SELECT * from setup";
    require('connect.php');
    
        list($linetoken)=mysqli_fetch_array($result);
        
    require('unconn.php');
?>