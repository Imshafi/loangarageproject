<?php
if ( isset ( $_POST ) && count( $_POST ) ===4 && isset( $_POST['type'] ) && $_POST['type']!=='' && isset( $_POST['value'] ) && !empty( $_POST['value'] ) && is_numeric( $_POST['value'] ) && $_POST['value']>0
    && isset( $_POST['uid'] ) && !empty( $_POST['uid'] ) && is_numeric( $_POST['uid'] ) && $_POST['uid']>0 )
{

    $error=[];
    require_once '../all.inc.fle.php.dir/al-fun-form-functions.php';
    if( isset( $_SESSION['VERIFICATION_TOKEN'] ) && !empty($_SESSION['VERIFICATION_TOKEN']) &&
        isset( $_POST['token'] ) && !empty( $_POST['token'] ) && $_POST['token']==$_SESSION['VERIFICATION_TOKEN'] 
      )
    {
        require_once 'connection.all.min.php';
        $uid=xss_val($con,$_POST['uid']);
        $user_otp=xss_val($con,$_POST['value']);
        if( $_POST['type']==="loan_verification" &&
            isset( $_SESSION['LOAN_APPLY_MAIL'] ) && !empty( $_SESSION['LOAN_APPLY_MAIL'] ) )
        {
            $sle='check_sent';
            $table="loan_apply_form";
            $mail_check="email_confrim";
            $id_check="id";
            $unset="LOAN_APPLY_SUCCESS";
            $unset1="LOAN_APPLY_MAIL";
            $session="CONFRIM_LOAN_MAIL";
            $val=$_SESSION['LOAN_APPLY_MAIL'];
            $up_email="email_confrim";
            $up_mobile="mobile_confrim";
        }
        elseif( $_POST['type']==="parter_verification" && isset( $_SESSION['APPLY_PARTNER_STATUS'] ) && $_SESSION['APPLY_PARTNER_STATUS']===true &&
                isset( $_SESSION['APPLY_PARTNER_MAIL'] ) && !empty( $_SESSION['APPLY_PARTNER_MAIL'] ) )
        {
            $sle='verification_email';
            $table="form_information_submitted";
            $mail_check="email_verify";
            $id_check="id";
            $unset="APPLY_PARTNER_STATUS";
            $unset1="APPLY_PARTNER_MAIL";
            $session="CONFRIM_PARTNER_MAIL";
            $val=$_SESSION['APPLY_PARTNER_MAIL'];
            $up_email="email_verify";
            $up_mobile="mobile_verify";
        }else{
            array_push( $error,false );
        }

        if( in_array( false,$error ) || count($error)>0 ){
            return_data("failed","Something went wrong Please Retry..");
        }
        else
        {
            $check_mail=1;
            $stmt=mysqli_prepare($con,"SELECT $sle FROM $table WHERE $id_check=? AND $mail_check=?");
            if( $stmt )
            {
                mysqli_stmt_bind_param($stmt,"ii",$uid,$check_mail);
                mysqli_stmt_bind_result($stmt,$otp);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                if( mysqli_stmt_num_rows($stmt)>0 )
                {
                    mysqli_stmt_fetch($stmt);
                    mysqli_stmt_close($stmt);
                    if( password_verify($user_otp,$otp)==1 )
                    {
                        $stmt_update=mysqli_prepare($con,"UPDATE `$table` SET `$up_email`=?,`$up_mobile`=? WHERE `$id_check`=?");
                        if( $stmt_update )
                        {
                            $status_verify=0;
                            mysqli_stmt_bind_param($stmt_update,"iii",$status_verify,$status_verify,$uid);
                            mysqli_stmt_execute($stmt_update);
                            $aff_row=mysqli_stmt_affected_rows($stmt_update);
                            mysqli_stmt_close( $stmt_update );
                            if( $aff_row>0 )
                            {
                                if( $_POST['type']==="loan_verification" &&
                                    isset( $_SESSION['LOAN_APPLY_MAIL'] ) && !empty( $_SESSION['LOAN_APPLY_MAIL'] ) )
                                {
                                    $_SESSION['SUCCESS_GO_TO']=true;
                                    unset($_SESSION['LOAN_APPLY_SUCCESS']);
                                    unset($_SESSION['LOAN_APPLY_MAIL']);
                                }
                                elseif( $_POST['type']==="parter_verification" && isset( $_SESSION['APPLY_PARTNER_STATUS'] ) && $_SESSION['APPLY_PARTNER_STATUS']===true &&
                                        isset( $_SESSION['APPLY_PARTNER_MAIL'] ) && !empty( $_SESSION['APPLY_PARTNER_MAIL'] ) )
                                {
                                    $_SESSION['CONFRIM_PARTNER_MAIL']=$_SESSION['APPLY_PARTNER_MAIL'];
                                    $_SESSION['CONFRIM_PARTNER_UID']=$_POST['uid'];
                                    unset($_SESSION['APPLY_PARTNER_STATUS']);
                                    unset($_SESSION['APPLY_PARTNER_MAIL']);
                                }else{
                                    array_push( $error,false );
                                }
                                if( in_array( false,$error ) || count($error)>0 )
                                {
                                    return_data("failed","Something went wrong Please Retry..");
                                }else
                                {
                                    unset($_SESSION['VERIFICATION_TOKEN']);
                                    return_data("success",$_POST['type']);
                                }
                            }
                            else
                            {
                                return_data("failed","Unable To Verify");
                            }
                        }
                        else
                        {
                            return_data("failed","Object Not Created");
                        }
                    }
                    else
                    {
                        return_data("failed","Invalid OTP");
                    }
                }
                else
                {
                    return_data("failed","No Data Found Please Retry");
                }
            }
            else
            {
                return_data("failed","Object Not Created");
            }
        }
    }
    else
    {
        return_data("failed","Session Error Please Reload the page...");
    }
}
else
{
    header("location:../index.php");
}

function return_data($status,$data)
{
    echo json_encode(['status'=>$status,"data"=>$data]);
}

?>