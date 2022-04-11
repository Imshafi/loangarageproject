// all inputs 
var fname=document.getElementById("f_name");
var lname=document.getElementById("l_name");
var ccode=document.getElementById("code");
var area=document.getElementById("area");
var mobile=document.getElementById("number");
var email=document.getElementById("email");
var aad_one=document.getElementById("add_aad_one");
var aad_two=document.getElementById("add_aad_two")
var aad_city=document.getElementById("add_city")
var aad_state=document.getElementById("add_state")
var aad_pin=document.getElementById("add_pin")
var cur_one=document.getElementById("add_cur_one")
var cur_two=document.getElementById("add_cur_two")
var cur_city=document.getElementById("cur_city")
var cur_state=document.getElementById("cur_state")
var cur_pin=document.getElementById("cur_pin")
var type=document.getElementById("select_loan")
var pan=document.getElementById("upload_pan")
var aad_front=document.getElementById("upload_aad_front")
var aad_back=document.getElementById("upload_aad_back")
var bank_stm=document.getElementById("upload_bank")
var salary=document.getElementById("upload_salary")
var selfie=document.getElementById("upload_selfie")
var return_con=document.getElementById("loan_return_shaower");
var loan_amt=document.getElementById("loan_amt");

// all inputs contaniers
var name_con=document.getElementById("name_continer");
var number_con=document.getElementById("mobile_con");
var email_con=document.getElementById("email_con");
var aad_add_con=document.getElementById("address_aadhar_continer");
var cur_add_con=document.getElementById("cur_address_continer");
var type_con=document.getElementById("select_continer");
var pan_con=document.getElementById("pan_con");
var aad_front_con=document.getElementById("aad_front_con");
var aad_back_con=document.getElementById("aad_back_con");
var bank_con=document.getElementById("bank_con");
var salary_con=document.getElementById("salary_con");
var selfie_con=document.getElementById("selfie_con");
var loan_amt_con=document.getElementById("loan_amt_con");
var form_data;
jQuery('#full_form_apply_loan').on('submit',function(e){
    e.preventDefault();
    form_data=new FormData(this);
    if( validate_form() )
    {
        set_data(form_data);
    }
})

