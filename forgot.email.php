<?php
    require_once 'all.inc.fle.php.dir/inc.fle.php';
    require_once 'all.inc.fle.php.dir/al-fun-form-functions.php';
    if( !isset( $_SESSION['FORGOT_UID'] ) || empty( $_SESSION['FORGOT_UID'] ) || !is_numeric( $_SESSION['FORGOT_UID'] ) )
    {
        header("location:index.php");
    }
?>
<title>Forgor Password</title>
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
            <h2 class="heading_verify">Enter OTP</h2>
            <span class="span_heading">OTP Sent To Your Email</span>
        </div>
        <div class="verify_main_con">
            <form id="forgot" method="post">
                <input type="hidden" name="csrf" id="token" value="<?=token("FORGOT_EMAIL_STEP_TWO")?>">
                <input type="number" name="user_otp" id="verify_num" placeholder="Enter OTP" class="inp verify_num_cls" required autocomplete="off">
                <div class="error_msg" id="error_con">
                    <span id="error_lab" class="error_msg">error Occured</span>
                </div>
                <div class="submit_btn">
                    <input type="submit" id="verify_sub" value="Verify" class="inp verify_btn" required autocomplete="off">
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
    jQuery('#forgot').on('submit',function(e){
        e.preventDefault();
        form_data=new FormData(this);
        if( validate( form_data.get("user_otp") ) )
        {
            if( form_data.get("csrf")!=="" )
            {
                document.getElementById("verify_sub").value="Checking...";
                $.ajax({
                    url:"set_forgot_email.php",
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
                                    window.location.href="forgot.change.password.php";
                                }else{
                                    error("er",data.data);
                                }
                            }else{
                                error("er","Something went wrong");
                            }
                        }else{
                            error("er","Something went wrong");
                        }
                        document.getElementById("verify_sub").value="Verify"
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
            error("er","Invalid Email");
        }
    })

    function validate(val)
    {
        if(val!=="")
        {
            return true;
        }
        else
        {
            return false;
        }
    }
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