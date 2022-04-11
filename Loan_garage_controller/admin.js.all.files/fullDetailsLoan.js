var textarea=document.getElementById("response");
var success_btn=document.getElementById("success_btn");
var failed_btn=document.getElementById("failed_btn");
var tkn=document.getElementById("tkn_csrf_response");
var error_con=document.getElementById("error_con_id");
var error_lab=document.getElementById("error_lab_id");
var response_text_con=document.getElementById("response_box");
var response_btn_con=document.getElementById("response_box_btns");
var error;
if(error===true){
    response_text_con.style.display="none";
    response_btn_con.style.display="none";
    response_text_con.style.opacity=0;
    response_btn_con.style.opacity=0;
    error_dis("Loan Successfully Accepted",'er',"#7cff7c");
}

success_btn.addEventListener("click",success);
failed_btn.addEventListener("click",failed);
textarea.addEventListener("input",e=>{
    let scHeight=e.target.scrollHeight;
    let length=textarea.value.length;
    if(textarea.value==''){
        scHeight=40;
        textarea.style.color="black";
        textarea.style.borderColor="#11e311";
    }
    if(scHeight>=40){
        var scroll_height=`${scHeight}px`
        textarea.style.height=scroll_height;
    }
    if(length>200){
        error_dis("Maximun Size Reached..","er","#ff8585");
    }else{
        error_dis("nothing","er_rem","#ff8585");
    }
})

function success(){
    change_status(0);
}
function failed(){
    change_status(2);
}
function change_status(type){
    var response=textarea.value;
    if(validation_msg(response)){
        if(typeof(imp_id)==="number" && imp_id!==0){
            if(type==2)
            {
                failed_btn.innerText="Rejecting..";
            }else
            {
                success_btn.innerText="Accepting..";
            }
            document.getElementById
            $.ajax({
                url:"./set_loan_status.php",
                type:"POST",
                data:{"response":response,"LOAN_RESPONSE_ADMIN":tkn.value,"loan_id":imp_id,"type":type},
                success:function(data){
                    data=$.parseJSON(data);
                    if( Object.entries(data).length>0 ){
                        if(data.constructor==Object){
                            if(data.status=="success"){
                                if(type==0){
                                    response_text_con.style.display="none";
                                    response_btn_con.style.display="none";
                                    response_text_con.style.opacity=0;
                                    response_btn_con.style.opacity=0;
                                    error_dis("Loan Successfully Accepted",'er',"#7cff7c");
                                }else{
                                    error_dis(data.data,"er","#ff8585")
                                    textarea.value='';
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
                    if(type==2)
                    {
                        failed_btn.innerText="Reject ...";
                    }else
                    {
                        success_btn.innerText="Accept ...";
                    }
                }
            })
        }else{
            error_dis("Invalid UID Please Go Back","er","#ff8585") 
        }
    }
}

function validation_msg(val){
    if(val!==''){
        error_dis("nothing","er_rem","#ff8585");
        if(val.length<200){
            error_dis("nothing","er_rem","#ff8585");
            let rgx=/^[a-zA-Z0-9\s,\''%!@#$&.)(-]*$/;
            if(rgx.test(val)){
                return true;
            }else{
                error_dis("Please Enter Your Response","er","#ff8585");
                return false;
            }   
        }else{
            error_dis("Please Enter Valid Response","er","#ff8585");
            return false;
        }
    }else{
        error_dis("Please Enter Your Response","er","#ff8585");
        return false;
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
