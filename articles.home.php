<?php 
        require_once 'all.inc.fle.php.dir/inc.fle.php';
        define("A0(57%?<Fr@4**&K#2*&(J^8392$()8347&^",true);
    ?>
        <link rel="stylesheet" href="all.min.style_sheet.dir/articles.home.css">
        <title>Articles</title>
    </head>
    <body class="body">
        <div class="loader_con">
            <div class="loading">
            </div>
        </div>
        <style>
            .loader_con
            {
                background-color:rgb(218 218 218 / 0.7);
                height:100vh;
                width:100%;
                position:absolute;
                display:flex;
                justify-content:center;
                align-items:center;
                z-index:1;
            }
            .loading
            {
                height:50px;
                width:50px;
                border-top:5px solid #11e311;
                border-radius:50%;
                animation:rotate 1s infinite;
            }
            @keyframes rotate
            {
                from
                {
                    transform:rotate(0deg);
                }
                to
                {
                    transform:rotate(360deg);
                }
            }
        </style>
        <script>
            window.addEventListener("load",()=>{
                document.querySelector(".loader_con").style.display="none";
            })
        </script>
        <div class="continer_page">
            <?php 
                require_once 'all.inc.fle.php.dir/nav.bar.full.inc.php';
                require_once 'all.inc.fle.php.dir/al-fun-form-functions.php';
            ?>
            <input type="hidden" id="GET_ALL_ARTICLES" value="<?=token("GET_ALL_ARTICLES")?>">
            <div class="continer_content">
                <div class="error_con" id="error_con_id" >
                    error
                </div>
                <div class="all_art_con" id="set_article">
                </div>
            </div>
            <?php
                require_once 'all.inc.fle.php.dir/footer.full.inc.php';
            ?>
        </div>
    </body>
</html>

<script>

    var error_con=document.getElementById("error_con_id");
    function set_article(id,heading,content)
    {
        let a=document.createElement("a");
        a.href="article.full.details.php?uid="+id;
        a.classList.add("go_to");
        
        let sng_con=document.createElement("div");
        sng_con.classList.add("single_art_con");

        let head_con=document.createElement("div");
        head_con.classList.add("heading_art_con");
        sng_con.appendChild(head_con);

        let h3=document.createElement("h3");
        if(heading.length>49)
        {
            heading=heading.slice(0,46)+"...";
        }
        h3.innerText=heading;
        head_con.appendChild(h3);

        if(content.length>=75)
        {
            content=content.slice(0,71)+"...";
        }

        let p=document.createElement("p");
        p.classList.add("some_info_span");
        p.innerText=content;
        sng_con.appendChild(p);
        
        a.appendChild( sng_con );
        document.getElementById("set_article").appendChild(a);

    }
function get_articles (tkn)
{
    $.ajax({
        url:"get_all_articles.php",
        type:"POST",
        data:{"tkn":tkn},
        success:function(data)
        {
            if( Object.entries(data).length>0 ){
                data=$.parseJSON(data);
                if(data.constructor==Object){
                    if(data.status=="success"){
                        data.data.forEach(element => {
                            if( Object.entries(element).length>0 ){
                                element=$.parseJSON(element);
                                set_article(element.id,element.heading,element.content);
                            }else{
                                __set_error("Something went wrong. Please Retry");
                            }
                        });
                    }else{
                        __set_error(data.data)
                    }
                }else{
                    __set_error("Something went wrong. Please Retry");
                }
            }else{
                __set_error("Please Refresh Page..");
            }
        }
    })
}

get_articles( document.getElementById("GET_ALL_ARTICLES").value );

function __set_error(data)
{
    error_con.style.display="block";
    error_con.style.opacity=1;
    error_con.innerText=data;

}
</script>