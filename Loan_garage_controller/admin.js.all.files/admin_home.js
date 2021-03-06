var from=document.getElementById("date_one");
var to=document.getElementById("date_two");
var filter_btn=document.getElementById("filter_get_data");
var error=document.getElementById("date_error");


___getPartner__Activity("nothing","nothing");

filter_btn.addEventListener("click",()=>{
    var fromVal=from.value;
    var toVal=to.value;
    if(validate_date(fromVal)){
        error.style.display="none";
        error.style.opacity=0;
        if(validate_date(toVal)){
            error.style.display="none";
            error.style.opacity=0;
            ___getPartner__Activity(fromVal,toVal)
        }else{
            error.style.display="block";
            error.style.opacity=1;
        }
    }else{
        error.style.display="block";
        error.style.opacity=1;
    }
})


function ___error(type,data){
    if(type=="set"){
        dis="block";
        opa=1;
    }else{
        dis="none";
        opa=0;
    }
    document.getElementById("error_continer").style.display=dis;
    document.getElementById("error_continer").style.opacity=opa;
    document.getElementById("error_msg").innerText=data;
}

function partner_activity(loan_app_id,sno,client_name,loan_status,admin_response_dis,date){
    // crating table row 
    let tr=document.createElement("tr");
    tr.id=loan_app_id;

    // creating table columns 
    let td1=document.createElement("td");
    let td2=document.createElement("td");
    let td3=document.createElement("td");
    let td4=document.createElement("td");
    let td5=document.createElement("td");
    
    // creating span 
    let span1=document.createElement("span");
    let span3=document.createElement("span");
    let span4=document.createElement("span");
    let span5=document.createElement("span");

    // creating links 
    let a=document.createElement("a");


    // convert status 
    if(loan_status=="success"){
        var class_status="success";
        var loan_sts="Success";
    }else if(loan_status=="progress"){
        var class_status="progress";
        var loan_sts="On Progress...";
    }else if(loan_status=="failed"){
        var class_status="failed";
        var loan_sts="Failed";
    }

    //setting span values
    span1.innerText=sno;
    span3.innerText=admin_response_dis;
    span3.classList="res_val";
    span4.innerText=loan_sts;
    span4.classList=class_status;
    span5.innerText=date;

    a.href="./fullDetailsLoan.php?UID="+loan_app_id;
    a.innerText=client_name;
    a.classList.add("client_name");

    // setting table columns with span 
    td1.appendChild(span1);
    td2.appendChild(a);
    td3.appendChild(span3);
    td4.appendChild(span4);
    td5.appendChild(span5);

    // setting table columns to rows
    tr.appendChild(td1);
    tr.appendChild(td2);
    tr.appendChild(td3);
    tr.appendChild(td4);
    tr.appendChild(td5);
    

    // setting rows to table
    document.getElementById("table_activity_partner").appendChild(tr);
}

function ___getPartner__Activity(from,to){
    document.querySelector(".loading_con").innerText="Getting Details ....";
    if(from==="nothing" && to==="nothing"){
        var post_data={"get":true,'type_get':1}
    }else{
        var post_data={"get":true,'type_get':1,"from":from,"to":to}
    }
    $.ajax({
        url:"./get_loan_applications.php",
        type:"POST",
        data:post_data,
        success:function(data){
                data=$.parseJSON(data);
                var a=1;
                if(data.status){
                    if(data.status==="failed" || data.status==="no_data"){
                        document.getElementById("error_msg").innerText=data.data;
                        document.getElementById("error_continer").style.display="block";
                        document.getElementById("error_continer").style.opacity=1;
                    }else{
                        
                    }
                }else{
                    if(Object.keys(post_data).length===2){
                        $.each(data,function(key,value){
                            if(value.user_id==="remove"){
                            }else{
                                partner_activity(value.id,a,value.name,value.status,value.response,value.time);
                                a++;
                            }
                        })
                    }else if(Object.keys(post_data).length===4){
                        document.getElementById("table_activity_partner").innerHTML='';
                        $.each(data,function(key,value){
                            jQuery.fn.exists=function (){return this.length>0;}
                            if( $('#'+value.user_id).exists()){
                                $('#'+value.user_id).remove()
                            }
                            if(value.user_id==="remove"){
                            }else{
                                ___error("re","none")
                                partner_activity(value.id,a,value.name,value.status,value.response,value.time);
                                a++;
                            }
                        })
                    }
                }
                document.querySelector(".loading_con").innerText="";
        }
    })
}
function validate_date(val){
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