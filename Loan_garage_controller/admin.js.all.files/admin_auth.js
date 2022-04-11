var user_name=document.getElementById("user_name");
var user_password=document.getElementById("user_password");
var logContiner=document.getElementById("logContiner");
var error_continer=document.getElementById("error_continer");
var errorMsg_lab=document.getElementById("errorMsg_lab");
jQuery('#partner_login_form').on('submit',function(e){
    e.preventDefault();
    form_data=new FormData(this);
    if(validate_form(user_name.value,user_password.value)){
        error_continer.style.display="none";
        __auth_partner(form_data);
    }else{
        error_continer.style.display="block";
        __error_occ(logContiner);
    }
})
function __auth_partner(data_form){
    document.getElementById("user_submit").value="Please wait";
    $.ajax({
        url:"files.php.all.sub.php/files.php.all.sub.php.php",
        type:"POST",
        data:data_form,
        contentType:false,
        processData:false,
        success:function(data){
            if( Object.entries(data).length>0 ){
                data=$.parseJSON(data);
                if(data.constructor==Object){
                    if(data.status=="success" && data.data=="login"){
                        window.location.href="./admin_home.php";
                    }else{
                        __setError__(error_continer,errorMsg_lab,data.data,logContiner,"block");
                    }
                }else{
                    __setError__(error_continer,errorMsg_lab,data.data,logContiner,"block");                }
            }else{
                __setError__(error_continer,errorMsg_lab,data.data,logContiner,"block");
            }
            document.getElementById("user_submit").value="Login";
        }
    })
}
function __setError__(error_con,error_msg_con,error,whole_con,show){
    __error_occ(whole_con);
    error_con.style.display=show;
    error_msg_con.innerText=error

}
function __error_occ(con){
    con.classList.add("error_occ");
    setTimeout(function(){
        con.classList.remove("error_occ");
    },100)
}