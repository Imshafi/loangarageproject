var amt_label=document.getElementById("amt_label");
var range_amt=document.getElementById("range_amt");
var user_inp_amount=document.getElementById("user_inp_amount");
var interest_label=document.getElementById("interest_label");
var range_int=document.getElementById("range_int");
var user_inp_interest=document.getElementById("user_inp_interest");
var time_yr_label=document.getElementById("time_yr_label");
var range_time_yr=document.getElementById("range_time_yr");
var user_inp_time_yr=document.getElementById("user_inp_time_yr");


user_inp_amount.value=range_amt.value*100000;
range_amt.oninput =(()=>{
    let val=range_amt.value;
    amt_label.textContent=val;
    user_inp_amount.value=range_amt.value*100000;
    amt_label.style.left=(val/2)+"%";
})


user_inp_interest.value=range_int.value;
range_int.oninput =(()=>{
    let val=range_int.value;
    interest_label.textContent=val;
    user_inp_interest.value=range_int.value;
    interest_label.style.left=(val*5)+"%"
})
range_amt.onchange =(()=>{
    
    set_all()
})
range_int.onchange =(()=>{
    
    set_all()
})
range_time_yr.onchange =(()=>{
    
    set_all()
})

user_inp_time_yr.value=range_time_yr.value;
range_time_yr.oninput =(()=>{
    let val=range_time_yr.value;
    time_yr_label.textContent=val;
    user_inp_time_yr.value=range_time_yr.value;
    time_yr_label.style.left=(val*2)+"%"
})

user_inp_amount.onchange=(()=>{
    set_all()
})

user_inp_interest.onchange=(()=>{
    set_all()
})

user_inp_time_yr.onchange=(()=>{
    set_all()
})


function calc(amt,intrest,time,Continer_canvas){
         
    // P=principal amount 
    // r=intrest rate/12/100
    // n=no of months=(years*12)

    
    var p=parseFloat(amt);
    var r=parseFloat(intrest/12/100);
    var n=parseFloat(time*12);
    var on=1+r;

    var upper=Math.pow(on,n);
    var down=parseFloat(upper-1);
    var div=parseFloat(upper/down);

    // e=emi=(p.r.(1+r)^n)/((1+r)^n-1)
    var e=parseFloat(p*r*div);

    // i=total=intrest=emi*no of months*principal amount 
    var i=e*n-p;

    // t=total payment=p+i;
    var pit=parseFloat(p)+parseFloat(i);

    // p in piechart
    var pInChart=(parseFloat(p)/pit)*100;
    
    //i in piechart
    var iInChart=(parseFloat(i)/pit)*100;

    return {
        totalEmi:Math.round(e),
        totalIntrest:Math.round(i),
        totalAmount:Math.round(pit)
    }
}

function setData(amount,intrest,time){
    var rtnval=calc(amount,intrest,time,document.getElementById("chat_show_con_id"));
    document.getElementById("total_emi").innerHTML="&#8377;"+rtnval.totalEmi;
    document.getElementById("total_int").innerHTML="&#8377;"+rtnval.totalIntrest;
    document.getElementById("total_amt").innerHTML="&#8377;"+rtnval.totalAmount;
}

function validation(val){
    if(val!=''){
        var rgx=/^[0-9]/;
        var array_check=[];
        for(i=0; i<val.length; i++){
            if(rgx.test(val[i]) || val[i]=="."){
                array_check.push(true);
            }else{
                array_check.push(false)
            }
        }
        if(array_check.includes(false)){
            return false;
        }else{
            return true;
        }
    }else{
        return false;
    }
}

function check_all(amt,int,tm){
    if(!validation(amt)){
        amt=100;
    }
    if(!validation(int)){
        int=10;
    }
    if(!validation(tm)){
        tm=25;
    }
    return {
        amt:amt,
        int:int,
        tm:tm
    }
}

function set_all(){
    var data=check_all(user_inp_amount.value,user_inp_interest.value,user_inp_time_yr.value);


    if( data.amt<=20000000 && data.amt>=100000 ){
        var amt_val=data.amt/100000;
    }else{
        var amt_val=100;
    }
    range_amt.value=amt_val;
    amt_label.style.left=(amt_val/2)+"%"
    amt_label.textContent=amt_val;
    user_inp_amount.value=amt_val*100000;


    if( data.int>=0 && data.int<=20 ){
        var int_val=data.int;
    }else{
        var int_val=10;
    }
    range_int.value=int_val;
    interest_label.style.left=(int_val*5)+"%"
    interest_label.textContent=int_val;
    user_inp_interest.value=int_val;


    if( data.tm>=0 && data.tm<=50 ){
        var tm_val=data.tm;
    }else{
        var tm_val=25;
    }
    range_time_yr.value=tm_val;
    time_yr_label.style.left=(tm_val*2)+"%"
    time_yr_label.textContent=tm_val;
    user_inp_time_yr.value=tm_val;

    setData(data.amt,data.int,data.tm)

}
set_all()