// function for validate and return response 
var validate_form=function(){
    //fname
    if(validate_name(fname.value)){
        clear(fname,name_con)
        //lname
        if(validate_name(lname.value)){
            clear(lname,name_con);
            // country code 
            if(validate_country_code(ccode.value)){
                clear(ccode,number_con);
                // mobile
                if(validate_number(mobile.value)){
                    clear(mobile,number_con);
                    // email 
                    if(validate_email(email.value)){
                        clear(email,email_con);
                        //aadhar address one
                        if(validate_name_add(aad_one.value)){
                            clear(aad_one,aad_add_con);
                            // aadhar address two 
                            if(validate_name_add(aad_two.value)){
                                clear(aad_two,aad_add_con);
                                // aadhar city 
                                if(validate_name(aad_city.value)){
                                    clear(aad_city,aad_add_con);
                                    // aadhar state 
                                    if(validate_name(aad_state.value)){
                                        clear(aad_state,aad_add_con);
                                        // aadhar pincode 
                                        if(validate_pincode(aad_pin.value)){
                                            clear(aad_pin,aad_add_con);
                                            //current address one
                                            if(validate_name_add(cur_one.value)){
                                                clear(cur_one,cur_add_con);
                                                // current address two 
                                                if(validate_name_add(cur_two.value)){
                                                    clear(cur_two,cur_add_con);
                                                    // current city 
                                                    if(validate_name(cur_city.value)){
                                                        clear(cur_city,cur_add_con);
                                                        // current state 
                                                        if(validate_name(cur_state.value)){
                                                            clear(cur_state,cur_add_con);
                                                            // current pincode 
                                                            if(validate_pincode(cur_pin.value)){
                                                                clear(cur_pin,cur_add_con);
                                                                // current state 
                                                                if(validate_type(type.value)){
                                                                    clear(type,type_con);
                                                                    if(validate_amt(loan_amt.value)){
                                                                        clear(loan_amt,loan_amt_con);
                                                                        //pan upload
                                                                        if(validate_img(pan)){
                                                                            clear(pan,pan_con);
                                                                            //aadhar front side  upload
                                                                            if(validate_img(aad_front)){
                                                                                clear(aad_front,aad_front_con);
                                                                                //aadhar back side upload
                                                                                if(validate_img(aad_back)){
                                                                                    clear(aad_back,aad_back_con);
                                                                                    //bank statement upload
                                                                                    if(validate_img(bank_stm)){
                                                                                        clear(bank_stm,bank_con);
                                                                                        //salary upload
                                                                                        if(validate_img(salary)){
                                                                                            clear(salary,salary_con);
                                                                                            //selfie upload
                                                                                            if(validate_img(selfie)){
                                                                                                clear(selfie,selfie);
                                                                                                return true;
                                                                                            }else{
                                                                                                error(selfie,selfie);
                                                                                                return false
                                                                                            }
                                                                                        }else{
                                                                                            error(salary,salary_con);
                                                                                            return false
                                                                                        }
                                                                                    }else{
                                                                                        error(bank_stm,bank_con);
                                                                                        return false
                                                                                    }
                                                                                }else{
                                                                                    error(aad_back,aad_back_con);
                                                                                    return false
                                                                                }
                                                                            }else{
                                                                                error(aad_front,aad_front_con);
                                                                                return false
                                                                            }
                                                                        }else{
                                                                            error(pan,pan_con);
                                                                            return false
                                                                        }
                                                                    }else{
                                                                        error(loan_amt,loan_amt_con);
                                                                        return false
                                                                    }
                                                                }else{
                                                                    error(type,type_con);
                                                                    return false
                                                                }
                                                            }else{
                                                                error(cur_pin,cur_add_con);
                                                                return false
                                                            }
                                                        }else{
                                                            error(cur_state,cur_add_con);
                                                            return false
                                                        }
                                                    }else{
                                                        error(cur_city,cur_add_con);
                                                        return false
                                                    }
                                                }else{
                                                    error(cur_two,cur_add_con);
                                                    return false
                                                }
                                            }else{
                                                error(cur_one,cur_add_con);
                                                return false
                                            }
                                        }else{
                                            error(aad_pin,aad_add_con);
                                            return false
                                        }
                                    }else{
                                        error(aad_state,aad_add_con);
                                        return false
                                    }
                                }else{
                                    error(aad_city,aad_add_con);
                                    return false
                                }
                            }else{
                                error(aad_two,aad_add_con);
                                return false
                            }
                        }else{
                            error(aad_one,aad_add_con);
                            return false
                        }
                    }else{
                       error(email,email_con);
                       return false
                    }
                }else{
                   error(mobile,number_con);
                   return false
                }
            }else{
               error(ccode,number_con);
               return false
            }
        }else{
           error(lname,name_con);
           return false
        }
    }else{
       error(fname,name_con);
       return false
    }
}

function clear(child,parent){
    child.style.border="2px solid rgb(43 217 43 / 0.5)";
    child.style.boxShadow="0px 0px 0px 0px #ffff";
    parent.style.backgroundColor="#ffff";
    scrollEle(parent);
    change_dis_error(parent,"no");
}

function error(child,parent){
    child.style.border="2px solid red";
    child.style.boxShadow="0px 0px 3px 0.5px rgba(0,0,0,0.3)";
    parent.style.backgroundColor="#ffd7d7";
    scrollEle(parent);
    change_dis_error(parent,"yes");
    child.focus();
}

function change_dis_error(parent,type){
    let childerns=parent.children;
    for(var i=0; i<childerns.length; i++){
        if(childerns.item(i).hasAttribute("class")){
            classlists=childerns.item(i).classList;
            for(var j=0; j<classlists.length; j++){
                if(classlists[j]=="error_lab"){
                    if(type==="no"){
                        childerns[i].style.display="none";
                    }else{
                        childerns[i].style.display="block";
                    }
                }
            }
        }
    }
}

