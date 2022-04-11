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
            $loan_id=xss_val($con,$_GET['UID']);
            $stmt_loan_data=mysqli_prepare($con,"SELECT * FROM `loan_apply_form` WHERE `id`=? AND `mobile_confrim`=? AND `email_confrim`=?");
            if($stmt_loan_data){
                $em=0;
                $mb=0;
                mysqli_stmt_bind_param($stmt_loan_data,"iii",$loan_id,$em,$mb);
                mysqli_stmt_bind_result($stmt_loan_data,$id,$f_name,$l_name,$code,$number,$email,$add_aad_one,$add_aad_two,$add_city,$add_state,$add_pin,$add_cur_one,$add_cur_two,$cur_city,$cur_state,$cur_pin,$select_name,$pannu_ka,$UID_front,$UID_back,$jama_kha,$jitm_kha,$mukham,$mukhyam,$samaym_req,$mobile_confrim,$email_confrim,$status_loan,$response,$check_sent,$check_sent_two,$loan_amt);
                mysqli_stmt_execute($stmt_loan_data);
                if(mysqli_stmt_fetch($stmt_loan_data)){
                    mysqli_stmt_close($stmt_loan_data);
                        $check_sent='';
                        $check_sent_two='';
                        $id='';
                        $error_array=[];
                        if($mukhyam!=''){
                            $dec_array=[$f_name,$l_name,$code,$add_aad_one,$add_aad_two,$add_city,$add_state,$add_pin,$add_cur_one,$add_cur_two,$cur_city,$cur_state,$cur_pin,$select_name,$loan_amt];
                            $undec_array=[$number,$email,$status_loan,$response];
                            $img_array=[$pannu_ka,$UID_front,$UID_back,$jama_kha,$jitm_kha,$mukham];
                            for($i=0; $i<count($dec_array); $i++){
                                if($dec_array[$i]!=''){
                                    $dec_array[$i]=en_de_cry($con,$dec_array[$i],$mukhyam,"de");
                                }else{
                                    array_push($error_array,1);
                                }
                            }
                            for($i=0; $i<count($undec_array); $i++){
                                if($undec_array[$i]!==''){
                                    $undec_array[$i]=xss_val($con,$undec_array[$i]);
                                }else{
                                    array_push($error_array,2);
                                }
                            }
                            for($i=0; $i<count($img_array); $i++){
                                if($img_array[$i]!=''){
                                    $img_array[$i]=xss_date($img_array[$i]);
                                }else{
                                    array_push($error_array,3);
                                }
                            }
                            $samaym_req=change_date($samaym_req);
                            if(!in_array(false,$error_array) && count($error_array)===0){          
                                $stmt_refer=mysqli_prepare($con,"SELECT lr.partner_id,pd.first_name,pd.last_name,pd.main_all_acc FROM refer_loan lr INNER JOIN form_information_submitted pd ON pd.id=lr.partner_id AND pd.email_verify=? AND pd.mobile_verify=? AND pd.status=? WHERE lr.user_id=?");
                                if($stmt_refer){
                                    $status=0;
                                    mysqli_stmt_bind_param($stmt_refer,"iiii",$status,$status,$status,$loan_id);
                                    mysqli_stmt_bind_result($stmt_refer,$partner_id,$partner_fname,$partner_lname,$iv);
                                    mysqli_stmt_execute($stmt_refer);
                                    mysqli_stmt_fetch($stmt_refer);
                                    mysqli_stmt_close($stmt_refer);
                                    if(!empty($partner_fname) AND !empty($partner_lname) AND !empty($iv) AND !empty($partner_id) AND $partner_id>0){
                                        $partner_name=en_de_cry($con,$partner_fname,$iv,"de")." ".en_de_cry($con,$partner_lname,$iv,"de");
                                        if($partner_id=='' || !is_numeric($partner_id) || $partner_id===0){        
                                            move("error_occ");
                                        }
                                    }else{
                                        $partner_name="none";
                                        $partner_id="none";
                                    }
                                    if($status_loan==0){
                                        echo "<script>var error=true</script>";   
                                    }
                                    $loan_id=xss_val( $con,$loan_id );
                                    echo "<script>var imp_id=$loan_id</script>";
                                    $url="../uploda.all.clients.kyc.pics.dir/";
                                    mysqli_close( $con );
                                }else{
                                    move("error_occ");
                                }
                            }else{
                                move("error_occ");
                            }
                        }else{
                            move("undefine_data");
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
                        Loan Applicaion
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
                        <td><?=$dec_array[2]?> <?=$undec_array[0]?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><?=$undec_array[1]?></td>
                    </tr>
                    <tr>
                        <td>Loan Type</td>
                        <td>
                            <?php
                                if($dec_array[13]==="personal_loan"){
                                    echo "Personal Loan";
                                }else if($dec_array[13]==="business_loan"){
                                    echo "Business Loan";
                                }else if($dec_array[13]==="home_loan"){
                                    echo "Home Loan";
                                }else if($dec_array[13]==="mortgage_loan"){
                                    echo "Mortgage Loan";
                                }else if($dec_array[13]==="personal_loan_balance_transfer"){
                                    echo "Personal Loan Balance Transfer";
                                }else if($dec_array[13]==="home_loan_balance_transfer"){
                                    echo "Home Loan Balance Transfer";
                                }else if($dec_array[13]==="credit_cards"){
                                    echo "Credit Cards";
                                }else{
                                    echo "Not Selected";
                                }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Loan Amount</td>
                        <td><?=$dec_array[14]?></td>
                    </tr>
                    <tr>
                        <td>Refer Partner UID</td>
                        <td><?=$partner_id?></td>
                    </tr>
                    <tr>
                        <td>Refer Partner Name</td>
                        <td><?=$partner_name?></td>
                    </tr>
                    <tr>
                        <td>Applied On</td>
                        <td><?=$samaym_req?></td>
                    </tr>
                    <tr class="heading">
                        <td colspan=2>Address As Per AADHAR</td>
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
                            <td colspan=2>Current Address</td>
                        </tr>
                    <tr>
                        <td>Street Address 1</td>
                        <td><?=$dec_array[8]?></td>
                    </tr>
                    <tr>
                        <td>Street Address 2</td>
                        <td><?=$dec_array[9]?></td>
                    </tr>
                    <tr>
                        <td>City</td>
                        <td><?=$dec_array[10]?></td>
                    </tr>
                    <tr>
                        <td>State / Province</td>
                        <td><?=$dec_array[11]?></td>
                    </tr>
                    <tr>
                        <td>Pincode</td>
                        <td><?=$dec_array[12]?></td>
                    </tr>
                    <tr>
                        <tr class="heading">
                            <td colspan=2>Uploaded Files</td>
                        </tr>
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
                        <td>Last 6 months Bank Statement (including yesterday)</td>
                        <td><a target="blank" href="<?=$url?>upload_bank/<?=$img_array[3]?>">BANK STATEMENT</a></td>
                    </tr>
                    <tr>
                        <td>Last 3 months Salary Slips</td>
                        <td><a target="blank" href="<?=$url?>upload_salary/<?=$img_array[4]?>">SALARY SLIP</a></td>
                    </tr>
                    <tr>
                        <td>Upload your Selfie</td>
                        <td><a target="blank" href="<?=$url?>upload_selfie/<?=$img_array[5]?>">SELFIE</a></td>
                    </tr>
                </table>
                <div class="inp_response" id="response_box">
                    <input type="hidden" name="csrf_tkn_response" id="tkn_csrf_response" value="<?=token("LOAN_RESPONSE_ADMIN")?>">
                    <textarea class="response_admin" name="admin_resposne" id="response" placeholder="Enter Your Response" required autocomplete="off"></textarea>
                </div>
                <div class="error_con" id="error_con_id">
                    <span class="error_lab" id="error_lab_id">error</span>
                </div>
                <div class="edit_buttons" id="response_box_btns">
                    <button id="failed_btn" class="button failed">Reject</button>
                    <button id="success_btn" class="button success">Accept</button>
                </div>
            </div>
        </div>
        <script src="admin.js.all.files/fullDetailsLoan.js"></script>
    </body>
</html>
<?php
function move($data)
{
    header("location:admin_home.php?user_error=".$data);
    die();
}
?>