<?php
if( isset( $_POST ) && !empty( $_POST ) && count( $_POST )===2 &&
    isset( $_POST['user_passwod'] ) && !empty( $_POST['user_passwod'] )  &&
    isset( $_POST['csrf'] ) && !empty( $_POST['csrf'] ) 
  )
{

    require_once 'all.inc.fle.php.dir/al-fun-form-functions.php';
    if( isset( $_SESSION['CHANGE_PASSWORD_PARTNER'] ) && !empty( $_SESSION['CHANGE_PASSWORD_PARTNER'] ) && is_numeric( $_SESSION['CHANGE_PASSWORD_PARTNER'] ) && $_SESSION['CHANGE_PASSWORD_PARTNER']!==0 &&
        isset( $_SESSION['CHANGE_PASSWORD_OTP'] ) && !empty( $_SESSION['CHANGE_PASSWORD_OTP'] ) && is_numeric( $_SESSION['CHANGE_PASSWORD_OTP'] ) && $_SESSION['CHANGE_PASSWORD_OTP']!==0 &&
        isset( $_SESSION['CHANGE_PASSWORD_PARTNER_FORM'] ) && !empty( $_SESSION['CHANGE_PASSWORD_PARTNER_FORM'] ) && $_SESSION['CHANGE_PASSWORD_PARTNER_FORM']==$_POST['csrf']
      )
    {
        require_once 'all.min.sub.php.dir/connection.all.min.php';
        $pass_id=xss_val( $con, $_SESSION['CHANGE_PASSWORD_PARTNER'] );
        $otp_id=xss_val( $con, $_SESSION['CHANGE_PASSWORD_OTP'] );
        $password=password_hash(xss_val( $con,$_POST['user_passwod'] ),PASSWORD_DEFAULT );
        $status=0;
        $stmt_check=mysqli_prepare($con,"SELECT id FROM changing_muhk WHERE `id`=? AND `user`=? AND `status`=? ORDER BY id DESC" );
        if( $stmt_check )
        {
            mysqli_stmt_bind_param( $stmt_check,"iii",$otp_id,$pass_id,$status );
            mysqli_stmt_bind_result( $stmt_check,$id );
            mysqli_stmt_execute( $stmt_check );
            mysqli_stmt_store_result( $stmt_check );
            $count=mysqli_stmt_num_rows( $stmt_check );
            $fetch=mysqli_stmt_fetch( $stmt_check );
            mysqli_stmt_close( $stmt_check );

            if( $count>0 && $fetch>0 )
            {
                $stmt_update=mysqli_prepare($con,"UPDATE `partner_auth` SET `user_password`=? WHERE `info`=?" );
                if( $stmt_update )
                {
                    mysqli_stmt_bind_param( $stmt_update,"si",$password,$pass_id );
                    $exe=mysqli_stmt_execute( $stmt_update );
                    $update=mysqli_stmt_affected_rows( $stmt_update );
                    mysqli_stmt_close( $stmt_update );
                    if( $update>0 && $exe>0 )
                    {
                        unset( $_SESSION['CHANGE_PASSWORD_PARTNER'] );
                        unset( $_SESSION['CHANGE_PASSWORD_OTP'] );
                        unset( $_SESSION['CHANGE_PASSWORD_PARTNER_FORM'] );
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