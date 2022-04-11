<?php
    define("A0(57%?<Fr@4**&__Admin___K#2*&(J^8392$()8347&^",true);
    require_once 'all.inc.nav.php';
    $admin_id=$_SESSION['ADMIN_ID'];
?>
<link rel="stylesheet" href="../all.min.style_sheet.dir/partner_home.css">
<link rel="stylesheet" href="admin.style.all.files/get.app.partners.css">
        <div class="allContner">
            <div class="error_continer" id="error_continer">
                <span class="error_msg" id="error_msg">Error Occured</span>
            </div>
            <div id="loading"></div>
            <div class="main_head_con">
                <div class="myactv">All Partners</div>
            </div>
            </div>
            <input type="hidden" id="token" value="<?=token("GET_PARTNER_DATA_FULL")?>" >
            <div class="table_con">
                <table class="reffer_table" border="1">
                    <thead  cell-padding="10">
                        <tr class="tr_head">
                            <th>Partner Name</th>
                            <th>Partner UID</th>
                        </tr>
                    </thead>
                    <tbody  id="table_activity_partner">
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>
<style>
    .home
    {
        background-color:rgba(0,0,0,0);
    }
</style>
<script>

var tkn=document.getElementById("token").value;
function get_partner(tkn)
{
    document.getElementById("loading").innerText="Please wait ..."
    $.ajax({
        url:"get.app.partners.data.php",
        type:"POST",
        data:{"get":true,"token":tkn},
        success:function(data)
        {
            data=$.parseJSON(data);
            if(data.status=="success")
            {
                err("none","none")
                partner_data=$.parseJSON(data.data);
                $.each(partner_data,function(key,value){
                    set(value[0],value[1]);
                })
            }
            else
            {
                err(data.data,"err")
            }
            document.getElementById("loading").innerText=" "
        }
    })
}
function set(name,id)
{
    let tr=document.createElement("tr");
    tr.id=id;

    let td1=document.createElement("td");
    let a=document.createElement("a");
    a.href="get_partner_all_data.php?uid="+id;
    a.innerText=name;
    td1.appendChild(a);

    let td2=document.createElement("td");
    td2.innerText=id;

    tr.appendChild(td1)
    tr.appendChild(td2)
    document.getElementById("table_activity_partner").appendChild(tr);
}
function err(data,type)
{
    let dis="none";
    let opa=0;
    if(type=="err")
    {
        dis="block";
        opa=1;
    }
    document.getElementById("error_continer").style.display=dis;
    document.getElementById("error_continer").style.opacity=opa;
    document.getElementById("error_msg").innerText=data;
}
get_partner(tkn)
</script>