<?php
require_once 'all.inc.fle.php.dir/al-fun-form-functions.php';
if(!isset($_SESSION['PARTNER_LOGIN_STATUS'])          OR !isset($_SESSION['PARTNER_ID'])            OR  
    empty($_SESSION['PARTNER_LOGIN_STATUS'])          OR  empty($_SESSION['PARTNER_ID'])            OR
    is_bool($_SESSION['PARTNER_LOGIN_STATUS'])==false OR is_numeric($_SESSION['PARTNER_ID'])==false OR
    $_SESSION['PARTNER_LOGIN_STATUS']==false     OR $_SESSION['PARTNER_ID']<1)
    {
        header("location:../partner_auth.php");
        die();
    }
    // $_SESSION['CHANGE_PASSWORD_PARTNER']=true;
    // $_SESSION['CHANGE_PASSWORD_PARTNER_ID']=$partner_id;
    if( isset( $_SESSION['CHANGE_PASSWORD_PARTNER'] ) && $_SESSION['CHANGE_PASSWORD_PARTNER']===true && isset($_SESSION['CHANGE_PASSWORD_PARTNER_ID']) && is_numeric( $_SESSION['CHANGE_PASSWORD_PARTNER_ID'] ) )
    define("A0(57%?<Fr@4**__verify___&K#2*&(J^8392$()8347&^",true);
    define("A0(57%?<Fr@4**&K#2*&(J^8392$()8347&^",true);
    require_once 'all.inc.fle.php.dir/inc.fle.php';
    require_once 'all.inc.fle.php.dir/nav.bar.full.inc.php';
    require_once 'verify_email.php';
function error_msg($data){
    echo 
   "<div class='error_msg_back'>
        <span class='error_msg_back_lab'>
            $data
        </span>
    </div>
   ";
}
?>
<style>
.aCus.loan_apply
{
    background-color:rgba(225,225,225,0.25);
    transition:.7s;
    margin:0px auto;
}
.error_msg_back
{
    height:calc(100vh - 80px);
    width:100%;
    display:flex;
    justify-content:center;
    align-items:center;
}
.error_msg_back_lab
{
    background-color:red;
    padding:15px;
    margin:10px auto;
    color:#ffff;
    border-radius:5px;
    line-height:25px;
}
</style>
<script>
    var check_type="change_password_partner";
    var uid="<?=$_SESSION['PARTNER_ID']?>";
</script>
<head>
    <title>Email Verification</title>
</head>
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