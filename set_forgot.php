<?php
if( isset( $_POST ) && !empty( $_POST ) && count( $_POST )===2 &&
    isset( $_POST['user_email'] ) && !empty( $_POST['user_email'] ) &&
    isset( $_POST['csrf'] ) && !empty( $_POST['csrf'] ) 
  )
{
    require_once 'all.inc.fle.php.dir/al-fun-form-functions.php';
    if( isset( $_SESSION['FORGOT_EMAIL'] ) && !empty( $_SESSION['FORGOT_EMAIL'] ) && $_SESSION['FORGOT_EMAIL']==$_POST['csrf'] )
    {
        require_once 'all.min.sub.php.dir/connection.all.min.php';
        require_once 'all.min.sub.php.dir/send_mail.php';
        $email=xss_val( $con,valid_email( $_POST['user_email'] ) );
        $status=0;
        if($email!=="failed")
        {
            $stmt_check=mysqli_prepare($con,"SELECT `id` FROM `form_information_submitted` WHERE `email`=? AND `status`=? AND `email_verify`=? AND `mobile_verify`=? ");
            if( $stmt_check )
            {
                mysqli_stmt_bind_param( $stmt_check,"siii",$email,$status,$status,$status );
                mysqli_stmt_bind_result( $stmt_check,$user_id );
                mysqli_stmt_execute( $stmt_check );
                mysqli_stmt_store_result( $stmt_check );
                $count=mysqli_stmt_num_rows( $stmt_check );
                $fetch=mysqli_stmt_fetch( $stmt_check );
                mysqli_stmt_close( $stmt_check );

                if( $count>0 && $fetch>0 )
                {
                    $code=mt_rand(11111111,99999999);
                    $code_en=password_hash($code,PASSWORD_DEFAULT);
                    $stmt_set=mysqli_prepare( $con,"INSERT INTO changing_muhk(user,verification_code) VALUES(?,?)" );
                    if( $stmt_set )
                    {
                        mysqli_stmt_bind_param( $stmt_set,"is",$user_id,$code_en );
                        mysqli_stmt_execute( $stmt_set );
                        $affected=mysqli_stmt_affected_rows( $stmt_set );
                        mysqli_stmt_close( $stmt_set );
                        if($affected)
                        {
                            if( otp_send( $code,$email ) )
                            {
                                unset( $_SESSION['FORGOT_EMAIL'] );
                                $_SESSION['FORGOT_UID']=$user_id;
                                return_data("success","success");
                            }
                            else
                            {
                                return_data("failed","Unable to send mail");
                            }
                        }
                        else
                        {
                            return_data("failed","Something Error Please retry");
                        }
                    }
                    else
                    {
                        return_data("failed","Something Error Please refersh the page");
                    }
                }
                else
                {
                    return_data("failed","Data not found");
                }
            }
            else
            {
                return_data("failed","Something Error Please refersh the page");
            }
        }
        else
        {
            return_data("failed","Invalid Email");
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