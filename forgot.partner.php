<?php
    require_once 'all.inc.fle.php.dir/inc.fle.php';
    require_once 'all.inc.fle.php.dir/al-fun-form-functions.php';
    if( isset( $_SESSION['PARTNER_LOGIN_TOKEN'] ) )
    {
        unset( $_SESSION['PARTNER_LOGIN_TOKEN'] );
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
    <div class="verify_sub_con">
        <div class="heading_verify_con">
            <h2 class="heading_verify">Enter Email</h2>
            <span class="span_heading">OTP will be Sent To Your Email</span>
        </div>
        <div class="verify_main_con">
            <form id="forgot" method="post">
                <input type="hidden" name="csrf" id="token" value="<?=token("FORGOT_EMAIL")?>">
                <input type="email" name="user_email" id="verify_num" placeholder="Enter Email" class="inp verify_num_cls" required autocomplete="off">
                <div class="error_msg" id="error_con">
                    <span id="error_lab" class="error_msg">error Occured</span>
                </div>
                <div class="submit_btn">
                    <input type="submit" id="verify_sub" value="Send" class="inp verify_btn" required autocomplete="off">
                </div>
            </form>
        </div>
    </div>
</div>
<script src="all.js.min.dir/validation_func.js"></script>
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
        if( validate_email( form_data.get("user_email") ) )
        {
            if( form_data.get("csrf")!=="" )
            {
                document.getElementById("verify_sub").value="Sending..";
                $.ajax({
                    url:"set_forgot.php",
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
                                    window.location.href="forgot.email.php";
                                }else{
                                    error("er",data.data);
                                }
                            }else{
                                error("er","Something went wrong");
                            }
                        }else{
                            error("er","Something went wrong");
                        }
                        document.getElementById("verify_sub").value="Send";
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
