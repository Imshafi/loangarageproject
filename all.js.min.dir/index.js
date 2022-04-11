var count=1;
setInterval(function(){
    document.getElementById("radio_btn"+count).checked=true;
    count++;
    if(count>8){
        count=1;
    }
},5000);