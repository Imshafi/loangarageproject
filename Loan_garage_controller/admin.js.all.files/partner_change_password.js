var curr_error=document.getElementById("current_error");
var new_error=document.getElementById("new_error");
jQuery('#change_pass_form').on('submit',function(e){
    e.preventDefault();
    form_data=new FormData(this);
    if(validate_password(form_data.get("current_password_partner"))){
        ___error_clear__(curr_error);
        if(validate_password(form_data.get("new_password_partner"))){
            ___error_clear__(new_error);
            if(form_data.get("current_password_partner")!=form_data.get("new_password_partner")){
                ___error_clear__(new_error);
                __change_password(form_data);
            }else{
                __set_error(new_error,"Enter New Password")
            }
        }else{
            __set_error(new_error,"Invalid Password")
        }
    }else{
        __set_error(curr_error,"Invalid Password")
    }
})

function __set_error(error,content){
    error.innerText=content;
    error.style.display="block";

}
function ___error_clear__(error){
    error.innerText="";
    error.style.display="none";
}

function validate_password(val){
    if(val.length>8){
        var rgx=/^[A-Za-z0-9!@#$%^&*()]{8,10}$/;
        if(rgx.test(val)){
            return true;
        }else{
           return false;
        }
    }else{
        return false;
    }
}

function __change_password(values){
    $.ajax({
        url:"../all.min.sub.php.dir/change.password.partner.all.php",
        type:"POST",
        data:values,
        contentType:false,
        processData:false,
        success:function(data){
            console.log(data)
            if( Object.entries(data).length>0 ){
                ___error_clear__(new_error);
                data=$.parseJSON(data);
                if(data.constructor==Object){
                    ___error_clear__(new_error);
                    if(data.status=="success" && data.data=="changed"){
                        ___error_clear__(new_error);
                        window.location.href="./verify_change_password.php";
                    }else{
                        __set_error(new_error,data.data);   
                    }
                }else{
                    __set_error(new_error,data.data);   
                }
            }else{
                __set_error(new_error,"Unable To Change...");            
            }
        }
    })
}
