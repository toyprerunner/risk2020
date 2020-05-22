<?php
    $sql="SELECT group_id,group_name from `group` where group_id=$group_id";
    require('connect.php');
    
        list($group_id,$group_name)=mysqli_fetch_array($result);
        
    require('unconn.php');
?>