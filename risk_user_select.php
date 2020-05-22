<?php
    $sql="SELECT user.id,user.username,profile.name,user.email,profile.dep_id,user.urole as ulevel from user LEFT OUTER JOIN profile on profile.user_id = user.id where user.id=$id";
    require('connect.php');

        list($id,$username,$name,$email,$dep_id,$ulevel)=mysqli_fetch_array($result);
        
    require('unconn.php');
?>