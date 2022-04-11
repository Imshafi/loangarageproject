<?php
    require_once '../all.inc.fle.php.dir/al-fun-form-functions.php';
    if(!isset($_SESSION['ADMIN_LOGIN_STATUS'])          OR !isset($_SESSION['ADMIN_ID'])            OR  
        empty($_SESSION['ADMIN_LOGIN_STATUS'])          OR  empty($_SESSION['ADMIN_ID'])            OR
        is_bool($_SESSION['ADMIN_LOGIN_STATUS'])==false OR is_numeric($_SESSION['ADMIN_ID'])==false OR
        $_SESSION['ADMIN_LOGIN_STATUS']==false     OR $_SESSION['ADMIN_ID']<1){
            header("location:../partner_auth.php");
            die();
    }
    if(isset($_POST['get']) && $_POST['get']==="true" && isset($_POST['partner_id']) && is_numeric($_POST['partner_id']) && $_POST['partner_id']>0){
        if(!empty($_POST['msg'])){
            require_once '../all.min.sub.php.dir/connection.all.min.php';
            $iv=openssl_random_pseudo_bytes(16);
            $msg=en_de_cry($con,$_POST['msg'],$iv,"en");
            $reciver=xss_val($con,$_POST['partner_id']);
            $time=date_format_cus();
            $sender="ADMIN_CHAT_PARTNER";
            $iv=bin2hex($iv);
            $stmt_set_msg=mysqli_prepare($con,"INSERT INTO `partner_admin`(`sender_id`,`reciver_id`,`time_com`,`admin_partner_com`,`mukhyam`) VALUES(?,?,?,?,?)");
            if($stmt_set_msg){
                mysqli_stmt_bind_param($stmt_set_msg,"sisss",$sender,$reciver,$time,$msg,$iv);
                $exe_stmt=mysqli_stmt_execute($stmt_set_msg);
                $aff_stmt=mysqli_stmt_affected_rows( $stmt_set_msg );
                mysqli_stmt_close( $stmt_set_msg );
                if( $exe_stmt>0 && $aff_stmt>0 ){
                    return_value("success","success");
                }else{
                    return_value("failed","Failed To Send Message Please Retry..");
                }
            }else{
                return_value("failed","Failed To Create Object Please Retry..");
            }
        }else{
            return_value("failed","Message Is Empty");
        }
    }else{
        header("location:../index.php");
        die();
    }
function return_value($status,$data){
    echo json_encode(["status"=>$status,"data"=>$data]);
}
?>