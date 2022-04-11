<?php
session_start();
if(!isset($_SESSION['ADMIN_LOGIN_STATUS'])    OR !isset($_SESSION['ADMIN_ID']) OR
    $_SESSION['ADMIN_LOGIN_STATUS']==false    OR $_SESSION['ADMIN_ID']!==1){
    header("location:../../index.php");
    die();
}
else
{
    unset( $_SESSION['ADMIN_LOGIN_STATUS'] );
    unset( $_SESSION['ADMIN_ID'] );
    header("location:../index.php");
    die();
}
?>