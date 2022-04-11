
<?php
    include 'all.inc.fle.php.dir/al-fun-form-functions.php';
    require_once 'all.inc.fle.php.dir/inc.fle.php';
    define("A0(57%?<Fr@4**&K#2*&(J^8392$()8347&^",true);
?>
    <link rel="stylesheet" href="all.min.style_sheet.dir/join-aff.css">
    <!-- <link rel="stylesheet" href="font-icons/css/all.min.css"> -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gemunu+Libre:wght@200&family=Yaldevi:wght@200&display=swap" rel="stylesheet">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="all.js.min.dir/validation_func.js"></script>
    <title>Partner Applicaion</title>
</head>
<body>
    <?php 
        require_once 'all.inc.fle.php.dir/nav.bar.full.inc.php';
    ?>
    <div id="formWholeContiner" class="wholecontiner">
        <div class="forReturnContiner" id="con_return_status">
            <span class="result_span" id="return_msg">
            </span>
        </div>
        <!-- MAIN FORM CONTINER STARTS HERE  -->
        <div id="mainFormContiner" class='form-main-continer'>
            <!-- HEADER DIV STARTS HERE  -->
            <div id="header" class="form-header">
                <label class="main-header-form"><strong>Form</strong></label>
                <label class="base-heading">Loan Affiliate Joining Form</label>
            </div>
            <!-- HEADER DIV ENDS HERE  -->
            <!-- CONTINER DIV STARTS HERE  -->
            <div id="formContiner" class="all-contiers-inc-form-continer">
                <!-- FORM STARTS HERE  -->
                <form name="full-form" method="post" enctype="multipart/form-data" class="form-data-form" id="formData">
                    <!--FORM MAIN CONTINER DIV STARTS HERE  -->
                    <div id="MainContiner" class="form-full-continer">
                        <input type="hidden" name="csrf_token" value="<?=token("JOIN_AFF_TOKEN")?>">
                        <!--NAME CONTINER DIV STARTS HERE  -->
                        <div id="nameContiner" class="form-name-continer">
                            <div id="label_name" class="form-name-label-continer">
                                <!-- LABEL STARTS HERE FOR NAME  -->
                                <label  for="first_name_input" id="label_name" class="form-label">
                                    Name
                                </label>
                                <!-- LABEL ENDS FOR NAME  -->
                                
                                <!-- LABEL STARTS HERE FOR *(1)  -->
                                <label for="label_name" id="label_name_star-one" class="label_star">
                                *
                                </label>
                                <!-- LABEL ENDS FOR *(1)  -->
                            </div>
                            <!-- FIRST NAME CONTINER STARTS HERE  -->
                            <div id="first_name_continer" class="form-first-name-continer">
                                <!-- INPUT FIELD STATRS HERE FOR FIRST NAME  -->
                                <input type="text" id="first_name_input" name="name_first_in_1"  autocomplete="off" required class="input form-first-name-input focus">
                                <!-- INPUT FIELD ENDS HERE FOR FIRST NAME  -->

                                <!-- LABEL STARTS FOR FIRST NAME  -->
                                <label for="first_name_input" id="label_first_name" class="form-first-name-label">
                                    First Name
                                </label>
                                <!-- LABEL ENDS HERE FOR FIRST NAME  -->
                            </div>
                            <!-- FIRST NAME CONTINER ENDS HERE  -->

                            <!-- LAST NAME CONTINER STARTS HERE  -->
                            <div id="last_name_continer" class="form-last-name-continer">
                                <!-- INPUT FIELD STATRS HERE FOR LAST NAME  -->
                                <input type="text" id="last_name_input" name="name_last_in_2" autocomplete="off" class="input form-last-name-input focus">
                                <!-- INPUT FIELD ENDS HERE FOR last NAME  -->

                                <!-- LABEL STARTS FOR LAST NAME  -->
                                <label id="label_last_name" class="sub-name-label form-last-name-label">
                                    Last Name
                                </label>
                                <!-- LABEL ENDS HERE FOR LAST NAME  -->

                            </div>
                            <!-- LAST NAME CONTINER ENDS HERE  -->

                        </div>
                        <!--NAME CONTINER DIV ENDS HERE  -->
                        
                        <!--MOBILE CONTINER DIV STARTS HERE  -->
                        <div id="mobileContiner" class="spaceCon form-mobile-continer">
                            <!-- DIV STARTS HERE FOR LABELS OF MOBILE NUMBER -->
                            <div id="labelsContiner" class="block mobContiner">
                                <!-- LAbel STARTS HERE FOR MOBILE  -->
                                <label for="tel_number" id="label_tel_number" class="form-mobile-label">
                                    Mobile Number
                                </label>
                                <!-- LAbel ENDS HERE FOR MOBILE  -->

                                <!-- LAbel STARTS HERE FOR *(2)  -->
                                <label  id="label_mobile_star-two" class="label_star">
                                    *
                                </label>
                                <!-- LAbel ENDS HERE FOR *(2)  -->
                            </div>
                            <!-- DIV ENDS HERE FOR MOBILE  -->
                            <!-- INPUT STARTS HERE FOR MOBILE  -->
                            <input type="number" id="tel_number" autocomplete="off" name="mobile_10_name_in_3" class="form-mobile-input focus input"  required />
                            <!-- INPUT ENDS HERE FOR MOBILE  -->
                        </div>
                        <!--MOBILE CONTINER DIV ENDS HERE  -->

                        <!--SELFIE FILE CONTINER DIV STARTS HERE  -->
                        <div id="selfieFilesContiner" class="spaceCon form-selfie-continer">
                            <!-- LABEL STARTS HERE FOR BROWSE THE SELFIE PICTURE -->
                            <label for="selfie_upload" id="label_selfie"  class="form-selfie-label">
                                Upload your selfie (Clear Face)
                            </label>
                            <!-- LABEL ENDS HERE FOR BROWSE THE SELFIE PICTURE -->

                            <!-- LABEL STARTS HERE FOR *(3) -->
                            <label id="label_selfie_upload_star-three"  class="label_star">
                                *
                            </label>
                            <!-- LABEL ENDS HERE FOR *(3) -->

                            <!-- LABEL STARTS HERE FOR INPUT BROWSE THE SELFIE PICTURE -->
                            <input type="file" name="file_upload_selfie_in_4" id="selfie_upload" class="form-selfie-input block nodis" required>
                            <!-- DIV STARTS HERE FOR CHOOSE  FILE -->
                            <div id="choosefilehere_con_selfie" class="choose-file-upload">
                                <!-- LABEL STARTS FOR INNRE TEXT  -->
                                <label for="selfie_upload" id="choosefilehere_selfie"class="labforinnertext">
                                    Browse Files 
                                </label>
                                <!-- LABEL ENDS FOR INNRE TEXT -->  
                            </div>
                            <!-- DIV ENDS HERE FOR CHOOSE  FILE -->
                            <!-- LABEL ENDS HERE FOR INPUT BROWSE THE SELFIE PICTURE -->
                        </div>
                        <!--SELFIE FILE DIV ENDS HERE  -->

                        <!--EMAIL CONTINER DIV STARTS HERE  -->
                        <div id="emailContiner" class="spaceCon form-email-continer">
                            <!-- LABEL STARTS HERE FOR EMAIL -->
                            <label for="input_email" id="label_email" class="form-email-label">
                                Email
                            </label>
                            <!-- LABEL ENDS HERE FOR EMAIL -->

                            <!-- LABEL STARTS HERE FOR *(4) -->
                            <label id="label_email_star-four" class="label_star">
                                *
                            </label>
                            <!-- LABEL ENDS HERE FOR *(4) -->

                            <!-- LABEL STARTS HERE FOR INPUT EMAIL -->
                            <input type="email" name="email_in_5" class="input form-email-input" autocomplete="off" id="input_email" required >
                            <!--INPUT ENDS HERE FOR  EMAIL -->

                             <!-- LABEL STARTS HERE FOR EMAIL EXAMPLE-->
                             <label  class="sub-name-label form-email-example-label" id="label_example_email">
                                example@example.com
                            </label>
                            <!-- LABEL ENDS HERE FOR EMAIL EXAMPLE-->

                        </div>
                        <!--EMAIL CONTINER DIV ENDS HERE  -->
                        
                        <!--ADDRESS CONTINER DIV STARTS HERE  -->
                        <div id="addressContiner" class="spaceCon form-adderss-continer form-add-margin-continer">
                            <!-- LABEL STARTS HERE FOR ADDRESS -->
                            <label  for="street_address_one" id="label_email" class="form-address-label">
                                Address
                            </label>
                            <!-- LABEL ENDS HERE FOR ADDRESS -->
                            
                            <!-- LABEL STARTS HERE FOR *(5) -->
                            <label id="label_email_star-five" class="label_star">
                                *
                            </label>
                            <!-- LABEL ENDS HERE FOR *(5) -->
                            
                            <!-- DIV STARTS HERE FOR ADDRESS NORMAL CONTINER -->
                            <div id="addressNormalContiner" class="form-normal-address-continer">
                                <!-- DIV STARTS HERE FOR STREET ADDRESS 1  -->
                                <div id="streetAdderess_one"  class="form-address-street-continer-one form-add-margin-continer">
                                    <!-- INPUT STARTS HERE FOR ADDRESS 1  -->
                                    <input type="text" name="street_address_one_in_6" autocomplete="off" id="street_address_one" class="input form-address-strees-input-one" required>
                                    <!-- INPUT ENDS HERE FOR ADDRESS 1  -->

                                    <!-- LABEL STARTS HERE FOR STREET ADDRESS 1-->
                                    <label  class="sub-name-label form-address-street-label-one" id="label_street_address_one" for="street_address_one">
                                        Street Address
                                    </label>
                                    <!-- LABEL ENDS HERE FOR STREET ADDRESS 1-->
                                </div>
                                <!-- DIV ENDS HERE FOR STREET ADDRESS 1  -->
                                
                                <!-- DIV STARTS HERE FOR STREET ADDRESS 2  -->
                                <div id="streetAdderess_two"  class="form-address-street-continer-two form-add-margin-continer">
                                    <!-- INPUT STARTS HERE FOR ADDRESS 2  -->
                                    <input type="text" name="street_address_two_in_7" id="street_address_two" class="input  form-address-street-input-two" autocomplete="off" required>
                                    <!-- INPUT ENDS HERE FOR ADDRESS 2 -->

                                    <!-- LABEL STARTS HERE FOR STREET ADDRESS 2-->
                                    <label id="label_street_address_two"  class="sub-name-label form-address-street-two-label">
                                        Street Address
                                    </label>
                                    <!-- LABEL ENDS HERE FOR STREET ADDRESS 2-->
                                </div>
                                <!-- DIV ENDS HERE FOR STREET ADDRESS 2  -->
                                
                                <!-- DIV STARTS HERE FOR CITY-->
                                <div id="city"  class="form-address-city-continer form-add-margin-continer" >
                                    <!-- INPUT STARTS HERE FOR city  -->
                                    <input type="text" name="city_in_8"  required id="city_input" class="input form-address-city-input" autocomplete="off">
                                    <!-- INPUT ENDS HERE FOR CITY -->

                                    <!-- LABEL STARTS HERE FOR CITY-->
                                    <label id="label_city" class="form-address-city-label sub-name-label" for="city_input">
                                        City
                                    </label>
                                    <!-- LABEL ENDS HERE FOR CITY -->
                                </div>
                                <!-- DIV ENDS HERE FOR CITY  -->
                                
                                <!-- DIV STARTS HERE FOR STATE-->
                                <div id="state" class="form-address-state-continer form-add-margin-continer">
                                    <!-- INPUT STARTS HERE FOR STATE  -->
                                    <input type="text" name="state_in_9" required id="state_input" autocomplete="off" class="input form-address-state-input">
                                    <!-- INPUT ENDS HERE FOR STATE -->

                                    <!-- LABEL STARTS HERE FOR STATE-->
                                    <label id="label_state" class="sub-name-label form-address-state-label" for="state_input">
                                        State
                                    </label>
                                    <!-- LABEL ENDS HERE FOR STATE -->
                                </div>
                                <!-- DIV ENDS HERE FOR STATE  -->
                                
                                <!-- DIV STARTS HERE FOR PINCODE-->
                                <div id="pincode" class="form-address-pincode-continer form-add-margin-continer">
                                    <!-- INPUT STARTS HERE FOR PINCODE  -->
                                    <input type="number" name="pincode_in_10" required id="pincode_input" autocomplete="off" class="input form-address-pincode-input">
                                    <!-- INPUT ENDS HERE FOR PINCODE -->

                                    <!-- LABEL STARTS HERE FOR PINCODE-->
                                    <label id="label_pincode" class="sub-name-label form-address-pincode-label" for="pincode_input">
                                        Pincode
                                    </label>
                                    <!-- LABEL ENDS HERE FOR PINCODE -->
                                </div>
                                <!-- DIV ENDS HERE FOR PINCODE  -->
                            </div>
                            <!-- DIV ENDS HERE FOR ADDRESS NORMAL CONTINER -->
                        </div>
                        <!--ADDRESS CONTINER DIV ENDS HERE  -->

                        <!--DATE OF BIRTH CONTINER DIV STARTS HERE  -->
                        <div id="dateOfBirthContiner" class="spaceCon form-dob-continer form-add-margin-continer">
                                    <!-- LABEL STARTS HERE FOR DATE OF BIRTH-->
                                    <label id="label_date" for="date_input" class="form-dob-label">
                                        Date Of Birth
                                    </label>
                                    <!-- LABEL ENDS HERE FOR DATE OF BIRTH-->
                                         <!-- LABEL STARTS HERE FOR *(6) -->
                                    <label id="label_date_star-six" class="label_star">
                                        *
                                    </label>
                                    <!-- LABEL ENDS HERE FOR *(6) -->

                                    <!-- INPUT STARTS HERE FOR DATE OF BIRTH -->
                                    <input type="date" name="date_in_11" class="form-dob-input block" required id="date_input">
                                    <!-- INPUT ENDS HERE FOR DATE OF BIRTH -->

                        </div>
                        <!--DATE OF BIRTH CONTINER DIV ENDS HERE  -->

                        <!--PAN FILES CONTINER DIV STARTS HERE  -->
                        <div id="panFilesContiner" class="spaceCon form-pan-continer">
                            <!-- PAN CARD NUMBER DIV STARTS HERE  -->
                            <div id="pancard_numbre" class="form-pan-number-continer">
                                <!-- LABEL STARTS HERE FOR PAN NUMBER -->
                                <label id="label_pan_number" for="pan_number" class="form-pan-number-label" for="pan_number">
                                    Enter Your PAN Number
                                </label>
                                <!-- LABEL ENDS HERE FOR PAN NUMBER -->

                                <!-- LABEL STARTS HERE FOR *(7) -->
                                <label id="label_pan_numner_star-seven"  class="label_star">
                                    *
                                </label>
                                <!-- LABEL ENDS HERE FOR *(7) -->

                                <!-- LABEL STARTS HERE FOR INPUT PAN NUMBER -->
                                <input type="text" name="pan_number_in_12" autocomplete="off" class="input form-pan-number-input" id="pan_number">
                                <!-- LABEL ENDS HERE FOR INPUT PAN NUMBER-->
                            </div>
                            <!--PAN NUMBER DIV ENDS HERE  -->
                            <!-- PAN CARD UPLOAD FILE STARS HERE  -->
                            <div id="pancard_picture" class="relative form-pan-pic-continer">
                                <!-- LABEL DIV STARTS HERE FOR BROWSE THE PAN CARD -->
                                <div id="label_browse_pan_card" class="block">
                                    <!-- LABEL STARTS HERE FOR BROWSE THE PAN CARD -->
                                    <label for="pan_card_upload" id="label_pan_card" class="form-pan-pic-label" for="pan_card_upload">
                                        Upload Your Pan Card
                                    </label>
                                    <!-- LABEL ENDS HERE FOR BROWSE THE PAN CARD PICTURE -->

                                    <!-- LABEL STARTS HERE FOR *(8) -->
                                    <label id="label_pan_card_upload_star-eight"  class="label_star">
                                        *
                                    </label>
                                    <!-- LABEL ENDS HERE FOR *(8) -->
                                </div>
                                <!--  STARTS HERE FOR INPUT BROWSE THE PAN CARD PICTURE -->
                                <input type="file" name="file_upload_pan_card_in_13" class="nodis form-pan-pic-input" id="pan_card_upload" required>
                                <!--  ENDS HERE FOR INPUT BROWSE THE PAN CARD PICTURE -->
                               <!-- DIV STARTS HERE FOR CHOOSE  FILE -->
                                <div id="choosefilehere_con_pan" class="block choose-file-upload">
                                    <!-- LABEL STARTS FOR INNRE TEXT  -->
                                    <label for="pan_card_upload" id="choosefilehere_pan" class="labforinnertext">
                                        Browse Files  
                                    </label>
                                    <!-- LABEL ENDS FOR INNRE TEXT --> 
                                </div>
                                <!-- DIV ENDS HERE FOR CHOOSE  FILE -->
                            </div>
                            <!-- PAN CARD UPLOAD FILE DIV ENDS HERE  -->

                        </div>
                        <!--PAN FILES CONTINER DIV ENDS HERE  -->

                        <!--AADHAR CONTINER DIV STARTS HERE  -->
                        <div id="aadharContiner" class="spaceCon form-aadhar-continer">
                            <!-- AADHAR CARD NUMBER DIV STARTS HERE  -->
                            <div id="aadhar_number" class="form-aadhar-number-continer">
                                <!-- LABEL STARTS HERE FOR AADHAR NUMBER -->
                                <label id="label_aadhar_number" class="form-aadhar-number-label" for="aadhar_number">
                                    Enter Your Aadhar Number
                                </label>
                                <!-- LABEL ENDS HERE FOR AADHAR NUMBER -->

                                <!-- LABEL STARTS HERE FOR *(8) -->
                                <label id="label_aadhar_numner_star-eight"  class="label_star">
                                    *
                                </label>
                                <!-- LABEL ENDS HERE FOR *(8) -->

                                <!-- INPUT STARTS HERE FOR  AADHAR NUMBER -->
                                <input type="number" name="aadhar_number_in_14" autocomplete="off" class="input form-aadhar-number-input" id="aadhar_number">
                                <!-- INPUT ENDS HERE FOR  PAN NUMBER-->
                            </div>
                            <!--AADHAR NUMBER DIV ENDS HERE  -->
                            
                            <!-- AADHAR CARD UPLOAD FILE(1) STARS HERE  -->
                            <div id="aadhar_card_picture_one" class="relative form-aadhar-pic-continer-one">
                                <!-- LABEL STARTS HERE FOR BROWSE THE AADHAR PICTURE(1) -->
                                <label id="label_aadhar_card" for="aadhar_card_one_upload" class="form-aadhar-pic-label-one" for="aadhar_card_one_upload">
                                    Upload Your Aadhar Card(Front Side)
                                </label>
                                <!-- LABEL ENDS HERE FOR BROWSE THE AADHAR CARD PICTURE(1) -->

                                <!-- LABEL STARTS HERE FOR *(9) -->
                                <label id="label_aadhar_card_upload_star-nine" for="aadhar_card_one_upload" class="label_star">
                                    *
                                </label>
                                <!-- LABEL ENDS HERE FOR *(9) -->

                                <!-- STARTS HERE FOR INPUT BROWSE THE AADHAR CARD PICTURE(1) -->
                                <input type="file"  name="file_upload_aadhar_card_one_in_15" class="form-aadhar-pic-input-one nodis" id="aadhar_card_one_upload" required>
                                <!-- ENDS HERE FOR INPUT BROWSE THE AADHAR CARD PICTURE(1) -->
                                <!-- DIV STARTS HERE FOR CHOOSE  FILE -->
                                <div id="choosefilehere_con_af" class="choose-file-upload">
                                    <!-- LABEL STARTS FOR INNRE TEXT  -->
                                    <label for="aadhar_card_one_upload" id="choosefilehere_af" class="labforinnertext">
                                        Browse Files 
                                    </label>
                                    <!-- LABEL ENDS FOR INNRE TEXT -->  
                                </div>
                                <!-- DIV ENDS HERE FOR CHOOSE  FILE -->
                            </div>
                            <!--AADHAR CARD UPLOAD FILE DIV(1) ENDS HERE  -->

                            <div id="aadhar_card_picture_two"  class="relative form-aadhar-pic-continer-two">
                                <!-- LABEL STARTS HERE FOR BROWSE THE AADHAR PICTURE(2) -->
                                <label id="label_aadhar_card" for="aadhar_card_two_upload"  class="form-aadhar-pic-label-two" for="aadhar_card_upload">
                                    Upload Your Aadhar Card(Back Side)
                                </label>
                                <!-- LABEL ENDS HERE FOR BROWSE THE AADHAR CARD PICTURE(2) -->

                                <!-- LABEL STARTS HERE FOR *(10) -->
                                <label id="label_aadhar_card_upload_star-ten"  class="label_star">
                                    *
                                </label>
                                <!-- LABEL ENDS HERE FOR *(10) -->

                                <!-- STARTS HERE FOR INPUT BROWSE THE AADHAR CARD PICTURE(2) -->
                                <input type="file" name="file_upload_aadhar_card_two_in_16" id="aadhar_card_two_upload"  class="nodis form-aadhar-pic-input-two" required>
                                <!-- ENDS HERE FOR INPUT BROWSE THE AADHAR CARD PICTURE(2) -->
                                <!-- DIV STARTS HERE FOR CHOOSE  FILE -->
                                <div id="choosefilehere_con_ab" class="choose-file-upload">
                                    <!-- LABEL STARTS FOR INNRE TEXT  -->
                                    <label for="aadhar_card_two_upload" id="choosefilehere_ab" class="labforinnertext">
                                        Browse Files 
                                    </label>
                                    <!-- LABEL ENDS FOR INNRE TEXT -->  
                                </div>
                                <!-- DIV ENDS HERE FOR CHOOSE  FILE -->
                            </div>
                            <!--AADHAR CARD UPLOAD FILE DIV(2) ENDS HERE  -->
                        </div>
                        <!--AADHAR CONTINER DIV ENDS HERE  -->

                        <!--AGREEMENT CONTINER DIV STARTS HERE  -->
                        <div id="agrementContiner"  class="spaceCon form-agrement-continer">
                            <!-- DIV STARTS FOR AGGREMENTS CONTENT -->
                            <div id="content" class="form-agrement-content">
                                <!-- LABEL STARTS FOR AGGREMENTS CONTENT-->
                                <label id="label_content" for="input_agree_radio" class="form-agrement-label">
                                    I Agree with Payout Slabs of Loan Garage Pvt Ltd. and I will be paid according to LGPL billing cycle only (Only for Disbursed Loans and Delivered Cards):
                                </label>
                                <!-- LABEL ENDS FOR AGGREMENTS CONTENT-->
                            </div>
                            <div id="response_user" class="form-agrement-response">
                                <!-- RADIO BTN STARTS FOR AGGREMENTS CONTENT-->
                                    <input type="radio" name="agree_in_17" value="ok" class="form-agrement-response-input" id="input_agree_radio">
                                    <!-- LABEL FOR AGREE STARTS HERE  -->
                                    <label class="agreeLabel" for="input_agree_radio">Agree</label>
                                    <!-- LABEL FOR AGREE ENDS HERE  -->
                                    <input type="radio" name="agree_in_17" value="no" class="form-agrement-response-input"  id="input_disagree_radio">
                                    <!-- LABEL FOR DISAGREE STARTS HERE  -->
                                    <label class="agreeLabel" for="input_disagree_radio">Disagree</label>
                                    <!-- LABEL FOR DISAGREE ENDS HERE  -->
                                <!-- RADIO BTN ENDS FOR AGGREMENTS CONTENT-->
                            </div>

                        </div>
                        <!--AGREEMENT CONTINER DIV ENDS HERE  -->
                        
                        <!--BANK DETAILS CONTINER DIV STARTS HERE  -->
                        <div id="bankDetailsContiner" class="spaceCon form-bank-continer">
                                <!-- BANK CARD NUMBER DIV STARTS HERE  -->
                                <div id="bank_account_number" class="form-bank-children-continer form-bank-number-continer">
                                        <!-- LABEL STARTS HERE FOR BANK ACCOUNT NUMBER -->
                                        <label id="label_bank_account_number" for="bank_account_number" class="form-bank-number-label">
                                            Enter Your Bank Account Number
                                        </label>
                                        <!-- LABEL ENDS HERE FOR BANK ACCOUNT NUMBER -->

                                        <!-- LABEL STARTS HERE FOR *(11) -->
                                        <label id="label_bank_account_numner_star-eleven"  class="label_star">
                                            *
                                        </label>
                                        <!-- LABEL ENDS HERE FOR *(11) -->

                                        <!-- INPUT STARTS HERE FOR BANK ACCOUNT NUMBER -->
                                        <input type="number" required autocomplete="off" class="input form-bank-children-input form-bank-number-input" name="bank_account_number_in_18" id="bank_account_number">
                                        <!-- INPUT ENDS HERE FOR  BANK ACCOUNT NUMBER-->
                                </div>
                                <!--BANK ACCOUNT NUMBER DIV ENDS HERE -->

                                <!-- BANK CARD NAME DIV STARTS HERE  -->
                                <div id="bank_account_name" class="form-bank-children-continer form-bank-account-name-continer">
                                    <!-- LABEL STARTS HERE FOR BANK ACCOUNT NAME -->
                                    <label id="label_bank_account_name"  class="form-bank-account-name-label" for="bank_account_name">
                                        Enter Your Bank Account Name
                                    </label>
                                    <!-- LABEL ENDS HERE FOR BANK ACCOUNT NAME -->

                                    <!-- LABEL STARTS HERE FOR *(12) -->
                                    <label id="label_bank_account_name_star-twelve"  class="label_star">
                                        *
                                    </label>
                                    <!-- LABEL ENDS HERE FOR *(12) -->

                                    <!-- INPUT STARTS HERE FOR BANK ACCOUNT NAME -->
                                    <input type="text" name="bank_account_name_in_19" required autocomplete="off" class="form-bank-children-input input form-bank-account-name-input" id="bank_account_name">
                                    <!-- INPUT ENDS HERE FOR  BANK ACCOUNT NAME-->
                                </div>
                                <!--BANK ACCOUNT NAME DIV ENDS HERE  -->

                                <!-- BANK NAME DIV STARTS HERE  -->
                                <div id="bank_name" class="form-bank-children-continer form-bank-name-continer">
                                    <!-- LABEL STARTS HERE FOR BANK NAME -->
                                    <label id="label_bank_name" class="form-bank-name-label" for="bank_name">
                                        Enter Your Bank Name
                                    </label>
                                    <!-- LABEL ENDS HERE FOR BANK NAME -->

                                    <!-- LABEL STARTS HERE FOR *(13) -->
                                    <label id="label_bank_name_star-thirteen" class="label_star">
                                        *
                                    </label>
                                    <!-- LABEL ENDS HERE FOR *(13) -->

                                    <!-- INPUT STARTS HERE FOR BANK NAME -->
                                    <input type="text" name="bank_name_in_20" required autocomplete="off" class="input form-bank-children-input form-bank-name-input" id="bank_name">
                                    <!-- INPUT ENDS HERE FOR  BANK  NAME-->
                                </div>
                                <!--BANK NAME DIV ENDS HERE  -->


                                <!-- BANK NAME DIV STARTS HERE  -->
                                <div id="bank_ifsc" class="form-bank-children-continer form-bank-ifsc-continer">
                                    <!-- LABEL STARTS HERE FOR BANK IFSC -->
                                    <label id="label_bank_ifsc" class="form-bank-ifsc-label" for="bank_IFSC">
                                        Enter Your Bank IFSC CODE
                                    </label>
                                    <!-- LABEL ENDS HERE FOR BANK IFSC -->

                                    <!-- LABEL STARTS HERE FOR *(14) -->
                                    <label id="label_bank_ifsc_star-foutteen" for="bank_ifsc" class="label_star">
                                        *
                                    </label>
                                    <!-- LABEL ENDS HERE FOR *(14) -->

                                    <!-- INPUT STARTS HERE FOR BANK IFSC -->
                                    <input type="text" name="bank_ifsc_in_21" required autocomplete="off" class="form-bank-children-input input form-bank-ifsc-input" id="bank_IFSC">
                                    <!-- INPUT ENDS HERE FOR  BANK  IFSC-->
                                </div>
                                <!--BANK IFSC DIV ENDS HERE  -->


                                <!-- CHEQUE UPLOAD FILE STARS HERE  -->
                                <div id="cheque_file" class="relative form-bank-children-continer form-bank-cheque-continer">
                                    <!-- LABEL STARTS HERE FOR BROWSE CHEQUE PICTURE -->
                                    <label id="label_cheque" class="form-bank-cheque-label" for="cheque_upload">
                                        Upload a Cancelled Cheque Photo
                                    </label>
                                    <!-- LABEL ENDS HERE FOR BROWSE THE CHEQUE PICTURE -->

                                    <!-- LABEL STARTS HERE FOR *(15) -->
                                    <label id="label_cheque_upload_star-fifteen" class="label_star">
                                        *
                                    </label>
                                    <!-- LABEL ENDS HERE FOR *(15) -->

                                    <!-- STARTS HERE FOR INPUT BROWSE THE CHEQUE -->
                                    <input type="file" class="nodis form-bank-children-input form-bank-cheque-input" name="file_upload_cheque_in_22" id="cheque_upload" required>
                                    <!-- ENDS HERE FOR INPUT BROWSE THE CHEQUE PICTURE -->
                                    <!-- DIV STARTS HERE FOR CHOOSE  FILE -->
                                    <div id="choosefilehere_con_c" class="choose-file-upload">
                                        <!-- LABEL STARTS FOR INNRE TEXT  -->
                                        <label for="cheque_upload" id="choosefilehere_c"class="labforinnertext">
                                            Browse Files 
                                        </label>
                                        <!-- LABEL ENDS FOR INNRE TEXT -->  
                                    </div>
                                    <!-- DIV ENDS HERE FOR CHOOSE  FILE -->
                                </div>
                                <!--CHEQUE UPLOAD FILE DIV ENDS HERE  -->
                        
                        </div>
                        <!--BAMK DETAILS CONTINER DIV ENDS HERE  -->  
                        
                        <!--VERIFICATION CONTINER DIV STARTS HERE  -->
                        <div  id="verificationContiner" class="relative form-veri-continer">
                             <!-- GOOGLE VERIFICATION DIV STARTS HERE  -->
                               <div class="g-recaptcha form-veri-goole-continer" data-sitekey="6Lf_EkEdAAAAABFFzlfsMRFz0Qi8_cKg75d_O7r6"></div>
                               <!-- GOOGLE VERIFICATION DIV ENDS HERE  -->
                        </div>
                        <!--VERIFICATION  CONTINER DIV ENDS HERE  -->
                        
                        
                    </div>
                    <!--FORM MAIN CONTINER DIV ENDS HERE  -->

                    <!--SUBMIT CONTINER DIV STARTS HERE  -->
                    <div id="submitContiner" class="form-submit-continer">
                        <!-- INPUT FOR SUBMIT ALL FORM STARTS HERE  -->
                        <input type="submit" class="form-submit-input" value="Submit" name="submit_22_feilds" id="allSubmit">
                        <!-- INPUT FOR SUBMUT ALL FORM ENDS HERE  -->
                    </div>
                    <!--SUBMIT CONTINER DIV ENDS HERE  -->
                </form>
                <!-- FORM ENDS HERE  -->
            </div>
             <!-- CONTINER DIV ENDS HERE  -->
        </div>
        <!-- MAIN FORM  CONTINER DIV ENDS HERE  -->
    </div>
    <!-- WHOLE CONTINER ENDS HERE -->
