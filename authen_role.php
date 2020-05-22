<?php
    if(isset($_SESSION['authen']['id'])){$authenid=$_SESSION['authen']['id'];}else{$authenid="";}
    if(isset($_SESSION['authen']['pwd'])){$authenpwd=$_SESSION['authen']['pwd'];}else{$authenpwd="";}
    //check login
    $sql="SELECT user.urole,user.urole,profile.dep_id,user.id,profile.name,profile.team_id from user inner join profile on profile.user_id = user.id WHERE username='$authenid' AND password_hash='$authenpwd'";
    require('connect.php');
    $record=mysqli_fetch_array($result);
    $authenrole=(int)$record[0];
    $userlevel=(int)$record[1];
    $userdept=(int)$record[2];
    $userid=$record[3];
    $username=$record[4];
    $userteam=$record[5];
    require('unconn.php');
?>
