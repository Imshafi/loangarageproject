<?php
    define("A0(57%?<Fr@4**&__Admin___K#2*&(J^8392$()8347&^",true);
    require_once 'all.inc.nav.php';  
    $admin_id=$_SESSION['ADMIN_ID'];
?>
        <link rel="stylesheet" href="admin.style.all.files/articles.css">
        <div class="whole_con">
            <div class="msg_con" id="msg_shw">
            </div>
            <div class="sub_con">
                <div class="heading_art">
                    <h3>Upload Your articles</h3>
                </div>
                <form id="form_art">
                    <input type="hidden" name="token"   value="<?=token("ARTICLE_INSERT")?>">
                    <input type="text"   name="heading" class="inp" id="head" required autocomplete="off" placeholder="Enter heading">
                    <input type="file"   name="image"   class="opa" id="imag" required autocomplete="off">
                    <label for="imag"    id="lab_up" class="btn">Upload image</label>
                    <br>
                    <textarea            name="content" class="txt" id="main" required autocomplete="off" placeholder="Enter Content" ></textarea>
                    <input type="submit" name="submit"  class="btn" id="submit"value="Post">
                </form>
            </div>
        </div>
    </body>
</html>
<script>
    var error_con=document.getElementById("msg_shw");
    var validTypes=['JPEG','PNG','JPG'];
    var select=document.getElementById("imag");
    select.addEventListener("change",image)
    jQuery('#form_art').on('submit',function(e){
    e.preventDefault();
    form_data=new FormData(this);
    if( validate_heaing( form_data.get("heading"),0 ) )
    {
        shw_msg("none","none","red");
        if( validate_img( form_data.get("image"),1 ) )
        {
            shw_msg("none","none","red");
            if( validate_heaing( form_data.get( "content" ) ) )
            {
                shw_msg("none","none","red");
                if( form_data.get( "token" ).length!==0 )
                {
                    shw_msg("none","none","red");
                    set_data(form_data);
                }
                else
                {
                    shw_msg("err","Please refersh the page","red");
                }
            }
            else
            {
                shw_msg("err","Content only contains A-Z , a-z , 0-9 , : , - and + from 5 to 1000 characters","red");
            }
        }
        else
        {
            shw_msg("err","Only JPEG,PNG,JPG images","red");
        }
    }
    else
    {
        shw_msg("err","Heading only contains A-Z , a-z , 0-9 , : , - and + from 5 to 30 characters","red");
    }
})


function set_data(form)
{
    document.getElementById("submit").value="Posting ...";
    $.ajax({
        url:"set_article.php",
        type:"POST",
        data:form,
        contentType:false,
        processData:false,
        success:function(data)
        {
            shw_msg("none","none","red");
            data=$.parseJSON( data );
            if(data.status=="success" && data.data=="success")
            {
                shw_msg("none","none","red");
                document.getElementById("head").value='';
                document.getElementById("imag").value='';
                document.getElementById("main").value='';
                shw_msg("err","Successfully post uploded","green")
            }
            else
            {
                shw_msg("err",data.data,"red");
            }
            document.getElementById("submit").value="Post";
        }
    })
}


function shw_msg(type,data,clr)
{
    let dis="none";
    let opa=0;
    if(type=="err")
    {
        dis="block";
        opa=1;
    }
    error_con.innerText=data;
    error_con.style.display=dis;
    error_con.style.opacity=opa;
    error_con.style.backgroundColor=clr;
}

function validate_heaing(val,type)
{
    if(val.length>0){
        // if(type==0)
        // {
        //     // var rgx=/^[A-Za-z]{5,30}$/;
        //     // return ( val.length>0 && val.length<30 );
        //     return ( val.length>0 );
        // }
        // else
        // {
        //     // var rgx=/^[A-Za-z0-9\-\+\:]{5,10000}$/;
        //     return ( val.length>5 && val.length<10000 );
        // }
        return true;
    }else{
        return false;
    }
}

function validate_img(img){
    if(img.name!=''){
        var res=validTypes.includes(img.name.substring(img.name.lastIndexOf(".")+1).toUpperCase());
        if(res){
            return true;
        }else{
            return false;
        }           
    }
    else{
        return false;
    }
}

function image(){
    var files=this.files[0];
    change_img(files,select);
}


function change_img(files,inp){
    if(inp.value!=''){
        shw_msg("none","none","red");
        var res=validTypes.includes(files.name.substring(files.name.lastIndexOf(".")+1).toUpperCase());
        if(res){
            shw_msg("none","none","red");
            document.getElementById("lab_up").innerText=files.name.substring(files.name.lastIndexOf(".")+1).toUpperCase()+" File";
            return true;
        }else{
            shw_msg("err","Only JPEG,JPG,PNG images","red");
            return false;
        }
    }else{
        shw_msg("err","Plese Select a Image","red");
        return false;
    }
}
</script>