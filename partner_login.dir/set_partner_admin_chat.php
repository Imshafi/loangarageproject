<?php
    require_once '../all.inc.fle.php.dir/al-fun-form-functions.php';
    if(!isset($_SESSION['PARTNER_LOGIN_STATUS'])          OR !isset($_SESSION['PARTNER_ID'])            OR  
        empty($_SESSION['PARTNER_LOGIN_STATUS'])          OR  empty($_SESSION['PARTNER_ID'])            OR
        is_bool($_SESSION['PARTNER_LOGIN_STATUS'])==false OR is_numeric($_SESSION['PARTNER_ID'])==false OR
        $_SESSION['PARTNER_LOGIN_STATUS']==false     OR $_SESSION['PARTNER_ID']<1){
            header("location:../partner_auth.php");
            die();
    }
    if(isset($_POST['get']) && $_POST['get']==="true"){
        if(!empty($_POST['msg'])){
            require_once '../all.min.sub.php.dir/connection.all.min.php';
            $iv=openssl_random_pseudo_bytes(16);
            $msg=en_de_cry($con,$_POST['msg'],$iv,"en");
            $partner_id=xss_val($con,$_SESSION['PARTNER_ID']);
            $time=date_format_cus();
            $reciver="ADMIN_CHAT_PARTNER";
            $iv=bin2hex($iv);
            $stmt_set_msg=mysqli_prepare($con,"INSERT INTO `partner_admin`(`sender_id`,`reciver_id`,`time_com`,`admin_partner_com`,`mukhyam`) VALUES(?,?,?,?,?)");
            if($stmt_set_msg){
                mysqli_stmt_bind_param($stmt_set_msg,"issss",$partner_id,$reciver,$time,$msg,$iv);
                if(mysqli_stmt_execute($stmt_set_msg)){
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