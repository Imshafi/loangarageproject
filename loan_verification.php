<?php
$url="success.php";
require_once 'all.inc.fle.php.dir/al-fun-form-functions.php';
if(isset($_SESSION['LOAN_APPLY_SUCCESS']) && !empty($_SESSION['LOAN_APPLY_SUCCESS']) && $_SESSION['LOAN_APPLY_SUCCESS']==true && 
   isset($_SESSION['LOAN_UID']) && !empty($_SESSION['LOAN_UID']) && is_numeric( $_SESSION['LOAN_UID'] ) && isset($_SESSION['LOAN_APPLY_MAIL']) && !empty( $_SESSION['LOAN_APPLY_MAIL'] ) ){ 
    require_once 'all.min.sub.php.dir/connection.all.min.php';
    $user_id=xss_val($con,$_SESSION['LOAN_UID']);
    $status=1;
    $stmt_check=mysqli_prepare($con,"SELECT `id` FROM `loan_apply_form` WHERE `id`=? AND `mobile_confrim`=? AND `email_confrim`=?");
    if($stmt_check)
    {
        mysqli_stmt_bind_param($stmt_check,"iii",$user_id,$status,$status);
        mysqli_stmt_bind_result($stmt_check,$loan_id);
        mysqli_stmt_execute($stmt_check);
        mysqli_stmt_store_result($stmt_check);
        if ( mysqli_stmt_num_rows( $stmt_check )>0 ){
            if ( mysqli_stmt_fetch( $stmt_check ) ) {
                $loan_id="";
                define("A0(57%?<Fr@4**__verify___&K#2*&(J^8392$()8347&^",true);
                define("A0(57%?<Fr@4**&K#2*&(J^8392$()8347&^",true);
                require_once 'all.inc.fle.php.dir/inc.fle.php';
                require_once 'all.inc.fle.php.dir/nav.bar.full.inc.php';
                require_once 'verify_email.php';
            } else {
                error_msg("Unable to fetch data <br> Please retry...");
            }
        } else {
            error_msg("Data Not Found Please Retry");
        }
        mysqli_stmt_close( $stmt_check );
    }
    else
    {
        error_msg("Some thing went wrong <br>Please Reolad The Page...");
    }
}else{
    header("location:index.php");
}

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
<script>
    var check_type="loan_verification";
    var uid="<?=$user_id?>";
</script>
<head>
    <title>Email Verification</title>
</head>
