
//error
var error_con=document.getElementById("error_con");


//inputs
var inp1=document.getElementById("inp1");
var inp2=document.getElementById("inp2");
var inp3=document.getElementById("inp3");
var inp4=document.getElementById("inp4");
var casrf_tkn=document.getElementById("casrf_tkn");

//result
var res_con=document.getElementById("rtn_res_con");
var res_ifsc   = document.getElementById("res_ifsc");
var res_micr   = document.getElementById("res_micr");
var res_bank   = document.getElementById("res_bank");
var res_adr    = document.getElementById("res_adr");
var res_dis    = document.getElementById("res_dis");
var res_state  = document.getElementById("res_state");
var res_branch = document.getElementById("res_branch");
var res_num    = document.getElementById("res_num");

//labels
var sta_lab="Please Select State"
var dis_lab="Please Select District"
var branch_lab="Please Select Branch"


document.addEventListener("load",()=>{
    document.querySelector(".loader_con").style.display="none";
})


function set_opt(val,con)
{
    let opt=document.createElement("option");
    opt.innerText=val;
    opt.value=val;
    con.appendChild(opt);
}

inp1.addEventListener("change",(e)=>{
    remove_child(inp2,sta_lab);
    remove_child(inp3,dis_lab);
    remove_child(inp4,branch_lab);
    e.preventDefault();
    form_data=new FormData();
    if( valid_name( inp1.value ) )
    {
        clr_err( inp1 );
        form_data.append( "name",inp1.value );
        form_data.append("state","def" );
        form_data.append("dis","def" );
        form_data.append("branch","def" );
        form_data.append("token",casrf_tkn.value );
        set(form_data,inp2,0);
    }
    else
    {
        set_err( inp1 );
    }
})

inp2.addEventListener("change",(e)=>{
    remove_child(inp3,dis_lab);
    remove_child(inp4,branch_lab);
    e.preventDefault();
    form_data=new FormData();
    if( valid_name( inp1.value ) )
    {
        clr_err( inp1 );
        if( valid_name( inp2.value ) )
        {
            clr_err( inp2 );
            form_data.append( "name",inp1.value );
            form_data.append("state",inp2.value );
            form_data.append("dis","def" );
            form_data.append("branch","def" );
            form_data.append("token",casrf_tkn.value );
            set(form_data,inp3,0);
        }else{
            set_err( inp2 );
        }
    }
    else
    {
        set_err( inp1 );
    }
})

inp3.addEventListener("change",(e)=>{
    remove_child(inp4,branch_lab);
    e.preventDefault();
    form_data=new FormData();
    if( valid_name( inp1.value ) )
    {
        clr_err( inp1 );
        if( valid_name( inp2.value ) )
        {
            clr_err( inp2 );
            if( valid_name( inp3.value ) )
            {
                clr_err( inp3 );
                form_data.append( "name"  , inp1.value      );
                form_data.append( "state" , inp2.value      );
                form_data.append( "dis"   , inp3.value      );
                form_data.append( "branch", "def"           );
                form_data.append( "token" , casrf_tkn.value );
                set(form_data,inp4,0);
            }else{
                set_err( inp3 ); 
            }
        }else{
            set_err( inp2 );
        }
    }
    else
    {
        set_err( inp1 );
    }
})
inp4.addEventListener("change",(e)=>{
    e.preventDefault();
    document.getElementById("ifsc_get_all").value='';
    form_data=new FormData();
    if( valid_name( inp1.value ) )
    {
        clr_err( inp1 );
        if( valid_name( inp2.value ) )
        {
            clr_err( inp2 );
            if( valid_name( inp3.value ) )
            {
                clr_err( inp3 );
                if( valid_off( inp4.value ) )
                {
                    clr_err( inp4 );
                    form_data.append( "name"  , inp1.value      );
                    form_data.append( "state" , inp2.value      );
                    form_data.append( "dis"   , inp3.value      );
                    form_data.append( "branch", inp4.value      );
                    form_data.append( "token" , casrf_tkn.value );
                    set(form_data,res_con,1);
                }else{
                    set_err( inp4 ); 
                }
            }else{
                set_err( inp3 ); 
            }
        }else{
            set_err( inp2 );
        }
    }
    else
    {
        set_err( inp1 );
    }
})

