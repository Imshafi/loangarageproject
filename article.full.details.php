<link rel="stylesheet" href="all.min.style_sheet.dir/article.full.details.css">

<?php

if( isset( $_GET['uid'] ) && is_numeric( $_GET['uid'] )&& ($_GET['uid']>0) )
{
    require_once 'all.inc.fle.php.dir/al-fun-form-functions.php';
    require_once 'all.min.sub.php.dir/connection.all.min.php';
    require_once 'all.inc.fle.php.dir/inc.fle.php';
    define("A0(57%?<Fr@4**&K#2*&(J^8392$()8347&^",true);

    $id=xss_val( $con,$_GET['uid'] );
    $stmt=mysqli_prepare( $con,"SELECT `heading`,`img`,`content`,`time` FROM `articles` WHERE `id`=?" );
    if( $stmt )
    {
        mysqli_stmt_bind_param( $stmt,"i",$id );
        mysqli_stmt_bind_result( $stmt,$heading,$img,$content,$time );
        $exe=mysqli_stmt_execute( $stmt );
        if( $exe && mysqli_stmt_fetch( $stmt ) )
        {
            if( !empty( $heading  ) && !empty( $img  ) && !empty( $content  ) && !empty( $time  ) )
            {
                $heading=xss_val( $con,$heading );
                $img=xss_val( $con,$img );
                $content=xss_val( $con,$content );
                $time=xss_date( $time );
                $content = edit_art( $content );
                set_result($heading,$img,$content,$time,$id);
            }
            else
            {
                error("Something went wrong");
            }
        }
        else
        {
            error("Data not found");
        }

        mysqli_stmt_close( $stmt );
    }
    else
    {
        error("Something wrong please retry...");
    }
}
else
{
    header("location:index.php");
}

function error($data)
{
    echo "<!DOCTYPE html><html><head><title>Data not found</title></head><body><div class='error_con'>$data</div></body></html>";
}

function set_result($heading,$img,$content,$time,$id)
{
?>
        <title><?=$heading?></title>
    </head>
    <body>
        <div class="whole_con">
            <div class="heading_con" id="heading_edit_art">
                <h1><?=$heading?></h1>
            </div>
            <div class="sub_con">
                <img src="web.picture.dir/articles.images/<?=$img?>" alt="<?=$heading?>" class="img_art">
                <div class="content_con" id="content_edit_art">
                    <?=$content?>
                </div>
            </div>
            <br>
            <div class="back">
                <a href="articles.home.php" class="go_back">Go Back</a>
            </div>
        </div>
        <?php
            if( isset($_SESSION['ADMIN_LOGIN_STATUS'])   AND isset($_SESSION['ADMIN_ID'])       AND         
                !empty($_SESSION['ADMIN_LOGIN_STATUS'])  AND !empty($_SESSION['ADMIN_ID'])      AND       
                is_bool($_SESSION['ADMIN_LOGIN_STATUS']) AND is_numeric($_SESSION['ADMIN_ID'])  AND
                $_SESSION['ADMIN_LOGIN_STATUS']==true    AND $_SESSION['ADMIN_ID']==1)
            {
                    set_edit_mode($id);
            }
        ?>
    </body>
</html>
<?php
}

function set_edit_mode($id)
{?>
    <div class="del_con">
        <button id="del_article_admin" class="btn-del">Delete Article</button>
    </div>
    <div class="del_con" style="float:left">
        <button oncick="get()" id='save_content' class="btn-del" style="background-color:#11e311">Save Article</button>
    </div>
    <input type="hidden" value="<?=token('EDIT_ARTICLE_TOKEN')?>" id="change_article_token">
    <div class="error_art" id="error_con_art">
    </div>
    <script>
        var heading   = document.getElementById("heading_edit_art");
        var text      = document.getElementById("content_edit_art");
        var error_con = document.getElementById("error_con_art");
        heading.setAttribute("contenteditable",true);
        text.setAttribute("contenteditable",true);
        document.getElementById("save_content").addEventListener('click',()=>{
            document.getElementById("save_content").innerText="Saving...";
            error_con.style.display = 'none';
            $.ajax({
                url     : "save_article.php",
                type    : "POST",
                data    : {token:document.getElementById("change_article_token").value,article_id:"<?=$id?>",heading:heading.innerText,content:text.innerText},
                success : function(e)
                {
                    document.getElementById("save_content").innerText="Save Article";
                    var data=$.parseJSON(e);
                    if( data.data === "success" && data.status ==="success" )
                    {
                        document.getElementById("save_content").innerText="Article Saved";
                        error_con.style.display = 'none';
                    }
                    else
                    {
                        error_con.innerText     = data.data;
                        error_con.style.display = 'block';
                    }
                }
            })
        })
        document.getElementById("del_article_admin").addEventListener('click',()=>{
            error_con.style.display = 'none';
             document.getElementById("del_article_admin").innerText="Please Wait...";
            $.ajax({
                url     : "del_art.php",
                type    : "POST",
                data    : {token:document.getElementById("change_article_token").value,article_id:"<?=$id?>"},
                success : function(e)
                {
                    document.getElementById("del_article_admin").innerText="Save Article";
                    var data=$.parseJSON(e);
                    if( data.data === "success" && data.status ==="success" )
                    {
                        document.getElementById("del_article_admin").innerText="Article Deleted";
                        error_con.innerHTML = 'Article has been deleted  <a href="articles.home.php" style="color:#11e311">Go To Back</a>';
                        error_con.style.display = 'block';
                    }
                    else
                    {
                        error_con.innerText     = data.data;
                        error_con.style.display = 'block';
                    }
                }  
            })
        })
        

    </script>
<?php
}
?>