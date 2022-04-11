<?php
if( isset( $_POST ) && count( $_POST )===4 &&
    isset( $_POST['user_name'] ) && !empty( $_POST['user_name'] ) &&
    isset( $_POST['csrf_register'] ) && !empty( $_POST['csrf_register'] ) &&
    isset( $_POST['confrim_password'] ) && !empty( $_POST['confrim_password'] ) &&
    isset( $_POST['user_password'] ) && !empty( $_POST['user_password'] ) )
{
    require_once 'all.inc.fle.php.dir/al-fun-form-functions.php';
    if( isset( $_SESSION['CONFRIM_PARTNER_MAIL'] ) && !empty( $_SESSION['CONFRIM_PARTNER_MAIL'] ) &&
        isset( $_SESSION['REGISTER_PARTNER'] ) && !empty( $_SESSION['REGISTER_PARTNER'] ) &&
        isset( $_SESSION['CONFRIM_PARTNER_UID'] ) && !empty( $_SESSION['CONFRIM_PARTNER_UID'] ) && is_numeric( $_SESSION['CONFRIM_PARTNER_UID'] ) )
    {
        if( $_POST['user_name']!==$_POST['user_password'] )
        {
            if( $_POST['confrim_password']==$_POST['user_password'] )
            {
                if( $_SESSION['REGISTER_PARTNER']==$_POST['csrf_register'] )
                {
                    if( valid_email( $_SESSION['CONFRIM_PARTNER_MAIL'] ) )
                    {
                        require_once 'all.min.sub.php.dir/connection.all.min.php';
                        $user_mail=xss_val( $con,$_SESSION['CONFRIM_PARTNER_MAIL'] );
                        $user_uid=xss_val( $con,$_SESSION['CONFRIM_PARTNER_UID'] );
                        $user_name=xss_val( $con,$_POST['user_name'] );
                        $user_password=password_hash( $_POST['user_password'] , PASSWORD_DEFAULT );
                        $stmt_check_name=mysqli_prepare($con,"SELECT `id` FROM `partner_auth` WHERE `user_name`=?");
                        if( $stmt_check_name )
                        {
                            mysqli_stmt_bind_param($stmt_check_name,"s",$user_name);
                            mysqli_stmt_execute($stmt_check_name);
                            mysqli_stmt_store_result($stmt_check_name);
                            $user_name_exist=mysqli_stmt_num_rows($stmt_check_name);
                            mysqli_stmt_close($stmt_check_name);
                            if($user_name_exist==0){
                                $stmt_check=mysqli_prepare($con,"SELECT `id` FROM `form_information_submitted` WHERE `id`=? AND `email`= ? AND `status`=? AND `email_verify`=? AND `mobile_verify`=?");
                                if( $stmt_check )
                                {
                                    $status=0;
                                    mysqli_stmt_bind_param( $stmt_check,"isiii",$user_uid,$user_mail,$status,$status,$status );
                                    mysqli_stmt_bind_result( $stmt_check,$id );
                                    mysqli_stmt_execute( $stmt_check );
                                    mysqli_stmt_store_result($stmt_check );
                                    if( mysqli_stmt_num_rows( $stmt_check )==0 )
                                    {
                                        mysqli_stmt_close($stmt_check);
                                        $stmt_set=mysqli_prepare($con,"INSERT  INTO partner_auth(`user_name`,`user_password`,`info`) VALUES(?,?,?)");
                                        if( $stmt_set )
                                        {
                                            mysqli_stmt_bind_param( $stmt_set,"ssi",$user_name,$user_password,$user_uid );
                                            mysqli_stmt_execute( $stmt_set );
                                            if( mysqli_stmt_affected_rows( $stmt_set )>0 )
                                            {
                                                $_SESSION['SUCCESS_GO_TO']=true;
                                                unset( $_SESSION['CONFRIM_PARTNER_MAIL'] );
                                                unset( $_SESSION['REGISTER_PARTNER'] );
                                                unset( $_SESSION['CONFRIM_PARTNER_UID'] );
                                                return_data("success","success");
                                            }
                                            else
                                            {
                                                return_data("failed","Data Already Exist Please Retry");
                                            }
                                            mysqli_stmt_close( $stmt_set );
                                        }
                                        else
                                        {
                                            return_data("failed","Something Went Wrong Please Retry");
                                        }
                                    }
                                    else
                                    {
                                        return_data("failed","Unable To Get Data Plese Retry");
                                    }
                                }
                                else
                                {
                                    return_data("failed","Something Went Wrong Please Retry");
                                }
                            }
                            else
                            {
                                return_data("failed","User name already exist");
                            }
                        }
                        else {
                            return_data("failed","Something went wrong Please Retry");
                        }
                    }
                    else
                    {
                        return_data("failed","Invalid Mail Please Retry");
                    }
                }
                else
                {
                    return_data("failed","Mismatch Data Please Reload Page");
                }
            }
            else
            {
                return_data("failed","Mismatch Confrim Password");
            }
        }
        else
        {
            return_data("failed","Please change your password");
        }
    }
    else
    {
        return_data("failed","Something went wrong Please Retry");
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
?>