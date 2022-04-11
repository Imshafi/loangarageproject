'use strict';
var first_name=document.forms['full-form']['name_first_in_1'];
var last_name=document.forms['full-form']['name_last_in_2'];
var mobile=document.forms['full-form']['mobile_10_name_in_3'];
var selfie=document.getElementById('selfie_upload');
var email=document.forms['full-form']['email_in_5'];
var address_one=document.forms['full-form']['street_address_one_in_6'];
var address_two=document.forms['full-form']['street_address_two_in_7'];
var city=document.forms['full-form']['city_in_8'];
var state=document.forms['full-form']['state_in_9'];
var pincode=document.forms['full-form']['pincode_in_10'];
var pan_number=document.forms['full-form']['pan_number_in_12'];
var upload_pan_card=document.getElementById("pan_card_upload");
var aadhar_number=document.forms['full-form']['aadhar_number_in_14'];
var upload_aadhar_card_one=document.getElementById("aadhar_card_one_upload");
var upload_aadhar_card_two=document.getElementById("aadhar_card_two_upload");
var agree=document.forms['full-form']['agree_in_17'];
var bank_number=document.forms['full-form']['bank_account_number_in_18'];
var bank_account_name=document.forms['full-form']['bank_account_name_in_19'];
var bank_name=document.forms['full-form']['bank_name_in_20'];
var bank_ifsc=document.forms['full-form']['bank_ifsc_in_21'];
var date_input=document.getElementById("date_input");;
var dateOfBirthContiner=document.getElementById("dateOfBirthContiner");;
var upload_cheque=document.getElementById("cheque_upload");;
var parent_name=document.getElementById("nameContiner");
var mobileContiner=document.getElementById("mobileContiner");
var selfieFilesContiner=document.getElementById("selfieFilesContiner");
var emailContiner=document.getElementById("emailContiner");
var addressContiner=document.getElementById("addressContiner");
var panFilesContiner=document.getElementById("panFilesContiner");
var aadharContiner=document.getElementById("aadharContiner");
var agrementContiner=document.getElementById("agrementContiner");
var bankDetailsContiner=document.getElementById("bankDetailsContiner");
var choosefilehere_selfie=document.getElementById("choosefilehere_selfie");
var choosefilehere_pan=document.getElementById("choosefilehere_pan");
var choosefilehere_af=document.getElementById("choosefilehere_af");
var choosefilehere_ab=document.getElementById("choosefilehere_ab");
var choosefilehere_c=document.getElementById("choosefilehere_c");
var form_data;


selfie.addEventListener("change",changeSelfie);
upload_pan_card.addEventListener("change",changePan);
upload_aadhar_card_one.addEventListener("change",changeAf);
upload_aadhar_card_two.addEventListener("change",changeAb);
upload_cheque.addEventListener("change",changeC);

jQuery('#formData').on('submit',function(e){
    e.preventDefault();
    form_data=new FormData(this);
    if( validation() )
    {
        set_data_partner(form_data);
    }
})

