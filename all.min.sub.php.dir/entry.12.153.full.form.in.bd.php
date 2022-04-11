<?php

// echo count($_POST);
// echo "<pre>";
// print_r($_POST);
// die();
if(isset($_POST) && !empty($_POST) && count($_POST)===19){
    $sec="6Lf_EkEdAAAAAHMvikpZwxfKTMMAuPVdkbp_15rJ";
    $val=file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$sec.'&response='.$_POST['g-recaptcha-response']);
    $res=json_decode($val);
    if($res->success){
        include '../all.inc.fle.php.dir/al-fun-form-functions.php';
        if(isset($_POST['csrf_token'])){
            if(isset($_SESSION['JOIN_AFF_TOKEN'])){
                if($_SESSION['JOIN_AFF_TOKEN']===$_POST['csrf_token']){
                    $error=[];
                    $email = filter_var( $email=$_POST['email_in_5'],FILTER_SANITIZE_EMAIL);
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                        require_once 'connection.all.min.php';
                        require_once 'send_mail.php';
                        $check_email=mysqli_query($con,"SELECT `id` FROM `form_information_submitted` WHERE `email`='$email' AND `status`=0");
                        if(mysqli_num_rows($check_email)==0){
                            $mobile_len=strlen($_POST['mobile_10_name_in_3']);
                            if($mobile_len==10 || $mobile_len==13){
                                $date= xss_date($_POST['date_in_11']);
                                if($date!==false){
                                    $iv=openssl_random_pseudo_bytes(16);
                                    $date= en_de_cry($con,$date,$iv,"en");
                                    $allow_img=['JPG','PNG','JPEG','PDF'];
                                    $arry_error=['file_upload_selfie_in_4','file_upload_pan_card_in_13','file_upload_aadhar_card_one_in_15','file_upload_aadhar_card_two_in_16','file_upload_cheque_in_22'];
                                    foreach($arry_error as $i){
                                       if( $_FILES[$i]['error']>0 ){
                                        array_push($error,1);
                                        }
    
                                        $file_name=explode('.',$_FILES[$i]['name']);
                                        $file_ext=strtoupper(end($file_name));
    
                                        if(!in_array($file_ext,$allow_img)){
                                            array_push($error,2);
                                        }
    
                                        $_FILES[$i]['name']=uniqid('',true).".".$file_ext;
                                    }
                                    if(!in_array(false,$error)){
                                        $f_name= en_de_cry($con,filter_var($_POST['name_first_in_1'], FILTER_SANITIZE_STRING),$iv,"en");
                                        $l_name= en_de_cry($con,filter_var($_POST['name_last_in_2'], FILTER_SANITIZE_STRING),$iv,"en");
                                        $mobile= en_de_cry($con,filter_var($_POST['mobile_10_name_in_3'], FILTER_SANITIZE_STRING),$iv,"en");
                                        $add_one= en_de_cry($con,filter_var($_POST['street_address_one_in_6'], FILTER_SANITIZE_STRING),$iv,"en");
                                        $add_two= en_de_cry($con,filter_var($_POST['street_address_two_in_7'], FILTER_SANITIZE_STRING),$iv,"en");
                                        $city= en_de_cry($con,filter_var($_POST['city_in_8'], FILTER_SANITIZE_STRING),$iv,"en");
                                        $state= en_de_cry($con,filter_var($_POST['state_in_9'], FILTER_SANITIZE_STRING),$iv,"en");
                                        $pincode= en_de_cry($con,filter_var($_POST['pincode_in_10'], FILTER_VALIDATE_INT),$iv,"en");
                                        $pan_number= en_de_cry($con,filter_var($_POST['pan_number_in_12'], FILTER_SANITIZE_STRING),$iv,"en");
                                        $aadhar_number= en_de_cry($con,filter_var($_POST['aadhar_number_in_14'], FILTER_VALIDATE_INT),$iv,"en");
                                        $aggre=$_POST['agree_in_17'];
                                        if($aggre=="ok"){
                                            $aggre=0;
                                        }else if($aggre=="no"){
                                            $aggre=1;
                                        }
                                        $bank_acc_number= en_de_cry($con,filter_var($_POST['bank_account_number_in_18'], FILTER_VALIDATE_INT),$iv,"en");
                                        $bank_acc_name= en_de_cry($con,filter_var($_POST['bank_account_name_in_19'], FILTER_SANITIZE_STRING),$iv,"en");
                                        $bank_name= en_de_cry($con,filter_var($_POST['bank_name_in_20'], FILTER_SANITIZE_STRING),$iv,"en");
                                        $bank_ifsc= en_de_cry($con,filter_var($_POST['bank_ifsc_in_21'], FILTER_SANITIZE_STRING),$iv,"en");
                                        $selfie=$_FILES['file_upload_selfie_in_4']['name'];
                                        $pan_pic=$_FILES['file_upload_pan_card_in_13']['name'];
                                        $aadhar_front=$_FILES['file_upload_aadhar_card_one_in_15']['name'];
                                        $aadhar_back=$_FILES['file_upload_aadhar_card_two_in_16']['name'];
                                        $cheque=$_FILES['file_upload_cheque_in_22']['name'];
        
                                        $selfie_tmp=$_FILES['file_upload_selfie_in_4']['tmp_name'];
                                        $pan_pic_tmp=$_FILES['file_upload_pan_card_in_13']['tmp_name'];
                                        $aadhar_front_tmp=$_FILES['file_upload_aadhar_card_one_in_15']['tmp_name'];
                                        $aadhar_back_tmp=$_FILES['file_upload_aadhar_card_two_in_16']['tmp_name'];
                                        $cheque_tmp=$_FILES['file_upload_cheque_in_22']['tmp_name'];
                                        $check_dec_one=mt_rand(11111111,99999999);
                                        $check_dec_two=mt_rand(11111111,99999999);
                                        $verification_email=password_hash($check_dec_one,PASSWORD_DEFAULT);
                                        $verification_mobile=password_hash($check_dec_two,PASSWORD_DEFAULT);
                                        $iv=bin2hex($iv);
                                    
                                        $stmt_partner=mysqli_prepare($con,"INSERT INTO `form_information_submitted`
                                        (`first_name`,`last_name`,`mobile_number`,`selfie_image`,`email`,`street_address_one`,`street_address_two`,`city`,`state`,`pincode`,`date_of_birth`,`pan_number`,`pan_card_image`,`aadhar_number`,`aadhar_front_image`,`aadhar_back_image`,`agree_disagree`,`bank_account_number`,`bank_account_name`,`bank_name`,`bank_account_ifsc`,`check_image`,`verification_email`,`verification_mobile`,`main_all_acc`)
                                        VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        
                                        if( $stmt_partner ){
                                            mysqli_stmt_bind_param( $stmt_partner,"sssssssssssssssssssssssss",$f_name,$l_name,$mobile,$selfie,$email,$add_one,$add_two,$city,$state,$pincode,$date,$pan_number,$pan_pic,$aadhar_number,$aadhar_front,$aadhar_back,$aggre,$bank_acc_number,$bank_acc_name,$bank_name,$bank_ifsc,$cheque,$verification_email,$verification_mobile,$iv);
                                            $exe_stmt=mysqli_stmt_execute( $stmt_partner );
                                            $aff_rows=mysqli_stmt_affected_rows( $stmt_partner );
                                            mysqli_stmt_close( $stmt_partner );
                                            if( $exe_stmt>0 && $aff_rows>0 ){
                                                $upload_tmp=[$selfie_tmp,$pan_pic_tmp,$aadhar_front_tmp,$aadhar_back_tmp,$cheque_tmp];
                                                $upload_arry=['/upload_pictures/upload_selfie','upload_pictures/upload_pan_card','upload_pictures/upload_aadhar_front','upload_pictures/upload_aadhar_back','upload_pictures/upload_cheque'];
                                                $upload_file=[$selfie,$pan_pic,$aadhar_front,$aadhar_back,$cheque];
                                                for($i=0;$i<=4; $i++){
                                                    move_uploaded_file( $upload_tmp[$i],"../upload.all.pic.dir/".$upload_arry[$i]."/".$upload_file[$i] ) ? : array_push($error,false);
                                                }
                                                if( !in_array( false,$error ) ){
                                                    if( otp_send( $check_dec_one,$email ) )
                                                    {
                                                        send_mail('newmail@loangarage.co.in','Partner Application',"New Partner application recived .");
                                                        unset($_SESSION['JOIN_AFF_TOKEN']);
                                                        $_SESSION['APPLY_PARTNER_STATUS']=true;
                                                        $_SESSION['APPLY_PARTNER_MAIL']=$email;
                                                        mysqli_close( $con );
                                                        return_status("success","data_success");
                                                    }
                                                    else
                                                    {
                                                        return_status("failed","Unable to send mail");
                                                    }
                                                }else{
                                                    return_status("failed","Failed To Upload Files Please Retry...");
                                                }
                                            }else{
                                                return_status("failed","Failed To Submit  Please Retry...");
                                            }
                                        }else{
                                            return_status("failed","Object Not Created Please Retry...");
                                        }
                                    }else{
                                        return_status("failed","Errors Found In Files..");
                                    }
                                }else{
                                    return_status("failed","Invalid Date Please Retry...");
                                }
                            }else{
                                return_status("failed","Invalid Mobile Number");
                            }
                        }else{
                            return_status("failed","Email Already Exist");
                        }
                    }else{
                        return_status("failed","Invalid Email");
                    }
                }else{
                    return_status("failed","Token Mismatch Plese Reload Page...");
                }
            }else{
                return_status("failed","Session Missing Plese Reload Page...");
            }
        }else{
            return_status("failed","Token Missing Plese Reload Page...");
        }
    }else{   
        return_status("failed","Captcha Error");
    }
}else{
    header("location:../join-affilite.php?status=failed&&dat=fill");
    die();
}

function return_status($status,$data){
    echo json_encode(["status"=>$status,"data"=>$data]);
}
?>