var error_con=document.getElementById("error_con");
var error_lab=document.getElementById("error_lab");
var all_partners_con=document.getElementById("all_partners_con");

get_partners();



function single_user(partner_id,partner_name,msg_status){
    let a=document.createElement("a");
    a.classList="redir";
    a.id=partner_id;
    a.href="./admin_partner_chat.php?UID="+partner_id;

    let pirticular_con=document.createElement("div");
    pirticular_con.classList="pirticular_con";
    a.appendChild(pirticular_con);

    let name_con=document.createElement("div");
    name_con.classList="nameCOntiner"
    name_con.innerText=partner_name;
    pirticular_con.appendChild(name_con);

    if(msg_status==1){
        let new_msg=document.createElement("div");
        new_msg.classList="new_msg_con";
        pirticular_con.appendChild(new_msg);
    }
    all_partners_con.appendChild(a);
}

function get_partners(){
    $.ajax({
        url:"./get_all_partners.php",
        type:"POST",
        data:{"get":true,"admin_id":mukhyam},
        success:function(data){
            data=$.parseJSON(data);
            if( Object.entries(data).length>0 ){
                shw_err__("remove","un_er");
                if(data.status=="success"){
                    shw_err__("remove","un_er")
                    data.data.forEach(element => {
                        if(!document.getElementById(element.id)){
                            single_user(element.id,element.name,element.msg_status);
                        }
                    });
                }else if(data.status=="failed" || data.status=="no_data"){
                    shw_err__(data.data,"er");
                }else{
                    shw_err__("Error Occured","er");
                }
            }else{
                shw_err__("Error Occured","er");
            }
        }
    })
}

function shw_err__(data,type){
    if(type=="er"){
        error_con.classList.add("un_error");
    }else{
        error_con.classList.remove("un_error");
    }
    error_lab.innerText=data;
}

