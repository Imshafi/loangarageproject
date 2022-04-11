<?php
require_once '../all.inc.fle.php.dir/al-fun-form-functions.php';
if(!isset($_SESSION['ADMIN_LOGIN_STATUS'])          OR !isset($_SESSION['ADMIN_ID'])            OR  
    empty($_SESSION['ADMIN_LOGIN_STATUS'])          OR  empty($_SESSION['ADMIN_ID'])            OR
    is_bool($_SESSION['ADMIN_LOGIN_STATUS'])==false OR is_numeric($_SESSION['ADMIN_ID'])==false OR
    $_SESSION['ADMIN_LOGIN_STATUS']==false     OR $_SESSION['ADMIN_ID']!==1){
        header("location:../partner_auth.php");
        die();
}
if(isset($_POST) AND !empty($_POST) AND isset($_POST['partner_id']) AND is_numeric($_POST['partner_id']) AND $_POST['partner_id']>0){
    if(isset($_SESSION['PARTNER_RESPONSE_ADMIN']) AND !empty($_SESSION['PARTNER_RESPONSE_ADMIN']) AND $_SESSION['PARTNER_RESPONSE_ADMIN']!==0){
        if(isset($_POST['PARTNER_RESPONSE_ADMIN']) AND !empty($_POST['PARTNER_RESPONSE_ADMIN']) AND $_POST['PARTNER_RESPONSE_ADMIN']!==0){
            if($_POST['PARTNER_RESPONSE_ADMIN']==$_SESSION['PARTNER_RESPONSE_ADMIN']){
                require_once '../all.min.sub.php.dir/connection.all.min.php';
                require_once '../all.min.sub.php.dir/send_mail.php';
                $partner_id=xss_val($con,$_POST['partner_id']);
                $status=xss_val($con,$_POST['type']);
                $stmt_update=mysqli_prepare($con,"UPDATE `form_information_submitted` SET `status`=? WHERE `id`=? AND `email_verify`=? AND `mobile_verify`=? AND (`status`=? || `status`=?)");
                if($stmt_update){
                    if($status==="success"){
                        $status=0;
                    }else {
                        $status=2;
                    }
                    $verify_status=0;
                    $un_verify=1;
                    $un_verify_two=2;
                    mysqli_stmt_bind_param($stmt_update,"iiiiii",$status,$partner_id,$verify_status,$verify_status,$un_verify,$un_verify_two);
                    $exe_stmt=mysqli_stmt_execute( $stmt_update );
                    $aff_stmt=mysqli_stmt_affected_rows( $stmt_update );
                    mysqli_stmt_close( $stmt_update );
                    if( $exe_stmt>0 && $aff_stmt>0 ){
                        if($status==0){
                            $ret="Accepted";
                            $msg="Now you can login and refer loans . There is no better time than now,<br> Thank you.";
                        }else{
                            $ret="Rejected";
                            $msg="Sorry! Your application has beenrejected .";
                        }
                        $stmt=mysqli_prepare($con,"SELECT `email` FROM `form_information_submitted` WHERE `id`=?");
                        if( $stmt )
                        {
                            mysqli_stmt_bind_param( $stmt,"i",$partner_id );
                            mysqli_stmt_bind_result( $stmt,$partner_mail );
                            $exe=mysqli_stmt_execute( $stmt );
                            mysqli_stmt_store_result( $stmt );
                            $row=mysqli_stmt_num_rows( $stmt );
                            $fetch=mysqli_stmt_fetch( $stmt );
                            mysqli_stmt_close( $stmt );
                            if( $exe && $row && $fetch && !empty( $partner_mail ) )
                            {
                                $sub="Application ".$ret;
                                //msg is in division of $ret
                                if( send_mail($partner_mail,$sub,$msg ) )
                                {
                                    unset( $_SESSION['PARTNER_RESPONSE_ADMIN'] );
                                    return_status("success","Application Successfully $ret.");
                                }
                                else
                                {
                                    return_status("success","Application Successfully ".$ret." But Unable to send mail");
                                }
                            }
                            else
                            {
                                return_status("failed","Failed To Send mail and Application $ret");
                            }
                        }
                        else
                        {
                            return_status("failed","Failed To Send mail and Application $ret");
                        }
                    }else{
                        return_status("failed","Failed To Update Loan Status");
                    }
                }else{
                    return_status("failed","Failed To Create Object");
                }
            }else{
                return_status("failed","Token Mismatch Please Reload Page");
            }
        }else{
            return_status("failed","Token Missing Please Reload Page");
        }
    }else{
        return_status("failed","Token Missing Please Reload Page");
    }
}else{
    header("location:../partner_auth.php");
    die();
}
function return_status($status,$data){
    echo json_encode(['status'=>$status,'data'=>$data]);
}
?>