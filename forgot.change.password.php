<?php
    require_once 'all.inc.fle.php.dir/inc.fle.php';
    require_once 'all.inc.fle.php.dir/al-fun-form-functions.php';
    if( !isset( $_SESSION['CHANGE_PASSWORD_PARTNER'] ) || empty( $_SESSION['CHANGE_PASSWORD_PARTNER'] ) || !is_numeric( $_SESSION['CHANGE_PASSWORD_PARTNER'] ) ||
        !isset( $_SESSION['CHANGE_PASSWORD_OTP'] ) || empty( $_SESSION['CHANGE_PASSWORD_OTP'] ) || !is_numeric( $_SESSION['CHANGE_PASSWORD_OTP'] ) )
    {
        header("location:index.php");
    }
?>
<title>Change Password</title>
<script src="all.js.min.dir/validation_login.js"></script>
<link rel="stylesheet" href="all.min.style_sheet.dir/verify_change_pass_email.css">
</head>
<div class="verify_full_con">
    <div class="loader_con">
        <div class="loading">
        </div>
    </div>
    <style>
        .loader_con
        {
            background-color:rgb(218 218 218 / 0.7);
            height:calc(100vh - 80px);
            width:100%;
            position:absolute;
            display:flex;
            justify-content:center;
            align-items:center;
            z-index:1;
            display:none;
        }
        .loading
        {
            height:50px;
            width:50px;
            border-top:5px solid #11e311;
            border-radius:50%;
            animation:rotate 1s infinite;
        }
    </style>
    <div class="verify_sub_con">
        <div class="heading_verify_con">
            <h2 class="heading_verify">Enter New Password</h2>
        </div>
        <div class="verify_main_con">
            <form id="change" method="post">
                <input type="hidden" name="csrf" id="token" value="<?=token("CHANGE_PASSWORD_PARTNER_FORM")?>">
                <input type="password" name="user_passwod" id="change_password" placeholder="Enter New Password" class="inp verify_num_cls" required autocomplete="off">
                <div class="error_msg" id="error_con">
                    <span id="error_lab" class="error_msg">error Occured</span>
                </div>
                <div class="submit_btn">
                    <input type="submit" id="verify_sub" value="Submit" class="inp verify_btn" required autocomplete="off">
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
<style>
    body
    {
        background-color:#d0d0d0;
    }
    .verify_num_cls
    {
        margin:10px 50px;
    }
</style>
<script>
    var error_con=document.getElementById("error_con");
    var error_lab=document.getElementById("error_lab");
    jQuery('#change').on('submit',function(e){
        e.preventDefault();
        form_data=new FormData(this);
        if( validate_password( form_data.get( "user_passwod" ) ) )
        {
            if( form_data.get("csrf")!=="" )
            {
                document.getElementById("verify_sub").value="Please wait ..."
                $.ajax({
                    url:"set.new.password.partner.php",
                    type:"POST",
                    data:form_data,
                    contentType:false,
                    processData:false,
                    success:function(data){
                        if( Object.entries(data).length>0 ){
                            error("rer","Something went wrong");
                            data=$.parseJSON(data);
                            if(data.constructor==Object){
                                error("rer","Something went wrong");
                                if(data.status=="success" && data.data=="success"){
                                    error("rer","Something went wrong");
                                    alert("Password Successfully changed");
                                    window.location.href="partner_auth.php";
                                }else{
                                    error("er",data.data);
                                }
                            }else{
                                error("er","Something went wrong");
                            }
                        }else{
                            error("er","Something went wrong");
                        }
                        document.getElementById("verify_sub").value="Submit"
                    }
                })
            }
            else
            {
                error("er","Token missing please refresh page");
            }
        }
        else
        {
            error("er","8 to 12 characters must be A-Z,a-z,0-9 and special characters");
        }
    })

// SHAIKANAs12@
// SHAIKANAs1
    function error(type,data)
    {
        if(type=="er")
        {
            var dis="block";
            var opa=1;
        }
        else
        {
            var dis="none";
            var opa=0;
        }
        error_con.style.display=dis;
        error_con.style.opacity=opa;
        error_lab.style.display=dis;
        error_lab.style.opacity=opa;
        error_lab.innerText=data;
    }
</script>