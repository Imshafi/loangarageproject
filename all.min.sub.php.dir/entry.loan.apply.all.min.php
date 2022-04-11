<?php
    if( isset($_POST) && isset($_FILES) && !empty($_POST) && !empty($_FILES) ){
        $sec="6Lf_EkEdAAAAAHMvikpZwxfKTMMAuPVdkbp_15rJ";
        $val=file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$sec.'&response='.$_POST['g-recaptcha-response']);
        $res=json_decode($val);
        if($res->success){
            include '../all.inc.fle.php.dir/al-fun-form-functions.php';
            if( isset($_SESSION['APPLY_LOAN_TOKEN']) && !empty($_SESSION['APPLY_LOAN_TOKEN']) ){
                if(isset($_POST['apply_loan_csrf_token']) && !empty($_POST['apply_loan_csrf_token']) ){
                    if( $_SESSION['APPLY_LOAN_TOKEN']==$_POST['apply_loan_csrf_token'] ){
                        $email = filter_var( $email=$_POST['email'],FILTER_SANITIZE_EMAIL);
                        if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                            $patren="/^[6-9]{1}[0-9]{9}$/";
                            if(preg_match($patren,$_POST['number'])){
                                require_once 'connection.all.min.php';
                                require_once 'send_mail.php';
                                $error=[];
                                $allow_img=['JPG','PNG','JPEG','PDF'];
                                $files=['upload_pan','upload_aad_front','upload_aad_back','upload_bank','upload_salary','upload_selfie'];
                                foreach($files as $i){

                                    if( $_FILES[$i]['error']>0 ){
                                        array_push($error,2);
                                    }

                                    $file_name=explode('.',$_FILES[$i]['name']);
                                    $file_ext=strtoupper(end($file_name));

                                    if(!in_array($file_ext,$allow_img)){
                                        array_push($error,1);
                                    }

                                    $_FILES[$i]['name']=uniqid('',true).".".$file_ext;
                                }
                                if(in_array(false,$error) || count( $error )>0 ){
                                    echo json_encode(return_data("failed","Invalid Files"));
                                }else{
                                    if(strlen($_POST['number'])===10){
                                        if(strlen($_POST['code'])<6){
                                            if(count($_POST)===21){
                                                if(count($_FILES)===6){
                                                    if(is_numeric($_POST['loan_amt']) && $_POST['loan_amt']>25000 && $_POST['loan_amt']<10000000){
                                                        
                                                        $details_array=['f_name','l_name','code','add_aad_one','add_aad_two','add_city','add_state','add_cur_one','add_cur_two','cur_city','cur_state','select_name','loan_amt'];
                                                        $iv=openssl_random_pseudo_bytes(16);
                                                        $mobile_number=xss_val($con,$_POST['number']);
                                                        $email=xss_val($con,$_POST['email']);
                                                        $refer_id=xss_val($con,$_POST['refer_id']);
                                                        $refer_value=xss_val($con,$_POST['refer_value']);
                                                        $add_pin=en_de_cry($con,filter_var($_POST['add_pin'],FILTER_VALIDATE_INT),$iv,"en");
                                                        $cur_pin=en_de_cry($con,filter_var($_POST['cur_pin'],FILTER_VALIDATE_INT),$iv,"en");
                                                        
                                                        for($i=0; $i<count($details_array); $i++){
                                                            
                                                            if($_POST[$details_array[$i]]!==''){
                                                                $details_array[$i]=en_de_cry($con,filter_var($_POST[$details_array[$i]], FILTER_SANITIZE_STRING),$iv,"en");
                                                            }else{
                                                                array_push($error,false);
                                                            }

                                                        }
                                                        
                                                        if( !in_array( false,$error ) AND count( $error )===0 ){
                                                            unset($_POST);
                                                            $iv=bin2hex($iv);
                                                            $check_dec_one=mt_rand(11111111,99999999);
                                                            $check_dec_two=mt_rand(11111111,99999999);
                                                            $check_sent_one=password_hash($check_dec_one,PASSWORD_DEFAULT);
                                                            $check_sent_two=password_hash($check_dec_two,PASSWORD_DEFAULT);

                                                            $stmt=mysqli_prepare($con,"INSERT INTO `loan_apply_form`
                                                            (`f_name`,`l_name`,`code`,`number`,`email`,`add_aad_one`,`add_aad_two`,`add_city`,`add_state`,`add_pin`,`add_cur_one`,`add_cur_two`,`cur_city`,`cur_state`,`cur_pin`,`select_name`,`pannu_ka`,`UID_front`,`UID_back`,`jama_kha`,`jitm_kha`,`mukham`,`mukhyam`,`check_sent`,`check_sent_two`,`loan_amt`) VALUES
                                                            (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
                                                            if($stmt){
                                                                mysqli_stmt_bind_param($stmt,"sssissssssssssssssssssssss",
                                                                    $details_array[0],$details_array[1],$details_array[2],$mobile_number,
                                                                    $email,$details_array[3],$details_array[4],$details_array[5],
                                                                    $details_array[6],$add_pin,$details_array[7],$details_array[8],
                                                                    $details_array[9],$details_array[10],$cur_pin,$details_array[11],
                                                                    $_FILES[$files[0]]['name'],$_FILES[$files[1]]['name'],$_FILES[$files[2]]['name'],$_FILES[$files[3]]['name'],
                                                                    $_FILES[$files[4]]['name'],$_FILES[$files[5]]['name'],$iv,
                                                                    $check_sent_one,$check_sent_two,$details_array[12]
                                                                );
                                                                $exe_rows_in=mysqli_stmt_execute( $stmt );
                                                                $aff_rows_in=mysqli_stmt_affected_rows( $stmt );

                                                                if( $aff_rows_in && $exe_rows_in ){
                                                                    $user_query="SELECT `id` FROM `loan_apply_form` WHERE `email`=? AND `number`=? ORDER BY `id` DESC";
                                                                    $stmt_user=mysqli_prepare($con,$user_query);
                                                                    if($stmt_user)
                                                                    {
                                                                        mysqli_stmt_bind_param($stmt_user,"si",$email,$mobile_number);
                                                                        mysqli_stmt_bind_result($stmt_user,$user_id);
                                                                        $exe_check=mysqli_stmt_execute($stmt_user);
                                                                        $fetch_check=mysqli_stmt_fetch($stmt_user);
                                                                        mysqli_stmt_close($stmt_user);
                                                                        if( $exe_check && $fetch_check && !empty( $user_id ) )
                                                                        {
                                                                            $folder_array=['upload_pan_card','upload_aadhar_front','upload_aadhar_back','upload_bank','upload_salary','upload_selfie'];
                                                                            for($i=0; $i<count($files); $i++){
                                                                                $destination="../uploda.all.clients.kyc.pics.dir/".$folder_array[$i]."/".$_FILES[$files[$i]]['name'];
                                                                                if( !move_uploaded_file($_FILES[$files[$i]]['tmp_name'],$destination) )
                                                                                {
                                                                                    array_push($error,false);
                                                                                }
                                                                            }
                                                                            if( !in_array( false, $error ) && count( $error ) ===0 )
                                                                            {
                                                                                if( otp_send( $check_dec_one,$email ) )
                                                                                {
                                                                                    if(isset($_SESSION['PARTNER_LOGIN_STATUS']) AND isset($_SESSION['PARTNER_ID']) AND is_bool($_SESSION['PARTNER_LOGIN_STATUS']) AND is_numeric($_SESSION['PARTNER_ID']))
                                                                                    { 
                                                                                        if(!empty($refer_id) AND !empty($refer_value) AND is_numeric($refer_id) AND is_numeric($refer_value)){
                                                                                            $stmt_refer=mysqli_prepare($con,"SELECT `partner_id`,`user_id`,refer_status`` FROM `refer_loan` WHERE `id`=? AND `refer_value`=? ORDER BY `id` DESC");
                                                                                            if($stmt_refer){
                                                                                                mysqli_stmt_bind_param($stmt_refer,"ii",$refer_id,$refer_value);
                                                                                                mysqli_stmt_bind_result($stmt_refer,$patren_id,$refer_user_id,$refer_base_status);
                                                                                                mysqli_stmt_execute($stmt_refer);
                                                                                                mysqli_stmt_fetch($stmt_refer);
                                                                                                mysqli_stmt_close($stmt_refer);
                                                                                                if(!empty($patren_id) AND empty($refer_user_id) AND $_SESSION['PARTNER_ID']==$patren_id){
                                                                                                    if($refer_base_status==1){
                                                                                                        $stmt_refer_update=mysqli_prepare($con,"UPDATE `refer_loan` SET `user_id`=? ,`refer_status`=? WHERE `id`=?");
                                                                                                        if($stmt_refer_update){
                                                                                                            $refer_status=0;
                                                                                                            mysqli_stmt_bind_param($stmt_refer_update,"iii",$user_id,$refer_status,$refer_id);
                                                                                                            $exe_stmt=mysqli_stmt_execute( $stmt_refer_update );
                                                                                                            $aff_rows=mysqli_stmt_affected_rows( $stmt_refer_update );
                                                                                                            mysqli_stmt_close( $stmt_refer_update );
                                                                                                            if( $exe_stmt>0 && $aff_rows>0 ){
                                                                                                                send_mail('newmail@loangarage.co.in','New Loan Application',"New Loan application recived of UID = $user_id . refer by partner UID = $patren_id .");
                                                                                                                echo json_encode(return_data("success","Form Successfully Submitted..."));
                                                                                                            }else{
                                                                                                                echo json_encode(return_data("success","Form Successfully Submitted But Reffer Is Not Success"));
                                                                                                            }
                                                                                                        }else{
                                                                                                            echo json_encode(return_data("success","Form Successfully Submitted But Reffer Is Not Success"));
                                                                                                        }
                                                                                                    }else{
                                                                                                        echo json_encode(return_data("success","Form Successfully Submitted But Already Referred"));
                                                                                                    }
                                                                                                }else{
                                                                                                    echo json_encode(return_data("success","Form Successfully Submitted But Reffer Is Not Success"));
                                                                                                }
                                                                                            }else{
                                                                                                echo json_encode(return_data("success","Object Not Created Please Try Again..."));
                                                                                            }
                                                                                        }else{
                                                                                            echo json_encode(return_data("success","Form Successfully Submitted With Out Refer"));
                                                                                        }
                                                                                    }else{
                                                                                        send_mail('newmail@loangarage.co.in','New Loan Application',"New Loan application recived of UID = $user_id .");
                                                                                        echo json_encode(return_data("success","Form Successfully Submitted.."));
                                                                                    }
                                                                                    unset($_SESSION['APPLY_LOAN_TOKEN']);
                                                                                    $_SESSION['LOAN_APPLY_SUCCESS']=true;
                                                                                    $_SESSION['LOAN_APPLY_MAIL']=$email;
                                                                                    $_SESSION['LOAN_UID']=$user_id;
                                                                                    mysqli_close( $con );
                                                                                }
                                                                                else
                                                                                {
                                                                                    echo json_encode(return_data("failed","Unable to send mail"));
                                                                                }
                                                                            }
                                                                            else
                                                                            {
                                                                                echo json_encode(return_data("failed","Something went wrong"));
                                                                            }
                                                                        }else{
                                                                            echo json_encode(return_data("failed","Failed To Get Your Data"));
                                                                        }
                                                                    }else{
                                                                        echo json_encode(return_data("failed","Failed To Get Your Data"));
                                                                    }
                                                                }else{
                                                                    echo json_encode(return_data("failed","Failed To Insert Data Please Retry.."));
                                                                }
                                                            }else{
                                                                echo json_encode(return_data("failed","Failed Please Retry.."));
                                                            }
                                                        }else{
                                                            echo json_encode(return_data("failed","Empty Details"));
                                                        }
                                                    }else{
                                                        echo json_encode(return_data("failed","Invalid Amount"));
                                                    }
                                                }else{
                                                    echo json_encode(return_data("failed","Please Fill All Details"));
                                                }
                                            }else{
                                                echo json_encode(return_data("failed","Please Fill All Details"));
                                            }
                                        }else{
                                            echo json_encode(return_data("failed","Enter Valid Country Code"));
                                        }
                                    }else{
                                        echo json_encode(return_data("failed","Enter Valid Mobile Number"));
                                    }
                                }
                            }else{
                                echo json_encode(return_data("failed","Enter Valid Email"));
                            }
                        }else{
                            echo json_encode(return_data("failed","Enter Valid Email"));
                        }
                    }else{
                        echo json_encode(return_data("failed","Token Not Match Please Reload Page"));
                    }
                }else{
                    echo json_encode(return_data("failed","Token Missing Please Reload Page"));
                }
            }else{
                echo json_encode(return_data("failed","Session Missing Please Reload Page"));
            }
        }else{
            echo json_encode(return_data("failed","Invalid Captch"));
        }
    }else{?>
        <script>
            window.location.href="../loan_apply.php";
        </script>
    <?php
    }

    function return_data($status,$data){
        return ["status"=>$status,"data"=>$data];
    }
?>