<?php
require_once 'all.inc.fle.php.dir/al-fun-form-functions.php';
if(!isset($_SESSION['PARTNER_LOGIN_STATUS'])          OR !isset($_SESSION['PARTNER_ID'])            OR  
empty($_SESSION['PARTNER_LOGIN_STATUS'])          OR  empty($_SESSION['PARTNER_ID'])            OR
is_bool($_SESSION['PARTNER_LOGIN_STATUS'])==false OR is_numeric($_SESSION['PARTNER_ID'])==false OR
$_SESSION['PARTNER_LOGIN_STATUS']==false     OR $_SESSION['PARTNER_ID']<1){
    header("location:../partner_auth.php");
    die();
}
if( isset($_POST['set']) && $_POST['set']=="true"){
    require_once 'all.min.sub.php.dir/connection.all.min.php';
    $partner_id=xss_val($con,$_SESSION['PARTNER_ID']);
    $admin_id="ADMIN_CHAT_PARTNER";
    $check=1;
    $set=0;
    $stmt_update=mysqli_prepare($con,"UPDATE `partner_admin` SET `status_com`=? WHERE `reciver_id`=? AND `sender_id`=? AND `status_com`=?");
    if($stmt_update){
        mysqli_stmt_bind_param($stmt_update,"iisi",$set,$partner_id,$admin_id,$check);
        $exe=mysqli_stmt_execute( $stmt_update );
        mysqli_stmt_close( $stmt_update );
        if($exe)
        {
            ret("success","success");
        }else{
            ret("failed","Error Occured");
        }
    }else{
        ret("failed","Object Not Created");
    }
}else{
    header("location:index.php");
}
function ret($status,$data){
    echo json_encode(["status"=>$status,"data"=>$data]);
}
?>