function validate_type(val){
    switch(val)
    {
        case "personal_loan":return true;
        case "business_loan":return true;
        case "home_loan":return true;
        case "mortgage_loan":return true;
        case "personal_loan_balance_transfer":return true;
        case "home_loan_balance_transfer":return true;
        case "credit_cards":return true;
        case "personal_loan":return true;
        default:return false;
    }
}

// events 

pan.addEventListener("change",pan_change);
aad_front.addEventListener("change",aad_front_change);
aad_back.addEventListener("change",aad_back_change);
bank_stm.addEventListener("change",bank_change);
salary.addEventListener("change",salary_change);
selfie.addEventListener("change",selfie_change);

function pan_change(){
    var files=this.files[0];
    change_img(files,document.getElementById("pan_label_con"),pan_con,pan);
}
function aad_front_change(){
    var files=this.files[0];
    change_img(files,document.getElementById("aad_front_label_con"),aad_front_con,aad_front);
}
function aad_back_change(){
    var files=this.files[0];
    change_img(files,document.getElementById("aad_back_label_con"),aad_back_con,aad_back);
}
function bank_change(){
    var files=this.files[0];
    change_img(files,document.getElementById("bank_label_con"),bank_con,bank_stm);
}
function salary_change(){
    var files=this.files[0];
    change_img(files,document.getElementById("salary_label_con"),salary_con,salary);
}
function selfie_change(){
    var files=this.files[0];
    var selfie_lab=document.getElementById("selfie_label_con")
    change_img(files,selfie_lab,selfie_con,selfie);
}


function change_img(files,con,parent,inp){
    if(inp.value!=''){
        var res=validTypes.includes(files.name.substring(files.name.lastIndexOf(".")+1).toUpperCase());
        if(res){
            con.innerHTML=files.name;
            con.style.color="black";
            parent.style.backgroundColor="#ffff";
            change_dis_error(parent,"no");
        }else{
            con.innerHTML='Your File Type Is "'+files.name.substring(files.name.lastIndexOf(".")+1).toUpperCase()+'"';
            con.style.color="red";
            parent.style.backgroundColor="#ffd7d7";
            change_dis_error(parent,"yes");
        }
    }else{
        con.innerHTML='Please Select A File';
        con.style.color="red";
        parent.style.backgroundColor="#ffd7d7";
        change_dis_error(parent,"yes");
    }
    
}
function set_data(form_data_verify){
    document.getElementById("submit_form_btn").value="Please Wait..."
    $.ajax({
        url:"all.min.sub.php.dir/entry.loan.apply.all.min.php",
        type:"POST",
        data:form_data_verify,
        contentType:false,
        processData:false,
        success:function(data){
            if( Object.entries(data).length>0 ){
                data=$.parseJSON(data);
                if(data.constructor==Object){
                    if(data.status=="success"){
                        window.location.href="./loan_verification.php";
                    }else{
                        __setErrors("block",1,"return_label",data.data,return_con,"red","#ffff");
                    }
                }else{
                    __setErrors("block",1,"return_label","Filed Retry...",return_con,'red',"#ffff");
                }
            }else{
                __setErrors("block",1,"return_label","Filed Retry...",return_con,"red","#ffff");
            }
            document.getElementById("submit_form_btn").value="Next";
        }
    })
    
}
function __setErrors(display,opacity,err_con,err,parent,bgClr,color){
    parent.style.display=display;
    parent.style.opacity=opacity;
    document.getElementById(err_con).innerText=err;
    document.getElementById(err_con).style.backgroundColor=bgClr;
    document.getElementById(err_con).style.color=color;
    scrollEle(parent);
}
function validate_amt(val){
    if(val!==''){
        if(val>=25000 && val<=10000000){
            return true;
        }else{
            return false;
        }
    }else{
        return false;
    }
}
