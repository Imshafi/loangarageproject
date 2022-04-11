var curr_error=document.getElementById("current_error");
var new_error=document.getElementById("new_error");
jQuery('#change_pass_form').on('submit',function(e){
    e.preventDefault();
    form_data=new FormData(this);
    if( validate_password( form_data.get( "current_password_partner" ) ) ){
        ___error_clear__(curr_error);
        if( validate_password( form_data.get( "new_password_partner" ) ) ) {
            ___error_clear__(new_error);
            if(form_data.get("current_password_partner")!=form_data.get("new_password_partner")){
                ___error_clear__(new_error);
                __change_password(form_data);
            }else{
                __set_error(new_error,"Enter New Password");
            }
        }else{
            __set_error(new_error,"Invalid Password");
        }
    }else{
        __set_error(curr_error,"Invalid Password");
    }
})

function __set_error(error,content){
    error.innerText=content;
    error.style.display="block";
    error.style.color="#ffff";
    error.style.backgroundColor="#ff9797"

}
function ___error_clear__(error){
    error.innerText="";
    error.style.display="none";
}

function __change_password(values){
    document.getElementById("change_password").value="Changing ...";
    $.ajax({
        url:"../all.min.sub.php.dir/change.password.partner.all.php",
        type:"POST",
        data:values,
        contentType:false,
        processData:false,
        success:function(data){
            if( Object.entries(data).length>0 ){
                ___error_clear__(new_error);
                data=$.parseJSON(data);
                if(data.constructor==Object){
                    ___error_clear__(new_error);
                    if(data.status=="success"){
                        __set_error(new_error,"Password Successfully changed");
                        new_error.innerText=data.data;
                        new_error.style.display="block";
                        new_error.style.color="green";
                        new_error.style.backgroundColor="#ffff"
                        document.getElementById("current_password").value='';
                        document.getElementById("new_password").value='';
                    }else{
                        __set_error(new_error,data.data);   
                    }
                }else{
                    __set_error(new_error,data.data);   
                }
            }else{
                __set_error(new_error,"Unable To Change...");            
            }
            document.getElementById("change_password").value="Change";
        }
    })
}
