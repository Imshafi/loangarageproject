<?php
    include 'all.inc.fle.php.dir/al-fun-form-functions.php';
    define("A0(57%?<Fr@4**&K#2*&(J^8392$()8347&^",true);
    $refer_id="nothing";
    $refer_value="nothing";
    if( isset( $_SESSION['LOAN_APPLY_SUCCESS'] ) && isset( $_SESSION['LOAN_APPLY_MAIL'] ) &&isset( $_SESSION['LOAN_UID'] ) && $_SESSION['LOAN_APPLY_SUCCESS']===true && is_numeric( $_SESSION['LOAN_UID'] ) && !empty( $_SESSION['LOAN_APPLY_MAIL'] ) )
    {
        header("location:loan_verification.php");
    }
    if(isset($_GET) && !empty($_GET) && isset($_GET['status']) && $_GET['status']==="refer"){
        $pattren="/^[0-9]+$/";
        if(isset($_SESSION['PARTNER_ID']) AND !empty($_SESSION['PARTNER_ID']) AND is_numeric($_SESSION['PARTNER_ID']) AND preg_match($pattren,$_SESSION['PARTNER_ID'])){
            if(isset($_GET['refer_id']) && is_numeric($_GET['refer_id'])){
                if(preg_match($pattren,$_GET['refer_id'])){
                    require_once 'all.min.sub.php.dir/connection.all.min.php';
                    $refer_query="SELECT `refer_value`,`user_id` FROM `refer_loan` WHERE `id`=? AND `refer_status`=? ORDER BY `id` DESC";
                    $stmt=mysqli_prepare($con,$refer_query);
                    $status_refer=1;
                    if($stmt){
                        mysqli_stmt_bind_param($stmt,"ii",$_GET['refer_id'],$status_refer);
                        mysqli_stmt_bind_result($stmt,$refer_value,$user_id);
                        mysqli_stmt_execute($stmt);
                        if(mysqli_stmt_fetch($stmt)){
                            if($user_id==0){
                                $refer_id=$_GET['refer_id'];
                            }else{
                                __error_refer("Error In Fetch Data. Please Refer Again Loan");
                            }
                        }else{
                            __error_refer("Error In Fetch Data . Please Refer Again Loan");
                        }
                        mysqli_stmt_close( $stmt );
                    }else{
                        __error_refer("Object Not Created. Please Refer Again Loan");
                    }
                }else{
                    __error_refer("Undefined Refer UID. Please Refer Again Loan");
                }
            }else{
                __error_refer("Undefined Refer UID. Please Refer Again Loan");
            }
        }else{
            __error_refer("Undefined Partner UID. Please Refer Again Loan");
        }
    }
?>
<?php 
    require_once 'all.inc.fle.php.dir/inc.fle.php';
