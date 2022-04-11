<?php
require_once 'all.inc.fle.php.dir/al-fun-form-functions.php';
if( isset( $_SESSION['SUCCESS_GO_TO'] ) && $_SESSION['SUCCESS_GO_TO']===true )
{
    show_data( "Thank you for your Application","Our team will get in touch with you at the earliest" );
    unset( $_SESSION['SUCCESS_GO_TO'] );
}
else
{
    header("location:index.php");
}

function show_data( $msg_heading,$msg_con )
    {

        $themecolor="#94f873";
        $title="Success"
?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1,user-scalable=no">
            <meta name="theme-color" content="<?=$themecolor?>">
            <meta name="apple-mobile-web-app-capable" content="yes">
            <meta name="apple-mobile-web-app-status-bar-style"  content="<?=$themecolor?>">
            <link rel="shortcut icon" href="./logo_pictures.dir/1.5.1.43.2.4.5.6.7.77.77.8.8.8.9.2.2.34.4.logo.4443.44967.gif">
            <link rel="stylesheet" href="all.min.style_sheet.dir/success.css">
            <link rel="stylesheet" href="font-icons/css/all.min.css">
            <title><?=$title?></title>
        </head>
        <body>
            <div class="whole_con">
                <div class="sub_con">
                    <div class="icon_con">
                        <i class="far cus fa-check-circle"></i>
                        <!-- <i class="fas cus fa-check-circle"></i> -->
                    </div>
                    <div class="text_con">
                        <span class="main_text">
                            <?=$msg_heading?>
                        </span>
                        <span class="sub_text">
                            <?=$msg_con?>
                        </span>
                        <a href="index.php" class="cus_anc">Go Back</a>
                    </div>
                </div>
            </div>
        </body>
<?php
    }
?>