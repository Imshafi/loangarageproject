<?php
    $themecolor="#94f873";
    require_once '../all.inc.fle.php.dir/al-fun-form-functions.php';
    if(!isset($_SESSION['ADMIN_LOGIN_STATUS'])          OR !isset($_SESSION['ADMIN_ID'])            OR  
        empty($_SESSION['ADMIN_LOGIN_STATUS'])          OR  empty($_SESSION['ADMIN_ID'])            OR
        is_bool($_SESSION['ADMIN_LOGIN_STATUS'])==false OR is_numeric($_SESSION['ADMIN_ID'])==false OR
        $_SESSION['ADMIN_LOGIN_STATUS']==false     OR $_SESSION['ADMIN_ID']!==1){
            header("location:../partner_auth.php");
            die();
    }else{
        if(isset($_GET) && !empty($_GET) && count($_GET)===1 && is_numeric($_GET['UID']) && $_GET['UID']>0){
            require_once '../all.min.sub.php.dir/connection.all.min.php';
            $partner_id=xss_val($con,$_GET['UID']);
            $stmt_partner_data=mysqli_prepare($con,"SELECT * FROM `form_information_submitted` WHERE `id`=? AND `email_verify`=? AND `mobile_verify`=?");
            if($stmt_partner_data){
                $em=0;
                $mb=0;
                mysqli_stmt_bind_param($stmt_partner_data,"iii",$partner_id,$em,$mb);
                mysqli_stmt_bind_result($stmt_partner_data,$id,$f_name,$l_name,$number,$mukham,$email,$aad_one,$aad_two,$city,$state,$pin,$dOB,$pannu_num,$pannu_ka,$UID_num,$UID_front,$UID_back,$agrement,$bank_acc_num,$bank_acc_nam,$bank_nam,$bank_ifsc,$check_img,$v_email,$time,$iv,$status_acc,$email_confrim,$mobile_confrim,$v_mobile);
                $exe_stmt=mysqli_stmt_execute($stmt_partner_data);
                $fetch_stmt=mysqli_stmt_fetch($stmt_partner_data);
                mysqli_stmt_close($stmt_partner_data);
                if( $exe_stmt>0 && $fetch_stmt>0 ){
                    if($status_acc==1 || $status_acc==2){
                        $v_email='';
                        $v_mobile='';
                        $id='';
                        $email_confrim='';
                        $mobile_confrim='';
                        $status_acc='';
                        $error_array=[];
                        if($iv!=''){
                            $dec_array=[$f_name,$l_name,$number,$aad_one,$aad_two,$city,$state,$pin,$dOB,$pannu_num,$UID_num,$bank_acc_num,$bank_acc_nam,$bank_nam,$bank_ifsc];
                            $undec_array=[$email,$agrement];
                            $img_array=[$pannu_ka,$UID_front,$UID_back,$check_img,$mukham];
                            $time=change_date($time);
                            for($i=0; $i<count($dec_array); $i++){
                                if($dec_array[$i]!==''){
                                    $dec_array[$i]=en_de_cry($con,$dec_array[$i],$iv,"de");
                                }else{
                                    array_push($error_array,false);
                                }
                            }
                            for($i=0; $i<count($undec_array); $i++){
                                if($undec_array[$i]!==''){
                                    $undec_array[$i]=xss_val($con,$undec_array[$i]);
                                }else{
                                    array_push($undec_array,false);
                                }
                            }
                            for($i=0; $i<count($img_array); $i++){
                                if($img_array[$i]!==''){
                                    $img_array[$i]=xss_date($img_array[$i]);
                                }else{
                                    array_push($error_array,false);
                                }
                            }
                            if(!in_array(false,$error_array) && count($error_array)===0){          
                                echo "<script>var imp_id=$partner_id</script>";
                                $url="../upload.all.pic.dir/upload_pictures/";
                                mysqli_close( $con );
                            }else{
                                move("error_occ");
                            }
                        }else{
                            move("undefine_data");
                        }
                    }else{
                        move("Already Accepted");
                    }
                }else{
                    move("failed_fetch");
                }
            }else{
                move("undefine_data");
            }
        }else{
            move("undefine_data");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1,user-scalable=no">
        <meta name="theme-color" content="<?=$themecolor?>">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style"  content="<?=$themecolor?>">
        <link rel="shortcut icon" href="../logo_pictures.dir/1.5.1.43.2.4.5.6.7.77.77.8.8.8.9.2.2.34.4.logo.4443.44967.gif">
        <link rel="stylesheet" href="./admin.style.all.files/fullDetails.css">
        <link rel="stylesheet" href="../font-icons/css/all.min.css">
        <script src="./admin.js.all.files/jquery.js"></script>
        <title>About Loan</title>
    </head>
    <body>
        <div class="whole_continer">
            <div class="details_contienr">
                <div class="loan_applied_header_con">
                    <h1 class="heading_lab">
                        Partner Applicaion
                    </h1>
                </div>
                <table class="details_table" border="1">
                    <tr class="heading">
                        <td colspan=2>Basic Data</td>
                    </tr>
                    <tr>
                        <td>First Name</td>
                        <td><?=$dec_array[0]?></td>
                    </tr>
                    <tr>
                        <td>Last Name</td>
                        <td><?=$dec_array[1]?></td>
                    </tr>
                    <tr>
                        <td>Mobile Number</td>
                        <td><?=$dec_array[2]?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><?=$undec_array[0]?></td>
                    </tr>
                    <tr>
                        <td>Date Of Birth</td>
                        <td><?=$dec_array[8]?></td>
                    </tr>
                    <tr>
                        <td>Applied On</td>
                        <td><?=$time?></td>
                    </tr>
                    <tr>
                        <td>Agrememt</td>
                        <td>
                            <?php
                            if($undec_array[1]==0){
                                echo "accepted";
                            }else{
                                echo "Not accepted";
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>PAN NUMBER</td>
                        <td><?=$dec_array[9]?></td>
                    </tr>
                    <tr>
                        <td>AADHAR NUMBER</td>
                        <td><?=$dec_array[10]?></td>
                    </tr>
                    <tr class="heading">
                        <td colspan=2>Bank Details</td>
                    </tr>
                    <tr>
                        <td>Bank Name</td>
                        <td><?=$dec_array[13]?></td>
                    </tr>
                    <tr>
                        <td>Account Name</td>
                        <td><?=$dec_array[12]?></td>
                    </tr>
                    <tr>
                        <td>Account Number</td>
                        <td><?=$dec_array[11]?></td>
                    </tr>
                    <tr>
                        <td>Bank IFSC Code</td>
                        <td><?=$dec_array[14]?></td>
                    </tr>
                    <tr class="heading">
                        <td colspan=2>Address</td>
                    </tr>
                    <tr>
                        <td>Street Address 1</td>
                        <td><?=$dec_array[3]?></td>
                    </tr>
                    <tr>
                        <td>Street Address 2</td>
                        <td><?=$dec_array[4]?></td>
                    </tr>
                    <tr>
                        <td>City</td>
                        <td><?=$dec_array[5]?></td>
                    </tr>
                    <tr>
                        <td>State / Province</td>
                        <td><?=$dec_array[6]?></td>
                    </tr>
                    <tr>
                        <td>Pincode</td>
                        <td><?=$dec_array[7]?></td>
                    </tr>
                    <tr class="heading">
                        <td colspan=2>Uploaded Files</td>
                    </tr>
                    <tr>
                        <td>PAN Card</td>
                        <td><a target="blank" href="<?=$url?>upload_pan_card/<?=$img_array[0]?>">PAN CARD</a></td>
                    </tr>
                    <tr>
                        <td>Adhaar Front Side</td>
                        <td><a target="blank" href="<?=$url?>upload_aadhar_front/<?=$img_array[1]?>">AADHAR FRONT SIDE</a></td>
                    </tr>
                    <tr>
                        <td>Adhaar Back Side</td>
                        <td><a target="blank" href="<?=$url?>upload_aadhar_back/<?=$img_array[2]?>">AADHAR BACK SIDE</a></td>
                    </tr>
                    <tr>
                        <td>Cancelled Cheque Photo</td>
                        <td><a target="blank" href="<?=$url?>upload_bank/<?=$img_array[3]?>">BANK STATEMENT</a></td>
                    </tr>
                    <tr>
                        <td>Upload your Selfie</td>
                        <td><a target="blank" href="<?=$url?>upload_selfie/<?=$img_array[4]?>">SELFIE</a></td>
                    </tr>
                </table>
                <div class="error_con" id="error_con_id">
                    <span class="error_lab" id="error_lab_id">error</span>
                </div>
                <div class="edit_buttons" id="response_box_btns">
                    <input type="hidden" name="csrf_tkn_response" id="tkn_csrf_response" value="<?=token("PARTNER_RESPONSE_ADMIN")?>">
                    <button id="failed_btn" class="button failed">Reject</button>
                    <button id="success_btn" class="button success">Accept</button>
                </div>
            </div>
        </div>
        <script src="admin.js.all.files/fullDetailsPartner.js"></script>
    </body>
</html>
<?php
function move($data)
{
    header("location:partner_applications.php?user_error=".$data);
    die();
}
?>