<?php
session_start();
if(!isset($_SESSION['PARTNER_LOGIN_STATUS'])          OR !isset($_SESSION['PARTNER_ID'])            OR  
empty($_SESSION['PARTNER_LOGIN_STATUS'])          OR  empty($_SESSION['PARTNER_ID'])            OR
is_bool($_SESSION['PARTNER_LOGIN_STATUS'])==false OR is_numeric($_SESSION['PARTNER_ID'])==false OR
$_SESSION['PARTNER_LOGIN_STATUS']==false     OR $_SESSION['PARTNER_ID']<1){
    header("location:../index.php");
    die();
}else{
    unset($_SESSION['PARTNER_LOGIN_STATUS']);
    unset($_SESSION['PARTNER_ID']);
    unset($_SESSION['PARTNER_LOGIN_TOKEN']);
    header("location:../index.php");
    die();
}
?>