<?php
if(!defined("A0(57%?<Fr@4**&__Partner___K#2*&(J^8392$()8347&^")){
    header("location:../index.php");
    die();
}
    $themecolor="#94f873";
    require_once '../all.inc.fle.php.dir/al-fun-form-functions.php';
    if(!isset($_SESSION['PARTNER_LOGIN_STATUS'])          OR !isset($_SESSION['PARTNER_ID'])            OR  
        empty($_SESSION['PARTNER_LOGIN_STATUS'])          OR  empty($_SESSION['PARTNER_ID'])            OR
        is_bool($_SESSION['PARTNER_LOGIN_STATUS'])==false OR is_numeric($_SESSION['PARTNER_ID'])==false OR
        $_SESSION['PARTNER_LOGIN_STATUS']==false     OR $_SESSION['PARTNER_ID']<1){
            header("location:../partner_auth.php");
            die();
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1,user-scalable=no">
        <meta name="theme-color" content="<?=$themecolor?>">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style"  content="<?=$themecolor?>">
        <link rel="shortcut icon" href="../logo_pictures.dir/1.5.1.43.2.4.5.6.7.77.77.8.8.8.9.2.2.34.4.logo.4443.44967.gif">
        <link rel="stylesheet" href="../all.min.style_sheet.dir/partner_inc.css">
        <link rel="stylesheet" href="../all.min.style_sheet.dir/nav.bar.full.inc.css">
        <link rel="stylesheet" href="../font-icons/css/all.min.css">
        <script src="../all.js.min.dir/jquery.js"></script>
        <title>Partner</title>
    </head>
    <body>
        <div class="continer_nav">
            <nav class="navCus">
                <input type="checkbox" id="check" class="check_btn_par noDis">
                <label for="check" class="check_btn">
                    <i class="fas fa-bars"></i>
                </label>
                <label class="logo">Loan Garage</label>
                <ul class="ulCus">
                    <li class="liCus"><a class="aCus home" href="partner_home.php">DASHBOARD</a></li>
                    <li class="liCus"><a class="aCus partner_admin" href="partner_admin_chat.php">Admin</a></li>
                    <li class="liCus"><a class="aCus partner_change_pass" href="partner_change_password.php">Change Password</a></li>
                    <li class="liCus"><a class="aCus logout" href="partner.logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
        <script>
            var check_menu=document.getElementById("check");
            var body=document.body;
            check_menu.addEventListener("change",()=>{
                if(check_menu.checked==true){
                    body.style.height="100vh";
                    body.style.overflow="hidden"
                }else{
                    body.style.height="auto";
                    body.style.overflow="auto"
                }
            })
        </script>