function validation(){
    if(validate_name(first_name.value)){
        changeNor(first_name,parent_name)
        if(validate_name(last_name.value)){
            changeNor(last_name,parent_name)
            if(validate_number(mobile.value)){
                changeNor(mobile,mobileContiner)
                if(validate_img(selfie)){
                    changeNor(selfie,selfieFilesContiner)
                    if(validate_email(email.value)){
                        changeNor(email,emailContiner)
                        if(validate_name_add(address_one.value)){
                            changeNor(address_one,addressContiner)
                            if(validate_name_add(address_two.value)){
                                changeNor(address_two,addressContiner)
                                if(validate_name(city.value)){
                                    changeNor(city,addressContiner)
                                    if(validate_name(state.value)){
                                        changeNor(state,addressContiner)
                                        if(validate_pincode(pincode.value)){
                                            changeNor(pincode,addressContiner)
                                            if(validate_pan_number(pan_number.value)){
                                                changeNor(pan_number,panFilesContiner)
                                                if(validate_img(upload_pan_card)){
                                                    changeNor(upload_pan_card,panFilesContiner)
                                                    if(validate_aadhar(aadhar_number.value)){
                                                        changeNor(aadhar_number,aadharContiner)
                                                        if(validate_img(upload_aadhar_card_one)){
                                                            changeNor(upload_aadhar_card_one,aadharContiner)
                                                            if(validate_img(upload_aadhar_card_two)){
                                                                changeNor(upload_aadhar_card_two,aadharContiner)
                                                                if(validate_aggr(agree.value)){
                                                                    changeNor(agrementContiner,agrementContiner)
                                                                    if(validate_bank_acc_num(bank_number.value)){
                                                                        changeNor(bank_number,bankDetailsContiner)
                                                                        if(validate_name(bank_account_name.value)){
                                                                            changeNor(bank_account_name,bankDetailsContiner)
                                                                            if(validate_name(bank_name.value)){
                                                                                changeNor(bank_name,bankDetailsContiner)
                                                                                if(validate_bank_ifsc(bank_ifsc.value)){
                                                                                    changeNor(bank_ifsc,bankDetailsContiner)
                                                                                    if(validate_img(upload_cheque)){
                                                                                        changeNor(upload_cheque,bankDetailsContiner)
                                                                                        if(validate_dob(date_input.value)){
                                                                                            changeNor(date_input,dateOfBirthContiner);
                                                                                            return true;
                                                                                        }else{
                                                                                            changeBGC(date_input,dateOfBirthContiner);
                                                                                            return false;
                                                                                        }
                                                                                    }else{
                                                                                        changeBGC(upload_cheque,bankDetailsContiner);
                                                                                        return false;
                                                                                    }
                                                                                
                                                                                }else{
                                                                                    changeBGC(bank_ifsc,bankDetailsContiner);
                                                                                    return false;
                                                                                }
                                                                            }else{
                                                                                changeBGC(bank_name,bankDetailsContiner);
                                                                                return false;
                                                                            }
                                                                            
                                                                        }else{
                                                                            changeBGC(bank_account_name,bankDetailsContiner);
                                                                            return false;
                                                                        }

                                                                    }else{
                                                                        changeBGC(bank_number,bankDetailsContiner);
                                                                        return false;
                                                                    }
                                                                }else{
                                                                    changeBGC(agrementContiner,agrementContiner);
                                                                    return false;
                                                                }
                                                            }else{
                                                                changeBGC(upload_aadhar_card_two,aadharContiner);
                                                                return false;
                                                            }

                                                        }else{
                                                            changeBGC(upload_aadhar_card_one,aadharContiner);
                                                            return false;
                                                        }

                                                    }else{
                                                        changeBGC(aadhar_number,aadharContiner);
                                                        return false;
                                                    }

                                                }else{
                                                    changeBGC(upload_pan_card,panFilesContiner);
                                                    return false;
                                                }
                                            }else{
                                                changeBGC(pan_number,panFilesContiner);
                                                return false;       
                                            }

                                        }else{
                                            changeBGC(pincode,addressContiner);
                                            return false;
                                        }

                                    }else{
                                        changeBGC(state,addressContiner);
                                        return false;
                                    }

                                }else{
                                    changeBGC(city,addressContiner);
                                    return false;
                                }

                            }else{
                                changeBGC(address_two,addressContiner);
                                return false;       
                            }

                        }else{
                            changeBGC(address_one,addressContiner);
                            return false;       
                        }

                    }else{
                       changeBGC(email,emailContiner);
                       return false;
                    }
                }else{
                    changeBGC(selfie,selfieFilesContiner);
                    return false;
                }
            }else{
                changeBGC(mobile,mobileContiner);
                return false;
            }

        }else{
            changeBGC(last_name,parent_name);
            return false;
        }    
    }else{
        changeBGC(first_name,parent_name);
        return false;
    }
}
function validate_aggr(val)
{
    return (val=="ok")?true:false;
}
function changePan(){
    if(upload_pan_card.value!=''){
        var files=this.files[0];
        var res=validTypes.includes(files.name.substring(files.name.lastIndexOf(".")+1).toUpperCase());
        if(res){
            choosefilehere_pan.innerHTML=files.name;
            choosefilehere_pan.style.color="black";
        }else{
            choosefilehere_pan.innerHTML="Choose jpeg,png,jpg Or PDF File";
            choosefilehere_pan.style.color="red";
        }
    }else{
        choosefilehere_pan.innerHTML="Choose jpeg,png,jpg Or PDF File";
        choosefilehere_pan.style.color="red";
    }
}
function changeAf(){
    if(upload_aadhar_card_one.value!=''){
        var files=this.files[0];
        var res=validTypes.includes(files.name.substring(files.name.lastIndexOf(".")+1).toUpperCase());
        if(res){
            choosefilehere_af.innerHTML=files.name;
            choosefilehere_af.style.color="black";
        }else{
            choosefilehere_af.innerHTML="Choose jpeg,png,jpg Or PDF File";
            choosefilehere_af.style.color="red";
        }
    }else{
        choosefilehere_af.innerHTML="Choose jpeg,png,jpg Or PDF File";
        choosefilehere_af.style.color="red";
    }
}
function changeAb(){
    if(upload_aadhar_card_two.value!=''){
        var files=this.files[0];
        var res=validTypes.includes(files.name.substring(files.name.lastIndexOf(".")+1).toUpperCase());
        if(res){
            choosefilehere_ab.innerHTML=files.name;
            choosefilehere_ab.style.color="black";
        }else{
            choosefilehere_ab.innerHTML="Choose jpeg,png,jpg Or PDF File";
            choosefilehere_ab.style.color="red";
        }
    }else{
        choosefilehere_ab.innerHTML="Choose jpeg,png,jpg Or PDF File";
        choosefilehere_ab.style.color="red";
    }
}
function changeC(){
    if(upload_cheque.value!=''){
        var files=this.files[0];
        var res=validTypes.includes(files.name.substring(files.name.lastIndexOf(".")+1).toUpperCase());
        if(res){
            choosefilehere_c.innerHTML=files.name;
            choosefilehere_c.style.color="black";
        }else{
            choosefilehere_c.innerHTML="Choose jpeg,png,jpg Or PDF File";
            choosefilehere_c.style.color="red";
        }
    }else{
        choosefilehere_c.innerHTML="Choose jpeg,png,jpg Or PDF File";
        choosefilehere_c.style.color="red";
    }
}
function changeSelfie(){
    if(selfie.value!=''){
        var files=this.files[0];
        var res=validTypes.includes(files.name.substring(files.name.lastIndexOf(".")+1).toUpperCase());
        if(res){
            choosefilehere_selfie.innerHTML=files.name;
            choosefilehere_selfie.style.color="black";
        }else{
            choosefilehere_selfie.innerHTML="Choose jpeg,png,jpg Or PDF File";
            choosefilehere_selfie.style.color="red";
        }
    }else{
        choosefilehere_selfie.innerHTML="Choose jpeg,png,jpg Or PDF File";
        choosefilehere_selfie.style.color="red";
    }
}

function set_data_partner(form_data_valid){
    document.querySelector("#allSubmit").value="Please Wait...";
    $.ajax({
        url:"./all.min.sub.php.dir/entry.12.153.full.form.in.bd.php",
        type:"POST",
        data:form_data_valid,
        contentType:false,
        processData:false,
        success:function(data){
            if( Object.entries(data).length>0 ){
                document.getElementById("con_return_status").style.opacity=0;
                data=$.parseJSON(data);
                if(data.constructor==Object){
                    document.getElementById("con_return_status").style.opacity=0;
                    if(data.status=="success"){
                        document.getElementById("con_return_status").style.opacity=0;
                        window.location.href="./joint.form.verification.php";
                    }else{
                        __set_error(data.data)
                    }
                }else{
                    __set_error("Object Not Found Please Retry");
                }
            }else{
                __set_error("Please Refresh Page..");
            }
            document.querySelector("#allSubmit").value="Submit";
        }
    })
}
function __set_error(data){
    var error_msg=document.getElementById("return_msg");
    error_msg.innerText=data;
    document.getElementById("con_return_status").style.opacity=1;
    scrollEle(error_msg);
}