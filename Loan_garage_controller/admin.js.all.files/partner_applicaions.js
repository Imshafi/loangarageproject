// var from=document.getElementById("date_one");
// var to=document.getElementById("date_two");
// var filter_btn=document.getElementById("filter_get_data");
var error=document.getElementById("date_error");


___get_partner__request("nothing","nothing");

// filter_btn.addEventListener("click",()=>{
//     var fromVal=from.value;
//     var toVal=to.value;
//     if(validate_date(fromVal)){
//         error.style.display="none";
//         error.style.opacity=0;
//         if(validate_date(toVal)){
//             error.style.display="none";
//             error.style.opacity=0;
//             ___get_partner__request(fromVal,toVal)
//         }else{
//             error.style.display="block";
//             error.style.opacity=1;
//         }
//     }else{
//         error.style.display="block";
//         error.style.opacity=1;
//     }
// })


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

function partner_application(loan_app_id,sno,client_name,date){
    // crating table row 
    let tr=document.createElement("tr");
    tr.id=loan_app_id;

    // creating table columns 
    let td1=document.createElement("td");
    let td2=document.createElement("td");
    let td5=document.createElement("td");
    
    // creating span 
    let span1=document.createElement("span");
    let span5=document.createElement("span");

    // creating links 
    let a=document.createElement("a");

    //setting span values
    span1.innerText=sno;
    span5.innerText=date;

    a.href="./fullDetailsPartner.php?UID="+loan_app_id;
    a.innerText=client_name;
    a.classList.add("client_name");

    // setting table columns with span 
    td1.appendChild(span1);
    td2.appendChild(a);
    td5.appendChild(span5);

    // setting table columns to rows
    tr.appendChild(td1);
    tr.appendChild(td2);
    tr.appendChild(td5);
    

    // setting rows to table
    document.getElementById("table_activity_partner").appendChild(tr);
}

function ___get_partner__request(from,to){
    if(from==="nothing" && to==="nothing"){
        var post_data={"get":true}
    }else{
        var post_data={"get":true,"from":from,"to":to}
    }
    $.ajax({
        url:"./get_partner_application.php",
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
                    if(Object.keys(post_data).length===1){
                        $.each(data,function(key,value){
                            if(value.user_id==="remove"){
                            }else{
                                partner_application(value.id,a,value.name,value.time);
                                a++;
                            }
                        })
                    }else{
                        console.log("failed");
                    }
                }
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

// if(Object.keys(post_data).length===3){
//     document.getElementById("table_activity_partner").innerHTML='';
//     // $.each(data,function(key,value){
//     //     jQuery.fn.exists=function (){return this.length>0;}
//     //     if( $('#'+value.user_id).exists()){
//     //         $('#'+value.user_id).remove()
//     //     }
//     //     if(value.user_id==="remove"){
//     //     }else{
//     //         partner_activity(value.id,a,value.name,value.time);
//     //         a++;
//     //     }
//     // })
//     console.log(data)
// }