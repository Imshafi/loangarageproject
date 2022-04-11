var textarea=document.getElementById("send_text");
var textarea_con=document.getElementById("send_msg_con_send");
var all_msg_con=document.getElementById("partner_admin_chat_con");
var send_msg=document.getElementById("send_text_btn");
var new_id=1;
send_msg.addEventListener("click",set_msg);


function set_msg(){
    var msg=textarea.value
    if(validate_msg(msg)){
        $.ajax({
            url:"../partner_login.dir/set_partner_admin_chat.php",
            type:"POST",
            data:{"get":true,"msg":msg},
            success:function(data){
                data=$.parseJSON(data);
                if( Object.entries(data).length>0 ){
                    if(data.constructor==Object){
                        if(data.status=="success" && data.data=="success"){
                            set_chat_partner(new_id,msg,"Just Now","this",all_msg_con);
                            textarea.value='';
                            new_id++;
                            scrollDown(all_msg_con);
                        }else{
                            __setError__(data.data);
                        }
                    }else{
                        __setError__("Oblect Not Created");
                    }
                }else{
                    __setError__("Failed To Send Please Retry...")
                }
            }
        })
    }else{
        __setError__("Invalid Message"); 
    }
}

function validate_msg(val){
    if(val!=''){
        return true;
    }else{
        return false;
    }
}
function set_chat_partner(id,msg,time,sender,parent_con){
    var pirticular_msg_con=document.createElement("div");
    pirticular_msg_con.classList.add("pirticular_msg_con");
    pirticular_msg_con.id=id;

    var msg_content_con=document.createElement("div");
    msg_content_con.classList.add("msg_content_con");
    pirticular_msg_con.appendChild(msg_content_con);
    if(sender=="this"){
        pirticular_msg_con.classList.add("sended");
    }

    var msg_content=document.createElement("div");
    msg_content.classList.add("msg_content");
    msg_content_con.appendChild(msg_content);

    var msg_content_lab=document.createElement("span");
    msg_content_lab.classList.add("msg_content_lab");
    msg_content_lab.innerText=msg;
    msg_content.appendChild(msg_content_lab);

    var time_con=document.createElement("div");
    time_con.classList.add("time_con");
    msg_content_con.appendChild(time_con);

    var time_lab=document.createElement("span");
    time_lab.innerText=time;
    time_lab.classList.add("time_lab");
    time_con.appendChild(time_lab);

    parent_con.appendChild(pirticular_msg_con);
}

textarea.addEventListener("input",e=>{
        let scHeight=e.target.scrollHeight;
        if(textarea.value==''){
            scHeight=40;
            textarea.style.color="black";
            textarea.style.borderColor="#36f236";
        }
        if(scHeight>=40 && scHeight<97){
            var scroll_height=`${scHeight}px`
            textarea.style.height=scroll_height;
            var calc_height=`calc(100% - 40px - ${scroll_height})`;
            partner_admin_chat_con.style.height=calc_height;
            scrollDown(all_msg_con);
        }
})

__user_chat_get("once");
function __user_chat_get(type_fetch){
    $.ajax({
        url:"../partner_login.dir/get_partner_admin_chat.php",
        type:"POST",
        data:{"get":true,"type":type_fetch},
        success:function(data){
            data=$.parseJSON(data);
            if( Object.entries(data).length>0 ){
                if(data.constructor==Array || data.constructor==Object){
                    if(data.status=="failed"){
                        
                    }else{
                        data.forEach(element => {
                            jQuery.fn.exists=function (){return this.length>0;}
                            if( $('#'+element.id).exists()){
                            }else{
                                set_chat_partner(element.id,element.admin_partner_com,element.time_com,element.sender_id,all_msg_con);
                                scrollDown(all_msg_con);
                            }
                        });
                    }
                }else{
                    __setError__("Oblect Not Created");
                }
            }else{
                __setError__("Failed To Send Please Retry...")
            }
        }
    })
}
function set_status(){
    $.ajax({
        url:"../set_msg_status_partner.php",
        type:"POST",
        data:{"set":true},
        success:function(data){
            data=$.parseJSON(data);
            if( Object.entries(data).length>0 ){
                if(data.constructor==Object){
                    if(data.status=="success"){
                    }else{
                        window.location.href="partner_home.php?data="+data.data;
                    }
                }else{
                    window.location.href="partner_home.php?data=error_occured";
                }
            }else{
                window.location.href="partner_home.php?data=error_occured";
            }
        }
    })
}
var scrollDown=function(continer){
    continer.scrollTop=continer.scrollHeight;
}
function __setError__(val){
    textarea.value=val;
    textarea.style.color="red";
    textarea.style.borderColor="red";
}
scrollDown(all_msg_con);
setInterval(function(){
    __user_chat_get("multiple");
},500);

setInterval(function(){
    set_status()
},5000);