?>
    <link rel="stylesheet" href="all.min.style_sheet.dir/loan_apply.css">
    <script src="all.js.min.dir/validation_func.js"></script>
    <title>Loan Applicaion</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gemunu+Libre:wght@200&family=Yaldevi:wght@200&display=swap" rel="stylesheet">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
    <div class="loader_con">
        <div class="loading">
        </div>
    </div>
    <style>
        .loader_con
        {
            background-color:rgb(218 218 218 / 0.7);
            height:100vh;
            width:100%;
            position:absolute;
            display:flex;
            justify-content:center;
            align-items:center;
            z-index:1;
        }
        .loading
        {
            height:50px;
            width:50px;
            border-top:5px solid #11e311;
            border-radius:50%;
            animation:rotate 1s infinite;
        }
        @keyframes rotate
        {
            from
            {
                transform:rotate(0deg);
            }
            to
            {
                transform:rotate(360deg);
            }
        }
    </style>
    <script>
        window.addEventListener("load",()=>{
            document.querySelector(".loader_con").style.display="none";
            document.querySelector(".con_all_nav_fot").style.display="block";

        })
    </script>
    <div class="con_all_nav_fot">
    <?php 
        require_once 'all.inc.fle.php.dir/nav.bar.full.inc.php';
    ?>
    <div class="whole_loan_app_con">
        <div class="logo_loan_app_con">
            <img src="logo_pictures.dir/1.5.1.43.2.4.5.6.7.77.77.8.8.8.9.2.2.34.4.logo.4443.44967.gif" alt="LOGO" class="logo_loan_app_img">
        </div>
        <div id="formWholeContiner" class="wholecontiner_form">
            <div class="form_apply_loan_con">
                <h2 class="apply_loan_heading">Form</h2>
                <p class="apply_form_para">Apply For Loan / Credit Card</p>
                <hr class="hr_apply_loan">
            </div>
            <div class="loanReturnShower" id="loan_return_shaower">
                <span id="return_label"></span>
            </div>
            <form id="full_form_apply_loan">
            <input type="hidden" name="apply_loan_csrf_token" id="APPLY_LOAN_TOKEN" value="<?=token('APPLY_LOAN_TOKEN')?>">
                <div class="con nameContiner" id="name_continer">
                    <label for="f_name" class="main_label">Name</label>
                    <div class="f_name_con lab_inp_con">
                        <input class="inp" type="text" name="f_name" id="f_name" required autocomplete="off">
                        <label for="f_name" class="sub_lab">First Name</label>
                    </div>
                    <div class="l_name_con lab_inp_con">
                        <input class="inp" type="text" name="l_name" id="l_name" required autocomplete="off">
                        <label class="sub_lab" for="l_name">Last Name</label>
                    </div>
                    <div class="error_lab">Enter Valid Name</div>
                </div>
                <div class="con mobileContiner" id="mobile_con">
                    <label for="code" class="main_label phone_number">Phone Number <span class="star">*</span> </label>
                    <div class="code_num lab_inp_con">
                        <input class="inp" type="text" value="+91" name="code" id="code" required autocomplete="off">
                        <label for="code" class="sub_lab">Country Code</label>
                    </div>
                    <div class="number lab_inp_con">
                        <input class="inp" type="number" name="number" id="number" required pattren="[6-9]{1}[0-9]{9}" autocomplete="off">
                        <label class="sub_lab" for="number">Phone Number</label>
                    </div>
                    <div class="error_lab">Enter Valid Number</div>
                </div>
                <div class="con nameContiner" id="email_con">
                    <label for="email" class="main_label">Email <span class="star">*</span> </label>
                    <div class="email lab_inp_con">
                        <input class="inp" type="email" name="email" id="email" required autocomplete="off">
                    </div>
                    <div class="error_lab">Enter Valid Email</div>
                </div>
                <div class="con addaaContiner" id="address_aadhar_continer">
                    <label for="add_aad_one" class="main_label">Address as per Adhaar <span class="star">*</span> </label>
                    <div class="aad add_one add_aad_one_con lab_inp_con">
                        <input class="inp" type="text" name="add_aad_one" id="add_aad_one" required autocomplete="off">
                        <label for="add_aad_one" class="sub_lab">Street Address</label>
                    </div>
                    <div class="aad add_two add_aad_two_con lab_inp_con">
                        <input class="inp" type="text" name="add_aad_two" id="add_aad_two" required autocomplete="off">
                        <label class="sub_lab" for="add_aad_two">Street Address Line 2</label>
                    </div>
                    <div class="aad city add_city_con lab_inp_con">
                        <input class="inp" type="text" name="add_city" id="add_city" required autocomplete="off">
                        <label class="sub_lab" for="add_city">City</label>
                    </div>
                    <div class="aad state add_state_con lab_inp_con">
                        <input class="inp" type="text" name="add_state" id="add_state" required autocomplete="off">
                        <label class="sub_lab" for="add_state">State / Province</label>
                    </div>
                    <div class="aad pin add_pin_con lab_inp_con">
                        <input class="inp" type="number" name="add_pin" id="add_pin" required autocomplete="off">
                        <label class="sub_lab" for="add_pin">Pincode</label>
                    </div>
                    <div class="error_lab error_add_aad">Enter Valid Aadhar Address</div>
                </div>
                <div class="con addaaContiner" id="cur_address_continer">
                    <label for="add_cur_one" class="main_label">Current Address <span class="star">*</span> </label>
                    <div class="aad add_one add_cur_one_con lab_inp_con">
                        <input class="inp" type="text" name="add_cur_one" id="add_cur_one" required autocomplete="off">
                        <label for="add_cur_one" class="sub_lab">Street Address</label>
                    </div>
                    <div class="aad add_two add_cur_two_con lab_inp_con">
                        <input class="inp" type="text" name="add_cur_two" id="add_cur_two" required autocomplete="off">
                        <label class="sub_lab" for="add_cur_two">Street Address Line 2</label>
                    </div>
                    <div class="aad city cur_city_con lab_inp_con">
                        <input class="inp" type="text" name="cur_city" id="cur_city" required autocomplete="off">
                        <label class="sub_lab" for="cur_city">City</label>
                    </div>
                    <div class="aad state cur_state_con lab_inp_con">
                        <input class="inp" type="text" name="cur_state" id="cur_state" required autocomplete="off">
                        <label class="sub_lab" for="cur_state">State / Province</label>
                    </div>
                    <div class="aad pin cur_pin_con lab_inp_con">
                        <input class="inp" type="number" name="cur_pin" id="cur_pin" required autocomplete="off">
                        <label class="sub_lab" for="cur_pin">Pincode</label>
                    </div>
                    <div class="error_lab error_add_aad error_add_cur">Enter Valid Current Address</div>
                </div>
                <div class="con selectContiner" id="select_continer">
                    <label for="select_loan" class="main_label">Loan / Credit Card Requirement <span class="star">*</span> </label>
                    <div class="select_loan_con lab_inp_con">
                        <select name="select_name" id="select_loan" class="inp" required>
                            <option value="#" class="first_select">Please Select</option>
                            <option value="personal_loan">Personal Loan</option>
                            <option value="business_loan">Business Loan</option>
                            <option value="home_loan">Home Loan</option>
                            <option value="mortgage_loan">Mortgage Loan</option>
                            <option value="personal_loan_balance_transfer">Personal Loan Balance Transfer</option>
                            <option value="home_loan_balance_transfer">Home Loan Balance Transfer</option>
                            <option value="credit_cards">Credit Cards</option>
                        </select>
                    </div>
                    <div class="error_lab">Select Valid Iteam</div>
                </div>                    
                <div class="lab_inp_con loan_amt" id="loan_amt_con">
                    <input  class="inp" type="number" name="loan_amt" id="loan_amt" required pattren="[1-9]{1}[0-9]{1,9}" autocomplete="off">
                    <label class="sub_lab cus" for="loan_amt">Loan Amount (LA) (In Rupees)</label>
                    <div class="error_lab">25000-10000000</div>
                </div>
                <input type="hidden" name="refer_id" id="refer_id" value="<?=$refer_id?>">
                <input type="hidden" name="refer_value" id="refer_value" value="<?=$refer_value?>">
                <!-- Files starts here  -->
                <!-- file no 1 -->
                <div class="con upload_pan_Continer" id="pan_con">
                    <label for="upload_pan" class="main_label">File Upload</label>
                    <div class="upload_pan_con lab_inp_con">
                        <input class="opaz" type="file" name="upload_pan" id="upload_pan">
                        <div class="choose_files_div">
                            <label for="upload_pan" class="choose_files_label">
                                <div class="choose_cursor" id="pan_label_con">
                                    Browse File
                                </div>
                            </label>
                        </div>
                        <label for="upload_pan" class="sub_lab">PAN</label>
                    </div>
                    <div class="error_lab error_file">Choose JPG , PNG or PDF FILE</div>
                </div>
                <!-- file no 2 -->
                <div class="con aad_front_Continer" id="aad_front_con">
                    <label for="upload_aad_front" class="main_label">File Upload</label>
                    <div class="upload_aad_con lab_inp_con">
                        <input class="opaz" type="file" name="upload_aad_front" id="upload_aad_front">
                        <div class="choose_files_div">
                            <label for="upload_aad_front" class="choose_files_label">
                                <div class="choose_cursor" id="aad_front_label_con">
                                    Browse File
                                </div>
                            </label>
                        </div>
                        <label for="upload_aad_front" class="sub_lab">Adhaar Front Side</label>
                    </div>
                    <div class="error_lab error_file">Choose JPG , PNG or PDF FILE</div>
                </div>
                <!-- file no 3  -->
                <div class="con upload_aad_back_Continer" id="aad_back_con">
                    <label for="upload_aad_back" class="main_label">File Upload</label>
                    <div class="upload_aad_con lab_inp_con">
                        <input class="opaz" type="file" name="upload_aad_back" id="upload_aad_back">
                        <div class="choose_files_div">
                            <label for="upload_aad_back" class="choose_files_label">
                                <div class="choose_cursor" id="aad_back_label_con">
                                    Browse File
                                </div>
                            </label>
                        </div>
                        <label for="upload_aad_back" class="sub_lab">Adhaar Back Side</label>
                    </div>
                    <div class="error_lab error_file">Choose JPG , PNG or PDF FILE</div>
                </div>
                <!-- file no 4 -->
                <div class="con upload_bank_Continer" id="bank_con">
                    <label for="upload_bank" class="main_label">File Upload</label>
                    <div class="upload_bank_con lab_inp_con">
                        <input class="opaz" type="file" name="upload_bank" id="upload_bank">
                        <div class="choose_files_div">
                            <label for="upload_bank" class="choose_files_label">
                                <div class="choose_cursor" id="bank_label_con">
                                    Browse File
                                </div>
                            </label>
                        </div>
                        <label for="upload_bank" class="sub_lab">Last 6 months Bank Statement (including yesterday)</label>
                    </div>
                    <div class="error_lab error_file">Choose JPG , PNG or PDF FILE</div>
                </div>
                <!-- file no 5 -->
                <div class="con upload_salary_Continer" id="salary_con">
                    <label for="upload_salary" class="main_label">File Upload</label>
                    <div class="upload_salary_con lab_inp_con">
                        <input class="opaz" type="file" name="upload_salary" id="upload_salary">
                        <div class="choose_files_div">
                            <label for="upload_salary" class="choose_files_label">
                                <div class="choose_cursor" id="salary_label_con">
                                    Browse File
                                </div>
                            </label>
                        </div>
                        <label for="upload_salary" class="sub_lab">Last 3 months Salary Slips</label>
                    </div>
                    <div class="error_lab error_file">Choose JPG , PNG or PDF FILE</div>
                </div>
                <!-- file no 6  -->
                <div class="con upload_selfie_Continer" id="selfie_con">
                    <label for="upload_selfie" class="main_label">File Upload</label>
                    <div class="upload_selfie_con lab_inp_con">
                        <input class="opaz" type="file" name="upload_selfie" id="upload_selfie">
                        <div class="choose_files_div">
                            <label for="upload_selfie" class="choose_files_label">
                                <div class="choose_cursor" id="selfie_label_con">
                                    Browse File
                                </div>
                            </label>
                        </div>
                        <label for="upload_selfie" class="sub_lab">Upload your Selfie</label>
                    </div>
                    <div class="error_lab error_file">Choose JPG , PNG or PDF FILE</div>
                </div>
                <!--VERIFICATION CONTINER DIV STARTS HERE  -->
                <div  id="verificationContiner" class="relative form-veri-continer">
                    <!-- GOOGLE VERIFICATION DIV STARTS HERE  -->
                    <div class="g-recaptcha form-veri-goole-continer" data-sitekey="6Lf_EkEdAAAAABFFzlfsMRFz0Qi8_cKg75d_O7r6"></div>
                    <!-- GOOGLE VERIFICATION DIV ENDS HERE  -->
                </div>
                <!--VERIFICATION  CONTINER DIV ENDS HERE  -->
                <div class="submit_continer">
                    <input type="submit" value="Next" id="submit_form_btn" class="submit_btn">
                </div>
            </form>
        </div>
    </div>
    <?php  require_once 'all.inc.fle.php.dir/footer.full.inc.php';?>
    <script src="all.js.min.dir/loan_apply.js"></script>
</div>
        
</body>
</html>
<?php
    if(isset($_GET['status']) && !empty($_GET)){
        if($_GET['status']==="apply"){
            if($_GET['data']==="personal_loan" || $_GET['data']==="business_loan" || $_GET['data']==="home_loan" || $_GET['data']==="mortgage_loan" || $_GET['data']==="personal_loan_balance_transfer" || $_GET['data']==="home_loan_balance_transfer" || $_GET['data']==="credit_cards"){
                $val=$_GET['data'];
            }else{
                $val="personal_loan";
            }
            echo "<script>document.getElementById('select_loan').value='".$val."'</script>" ;
        }else{

        }
    }
    function __error_refer($val){?>
        <script>
            var val="<?=$val?>";
            alert(val);
        </script>
    <?php
    }
?>