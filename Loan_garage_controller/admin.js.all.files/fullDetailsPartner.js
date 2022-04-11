var success_btn=document.getElementById("success_btn");
var failed_btn=document.getElementById("failed_btn");
var tkn=document.getElementById("tkn_csrf_response");
var error_con=document.getElementById("error_con_id");
var error_lab=document.getElementById("error_lab_id");
var error;
if(error===true){
    error_dis("Loan Successfully Accepted",'er',"#7cff7c");
}

success_btn.addEventListener("click",success);
failed_btn.addEventListener("click",failed);

function success(){
    change_status("success");
}
function failed(){
    change_status("failed");
}
function change_status(type){
    if(typeof(imp_id)==="number" && imp_id!==0){
        $.ajax({
            url:"./set_partner_status.php",
            type:"POST",
            data:{"partner_id":imp_id,"type":type,"PARTNER_RESPONSE_ADMIN":tkn.value},
            success:function(data){
                data=$.parseJSON(data);
                if( Object.entries(data).length>0 ){
                    if(data.constructor==Object){
                        if(data.status=="success"){
                            if(type==="success"){
                                error_dis("Application Successfully Accepted",'er',"#7cff7c");
                            }else{
                                error_dis(data.data,"er","#ff8585")
                            }
                        }else{
                            error_dis(data.data,"er","#ff8585")
                        }
                    }else{
                        error_dis("Failed To Accept Loan","er","#ff8585");
                    }
                }else{
                    error_dis("Failed To Accept Loan","er","#ff8585");
                }
            }
        })
    }else{
        error_dis("Invalid UID Please Go Back","er","#ff8585") 
    }
}
function error_dis(data,type,clr){
    if(type=="er"){
        error_con.style.display="block";
        error_con.style.backgroundColor=clr;
        error_con.style.opacity=1;
        error_lab.innerText=data;
    }else{
        error_con.style.display="none";
        error_con.style.opacity=0;  
    }
}
