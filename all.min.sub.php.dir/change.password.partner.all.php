<?php
    require_once '../all.inc.fle.php.dir/al-fun-form-functions.php';
    if(!isset($_SESSION['PARTNER_LOGIN_STATUS'])          OR !isset($_SESSION['PARTNER_ID'])            OR  
        empty($_SESSION['PARTNER_LOGIN_STATUS'])          OR  empty($_SESSION['PARTNER_ID'])            OR
        is_bool($_SESSION['PARTNER_LOGIN_STATUS'])==false OR is_numeric($_SESSION['PARTNER_ID'])==false OR
        $_SESSION['PARTNER_LOGIN_STATUS']==false     OR $_SESSION['PARTNER_ID']<1){
            header("location:../partner_login.dir/partner_change_password.php");
            die();
    }
    if(isset($_POST) AND !empty($_POST)){
        if(isset($_POST['current_password_partner']) AND isset($_POST['new_password_partner'])){
            if(!empty($_POST['current_password_partner']) AND !empty($_POST['new_password_partner'])){
                $current_pass=$_POST['current_password_partner'];
                $new_pass=$_POST['new_password_partner'];
                if($new_pass!==$current_pass){
                    require_once 'connection.all.min.php';
                    $current_pass=xss_val($con,$current_pass);
                    $new_pass=xss_val($con,$new_pass);
                    $partner_id=xss_val($con,$_SESSION['PARTNER_ID']);
                    $stmt=mysqli_prepare($con,"SELECT pa.user_password,pa.info FROM partner_auth pa INNER JOIN form_information_submitted pd ON pd.id=pa.info WHERE pa.id=? AND pd.email_verify=? AND pd.mobile_verify=? AND pd.status=?");
                    if($stmt){
                        $user_status=0;
                        $email_status=0;
                        $mobile_status=0;
                        mysqli_stmt_bind_param($stmt,"iiii",$partner_id,$email_status,$mobile_status,$user_status);
                        mysqli_stmt_bind_result($stmt,$user_password,$user_auth_partner);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_fetch($stmt);
                        mysqli_stmt_close($stmt);
                        if(!empty($user_password)){
                            if(password_verify($current_pass,$user_password)==1){
                                $change_stmt=mysqli_prepare($con,"UPDATE `partner_auth` SET `user_password`=? WHERE `id`=? AND `info`=?");
                                $new_pass=password_hash($new_pass,PASSWORD_DEFAULT);
                                if($change_stmt){
                                    mysqli_stmt_bind_param($change_stmt,"sii",$new_pass,$partner_id,$user_auth_partner);
                                    mysqli_stmt_execute($change_stmt);
                                    $aff_row=mysqli_stmt_affected_rows( $change_stmt );
                                    mysqli_stmt_close( $change_stmt );
                                    if( $aff_row>0 )
                                    {
                                        return_status("success","Password Successfully changed"); 
                                    }else{
                                        return_status("failed","Unable To Password");   
                                    }
                                }else{
                                    return_status("failed","Unable To Create Object Please Try Later");   
                                }
                            }else{
                                return_status("failed","Current Password Not Match");
                            }
                        }else{
                            return_status("failed","Unable To Fetch Data");
                        }
                    }else{
                        return_status("failed","Unable To Create Object Please Try Later");
                    }
                }else{
                    return_status("failed","Invalid Password");
                }
            }else{
                return_status("failed","Please Fill The Inputs");
            }
        }else{
            header("location:../partner_login.dir/partner_change_password.php");
        }
    }else{
        header("location:../partner_login.dir/partner_change_password.php");
    }

    function return_status($status,$data){
        echo json_encode(['status'=>$status,'data'=>$data]);
    }
?>