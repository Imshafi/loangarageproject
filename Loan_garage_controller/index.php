<?php
    $themecolor="#94f873";
    require_once '../all.inc.fle.php.dir/al-fun-form-functions.php';
    if(isset($_SESSION['ADMIN_LOGIN_STATUS']) AND isset($_SESSION['ADMIN_ID'])        AND 
    !empty($_SESSION['ADMIN_LOGIN_STATUS'])   AND !empty($_SESSION['ADMIN_ID'])       AND
    is_bool($_SESSION['ADMIN_LOGIN_STATUS'])  AND is_numeric($_SESSION['ADMIN_ID'])   AND
    $_SESSION['ADMIN_LOGIN_STATUS']===true    AND $_SESSION['ADMIN_ID']==1){
        header("location:admin_home.php");
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
        <link rel="stylesheet" href="admin.style.all.files/all.inc.style.css">
        <link rel="stylesheet" href="admin.style.all.files/admin_auth.css">
        <script src="../all.js.min.dir/validation_login.js"></script>
        <script src="admin.js.all.files/jquery.js"></script>
        <title>Admin Login</title>
    </head>
    <body>
        <div class="continer_page">
            <div class="continer_content">
                <div class="loginWholeContiner" id="logContiner">
                    <div class="loginHeadingContiner">
                        <h1 class="logHead">Admin Login</h1>
                    </div>
                    <div class="loginContiner">
                        <form id="partner_login_form" method="post">
                            <div class="inpcon userNameContiner">
                            <input type="hidden" name="csrf_token" value="<?=token("ADMIN_LOGIN_TOKEN")?>">
                                <label for="user_name" class="userNameLab">
                                    Enter User Name
                                </label>
                                <input type="text" name="user_name" class="user_name_inp inp" id="user_name" autocomplete="off" required>
                            </div>
                            <div class="inpcon userPasswordContiner">
                                <label for="user_password" class="userPasswordLab">
                                    Enter Password
                                </label>
                                <input type="password" class="user_password_inp inp" name="user_password" id="user_password" autocomplete="off" required>
                            </div>
                            <div class="errorContiner" id="error_continer">
                                <span class="errorMsg" id="errorMsg_lab">Invalid Details</span>
                            </div>
                            <div class="userSubmitContiner">
                                <input type="submit" class="user_submit_inp" name="user_submit" id="user_submit" value="Login">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="admin.js.all.files/admin_auth.js"></script>
    </body>
</html>
<!-- join-affilite.php -->