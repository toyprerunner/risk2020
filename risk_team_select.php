<?php
    $sql="SELECT team_name from team where team_id=$team_id";
    require('connect.php');
    
        list($team_name)=mysqli_fetch_array($result);
        
    require('unconn.php');
?>