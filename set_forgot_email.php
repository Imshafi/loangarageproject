<?php
if( isset( $_POST ) && !empty( $_POST ) && count( $_POST )===2 &&
    isset( $_POST['user_otp'] ) && !empty( $_POST['user_otp'] ) && is_numeric( $_POST['user_otp'] ) &&
    isset( $_POST['csrf'] ) && !empty( $_POST['csrf'] ) 
  )
{

    require_once 'all.inc.fle.php.dir/al-fun-form-functions.php';
    if( isset( $_SESSION['FORGOT_UID'] ) && !empty( $_SESSION['FORGOT_UID'] ) && is_numeric( $_SESSION['FORGOT_UID'] ) && $_SESSION['FORGOT_EMAIL_STEP_TWO']==$_POST['csrf'] )
    {
        require_once 'all.min.sub.php.dir/connection.all.min.php';
        $uid=xss_val( $con, $_SESSION['FORGOT_UID'] );
        $otp=xss_val( $con, $_POST['user_otp'] );
        $status=1;
        $ck_status=0;
        $stmt_check=mysqli_prepare($con,"SELECT cm.id,cm.verification_code FROM changing_muhk cm INNER JOIN form_information_submitted pd ON pd.id=cm.user WHERE cm.user=? AND cm.status=? AND pd.status=? AND pd.email_verify=? AND pd.mobile_verify=? ORDER BY cm.id DESC");
        if( $stmt_check )
        {
            mysqli_stmt_bind_param( $stmt_check,"iiiii",$uid,$status,$ck_status,$ck_status,$ck_status );
            mysqli_stmt_bind_result( $stmt_check,$otp_id,$code );
            mysqli_stmt_execute( $stmt_check );
            mysqli_stmt_store_result( $stmt_check );
            $count=mysqli_stmt_num_rows( $stmt_check );
            $fetch=mysqli_stmt_fetch( $stmt_check );
            mysqli_stmt_close( $stmt_check );

            if( $count>0 && $fetch>0 && !empty( $otp_id ) && !empty( $code ) )
            {
                if( password_verify($otp,$code)==1 )
                {
                   $stmt_update=mysqli_prepare($con,"UPDATE `changing_muhk` SET `status`=? WHERE `id`=?" );
                   if( $stmt_update )
                   {
                        mysqli_stmt_bind_param( $stmt_update,"ii",$ck_status,$otp_id );
                        $d=mysqli_stmt_execute( $stmt_update );
                        $update=mysqli_stmt_affected_rows( $stmt_update );
                        mysqli_stmt_close( $stmt_update );
                        if( $update>0 )
                        {
                            $_SESSION['CHANGE_PASSWORD_PARTNER']=$_SESSION['FORGOT_UID'];
                            $_SESSION['CHANGE_PASSWORD_OTP']=$otp_id;
                            unset( $_SESSION['FORGOT_UID'] );
                            unset( $_SESSION['FORGOT_EMAIL_STEP_TWO'] );
                            return_data("success","success");
                        }
                        else
                        {
                            return_data("failed","Something Went Wrong Please retry again");
                        }
                   }
                   else
                   {
                        return_data("failed","Something went wrong Please refersh the page");
                   }
                }
                else
                {
                    return_data("failed","Invalid OTP");
                }
            }
            else
            {
                return_data("failed","Data not found");
            }
        }
        else
        {
            return_data("failed","Something went wrong Please refersh the page");
        }
    }
    else
    {
        return_data("failed","Session Error Please refersh the page");
    }
}
else
{
    header("location:index.php");
}

function return_data($status,$data)
{
echo json_encode(['status'=>$status,"data"=>$data]);
}