<?php
    $sql="SELECT source_id,source_name from source where source_id=$source_id";
    require('connect.php');
    
        list($source_id,$source_name)=mysqli_fetch_array($result);
        
    require('unconn.php');
?>