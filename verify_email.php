<?php
if(!defined("A0(57%?<Fr@4**__verify___&K#2*&(J^8392$()8347&^")){
    header("location:index.php");
    die();
}
?>
<link rel="stylesheet" href="all.min.style_sheet.dir/verify_change_pass_email.css">
<div class="verify_full_con">
    <div class="verify_sub_con">
        <div class="heading_verify_con">
            <h2 class="heading_verify">Enter OTP</h2>
            <span class="span_heading">OTP Sent To Your Email</span>
        </div>
        <div class="verify_main_con">
            <button id="resend_otp" class="re_se_ot">Resend</button>
            <form id="verify_email" method="post">
                <input type="hidden" name="csrf" id="token" value="<?=token("VERIFICATION_TOKEN")?>">
                <input type="number" name="otp_user_email" id="verify_num" placeholder="Enter OTP" class="inp verify_num_cls" required autocomplete="off">
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
<script>
    var error_con=document.getElementById("error_con");
    var error_lab=document.getElementById("error_lab");
    var resend=document.getElementById("resend_otp");
    resend.addEventListener("click",resend_otp);

    jQuery('#verify_email').on('submit',function(e){
    e.preventDefault();
    form_data=new FormData(this);
    var otp=form_data.get("otp_user_email");
    if(validate_otp(otp)){
        __error_occ("Invalid OTP","uner");
        check_otp(otp,document.getElementById("token").value);
    }else{
        __error_occ("Invalid OTP","er");
    }
})

function validate_otp(val){
    if(val!==''){
        if(val.length===8){
            let rgx=/[1-9]{1}[0-9]{7}/;
            if(rgx.test(val)){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }else{
        return false;
    }
}

function __error_occ(data,type){
    if(type=="er"){
        error_con.classList.add("shw_error");
        error_lab.classList.add("shw_error");
        error_lab.innerText=data;
        error_lab.style.color="red";
    }else{
        error_con.classList.remove("shw_error");
        error_lab.classList.remove("shw_error");
        error_lab.innerText="ok";
    }
}

function check_otp(otp,tkn){
    if( otp=='' || tkn=='' || check_type=='' || uid=='')
    {
        __error_occ("Invalid Details","er");
    }
    else
    {
        document.getElementById("verify_sub").value="Checking...";
        $.ajax({
            url:"all.min.sub.php.dir/check_mukhyam.php",
            type:"POST",
            data:{"type":check_type,uid:uid,"value":otp,token:tkn},
            success:function(data){
                data=$.parseJSON(data);
                if( Object.entries(data).length>0 ){
                    if(data.constructor==Object){
                        if(data.status=="success"){
                            window.location.href="<?=$url?>";
                        }else{
                            __error_occ(data.data,"er");
                            document.getElementById("verify_num").value='';
                        }
                    }else{
                        window.location.href="./index.php?data=error_occured";
                    }
                }else{
                    window.location.href="./index.php?data=error_occured";
                }
                document.getElementById("verify_sub").value="Verify"
            }
        })
    }
}
function resend_otp(){
    if(check_type=='' || uid=='')
    {
        __error_occ("Invalid Details","er");
    }
    else
    {
        document.getElementById("resend_otp").innerText="Sending...";
        $.ajax({
            url:"all.min.sub.php.dir/set_mukhyam.php",
            type:"POST",
            data:{"type":check_type,"uid":uid,"token":document.getElementById("token").value},
            success:function(data){
                data=$.parseJSON(data);
                if( Object.entries(data).length>0 ){
                    __error_occ(data.data,"der");
                    if(data.constructor==Object){
                        __error_occ(data.data,"der");
                        if(data.status=="success"){
                            __error_occ(data.data,"er");
                            error_lab.style.color="green";
                            document.getElementById("verify_num").value='';
                        }else{
                            __error_occ(data.data,"er")
                        }
                    }else{
                        window.location.href="./index.php?data=error_occured";
                    }
                }else{
                    window.location.href="./index.php?data=error_occured";
                }
                document.getElementById("resend_otp").innerText="Resend";
            }
        })
    }
}
</script>