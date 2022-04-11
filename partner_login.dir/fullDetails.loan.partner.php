<?php
    $themecolor="#94f873";
    require_once '../all.inc.fle.php.dir/al-fun-form-functions.php';
    if(!isset($_SESSION['PARTNER_LOGIN_STATUS'])          OR !isset($_SESSION['PARTNER_ID'])            OR  
    empty($_SESSION['PARTNER_LOGIN_STATUS'])          OR  empty($_SESSION['PARTNER_ID'])            OR
    is_bool($_SESSION['PARTNER_LOGIN_STATUS'])==false OR is_numeric($_SESSION['PARTNER_ID'])==false OR
    $_SESSION['PARTNER_LOGIN_STATUS']==false     OR $_SESSION['PARTNER_ID']<1){
        header("location:../partner_auth.php");
        die();
    }else{
        require_once '../all.min.sub.php.dir/connection.all.min.php';
        $partner_id=xss_val($con,$_SESSION['PARTNER_ID']);
        if(isset($_GET) && !empty($_GET) && count($_GET)===1 && is_numeric($_GET['UID']) && $_GET['UID']>0){
            $loan_id=xss_val($con,$_GET['UID']);
            $check_refer=mysqli_prepare($con,"SELECT `partner_id`,`dabbu` FROM `refer_loan` WHERE `user_id`=?");
            if($check_refer){
                mysqli_stmt_bind_param($check_refer,"i",$loan_id);
                mysqli_stmt_bind_result( $check_refer,$refer_partner_id,$dabbu );
                mysqli_stmt_execute($check_refer);
                mysqli_stmt_store_result($check_refer);
                if(mysqli_stmt_num_rows($check_refer)>0){
                    mysqli_stmt_fetch($check_refer);
                    mysqli_stmt_close($check_refer);
                    if($partner_id==$refer_partner_id){
                        $partner_data=mysqli_prepare($con,"SELECT pd.first_name,pd.last_name,pd.main_all_acc FROM partner_auth pa INNER JOIN form_information_submitted pd ON pd.id=pa.info WHERE pa.id=? AND pd.status=? AND pd.email_verify=? AND pd.mobile_verify=?");
                        if($partner_data){
                            $sta=0;
                            mysqli_stmt_bind_param($partner_data,"iiii",$partner_id,$sta,$sta,$sta);
                            mysqli_stmt_bind_result($partner_data,$p_fname,$p_lname,$p_iv);
                            mysqli_stmt_execute($partner_data);
                            mysqli_stmt_store_result($partner_data);
                            if(mysqli_stmt_num_rows($partner_data)>0){
                                if(mysqli_stmt_fetch($partner_data)){
                                    mysqli_stmt_close($partner_data);
                                    if(!empty($p_fname) && !empty($p_lname) && !empty($p_iv)){
                                        $partner_name=en_de_cry($con,$p_fname,$p_iv,"de")." ".en_de_cry($con,$p_lname,$p_iv,"de");
                                        $stmt_loan_data=mysqli_prepare($con,"SELECT * FROM `loan_apply_form` WHERE `id`=? AND `mobile_confrim`=? AND `email_confrim`=?");
                                        if($stmt_loan_data){
                                            mysqli_stmt_bind_param($stmt_loan_data,"iii",$loan_id,$sta,$sta);
                                            mysqli_stmt_bind_result($stmt_loan_data,$id,$f_name,$l_name,$code,$number,$email,$add_aad_one,$add_aad_two,$add_city,$add_state,$add_pin,$add_cur_one,$add_cur_two,$cur_city,$cur_state,$cur_pin,$select_name,$pannu_ka,$UID_front,$UID_back,$jama_kha,$jitm_kha,$mukham,$mukhyam,$samaym_req,$mobile_confrim,$email_confrim,$status_loan,$response,$check_sent,$check_sent_two,$loan_amt);
                                            mysqli_stmt_execute($stmt_loan_data);
                                            mysqli_stmt_store_result($stmt_loan_data);
                                            if(mysqli_stmt_num_rows($stmt_loan_data)>0){
                                                if(mysqli_stmt_fetch($stmt_loan_data)){
                                                    mysqli_stmt_close($stmt_loan_data);
                                                    $check_sent='';
                                                    $check_sent_two='';
                                                    $id='';
                                                    $error_array=[];
                                                    if($mukhyam!==''){
                                                        $dec_array=[$f_name,$l_name,$code,$add_aad_one,$add_aad_two,$add_city,$add_state,$add_pin,$add_cur_one,$add_cur_two,$cur_city,$cur_state,$cur_pin,$select_name,$loan_amt];
                                                        $undec_array=[$number,$email,$status_loan,$response,$samaym_req];
                                                        $img_array=[$pannu_ka,$UID_front,$UID_back,$jama_kha,$jitm_kha,$mukham];
                                                        for($i=0; $i<count($dec_array); $i++){
                                                            if($dec_array[$i]!==''){
                                                                $dec_array[$i]=en_de_cry($con,$dec_array[$i],$mukhyam,"de");
                                                            }else{
                                                                array_push($error_array,false);
                                                            }
                                                        }
                                                        for($i=0; $i<count($undec_array); $i++){
                                                            if($undec_array[$i]!==''){
                                                                $undec_array[$i]=xss_val($con,$undec_array[$i]);
                                                            }else{
                                                                array_push($error_array,false);
                                                            }
                                                        }
                                                        for($i=0; $i<count($img_array); $i++){
                                                            if($img_array[$i]!=''){
                                                                $img_array[$i]=xss_date($img_array[$i]);
                                                            }else{
                                                                array_push($error_array,false);
                                                            }
                                                        }
                                                        if( $dabbu!=='' )
                                                        {
                                                            xss_val($con,$dabbu);
                                                        }
                                                        else
                                                        {
                                                            array_push($error_array,false);
                                                        }
                                                        if(!in_array(false,$error_array) && count($error_array)===0){
                                                            $url="../uploda.all.clients.kyc.pics.dir/";
                                                        }else{
                                                            move("Invalid Details");
                                                        }
                                                    }else{
                                                        move("Invalid Details");
                                                    }
                                                }else{
                                                    move("No Result Found");
                                                }
                                            }else{
                                                move("No Result Found");
                                            }
                                        }else{
                                            move("Failed To Create Object Please Retry");
                                        }
                                    }else{
                                        move("Invalid Details");
                                    }
                                }else{
                                    move("No Result Found");
                                }
                            }else{
                                move("No Result Found");
                            }
                        }else{
                            move("Failed To Create Object Please Retry");
                        }
                    }else{
                        move("Invalid UID");
                    }
                }else{
                    move("No Result Found");
                }
            }else{
                move("Failed To Create Object Please Retry");
            }
        }else{
            move("Invalid UID");
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
        <link rel="stylesheet" href="../Loan_garage_controller/admin.style.all.files/fullDetails.css">
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
                    <tr class="heading">
                        <td colspan=2>Loan Details</td>
                    </tr>
                    <tr>
                        <td>Loan Status</td>
                        <td>
                            <?php
                            if( $undec_array[2]==0 )
                            {
                                echo "Approved";
                            }
                            elseif( $undec_array[2]==1 )
                            {
                                echo "On Progress";
                            }else
                            {
                                echo "Rejected";
                            }
                            ?>
                        </td>
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
                        <td>Earned</td>
                        <td>&#8377; <?=$dabbu?></td>
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
        </div>
    </body>
</html>
<?php
function move($data)
{
    header("location:partner_home.php?status=failed&&user_error=".$data);
    die();
}
?>

                            
                            
                                

                                    
