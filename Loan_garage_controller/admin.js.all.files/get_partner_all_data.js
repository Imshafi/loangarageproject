var tkn=document.getElementById("token_val").value;
function set_data(loan_id,clint_name,loan_status,earned,time,refer_id)
{
    if(loan_status==0)
    {
        loan_status="Success";

    }else if(loan_status==1)
    {
        loan_status="On progress";

    }else
    {
        loan_status="Failed";
    }
    let pir=document.createElement("div");
    pir.classList.add("pir_con");
    pir.id=loan_id

    let table=document.createElement("table");
    pir.appendChild(table);

    let tr1=document.createElement("tr");
    let tr2=document.createElement("tr");
    let tr3=document.createElement("tr");
    let tr4=document.createElement("tr");
    let tr5=document.createElement("tr");

    table.appendChild(tr1);
    table.appendChild(tr2);
    table.appendChild(tr3);
    table.appendChild(tr4);
    table.appendChild(tr5);

    let td11=document.createElement("td");
    let td12=document.createElement("td");
    let td21=document.createElement("td");
    let td22=document.createElement("td");
    let td31=document.createElement("td");
    let td32=document.createElement("td");
    let td41=document.createElement("td");
    let td42=document.createElement("td");
    let td51=document.createElement("td");
    let td52=document.createElement("td");

    let span1=document.createElement("span");
    let span2=document.createElement("span");
    let span3=document.createElement("span");
    let span4=document.createElement("span");
    let span5=document.createElement("span");

    span1.classList.add("col");
    span2.classList.add("col");
    span3.classList.add("col");
    span4.classList.add("col");
    span5.classList.add("col");

    span1.innerText=":";
    span2.innerText=":";
    span3.innerText=":";
    span4.innerText=":";
    span5.innerText=":";

    td11.innerText="Clint name";
    td21.innerText="Loan UID";
    td31.innerText="Loan Status";
    td41.innerText="Earned";
    td51.innerText="Applied on";

    td12.innerText=clint_name;
    td22.innerText=loan_id;
    td32.innerText=loan_status;
    td52.innerText=time;

    let div_edit=document.createElement("input");
    div_edit.contentEditable=true;
    div_edit.value=earned;
    div_edit.type="number";
    div_edit.data=refer_id;
    div_edit.autocomplete=true;
    div_edit.classList.add("edit_con");
    td42.appendChild(div_edit);

    td11.appendChild(span1);
    td21.appendChild(span2);
    td31.appendChild(span3);
    td41.appendChild(span4);
    td51.appendChild(span5);

    tr1.appendChild(td11);
    tr1.appendChild(td12);
    tr2.appendChild(td21);
    tr2.appendChild(td22);
    tr3.appendChild(td31);
    tr3.appendChild(td32);
    tr4.appendChild(td41);
    tr4.appendChild(td42);
    tr5.appendChild(td51);
    tr5.appendChild(td52);

    let btn_con=document.createElement("div");
    btn_con.classList.add("go_to");

    let a=document.createElement("a");
    a.classList.add("anc");
    a.href="fullDetailsLoan.php?UID="+loan_id;
    a.innerText="Check";
    btn_con.appendChild(a);
    pir.appendChild(btn_con);

document.getElementById("all_con").appendChild(pir)

}
get_data(tkn,"nothing","nothing",user)

function get_data(token,from,to,id)
{
    document.getElementById("loading_cir").style.display="block";
    $.ajax({

        url     : "get_partner_work.php",
        type    : "POST",
        data    : {"token":token,"from":from,"to":to,"partner_id":id},
        success : function(data)
        {
            data=$.parseJSON(data);
            if( Object.keys(data).length==2 )
            {
                msg('type','data','clr');
                if( data.status=="success" )
                {
                    msg('type','data','clr');
                    document.getElementById("all_con").innerHTML='';
                    data.data.forEach(ele => {
                        ele=$.parseJSON(ele);
                        set_data(ele.id,ele.name,ele.status,ele.amt,ele.time,ele.refer_id)
                    });
                    get_selector();
                }
                else
                {
                    msg("er",data.data,"red");
                }
            }
            else
            {
                msg("er","Something went wrong","red");
            }
            document.getElementById("loading_cir").style.display="none";
        }
    })

}

function msg(type,data,clr)
{
    let opa=0;
    let dis='none'
    if(type=='er')
    {
        dis='block';
        opa=1;
    }
    document.getElementById("shw_msg").style.display=dis;
    document.getElementById("shw_msg").style.opacity=opa;
    document.getElementById("shw_msg").style.color=clr;
    document.getElementById("shw_msg").innerText=data;

}
jQuery('#get_data').on('submit',function(e){
    e.preventDefault();
    form_data=m=new FormData(this);
    if( validate_date( form_data.get( "from" ) ) )
    {
        msg('type','data','clr');
        if( validate_date( form_data.get( "to" ) ) )
        {
            msg('type','data','clr');
            if( form_data.get( "token" ).length!==0 )
            {
                msg('type','data','clr');
                get_data(form_data.get( "token" ),form_data.get( "from" ),form_data.get( "to" ),user);
            }
            else
            {
                msg("er","Please refersh the page","red");
            }
        }
        else
        {
            msg("er","Invalid to date","red");
        }
    }
    else
    {
        msg("er","Invalid from date","red");
    }
})

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
function get_selector()
{
    var amt_con=document.querySelectorAll(".edit_con");
    amt_con.forEach(ele => {
        ele.addEventListener("change",(e)=>{
            if( ele.value<50000 && ele.value>50 )
            {
                msg('type','data','clr');
                if( ele.data>0 && ele.data!=='' )
                {
                    msg('type','data','clr');
                    if( tkn!=='' )
                    {
                        msg('type','data','clr');
                        set_amt( tkn,ele.data,ele.value );
                    }
                    else
                    {
                        msg("er","Please reload the page","red");
                    }
                }
                else
                {
                    msg("er","Loan UID","red");
                }
            }
            else
            {
                msg("er","Money must be 50 to 50,000","red");
            }
        })
    });
}
function set_amt(token,uid,amt)
{
    document.getElementById("loading_cir").style.display="block";
    msg('type','data','clr');
    $.ajax({
        url:"set.amount.partner.php",
        type:"POST",
        data:{token:token,uid:uid,amt:amt},
        success:function(data)
        {
            data=$.parseJSON(data);
            if(data.status=="failed")
            {
                msg("er",data.data,"red");
            }
            else if(data.status=="success")
            {
                msg('type','data','clr');
            }
            document.getElementById("loading_cir").style.display="none";
        }
    })
}