<?php  require_once 'all.inc.fle.php.dir/footer.full.inc.php';?>
<script src="all.js.min.dir/formValidate-1-full.js"></script>
</body>
</html>

<?php
if(isset($_GET) && !empty($_GET)){
    if(isset($_GET['status'])){
        if($_GET['status']==='success'){
            $msg="Successfully Submitted...";
            $class="success";
        }
        if($_GET['status']==='failed'){
            if(isset($_GET['data'])){
                if($_GET['data']==='fill'){
                    $msg="Please Fill The Form...";
                    $class="failed";
                }
                if($_GET['data']==='captcha'){
                    $msg="Captcha Error Please Retry...";
                    $class="failed";
                }
                if($_GET['data']==='missTkn'){
                    $msg="Token Error Please Retry...";
                    $class="failed";
                }
                if($_GET['data']==='missSes'){
                    $msg="Session Error Please Retry...";
                    $class="failed";
                }
                if($_GET['data']==='tknNtmch'){
                    $msg="Session Error Please Retry..";
                    $class="failed";
                }
                if($_GET['data']==='invalEmail'){
                    $msg="Please Enter Valid Email...";
                    $class="failed";
                }
                if($_GET['status']==='invalMobile'){
                    $msg="Enter Valid Mobile Number...";
                    $class="failed";
                }
                if($_GET['status']==='alreadyExist'){
                    $msg="This Email Is Already Exist";
                    $class="failed";
                }
                if($_GET['status']==='invalDate'){
                    $msg="Please Enter Valid Date Of Birth";
                    $class="failed";
                }
                if($_GET['status']==='notSub'){
                    $msg="Please Retry...";
                    $class="failed";
                }

            }else{
                $msg="Please Fill The Form...";
                $class="failed";
            }
        }
    }?>
<script>
    var msg="<?=$msg?>";
    var clas="<?=$class?>";
    document.getElementById("con_return_status").style.display="block";
    document.getElementById("return_msg").classList.add(clas);
    document.getElementById("return_msg").innerText=msg;
</script>
<?php
}
?>