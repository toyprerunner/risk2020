<?php
    $sql="SELECT group_id,dep_name from dep where dep_id=$dep_id";
    require('connect.php');
    
        list($group_id,$dep_name)=mysqli_fetch_array($result);
        
    require('unconn.php');
?>