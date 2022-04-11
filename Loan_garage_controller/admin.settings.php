<?php
    define("A0(57%?<Fr@4**&__Admin___K#2*&(J^8392$()8347&^",true);
    require_once 'all.inc.nav.php';  
    $admin_id=$_SESSION['ADMIN_ID'];
?>
        <link rel="stylesheet" href="admin.style.all.files/admin.settings.css">
        <div class="whole_con">
            <div class="error_con" id="error_continer" >

            </div>
            <div class="sub_con">
                <div class="heading_con">
                    <h3 class="head_lab">
                        Settings
                    </h3>
                </div>
                <div class="con">
                    <input type="hidden" id="token" value="<?=token("COUNT_TOKEN")?>" >
                    <a href="get.app.loan.php"         class="items"> Approved Loans    <span class="count"> <span id="app_loan_lab">    0</span>/ <span id="all_loan_lab_one">    0 </span> </span></a>
                    <a href="get.app.partners.php"     class="items"> Approved Partners <span class="count"> <span id="app_partner_lab"> 0</span>/ <span id="all_partner_lab_one"> 0 </span> </span></a>
                    <a href="get.rej.loan.php.php"     class="items"> Rejected Loans    <span class="count"> <span id="rej_loan_lab">    0</span>/ <span id="all_loan_lab_two">    0 </span> </span></a>
                    <a href="get.rej.partners.php.php" class="items"> Rejected Partners <span class="count"> <span id="rej_partner_lab"> 0</span>/ <span id="all_partner_lab_two"> 0 </span> </span></a>
                    <a href="articles.php"             class="items">  Add Articles</a>
                    <a href="../articles.home.php"      class="items"> Edit Articles</a>
                </div>
                <div class="loading_data" id="loading_data_id">

                </div>
            </div>
        </div>
    </body>
</html>
<script>
    var tkn=document.getElementById("token").value;
    var error_con=document.getElementById("error_continer");
    var load=0     ;
    var all_loan   ;
    var all_partner;
    var app_loan   ;
    var app_partner;
    var rej_loan   ;
    var rej_partner;
    count_rec( tkn,"all_loan"    );
    count_rec( tkn,"all_partner" );
    count_rec( tkn,"app_loan"    );
    count_rec( tkn,"app_partner" );
    count_rec( tkn,"rej_loan"    );
    count_rec( tkn,"rej_partner" );

    function count_rec(tkn,type)
    {
        document.getElementById("loading_data_id").innerText="Getting Data...";
        $.ajax({
            url:"count_rec.php",
            type:"POST",
            data:{"token":tkn,"type":type},
            success:function(data)
            {
                data=$.parseJSON(data);
                if( Object.keys(data).length===2 )
                {
                    if(data.status=="success"){
                        switch(type)
                        {
                            case "all_loan":all_loan=data.data;
                            break;
                            case "all_partner":all_partner=data.data;
                            break;
                            case "app_loan":app_loan=data.data;
                            break;
                            case "app_partner":app_partner=data.data;
                            break;
                            case "rej_loan":rej_loan=data.data;
                            break;
                            case "rej_partner":rej_partner=data.data;
                            break;
                        }
                        load++;
                        set(load);
                    }else{
                        __err__(data.data,"red");
                    }
                }
                else
                {
                    __err__("Error occured","red");
                }
            }
        })
    }
function set(load)
{
    if(load>=6)
    {
        document.getElementById( "all_loan_lab_one"   ).innerText=change( all_loan    );
        document.getElementById( "all_partner_lab_one").innerText=change( all_partner );
        document.getElementById( "all_loan_lab_two"   ).innerText=change( all_loan    );
        document.getElementById( "all_partner_lab_two").innerText=change( all_partner );

        document.getElementById("app_loan_lab"   ).innerText=change( app_loan    ) ;
        document.getElementById("app_partner_lab").innerText=change( app_partner ) ;
        document.getElementById("rej_loan_lab"   ).innerText=change( rej_loan    ) ;
        document.getElementById("rej_partner_lab").innerText=change( rej_partner ) ;

        document.getElementById("loading_data_id").innerText="";
    }
}

function  __err__(data,clr)
{
    error_con.innerText=data;
    error_con.style.color=clr;

}

function change(val)
{
    if(val>=1000)
    {
        if(val>=1000000)
        {
            return (val/1000000)+"M";
        }
        else
        {
            return (val/1000)+"K";
        }
    }
    else
    {
        return val;
    }
}
</script>