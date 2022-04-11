<?php 
    require_once 'all.inc.fle.php.dir/al-fun-form-functions.php';
    if(isset($_SESSION['PARTNER_LOGIN_STATUS']) AND isset($_SESSION['PARTNER_ID'])){
        header("location:partner_login.dir/partner_home.php");
        die();
    }else{
        require_once 'all.inc.fle.php.dir/inc.fle.php';
        define("A0(57%?<Fr@4**&K#2*&(J^8392$()8347&^",true);
    }
?>
        <link rel="stylesheet" href="all.min.style_sheet.dir/partner_auth.css">
        <script src="all.js.min.dir/validation_login.js"></script>
        <title>Partner Login</title>
    </head>
    <body>
        <div class="loader_con">
            <div class="loading">
            </div>
        </div>
        <style>
            .loader_con
            {
                background-color:rgb(218 218 218 / 0.7);
                height:100vh;
                width:100%;
                position:absolute;
                display:flex;
                justify-content:center;
                align-items:center;
                z-index:1;
            }
            .loading
            {
                height:50px;
                width:50px;
                border-top:5px solid #11e311;
                border-radius:50%;
                animation:rotate 1s infinite;
            }
            @keyframes rotate
            {
                from
                {
                    transform:rotate(0deg);
                }
                to
                {
                    transform:rotate(360deg);
                }
            }
        </style>
        <script>
            window.addEventListener("load",()=>{
                document.querySelector(".loader_con").style.display="none";

            })
        </script>
        <div class="continer_page">
            <?php 
                require_once 'all.inc.fle.php.dir/nav.bar.full.inc.php';
            ?>
            <div class="continer_content">
                <div class="loginWholeContiner" id="logContiner">
                    <div class="loginHeadingContiner">
                        <h1 class="logHead">Login</h1>
                    </div>
                    <div class="loginContiner">
                        <form id="partner_login_form" method="post">
                            <div class="inpcon userNameContiner">
                            <input type="hidden" name="csrf_token" value="<?=token("PARTNER_LOGIN_TOKEN")?>">
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
                        <div class="loginFooterContiner">
                            <a href="forgot.partner.php" class="forgotPassword">Forgot Password ?</a>
                        </div>
                        <div class="create_acc_con">
                            <a href="#" class="createAcca">Create Account</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                require_once 'all.inc.fle.php.dir/footer.full.inc.php';
            ?>
        </div>
        <script src="./all.js.min.dir/partner_auth.js"></script>
    </body>
</html>