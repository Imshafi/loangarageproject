var validTypes=['JPEG','PNG','JPG','PDF'];
// mobile number validation 
function validate_number(num){
    if(!num){
        return false;
    }else{
        var rgx=/^[6-9]{1}[0-9]{9}$/; 

        return rgx.test(num)?true:false;
    }
}
// Aadhar number validation 
function validate_aadhar(num){
    if(num.length!=0 && num!==0){
        var rgx=/^[0-9]{12}$/; 
        if(rgx.test(num)){
            return true;
        }else{
            alert("Please Enter Valid Aadhar Number");
            return false;
        }
    }else{
        alert("Please Enter Aadhar Number");
        return false;
    }

}
// bank account number validations 
function validate_bank_acc_num(num){
    if(num.length!=0){
        var rgx=/^[0-9]{1,20}$/; 
        if(rgx.test(num)){
            return true;
        }else{
            alert("Please Enter Valid Bank Number");
            return false;
        }
        
    }else{
        alert("Please Enter Bank Number");
        return false;
    }
}
// bank IFSC code validations 
function validate_bank_ifsc(number){
    if(number.length!=0){
        var rgx=/^[A-Z]{1}[A-Z0-9]{10}$/;
        if(rgx.test(number)){
            return true;

        }else{
            alert("Please Enter Valid IFSC CODE");
            return false;
        }
    }else{
        alert("Please Enter IFSC CODE");
        return false
    }

}
// EMAIL VALIDATION 
// var tester = /^[-!#$%&'*+\/0-9=?A-Z^_a-z`{|}~](\.?[-!#$%&'*+\/0-9=?A-Z^_a-z`{|}~])*@[a-zA-Z0-9](-*\.?[a-zA-Z0-9])*\.[a-zA-Z](-?[a-zA-Z0-9])+$/;
var tester=/^([a-z0-9]+(?:[._-][a-z0-9]+)*)@([a-z0-9]+(?:[.-][a-z0-9]+)*\.[a-z]{2,})$/;
var validate_email = function (email) {
    if (!email) return false;

    var emailParts = email.split('@');

    if(emailParts.length !== 2) return false

    var account = emailParts[0];
    var address = emailParts[1];

    if(account.length > 64) return false

    else if(address.length > 255) return false

    var domainParts = address.split('.');
    if (domainParts.some(function (part) {
        return part.length > 63;
    })) return false;


    if (!tester.test(email)) return false;


    return true;
};

// VALIDATE BANK NAME 
function validate_name(name){
    if(name.length!=0){
        if(name.length>3){
            if(name.match(/^[A-Za-z ]+$/)){
                return true;
            }else{
                return false;
            }
        }else{
                return false;
        }  
    }else{
        return false;
    }
}

// IMAGE validation
function validate_img(img){
    if(img.value!=''){
        var res=validTypes.includes(img.value.substring(img.value.lastIndexOf(".")+1).toUpperCase());
        if(res){
            return true;
        }else{
            return false;
        }            
    }
    else{
        return false;
    }
}

// pincode validations 
function validate_pincode(num){
    if(num.length!=0 && num>0){
        var rgx=/^[0-9]{6}$/; 
        if(rgx.test(num)){
            return true;
        }else{
            return false;
        }
    }else{
        return false;
    }

    }

// pan number validation 
function validate_pan_number(number){
    if(number.length!=10){
        alert("Please Enter PanCard Number");
        return false
    }else{
        var rgx=/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/;
        if(rgx.test(number)){
            return true;
        }else{
            alert("Please Enter Valid PanCard Number");
            return false;
        }
    }
}
// address validation 
function validate_name_add(val){
    if(val.length<5){
        return false;
    }else{
        let rgx=/^[a-zA-Z0-9\s,\''-]*$/;
        return rgx.test(val)?true:false;
    }
}

function changeBGC(child,parent){
    parent.style.backgroundColor="#ffeded";
    child.style.border="2px solid red";
    scrollEle(parent);
}
function changeNor(child,parent){
    parent.style.backgroundColor="";
    child.style.border=""
}

function validate_dob(val){
    var rgx1=/^[0-9]{2}[-][0-9]{2}[-][0-9]{4}$/;
    var rgx2=/^[0-9]{4}[-][0-9]{2}[-][0-9]{2}$/;
    if(rgx1.test(val)){
        return true;
    }else{
        if(rgx2.test(val)){
            return true;
        }else{
            return false;
        }
    }
}

function validate_country_code(val){
    if(!val) return false; 

    var rgx=/^[+][0-9]{1,5}$/;

    return rgx.test(val)?true:false;
}

// function for scroll to element 
var scrollEle=function(ele){
    ele.scrollIntoView({
        behaviour:"smooth",
        block:"center",
        inline:"nearest"
    });
}