function set(form,setter,type)
{
    document.querySelector(".loader_con").style.display="flex";
    $.ajax({
        url:"./get_options_ifsc.php",
        type:"POST",
        data:form,
        contentType:false,
        processData:false,
        success:function(fetch_data){
        if(fetch_data!=='')
        {
         fetch_data=$.parseJSON( fetch_data );
            if( Object.entries(fetch_data).length>0 ){
                __error__("no","nothing","green");
                if(fetch_data.constructor==Object){
                    __error__("no","nothing","green");
                    if(fetch_data.status=="success")
                    {
                        __error__("no","nothing","green");
                        if(type==0)
                        {
                            let data=fetch_data.data
                            if(data.constructor==Array)
                            {
                                data.forEach(opt => {
                                    set_opt(opt,setter);
                                });
                            }
                            else
                            {
                                __error__("er",data.data,"#ff8585");
                            }
                        }
                        else if(type==1)
                        {
                            let data=fetch_data.data;
                            console.log(data);
                            let ifsc   = data[0][1];
                            let micr   = data[0][4];
                            let adr    = data[0][2];
                            let num    = data[0][3];
                            let bank   = inp1.value;
                            let dis    = inp3.value;
                            let state  = inp2.value;
                            let branch = inp4.value;
                            set_results(ifsc,micr,adr,num,bank,dis,state,branch);
                        }
                    }
                    else
                    {
                        __error__("er",fetch_data.data,"#ff8585");
                    }
                }else{
                    __error__("er","Something went wrong","#ff8585");
                }
            }else{
                __error__("er","Something went wrong","#ff8585");
            }   
        }
        else
        {
            __error__("er","Data not found","#ff8585");
        }
            document.querySelector(".loader_con").style.display="none";
        }
    })
}
var clr_err = function ( con )
{
    con.style.borderColor="#11e311";
}
var set_err = function ( con )
{
    con.style.borderColor="red";
    con.addEventListener("onchange",()=>{
        con.style.color="black"
    })
}
var valid_name = function(val)
{
    if(val!=='' && val!=="select")
    {
        if( val.length>2 && val.length<100 )
        {
            if(val.match(/^[A-Za-z\-\.\, ]+$/)){
                return true;
            }else{
                return false;
            }
        }
        else
        {
            return false;
        }
    }
    else
    {
        return false;
    }
}


function valid_off(val)
{
    if(val!=='' && val!=="select" )
    {
        return true;
    }
    else
    {
        return false;
    }
}
function __error__(type,data,clr)
{
    if(type=="er")
    {
        dis="block";
        opa=1;
    }
    else
    {
        dis="none";
        opa=0;
    }
    error_con.style.display=dis;
    error_con.style.opacity=opa;
    error_con.style.backgroundColor=clr;
    error_con.innerText=data;

}

function remove_child(id,txt)
{
    let opt=document.createElement("option");
    opt.value="select";
    opt.innerText=txt;
    id.innerHTML='';
    id.appendChild(opt);
}

jQuery('#get_details').on('submit',function(e){
    e.preventDefault();
    form_data=new FormData(this);
    if(casrf_tkn.value!==" ")
    {
        __error__("unerr","Invalid IFSC Code","red");
        if( validate_bank_ifsc( form_data.get( "ifsc_get_user_data" ) ) )
        {
            __error__("noer","Invalid IFSC Code","red");
            get_all_ifsc(form_data.get( "ifsc_get_user_data" ),casrf_tkn.value );
        }
        else
        {
            __error__("er","Invalid IFSC Code","red");
        }
    }
    else
    {
        __error__("er","Please refresh page","red");
    }
})

function validate_bank_ifsc(number){
    if(number.length!=0){
        var rgx=/^[A-Z]{1}[A-Z0-9]{10}$/;
        if(rgx.test(number)){
            return true;

        }else{
            return false;
        }
    }else{
        return false
    }

}

function get_all_ifsc(ifsc,tkn)
{console.log('dfsf')
    document.querySelector(".loader_con").style.display="flex";
    $.ajax({
        url:"get_all_ifsc_data.php",
        type:"POST",
        data:{"tkn":tkn,"ifsc":ifsc},
        success:function(data)
        {
            data=$.parseJSON(data);
            if(data.status==="success")
            {
                let fetch_data=$.parseJSON(data.data);
                set_results(ifsc,fetch_data.micr,fetch_data.adr5,fetch_data.contact,fetch_data.name,fetch_data.adr3,fetch_data.adr4,fetch_data.adr1);
            }
            else
            {
                __error__("er",data.data,"red");
            }
            document.querySelector(".loader_con").style.display="none";
        }
    })
}

function set_results(ifsc,micr,adr,num,bank,dis,state,branch)
{
    res_con.style.display="block";
    res_con.style.opacity=1;

    res_ifsc  .innerText = ( ifsc  ) ? ifsc  :"No Data";
    res_micr  .innerText = ( micr  ) ? micr  :"No Data";
    res_adr   .innerText = ( adr   ) ? adr   :"No Data";
    res_num   .innerText = ( num   ) ? num   :"No Data";
    res_bank  .innerText = ( bank  ) ? bank  :"No Data";
    res_dis   .innerText = ( dis   ) ? dis   :"No Data";
    res_state .innerText = ( state ) ? state :"No Data";
    res_branch.innerText = ( branch) ? branch:"No Data";

}

// ABPB0000002