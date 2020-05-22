
<?php require('web_config.php');?>
<?php require('config.php');?>

<?php
    require('authen_role.php');

    if($authenrole<3){
        require('authen_form.php');
}else{?> 
        <?php require('showindex.php');
    }
?>            
