<?php
if ( isset ( $_POST ) && count($_POST)===3 && isset( $_POST['type'] ) &&  isset( $_POST['uid'] ) && is_numeric( $_POST['uid'] ) && isset( $_POST['token'] ) && !empty( $_POST['token'] ) )
{
    require_once '../all.inc.fle.php.dir/al-fun-form-functions.php';
    $error=[];
    if( isset( $_SESSION['VERIFICATION_TOKEN'] ) && !empty( $_SESSION['VERIFICATION_TOKEN'] ) && $_SESSION['VERIFICATION_TOKEN']==$_POST['token'] )
    {
        if( $_SESSION['VERIFICATION_TOKEN']==$_POST['token'] ){
            require_once 'connection.all.min.php';
            require_once 'send_mail.php';
            $uid=xss_val($con,$_POST['uid']);
            $user_otp_de=mt_rand(11111111,99999999);
            $user_otp=password_hash($user_otp_de,PASSWORD_DEFAULT);
            if( $_POST['type']==="loan_verification" &&
                isset( $_SESSION['LOAN_APPLY_MAIL'] ) && !empty( $_SESSION['LOAN_APPLY_MAIL'] ) )
            {
                $sle="check_sent";
                $table="loan_apply_form";
                $mail_check="email_confrim";
                $id_check="id";
                $mail=$_SESSION['LOAN_APPLY_MAIL'];
            }
            elseif( $_POST['type']==="parter_verification" && isset( $_SESSION['APPLY_PARTNER_STATUS'] ) && $_SESSION['APPLY_PARTNER_STATUS']===true &&
                    isset( $_SESSION['APPLY_PARTNER_MAIL'] ) && !empty( $_SESSION['APPLY_PARTNER_MAIL'] ) )
            {
                $sle="verification_email";
                $table="form_information_submitted";
                $mail_check="email_verify";
                $id_check="id";
                $mail=$_SESSION['APPLY_PARTNER_MAIL'];
            }else{
                array_push( $error,false );
            }

            if( in_array( false,$error ) || count($error)>0 ){
                return_data("failed","Something went wrong Please Retry..");
            }
            else
            {
                $check_mail=1;
                $stmt=mysqli_prepare($con,"UPDATE `$table` SET `$sle`=? WHERE `$id_check`=? AND `$mail_check`=?");
                if( $stmt )
                {
                    mysqli_stmt_bind_param($stmt,"sii",$user_otp,$uid,$check_mail);
                    $exe_stmt=mysqli_stmt_execute( $stmt );
                    $aff_rows=mysqli_stmt_affected_rows( $stmt );
                    mysqli_stmt_close( $stmt );
                    if( $exe_stmt>0 && $aff_rows>0 )
                    {
                        if( otp_send($user_otp_de,$mail) )
                        {
                            return_data("success","OTP Successfully Send to Your Email $mail");
                        }
                        else
                        {
                            return_data("failed","Unable To Send Email Please Retry..");
                        }
                    }
                    else
                    {
                        return_data("failed","Something went wrong..");
                    }
                }
                else
                {
                    return_data("failed","No Data Found Please Retry");
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
        return_data("failed","Session Error Please Reload the page...");
    }
}
else
{
    header("location:../index.php");
}
function return_data( $status,$data )
{
    echo json_encode( ["status"=>$status,"data"=>$data] );
}
?>